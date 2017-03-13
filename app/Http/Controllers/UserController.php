<?php
/**
 * Created by PhpStorm.
 * User: elbachirnouni
 * Date: 06/03/2017
 * Time: 17:00
 */

namespace App\Http\Controllers;


use App\Business\Console\DbConsoleLog;
use App\Business\Constants\LoggableTypes;
use App\Business\Exception\BusinessException;
use App\Business\Services\NewUserService;
use App\Http\Requests\NewUserRequest;
use App\Models\ConsoleLog;
use App\Models\ImportedClientLine;
use App\Models\ImportedFile;
use App\Models\MandateStateLog;
use App\User;
use Illuminate\Http\Response;
use Illuminate\Pagination\Paginator;

class UserController extends Controller
{

    /**
     * @return Response
     */
    public function index()
    {
        //List all imported files
        $page_size = $this->page_size();
        /** @var Paginator $users */
        $users = User::orderBy('created_at', 'desc')
            ->paginate($page_size)
            ->appends('page_size', $page_size)
            ->setPath(route('users_list'));

        return view('users.index', [
            'users' => $users
        ]);
    }

    /**
     * @param NewUserRequest $request
     * @param NewUserService $service
     * @return Response
     */
    public function store(NewUserRequest $request,
                          NewUserService $service,
                          DbConsoleLog $dbConsoleLog)
    {
        $response = null;
        try {
            $service->register($request->getName(), $request->getPassword(), $request->getEmail());
            $this->flash('success', "User created successfully.");
            $dbConsoleLog->info(sprintf('User %s created successfully.', $request->getName()), [
                'loggable_type' => LoggableTypes::USER_MANAGEMENT
            ]);

            $response = redirect()->route('users_list');

        } catch (BusinessException $be) {
            $this->flash('error', $be->getMessage());
            $response = $this->index();
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            $this->flash('error', 'Technical error. Contact the administrator.');
            $response = $this->index();
        }
        return $response;
    }

    /**
     * @return Response
     */
    public function logs()
    {
        $logs = [];

        try {
            $page_size = $this->page_size();

            $logs = ConsoleLog::where('loggable_type', '=', LoggableTypes::USER_MANAGEMENT)
                ->orderBy('created_at', 'desc')
                ->paginate($page_size)
                ->appends('page_size', $page_size)
                ->setPath(route('users_logs'));

            $response = view('users.logs', [
                'console_logs' => $logs
            ]);
        } catch (BusinessException $be) {
            $this->flash('error', $be->getMessage());
            $response = view('users.logs', [
                'console_logs' => $logs
            ]);
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            $this->flash('error', 'Technical error. Contact the administrator.');
            $response = view('users.logs', [
                'console_logs' => $logs
            ]);
        }

        return $response;
    }

    /**
     * @param string $id file id
     * @param DbConsoleLog $dbConsoleLog
     * @return mixed
     */
    public function delete($id, DbConsoleLog $dbConsoleLog)
    {
        try {
            $user = User::find($id);
            if ($user instanceof User) {
                if (!$user->deletable)
                    throw new BusinessException('You can\'t delete this user');

                $user->delete();
                $this->flash('info', sprintf('User %s deleted successfully', $user->name));
                $dbConsoleLog->info(sprintf('User %s deleted successfully', $user->name),
                    [
                        'loggable_type' => LoggableTypes::USER_MANAGEMENT,
                        'loggable_id' => $id
                    ]);
            } else {
                $this->flash('warning', sprintf('User with id "%s" not found', $id));
            }
        } catch (BusinessException $be) {
            $this->flash('error', $be->getMessage());
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            $this->flash('error', 'Technical error. Contact the administrator.');
        }

        return redirect()->route('users_list');
    }
}
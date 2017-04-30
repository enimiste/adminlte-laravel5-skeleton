<?php
/**
 * Created by PhpStorm.
 * User: elbachirnouni
 * Date: 30/04/17
 * Time: 21:29
 */

namespace App\Http\Controllers\Api;

use App\Business\Exception\BusinessException;
use Illuminate\Http\Exception\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;

abstract class Controller extends BaseController
{

    /**
     * @return JsonResponse
     */
    public function example()
    {
        $this->canI('your permession key');

        try {
            //Without the "data" key
            return $this->ok([
                'message' => 'good',
                'id' => 1
            ]);
        } catch (BusinessException $e) {
            return $this->error4xx($e->getErrors());
        } catch (\Exception $e) {
            return $this->error5xx([$e->getMessage()], $e);
        }
    }

    /**
     * Should be called out of a try/catch bloc
     *
     * @param string $permissionCode
     * @throws HttpResponseException
     */
    protected function canI($permissionCode)
    {
        if (!can_i($permissionCode))
            throw new HttpResponseException(new JsonResponse([
                'auth_errors' => [
                    "You don't have access to this resource"
                ]
            ], 403));
    }

    /**
     * @param array $data
     * @return JsonResponse
     */
    protected function ok($data = [])
    {
        return new JsonResponse(
            [
                'data' => $data
            ], 200
        );
    }

    /**
     * @param array $errors
     * @param array $input_errors
     * @param int $code
     * @return JsonResponse
     */
    protected function error4xx(array $errors, array $input_errors = [], $code = 400)
    {
        $data = [
            'errors' => $errors,
        ];
        if (!empty($input_errors))
            $data['input_errors'] = $input_errors;

        return new JsonResponse(
            $data,
            $code
        );
    }

    /**
     * @param array $errors
     * @param \Exception $ex
     * @param int $code
     * @return JsonResponse
     */
    protected function error5xx(array $errors, \Exception $ex = null, $code = 500)
    {
        if ($ex != null)
            \Log::error($ex->getTraceAsString());

        return new JsonResponse(
            [
                'errors' => $errors,
            ], $code
        );
    }
}
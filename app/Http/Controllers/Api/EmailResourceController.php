<?php
/**
 * Created by PhpStorm.
 * User: elbachirnouni
 * Date: 29/03/17
 * Time: 12:32
 */

namespace Org\Asso\Http\Controllers\Api;


use App\Business\Assert\AssertThat;
use App\Http\Controllers\Api\Controller;
use Illuminate\Contracts\Cache\Repository;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Http\Response;

class EmailResourceController extends Controller
{
    /**
     * @var Repository
     */
    private $cache;
    /**
     * @var Filesystem
     */
    private $filesystem;


    /**
     * @param Repository $cache
     * @param Filesystem $filesystem
     */
    function __construct(Repository $cache, Filesystem $filesystem)
    {
        $this->cache = $cache;
        $this->filesystem = $filesystem;
    }

    /**
     * @param $token
     * @return Response
     */
    public function read($token)
    {
        try {
            $meta = $this->cache->get($token, null);
            if ($meta == null)
                return new Response('Invalid Token', 404);

            AssertThat::true(array_key_exists('model_id', $meta), 'Invalid resource meta. Key model_id not setted');
            AssertThat::true(array_key_exists('model_class', $meta), 'Invalid resource meta. Key model_class not setted');
            AssertThat::true(array_key_exists('resource_path', $meta), 'Invalid resource meta. Key resource_path not setted');

            $model_id = $meta['model_id'];
            $model_class = $meta['model_class'];
            $resource_path = $meta['resource_path'];

            $fs = $this->filesystem;
            if (!$fs->exists($resource_path)) {
                return new Response('Resource not found', 404);
            } else {
                $path = $this->moveToTempFile($fs, $resource_path);
                return response()->download($path, basename($path));
            }
        } catch (\Exception $e) {
            \Log::critical($e->getMessage());
            return new Response($e->getMessage(), 500);
        }

    }

    /**
     * @param Filesystem $fs
     * @param string $fsPath
     *
     * @return string
     * @throws \Error
     * @throws \Exception
     * @throws \TypeError
     */
    protected function moveToTempFile(Filesystem $fs, $fsPath)
    {
        return move_from_fs_to_temp_file($fs, $fsPath);
    }
}
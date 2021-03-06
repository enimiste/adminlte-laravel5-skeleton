<?php
/**
 * Created by PhpStorm.
 * User: elbachirnouni
 * Date: 08/02/2017
 * Time: 20:08
 */

namespace App\Http\Controllers\Api\Security;


use App\Business\Exception\BusinessException;
use App\Http\Controllers\Api\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\JWTAuth;

class AuthController extends Controller
{

    /**
     * @ApiDoc(
     *     description="Authenticate a given use",
     *     url="/api/auth/login",
     *     method="POST",
     *     input={
     *        "email":"",
     *        "password":""
     *     },
     *     inputMetaData={
     *        "password":"Clear password"
     *     },
     *     output={
     *        "data":{
     *           "token":"",
     *           "permissions":['permission1', 'permission2',...],
     *           "profil_metier":'code profil'
     *        },
     *        "errors":[]
     *     },
     *     statusCode={"400","500","200"}
     * )
     * @param Request $request
     * @param JWTAuth $jWTAuth
     * @return JsonResponse
     */
    public function authenticate(Request $request, JWTAuth $jWTAuth)
    {
        try {// grab credentials from the request
            $credentials = $request->only('email', 'password');

            // attempt to verify the credentials and create a token for the user
            if (!$token = $jWTAuth->attempt($credentials))
                throw new BusinessException('invalid_credentials');

            return new JsonResponse(
                [
                    'data' => [
                        'token' => $token,
                        'permissions' => [],
                    ]
                ], 200
            );
        } catch (BusinessException $bex) {
            \Log::error('BusinessException : ' . $bex->getTraceAsString());
            return new JsonResponse(
                [
                    'errors' => $bex->getErrors(),
                ], 400
            );
        } catch (JWTException $e) {
            \Log::error('JWTException : ' . $e->getTraceAsString());

            return new JsonResponse(
                [
                    'errors' => ['Could Not Create Token'],
                ], 500
            );
        } catch (\Exception $ex) {
            \Log::error('Exception : ' . $ex->getTraceAsString());

            return new JsonResponse(
                [
                    'errors' => [$ex->getMessage()],
                ], 500
            );
        }
    }

    /**
     * @ApiDoc(
     *     description="Logout a given use",
     *     url="/api/auth/logout",
     *     method="GET",
     *     output={
     *        "data": {"message":""},
     *        "errors":[]
     *     },
     *     statusCode={"400","500","200"}
     * )
     * @param Request $request
     * @param JWTAuth $jWTAuth
     * @return JsonResponse
     */
    public function logout(Request $request, JWTAuth $jWTAuth)
    {
        try {
            $token = $jWTAuth->setRequest($request)->getToken();
            $jWTAuth->invalidate($token);

            return new JsonResponse(
                [
                    'data' => [
                        'message' => 'Logout successfully'
                    ],
                ], 200
            );
        } catch (BusinessException $bex) {
            \Log::error('BusinessException : ' . $bex->getTraceAsString());
            return new JsonResponse(
                [
                    'errors' => $bex->getErrors(),
                ], 400
            );
        } catch (JWTException $e) {
            \Log::error('JWTException : ' . $e->getTraceAsString());

            return new JsonResponse(
                [
                    'errors' => ['Could Not Create Token'],
                ], 500
            );
        } catch (\Exception $ex) {
            \Log::error('Exception : ' . $ex->getTraceAsString());

            return new JsonResponse(
                [
                    'errors' => [$ex->getMessage()],
                ], 500
            );
        }
    }
}
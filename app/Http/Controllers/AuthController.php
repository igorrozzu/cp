<?php
/**
 * Created by PhpStorm.
 * User: igorrozu
 * Date: 12/4/18
 * Time: 1:07 AM
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;


class AuthController extends Controller
{
    /**
     * @var Request
     */
    private $request;

    /**
     * AuthController constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }


    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $credentials = $this->request->only('email', 'password');

        $token = null;
        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json([
                    'message' => 'invalid_email_or_password',
                ], 401);
            }
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 500);
        }
        JWTAuth::setToken($token);
        return response()->json([
            'token' => $token,
            'user' => JWTAuth::toUser()
        ]);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAuthUser()
    {
        $token = $this->request->cookie('token');
        if ($token) {
            JWTAuth::setToken($token);
            return response()->json(JWTAuth::toUser());
        } else {
            return response()->json('', 401);
        }
    }
}
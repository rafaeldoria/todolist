<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use App\Services\ResponseService;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Exception;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        
        try {
            if (!$token = auth()->attempt($credentials)) {
                throw new \Exception('Unauthorized.', -401);
            }
        } catch (\Throwable|\Exception $e) {
            return ResponseService::exception('auth.login', null, $e);
        }
        // $expires_in = auth()->factory()->getTTL() * 60;
        return response()->json(compact('token'));
    }

    public function logout()
    {
        try {
            auth()->logout();
        } catch (\Throwable|Exception $e) {
            return ResponseService::exception('auth.logout', null, $e);
        }
        return response(['status' => true,'msg' => 'Logout success'], 200);
    }

    public function refresh()
    {
        return JWTAuth::refresh();
    }

    public function validToken(){
        return response()->json(['message' => 'success', 'status' => 200, 'token' => '']);
    }
}

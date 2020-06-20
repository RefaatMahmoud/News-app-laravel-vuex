<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    use ApiResponseTrait;

    public function __construct()
    {
        $this->middleware('auth:api')->except('login');
    }

    public function login(UserRequest $request)
    {
        $credentials = $request->only(['email', 'password']);
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('Personal Access Token')->accessToken;
            return $this->returnSuccessResponse(
                [
                    'user'  => $user,
                    'token' => $token,
                ],
                Response::HTTP_OK
            );
        } else {
            return $this->returnErrorResponse(
                'invalid credentials , try with correct email and password',
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }
    }

    public function logout(Request $request)
    {
        Auth::user()->token()->revoke();
        return $this->returnSuccessResponse(
            [
                'message' => 'user logout successfully',
            ],
            Response::HTTP_OK
        );
    }
}

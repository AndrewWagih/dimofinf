<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserLoginRequest;
use Illuminate\Http\Request;
use App\Http\Services\UserAuthService;
use App\Http\Requests\UserRequest;
class AuthController extends Controller
{
    protected $userAuthService;

    public function __construct(UserAuthService $userAuthService)
    {
        $this->userAuthService = $userAuthService;
    }

    public function register(UserRequest $request){
        return $this->userAuthService->register($request->validated());
    }

    public function login(UserLoginRequest $request){
        return  $this->userAuthService->login($request->validated());
    }
}

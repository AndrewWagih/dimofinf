<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminLoginRequest;
use App\Http\Services\AdminAuthService;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
class AuthController extends Controller
{
    protected $adminAuthService;

    public function __construct(AdminAuthService $adminAuthService)
    {
        $this->adminAuthService = $adminAuthService;
    }

    public function login(AdminLoginRequest $request){
        $login = $this->adminAuthService->login($request->validated());
        if($login){
            return $this->success('sing in successfully');
        }else{
            throw ValidationException::withMessages([
                "password" => "The password is incorrect",
            ]);
        }
    }

    public function loginForm(){
        return view('auth.admin_login');
    }
}

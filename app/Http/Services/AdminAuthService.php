<?php
namespace App\Http\Services;

class AdminAuthService
{
    public function login($data){
        if(auth('admin')->attempt(['email'=>$data['email'],'password' => $data['password']])){
            return true;
        }else{
            return false;
        }
    }
}

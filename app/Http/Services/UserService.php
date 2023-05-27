<?php
namespace App\Http\Services;

class UserService{
    
    public function getProfileData(){
        return auth()->user();
    }
}
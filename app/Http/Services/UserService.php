<?php
namespace App\Http\Services;

use App\Models\User;

class UserService{
    
    public function getProfileData(){
        return auth()->user();
    }

    public function all(){
        return User::get();   
    }
    public function store($data){
        User::create($data);
        return true;
    }

    public function update($data,$user){
        $user->update($data);
        return true;
    }

    public function destroy($user){
        $user->delete();
        return  true;
    }

    
}
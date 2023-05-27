<?php
namespace App\Http\Services;
use App\Models\Admin;

class AdminService
{
    public function store ($data){
        Admin::create($data);
        return true;
    }

    public function update($data,$admin){
        $admin->update($data);
        return true;
    }

    public function destroy($admin){
        $admin->delete();
        return  true;
    }
}
<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRequestRequest;
use App\Http\Services\AdminService;
use App\Models\Admin;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    protected $adminService;

    public function __construct(AdminService $adminService)
    {
        $this->adminService = $adminService;
    }

    public function index(Request $request)
    {

        if ($request->ajax()){
            $data = getModelData( model: new Admin(), andsFilters: [['email', '!=', 'employee@demofinf.net']] );
            return response()->json($data);
        }
        return view('dashboard.admins.index');
    }

    public function create(){
        return view('dashboard.admins.create');
    }
    public function store(AdminRequestRequest $request){
        $admin = $this->adminService->store($request->validated());
        return  $this->success('Admin added successfully');
    }

    public function edit(Admin $admin){
        return view('dashboard.admins.edit',compact('admin'));
    }
    public function update(AdminRequestRequest $request,Admin $admin){
        $admin = $this->adminService->update($request->validated(),$admin);
        return  $this->success('Admin updated successfully');
    }

    public function destroy(Admin $admin){
        $admin = $this->adminService->destroy($admin);
        if($admin){
            return $this->success('Admin deleted successfully');
        }else{
            return $this->failure('something wrong!!',500);
        }
    }
}

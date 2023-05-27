<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Services\UserService;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index(Request $request)
    {

        if ($request->ajax()){
            $data = getModelData( model: new User() );
            return response()->json($data);
        }
        return view('dashboard.users.index');
    }

    public function create(){
        return view('dashboard.users.create');
    }
    

    public function store(UserRequest $request){
        $user = $this->userService->store($request->validated());
        if($user){
            return $this->success('User added successfully');
        }else{
            return $this->failure('something wrong!!',500);
        }
    }
    public function edit(User $user){
        return view('dashboard.users.edit',compact('user'));
    }

    public function update(UserRequest $request,User $user){
        $user = $this->userService->update($request->validated(),$user);
        if($user){
            return $this->success('User updated successfully');
        }else{
            return $this->failure('something wrong!!',500);
        }
    }

    public function destroy(User $user){
        $user = $this->userService->destroy($user);
        if($user){
            return $this->success('User deleted successfully');
        }else{
            return $this->failure('something wrong!!',500);
        }
    }
}

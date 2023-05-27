<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Http\Services\PostService;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Resources\PostListResource;
use App\Http\Services\UserService;

class PostController extends Controller
{
    
    protected $postService;
    protected $userService;

    public function __construct(PostService $postService,UserService $userService)
    {
        $this->postService = $postService;
        $this->userService = $userService;
    }

    public function index(Request $request){
        if ($request->ajax()){
            $data = getModelData( model: new Post(),relations :  [ 'user' => ['id','username'] ]   );
            return response()->json($data);
        }
        return view('dashboard.posts.index');
    }

    public function create(){
        $users = $this->userService->all();
        return view('dashboard.posts.create',compact('users'));
    }

    public function store(PostRequest $request){
        $post = $this->postService->store($request->validated());
        return $this->success('Post added successfully');
    }

    public function edit(Post $post){
        $users = $this->userService->all();
        return view('dashboard.posts.edit',compact('post','users'));
    }

    public function update(PostRequest $request,Post $post){
        $post = $this->postService->update($request->validated(),$post);
        return $this->success('Post updated successfully');
    }

    public function destroy(Post $post){
        $post = $this->postService->destroy($post);
        return $this->success('Post deleted successfully');
    }
}

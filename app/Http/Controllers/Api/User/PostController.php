<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Http\Services\PostService;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Resources\PostListResource;

class PostController extends Controller
{
    protected $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    public function allPosts(){
        $post = $this->postService->all();
        return $this->successWithPaginate('posts list',PostListResource::collection($post)->response()->getData(true));
    }

    public function index(Request $request){
        $post = $this->postService->userPosts($request->all());
        return $this->successWithPaginate('posts list',PostListResource::collection($post)->response()->getData(true));
    }

    public function store(PostRequest $request){
        $post = $this->postService->store($request->validated());
        $this->newUserNotification(auth('api')->user(),route('dashboard.posts.edit',$post->id),'post');
        return $this->success('Post  added successfully',$post);
    }

    public function show(Post $post){
        return $this->success('Post  added successfully',$post);
    }

    public function update(PostRequest $request,Post $post){
        $post = $this->postService->update($request->validated(),$post);
        return $this->success('Post data',$post);
    }

    public function destroy(Post $post){
        $post = $this->postService->destroy($post);
        return $this->success('Post deleted successfully',$post);
    }
}

<?php
namespace App\Http\Services;

use App\Models\Post;

class PostService{

    public function all(){
    
        return Post::with('user')->orderBy('id','DESC')->paginate(12);
    }
    public function userPosts($data=null){
        $posts = Post::query();
        if(auth('api')->check()){
            $posts = $posts->where('user_id',auth('api')->user()->id);
        }
        return $posts->orderBy('id','DESC')->paginate(12);
    }

    public function store($data){
        if(!isset($data['user_id'])){
            $data['user_id'] = auth('api')->user()->id;
        }
        $post = Post::create($data);
        return $post;
    }

    public function show($post){
        return $post;
    }

    public function update($data,$post){
        $post->update($data);
        return $post;
    }

    public function destroy($post){
        $post->delete();
        return $post;
    }
    
}
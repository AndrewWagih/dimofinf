<?php
namespace App\Http\Services;

use App\Models\Post;

use App\Models\User;
class ExportService
{
    public function exportUsers()
    {
        $users = User::whereBetween('created_at', [now()->subDays(1)->format('Y-m-d').' 00:00:00',now()->subDays(1)->format('Y-m-d').' 23:59:59'])->get()->map(function ($user) {
            return [
                'username' => $user->username,
                'mobile_number' => $user->mobile_number,
                'email' => $user->email,
            ];
        });
        return $users ;
    }

    public function exportPosts()
    {
        $posts = Post::with('user')->whereBetween('created_at', [now()->subDays(1)->format('Y-m-d').' 00:00:00',now()->subDays(1)->format('Y-m-d').' 23:59:59'])->get()->map(function ($post) {
            return [
                'title' => $post->title,
                'description' => $post->description,
                'contact_phone_number' => $post->contact_phone_number,
                'user' => $post->user->username
            ];
        });
        return $posts;
    }
}
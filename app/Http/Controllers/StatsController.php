<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\User;
use Illuminate\Http\Request;

class StatsController extends Controller
{
    public function getStats()
    {
        $total_users = User::count();
        $total_blogs = Blog::count();
        $users = User::latest()->limit(10)->get();
        $subscriptions = User::where('subscription', 2)
            ->where('subscription', 3)->count();

        return [
            'total_users' => $total_users,
            'total_blogs' => $total_blogs,
            'subscriptions' => $subscriptions,
            'users' => $users
        ];
    }

    public function getUsersStats()
    {
        return [
            'users' => User::latest()->get()
        ];
    }
}

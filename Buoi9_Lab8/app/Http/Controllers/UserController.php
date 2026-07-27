<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        // Eager Loading (with('profile')) giúp giảm số lượng câu truy vấn (tránh lỗi N+1 query)
        $users = User::with('profile')->paginate(10);
        return view('users.index', compact('users'));
    }
}

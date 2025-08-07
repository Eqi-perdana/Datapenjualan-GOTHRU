<?php

namespace App\Http\Controllers;

// Import model User
use App\Models\User;

// Import return type View
use Illuminate\View\View;

class UserController extends Controller
{
    /**
     * index
     *
     * @return View
     */
    public function index(): View
    {
        // get all users
        $users = User::latest()->paginate(10);

        // render view with users
        return view('users.index', compact('users'));
    }
}


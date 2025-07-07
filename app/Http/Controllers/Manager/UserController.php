<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('nom', 'asc')->paginate(10);
        return view('manager.users.index', compact('users'));
    }

    public function show(User $user)
    {
        return view('manager.users.show', compact('user'));
    }
}

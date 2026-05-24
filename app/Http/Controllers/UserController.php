<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('pages.users.index', compact('users'));
    }

    public function suspensions()
    {
        return view('pages.users.suspensions');
    }

    public function verifications()
    {
        return view('pages.users.verifications');
    }
}

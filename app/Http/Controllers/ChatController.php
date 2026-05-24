<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Professional;
use App\Models\Client;

class ChatController extends Controller
{
    public function index()
    {
        $professionals = Professional::take(3)->get();
        $clients = Client::take(2)->get();
        return view('pages.chat', compact('professionals', 'clients'));
    }
}

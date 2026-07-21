<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Professional;
use App\Models\Client;
use App\Models\Message;

class ChatController extends Controller
{
    public function index()
    {
        $professionals = Professional::take(3)->get();
        $clients = Client::take(2)->get();
        return view('pages.chat', compact('professionals', 'clients'));
    }

    public function send(Request $request)
    {
        $validated = $request->validate([
            'sender_id' => 'required',
            'receiver_id' => 'required',
            'content' => 'required|string',
        ]);

        Message::create($validated);

        return back()->with('success', 'Message sent!');
    }

    public function getMessages($receiverId)
    {
        $senderId = auth()->id();

        $messages = Message::where(function($q) use ($senderId, $receiverId) {
            $q->where('sender_id', $senderId)
              ->where('receiver_id', $receiverId);
        })->orWhere(function($q) use ($senderId, $receiverId) {
            $q->where('sender_id', $receiverId)
              ->where('receiver_id', $senderId);
        })->orderBy('created_at')->get();

        return response()->json($messages);
    }
}

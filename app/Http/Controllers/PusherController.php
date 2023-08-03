<?php

namespace App\Http\Controllers;

use App\Events\PusherBroadcast;
use Illuminate\Http\Request;

class PusherController extends Controller
{
    public function index()
    {
        return view('pusher.index');
    }
    public function broadcast(Request $request) {
        broadcast(new PusherBroadcast($request->message))->toOthers();
        return view('pusher.broadcast', [
            'message' => $request->message
        ]);
    }

     public function receive(Request $request) {
        return view('pusher.receive', [
            'message' => $request->message
        ]);
     }
}

<?php

namespace App\Http\Controllers\Chat;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function users(){
        $users = User::where('id','!=',Auth::user()->id)->get();
        return response()->json([
            'status' => 200,
            'users'  => $users
        ]);
    }
}

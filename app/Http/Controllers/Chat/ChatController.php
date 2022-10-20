<?php

namespace App\Http\Controllers\Chat;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Message;
use Illuminate\Database\Eloquent\Builder;
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

    public function getConversation(Request $request){
        $user = $request->id;
        $messages = Message::with('user')->where(['user_id'=>$user,'auth_id'=>Auth::user()->id])->orWhere(function ($query) use ($user) {
            $query->where(['user_id'=>Auth::user()->id, 'auth_id'=>$user]);
        })->get();


        return response()->json([
            'status' => 200,
            'message'=> $messages
        ]);
    }
}

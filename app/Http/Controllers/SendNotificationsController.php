<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use App\Models\User;

class SendNotificationsController extends Controller
{
    //
    public function index($id)
    {
        //
        $user =User::find(1);
        return   $user->unreadNotifications;
        foreach ($user->unreadNotifications as $notification) {
          return   $user->unreadNotifications;
        }
    }

    public function createnot(Request $request)
    {
        //
        return $request;
        $user=User::find($request->id);
        Notification::send($user,new  Otlop($request->title,$request->body));

    }
}

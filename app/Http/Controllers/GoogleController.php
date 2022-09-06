<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GoogleController extends Controller
{
    //

    public function sendNoti(Request $request){
        return $request;
            }
    public function index()
    {
        $locations = [
            ['Mumbai', 19.0760,72.8777],
            ['Pune', 18.5204,73.8567],
            ['Bhopal ', 23.2599,77.4126],
            ['Agra', 27.1767,78.0081],
            ['Delhi', 28.7041,77.1025],
            ['Rajkot', 22.2734719,70.7512559],
        ];
        return view('googleAutocomplete',compact('locations'));
    }
    public function getnot($id)
    {
        //
        $user = App\Models\User::find(1);
 
        foreach ($user->unreadNotifications as $notification) {
          return   $notification;
        }
    }
}

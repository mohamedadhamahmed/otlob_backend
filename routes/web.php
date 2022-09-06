<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\SendNotificationsController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'

    
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');

    })->name('dashboard');

});

Route::get('delete_chat', function () {
    Message::truncate();
    return redirect()->route('dashboard');

})->middleware(['auth'])->name('delete_chat');


Route::get('createnotification',[SendNotificationsController::class,'createnot']);

Route::get('shownotification/{id}',[SendNotificationsController::class,'index']);


Route::get('google-map', [GoogleController::class, 'index']);



Route::get('/sendnotification', function () {


    $SERVER_API_KEY = 'AAAAFwJ02-k:APA91bEDJn08iYmaZ3SyS6q-45NNm-lp9OzF5eBAifuVYe4rjIXA6Q7Wg9snz1V6ycL1gp-c7l-kKcWXYYQNyz7dsOcH7GJckH8vcm2ANhsX946LyMm6ieAHfR_9I5GsundI-MMbI1jO';

    $token_1 = 'cakGLq-JSFOR5K3QgB_J76:APA91bEVmlSf4xXX4KJC05wtpABRBFGU5uNko4oQl52VacEjXoncmCgB7WxLEYMvD1rB5MmEJtjj5Sf2BHnKlbiMQeASCXjFON6vb03yj4J0BQOqfoBUzTQQ1xdP_FMBZ-x7WRQI_cit';

    $data = [

        "registration_ids" => [
            $token_1
        ],

        "notification" => [

            "title" => 'Welcome',

            "body" => 'hi in my application  welcome back',

            "sound"=> "default" // required for sound on ios

        ],

    ];

    $dataString = json_encode($data);

    $headers = [

        'Authorization: key=' . $SERVER_API_KEY,

        'Content-Type: application/json',

    ];

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');

    curl_setopt($ch, CURLOPT_POST, true);

    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);

    $response = curl_exec($ch);

    dd($response);

});
<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CasinoController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Carbon;
use App\Http\Controllers\LinkController;
use App\Http\Controllers\RegistrationController;
use App\Models\User;
use App\Models\Win;
use Illuminate\Support\Facades\Redirect;

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

Route::get('/', function () {
    return view('main');
})->name("main");



Route::middleware('auth')->group(function () {

    Route::post('/logout',[AdminController::class, "destroy"])->name("exit");

    Route::get('/adminPage', function () {
        $users=User::all();
        return view('adminPage',compact("users"));
    })->name("adminPage");

    Route::post("adminredact",[AdminController::class,"redact"])->name("redact");
    Route::post("admindelete",[AdminController::class,"delete"])->name("delete");

    Route::post("adminnewuser",[AdminController::class,"newUser"])->name("newUser");

    Route::get('/admin', function () {
        return Redirect::route("adminPage");
    })->name("adminLogin");


});

Route::middleware('guest')->group(function () {

    Route::post('/admin', [AdminController::class, "auth"])->name("adminLogin");
    Route::get('/admin', function () {
        return view('adminLogin');
    })->name("adminLogin");

});





Route::post('reg', [RegistrationController::class, "create"])->name("registration");

Route::get("/links/{unique_link}",function(string $unique_link){


    $user = User::where("unique_link",$unique_link)->get();

    
    if(Carbon::now()->gt(Carbon::parse(($user[0]->link_will_end_at))))
    {
        Win::where("user_phone",$user[0]->phone)->delete();
        User::where("unique_link",$unique_link)->delete();
        return Redirect::route("main");

    }
    else{
        $plays = Win::where("user_phone",$user[0]->phone)->orderBy('id', 'desc')->take(3)->get();

        return view("linkpage",compact("user","plays"));
    }



})->name("link");

Route::post("generate",[LinkController::class,"update"])->name('linkRefresh');

Route::post("delete",[LinkController::class,"linkUserDelete"])->name('userDelete');

Route::post("play",[CasinoController::class,"play"])->name('play');

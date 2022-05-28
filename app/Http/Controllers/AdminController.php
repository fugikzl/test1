<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Win;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

class AdminController extends Controller
{
    public function auth(Request $request)
    {
        $request->validate([
            "login"=>["required"],
            "password"=>["required"],
        ]);



        if (Auth::attempt(['login' => $request->login, 'password' => $request->password])) {
      
            return Redirect::route("adminPage");
        }
        else{
            return back();
        }

    }

    public function destroy()
    {
        Auth::guard('web')->logout();
        return Redirect::route("adminPage");

    }

    public function delete(Request $request)
    {
        $request->validate([
            "phone"=>["required"],
        ]);

        User::where("phone", $request->phone)->delete();
        return back();

    }

    public function redact(Request $request)
    {
        $request->validate([
            "newphone"=>["required","numeric","digits:12"],
            "username"=>["required"],
        ]);

        Win::where("user_phone",$request->phone)->update([
            "user_phone"=>$request->newphone,
        ]);

        User::where("phone",$request->phone)->update([
            "username" =>$request->username,
            "phone" => $request->newphone,
        ]);

        return back();
    }

    public function newUser(Request $request)
    {
        $request->validate([
            "username"=>["required"],
            "phone"=>["required", "digits:12", "numeric"],
        ]);

        $link = Str::random(16);

        User::create([
            "username" => $request->username,
            "phone" => $request->phone,
            "unique_link" => $link,
            "link_created_at" => Carbon::now()->toDateTimeString(),
            "link_will_end_at" => Carbon::now()->addDays(7)->toDateTimeString(),
        ]);

        return back();
    }
}
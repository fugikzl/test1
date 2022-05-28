<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Carbon;




class RegistrationController extends Controller
{
    public function create(Request $request )
    {
        $request->validate([
            "username"=>['required'],
            "phone"=>['numeric','required',"unique:users","digits:12"],
        ]);

        $link = Str::random(16);

        

        User::create([
            "username" => $request->username,
            "phone" => $request->phone,
            "unique_link" => $link,
            "link_created_at" => Carbon::now()->toDateTimeString(),
            "link_will_end_at" => Carbon::now()->addDays(7)->toDateTimeString(),
        ]);

        return Redirect::route("link",["unique_link"=>$link]);
    }
}

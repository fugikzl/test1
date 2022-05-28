<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Win;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Carbon;

class LinkController extends Controller
{
    public function update(Request $request){
        $request->validate([
            "link"=>["required"],
        ]);

        $link = Str::random(16);

        User::where("unique_link",$request->link)->update([

            "unique_link" => $link,
            "link_created_at" => Carbon::now()->toDateTimeString(),
            "link_will_end_at" => Carbon::now()->addDays(7)->toDateTimeString(),

            ]);
        return Redirect::route("link",["unique_link"=>$link]);
    }

    public function linkUserDelete(Request $request)
    {
        $request->validate([
            "link"=>["required"],
        ]);

        $user = User::where("unique_link",$request->link)->get();

        Win::where("user_phone",$user[0]->phone)->delete();

        User::where("unique_link",$request->link)->delete();


        return Redirect::route("main");


    }
}

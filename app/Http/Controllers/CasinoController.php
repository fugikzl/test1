<?php

namespace App\Http\Controllers;

use App\Models\Win;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CasinoController extends Controller
{
    public function play(Request $request)
    {
        $request->validate([
            "phone"=>["required"],
        ]);

        $rand = rand(1,1000);

        if($rand % 2 != 0)
        {
            $win = 0;
            Win::create([
                "summ"=>$win,
                "user_phone"=>$request->phone,
                "num"=>$rand
            ]);
            return back();
        }

        if($rand < 300)
        {
            $win = intval(floor($rand*0.1));
        }
        
        if($rand > 300)
        {
            $win = intval(floor($rand*0.3));
        }

        if($rand > 600)
        {
            $win = intval(floor($rand*0.5));
        }
        if($rand > 900)
        {
            $win = intval(floor($rand*0.7));
        }

        Win::create([
            "summ"=>$win,
            "user_phone"=>$request->phone,
            "num"=>$rand
        ]);
        return back();

    }   //




}

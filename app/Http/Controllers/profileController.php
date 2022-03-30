<?php

namespace App\Http\Controllers;

use App\Models\profile;
use Illuminate\Http\Request;

class profileController extends Controller
{
    public function  index(){
        return view('profile.index');
    }

    public function store(Request $request){

        $request->validate([
            "phone"=>"required|numeric",
            "fb"=>"required",
            "linkedin"=>"required",
            "email"=>"required|email",
            "profile_pic"=>"required|image",
            "github"=>"required",
        ]);

        $path = $request->file('profile_pic')->store('profile_image');

        $profile = new profile();
        $profile->phone = $request->phone;
        $profile->fb = $request->fb;
        $profile->linkedin = $request->linkedin;
        $profile->email = $request->email;
        $profile->profile_pic = $path;
        $profile->github = $request->github;
        $profile->user_id = auth()->user()->id;
        $profile->save();

        return redirect('index');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\profile;
use App\Models\User;
use Illuminate\Http\Request;

class profileController extends Controller
{
    public function  index(){
        return view('profile.index');
    }

    public function profile($username){
       $profile =  profile::where('profile_name',$username)->with('user')->first();

       return view("single_profile",compact('profile'));
    }

    public function my_profile(){
        $profile =  User::find(auth()->user()->id)->profile;
    }

    public function store(Request $request){

        $request->validate([
            "profile_name"=>"required",
            "phone"=>"required|numeric",
            "fb"=>"required",
            "linkedin"=>"required",
            "email"=>"required|email",
            "profile_pic"=>"required|image",
            "github"=>"required",
        ]);

          $path =   time().".".$request->profile_pic->extension();
          $request->profile_pic->move(public_path("profile_image"),$path);

        $profile = new profile();
        $profile->phone = $request->phone;
        $profile->profile_name = $request->profile_name;
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

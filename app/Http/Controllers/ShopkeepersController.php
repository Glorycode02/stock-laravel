<?php

namespace App\Http\Controllers;

use App\Models\Shopkeepers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash as FacadesHash;

class ShopkeepersController extends Controller
{
    public function register()
    {
        return view("auth.register");
    }

    public function login()
    {
        return view("auth.login");
    }

    public function store(Request $request)
    {
        $request->validate([
            "UserName" => ["required", "string"],
            "Password" => ["required", "string", "min:5", "max:8"],
            "Cpass" => ["required", "string", "min:5", "max:8"]
        ]);

        if(Shopkeepers::where("UserName", "=", $request->UserName)->first()) {
            return back()->with("fail", "Username already exist?");
        }

        if($request->Password != $request->Cpass) {
            return back()->with("fail", "Password do not match?");
        }

        $user = Shopkeepers::create([
            "UserName" => $request->UserName,
            "Password" => FacadesHash::make($request->Password),
        ]);

        if ($user) {
            return redirect("/login")->with("success", "Registered successfully");
        } else {
            return redirect("/register")->with("error", "Error occurred please try again");
        }
    }

    public function loginUser(Request $request)
    {
        $request->validate([
            "UserName" => ["required", "string"],
            "Password" => ["required", "string", "min:5", "max:8"]
        ]);

        $user = Shopkeepers::where("UserName", "=", $request->UserName)->first();
        if ($user) {
            if (FacadesHash::check($request->Password, $user->Password)) {
                $request->session()->put("loginId", $user->ShopkeeperId);
                return redirect("/")->with("success", "login successfully");
            } else {
                return back()->with("fail", "password not match");
            }
        } else {
            return back()->with("fail", "Username not registered");
        }
    }

    public function logOut(Request $request)
    {
        $request->session()->forget("loginId");
        return redirect("login")->with("success", "logged out!!");
    }
}

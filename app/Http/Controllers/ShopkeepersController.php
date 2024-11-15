<?php

namespace App\Http\Controllers;

use App\Models\Shopkeepers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash as FacadesHash;
class ShopkeepersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function register()
    {
        return view("auth.register");
    }
    public function login()
    {
        return view("auth.login");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "UserName" => ["required", "string", "unique:shopkeepers"],
            "Password" => ["required", "string", "min:5", "max:8"],
            "Cpass" => ["required", "string", "min:5", "max:8"]
        ]);
        if($request->Password != $request->Cpass) return back()->with("fail", "Password do not match?");
        // dd($request);
        $user = Shopkeepers::create([
            "UserName" => $request->UserName,
            "Password" => facadesHash::make($request->Password),
        ]);
        $res = $user->save();
        if ($res) {
            return redirect("/login")->with("success", "Registered successfully");
        } else {
            return redirect("/register")->with("error", "Error occured please try again");
        }
    }
    public function loginUser(Request $request){
        $request->validate([
            "UserName" => ["required", "string"],
            "Password" => ["required", "string", "min:5", "max:8"]
        ]);
        $user = Shopkeepers::where("UserName", "=", $request->UserName)->first();
        if ($user) {
            if (FacadesHash::check($request->Password, $user->Password)) {
                $request->session()->put("loginId", $user->ShopkeeperId);
                return redirect("products")->with("success", "login successfully");
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
    /**
     * Display the specified resource.
     */
    public function show(Shopkeepers $shopkeepers)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Shopkeepers $shopkeepers)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Shopkeepers $shopkeepers)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Shopkeepers $shopkeepers)
    {
        //
    }
}

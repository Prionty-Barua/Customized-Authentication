<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use hash;
use session;
class CustomizedAuthController extends Controller
{
    public function login(){
        return view ("auth.Login");
    }
    public function registration(){
        return view ("auth.registration");
    }
    public function registerUser(Request $request){
        $request->validate([
            'name'=>'required',
            'email'=>'required|email|unique|users',
            'password'=>'required|min:5|max:12',
        ]);
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = hash::make($request->password);
        $res = $user->save();
        if($res){
            return back()->with('success',  'You have registrated successfully');
        }else{
            return back()->with('fail','Something went wrong');
        }
    }
    public function loginUser(Request $request){
        $request->validate([
            'email'=>'required|email',
            'password'=>'required|min:5|max:12',
        ]);
        $user = User::where('email','=',$request->email)->first();
        if($user){
            if(hash::check($request->password,$user->password)){
                $request->session()->put('loginId',$user->id);
                return redirect('Dashboard');
            }else{
                return back()->with('fail','Password is not matched.');
            }
        }else{
            return back()->with('fail','This email is not registered.');
        }
    }
    public function dashboard(){
        $data = array();
        if(Session::has('loginId')){
            $data = User::where('id','=',Session::get('loginId'))->first(); 
        }
        return view('dashboard',compact('data'));
    }
    public function logout()
    {
        if (Session::has('loginId')){
            Session::pull('LoginId');
            return redirect('login');
        }else{

        }
    }
}

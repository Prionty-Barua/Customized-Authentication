<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomizedAuthController extends Controller
{
    public function login(){
        return view ("auth.Login");
    }
    public function registration(){
        return view ("auth.registration");
    }
}

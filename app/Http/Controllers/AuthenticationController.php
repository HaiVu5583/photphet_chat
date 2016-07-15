<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class AuthenticationController extends Controller
{
    public function login(){
    	return view('login');
    }
    public function register(){
    	return view('register');
    }
}

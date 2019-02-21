<?php

//this is the command' php artisan make:controller aboutcontroller'
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class aboutcontroller extends Controller
{
    public function index(){
        return 'this\'s index function in aboutcontroller';
    }
    public function about(){
        $title="Lara";
        
        $arr=array("ball" => "football" ,'tot' => ['spars' ,'liverpool','man city']);
        return view('about', compact('arr','title'));
       //  return view('about')->with('title');
    }
}

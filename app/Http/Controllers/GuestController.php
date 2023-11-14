<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GuestController extends Controller
{

    //home
    public function home()
    {
        return view('user.index');
    }

    // about
    public function about()
    {
        return view('user.about');

    }

    // shop
    public function shop()
    {
        return view('user.shop');

    }

    // contact
    public function contact()
    {
        return view('user.contact');

    }

    // blog
    public function blog()
    {
        return view('user.blog');
    }

    // privacy
    public function privacy()
    {
        return view('user.privacy');
    }

    // loginPage
    public function loginPage()
    {
        return view('login');
    }

    // register Page
    public function registerPage()
    {
        return view('register');
    }
}

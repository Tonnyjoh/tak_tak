<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        if (session()->get('isLoggedIn') && session()->get('role')=='client') {
            return redirect()->to('/user/dashboard');
        }elseif (session()->get('isLoggedIn') && session()->get('role')=='admin') {
            return redirect()->to('/admin/dashboard');
        }
        return view("index");
    }
}
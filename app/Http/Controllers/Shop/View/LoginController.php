<?php

namespace App\Http\Controllers\Shop\View;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    public function index()
    {
        return view('shop.login');
    }
}

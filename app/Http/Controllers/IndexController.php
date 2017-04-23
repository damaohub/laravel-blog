<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    public function index()
    {

    }

    public function Crypt()
    {
        $str = 123456;
        echo Crypt::encrypt($str);
    }
}

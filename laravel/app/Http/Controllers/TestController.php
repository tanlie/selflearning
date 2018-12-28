<?php

namespace App\Http\Controllers;

use App\Exceptions\ParameterException;
use Illuminate\Http\Request;

use App\Http\Requests;

class TestController extends Controller
{
    public function index()
    {

     return view('welcome');

    }
}

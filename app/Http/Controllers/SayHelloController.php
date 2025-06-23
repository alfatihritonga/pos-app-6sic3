<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SayHelloController extends Controller
{
    public function sayHello($name)
    {
        return "Hello " . $name;
    }
}

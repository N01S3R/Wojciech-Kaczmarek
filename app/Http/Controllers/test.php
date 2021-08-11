<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class test extends Controller
{

    public function test(?string $test = null): void
    {
        if(null === $test){

        }
    }
}

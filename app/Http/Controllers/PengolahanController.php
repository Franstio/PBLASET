<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PengolahanController extends Controller
{
    public function list(Request $request )
    {
        return view("pblaset.pengelolaan");
    }
}

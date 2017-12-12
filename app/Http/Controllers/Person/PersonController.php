<?php

namespace App\Http\Controllers\Person;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PersonController extends Controller
{
    //
    public function index()
    {
        return view('person.index');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PastYearController extends Controller
{
    public function index()
    {
        return view('student.past-year.index');
    }
}

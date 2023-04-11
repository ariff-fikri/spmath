<?php

namespace App\Http\Controllers;

use App\Models\PastYear;
use Illuminate\Http\Request;

class PastYearController extends Controller
{
    public function index()
    {
        $past_years = PastYear::all();

        return view('student.past-year.index', compact('past_years'));
    }
}

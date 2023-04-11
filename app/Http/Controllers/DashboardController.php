<?php

namespace App\Http\Controllers;

use App\Models\Chapter;
use App\Models\StudentYear;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $student_year = StudentYear::all();
        $chapters_form_4 = Chapter::where('student_year_id', 4)->limit(3)->get();
        $chapters_form_5 = Chapter::where('student_year_id', 5)->limit(3)->get();

        $chapters_count_form_4 = Chapter::where('student_year_id', 4)->count();
        $chapters_count_form_5 = Chapter::where('student_year_id', 5)->count();

        return view('student.dashboard.index', compact('student_year', 'chapters_form_4', 'chapters_form_5', 'chapters_count_form_4', 'chapters_count_form_5'));
    }
}

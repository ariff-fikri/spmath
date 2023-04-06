<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        return view('student.course.index');
    }

    public function create()
    {
        return view('student.course.create');
    }

    public function show()
    {
        return view('student.course.show');
    }

    public function edit()
    {
        return view('student.course.edit');
    }
}

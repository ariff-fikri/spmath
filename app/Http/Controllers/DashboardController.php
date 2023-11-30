<?php

namespace App\Http\Controllers;

use App\Models\Chapter;
use App\Models\StudentYear;
use Illuminate\Contracts\View\View;

class DashboardController extends Controller
{
    /**
     * Display the student dashboard index.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index(): View
    {
        $studentYears = StudentYear::all();

        $chapters = Chapter::with('studentYear')
            ->whereIn('student_year_id', [4, 5])
            ->orderBy('student_year_id')
            ->get();

        $chaptersForm4 = $chapters->where('studentYear.id', 4)->values();
        $chaptersForm5 = $chapters->where('studentYear.id', 5)->values();

        $chaptersCountForm4 = $chapters->where('studentYear.id', 4)->count();
        $chaptersCountForm5 = $chapters->where('studentYear.id', 5)->count();

        return view('student.dashboard.index', compact(
            'studentYears',
            'chaptersForm4',
            'chaptersForm5',
            'chaptersCountForm4',
            'chaptersCountForm5'
        ));
    }
}

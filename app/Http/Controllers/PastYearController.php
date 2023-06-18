<?php

namespace App\Http\Controllers;

use App\Models\PastYear;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PastYearController extends Controller
{
    public function index()
    {
        $past_years = PastYear::all();

        return view('student.past-year.index', compact('past_years'));
    }

    public function create()
    {
        return view('student.past-year.create');
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        $past_year = PastYear::create($request->all());

        if ($request->hasFile('file')) {

            $destination_path = 'past-year/' . $past_year->id ?? 0 . '/';
            $file_name = $request->file('file')->getClientOriginalName();
            $request->file('file')->storeAs($destination_path, $file_name);

            $past_year->update([
                'file_name' => $file_name,
                'file_dir' => $destination_path,
            ]);
        }

        DB::commit();

        return redirect()->route('past-year.index')->with('success', 'Past Year Paper has been stored.');
    }

    public function remove(Request $request, PastYear $past_year)
    {
        if (file_exists(storage_path('app/public/' . $past_year->file_dir . '/' . $past_year->file_name))) {
            unlink(storage_path('app/public/' . $past_year->file_dir . '/' . $past_year->file_name));
        }

        $past_year->delete();

        return back()->with('success', 'Quiz has been deleted.');
    }
}

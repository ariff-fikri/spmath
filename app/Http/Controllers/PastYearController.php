<?php

namespace App\Http\Controllers;

use App\Models\PastYear;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Exception;

class PastYearController extends Controller
{
    /**
     * Display the index page for past years.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index(): View
    {
        $pastYears = PastYear::all();

        return view('student.past-year.index', compact('pastYears'));
    }

    /**
     * Display the form for creating a new past year entry.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create(): View
    {
        return view('student.past-year.create');
    }

    /**
     * Store a new past year entry in the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        DB::beginTransaction();

        try {
            $pastYear = PastYear::create($request->all());

            if ($request->hasFile('file')) {
                $destinationPath = 'past-year/' . $pastYear->id . '/';
                $fileName = $request->file('file')->getClientOriginalName();

                $request->file('file')->storeAs($destinationPath, $fileName);

                $pastYear->update([
                    'file_name' => $fileName,
                    'file_dir' => $destinationPath,
                ]);
            }

            DB::commit();

            return redirect()->route('past-year.index')->with('success', 'Past Year Paper has been stored.');
        } catch (Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('error', 'An error occurred while storing the Past Year Paper.');
        }
    }

    /**
     * Remove a past year entry and associated file from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PastYear  $pastYear
     * @return \Illuminate\Http\RedirectResponse
     */
    public function remove(Request $request, PastYear $pastYear): RedirectResponse
    {
        $filePath = storage_path('app/public/' . $pastYear->file_dir . '/' . $pastYear->file_name);

        if (File::exists($filePath)) {
            File::delete($filePath);
        }

        $pastYear->delete();

        return back()->with('success', 'Past Year Paper has been deleted.');
    }
}

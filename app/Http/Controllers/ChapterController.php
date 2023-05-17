<?php

namespace App\Http\Controllers;

use App\Models\Chapter;
use App\Models\ChapterFiles;
use App\Models\Enote;
use App\Models\Quiz;
use App\Models\StudentYear;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Zip;

class ChapterController extends Controller
{
    public function index()
    {
        $student_year = StudentYear::all();
        $chapters = Chapter::get()->groupBy('student_year_id');

        return view('student.course.index', compact('student_year', 'chapters'));
    }

    public function create()
    {
        return view('student.course.create');
    }

    public function store(Request $request)
    {
        $check_chapters_exist = Chapter::where('name', $request->name)->first();

        if (!$check_chapters_exist) {
            $chapter = Chapter::create($request->all());
        } else {
            $chapter = $check_chapters_exist;
        }

        if ($request->hasFile('file')) {

            foreach ($request->file('file') as $key => $file) {
                $destination_path = 'chapter/' . $chapter->id ?? 0 . '/';
                $file_name = $file->getClientOriginalName();
                $file->storeAs($destination_path, $file_name);

                ChapterFiles::create([
                    'name' => $file_name,
                    'file_dir' => $destination_path,
                    'chapter_id' => $chapter->id,
                ]);
            }
        }

        return redirect()->route('chapter.index')->with('success', 'Chapter has been stored.');
    }

    public function show(Request $request, Chapter $chapter)
    {
        $chapter_files = ChapterFiles::where('chapter_id', $chapter->id)->get();

        $quiz_available = Quiz::where('chapter_id', $chapter->id)->first();

        $enotes_available = Enote::where('chapter_id', $chapter->id)->first();

        return view('student.course.show', compact('chapter', 'chapter_files', 'quiz_available', 'enotes_available'));
    }

    public function preview(Request $request, Chapter $chapter)
    {
        $chapter_files = ChapterFiles::where('chapter_id', $chapter->id)->get();

        foreach ($chapter_files as $key => $chapter_file) {
            $chapter_file->url = asset('storage/' . $chapter_file->file_dir . '/' . $chapter_file->name);
        }

        return response()->json(['success' => 'Preview displayed.', 'chapter_files' => $chapter_files]);
    }

    public function edit(Request $request, Chapter $chapter)
    {
        $chapter_files = ChapterFiles::where('chapter_id', $chapter->id)->get();

        return view('student.course.edit', compact('chapter', 'chapter_files'));
    }

    public function update(Request $request, Chapter $chapter)
    {
        $chapter->update($request->all());

        return back()->with('success', 'Chapter has been stored.');
    }

    public function file(Request $request, Chapter $chapter)
    {
        $destination_path = 'chapter/' . $chapter->id ?? 0 . '/';
        $file_name = $request->file('file')->getClientOriginalName();
        $request->file('file')->storeAs($destination_path, $file_name);

        $chapter_files = ChapterFiles::where('name', $file_name)->first();

        if ($chapter_files) {

            $chapter_files->update([
                'name' => $file_name,
                'file_dir' => $destination_path,
                'chapter_id' => $chapter->id,
            ]);
        } else {

            ChapterFiles::create([
                'name' => $file_name,
                'file_dir' => $destination_path,
                'chapter_id' => $chapter->id,
            ]);
        }

        return response()->json(['success' => 'Files has been stored.']);
    }

    public function read_files(Request $request, Chapter $chapter)
    {
        $directory = 'storage\\chapter\\' . $chapter->id ?? 0 . '\\';
        $files_info = [];
        $file_ext = array('png', 'jpg', 'jpeg', 'pdf');

        if (file_exists(public_path($directory))) {
            foreach (File::allFiles(public_path($directory)) as $file) {
                $extension = strtolower($file->getExtension());

                if (in_array($extension, $file_ext)) {
                    $filename = $file->getFilename();
                    $size = $file->getSize();
                    $sizeinMB = round($size / (1000 * 1024), 2);

                    if ($sizeinMB <= 2) {
                        $files_info[] = array(
                            "name" => $filename,
                            "size" => $size,
                            "path" => url($directory . '/' . $filename)
                        );
                    }
                }
            }
        }

        return response()->json($files_info);
    }

    public function remove_files(Request $request, Chapter $chapter)
    {
        $destination_path = preg_split("#/#", $request->file_dir);

        $chapter_file = ChapterFiles::where('chapter_id', $chapter->id)->where('name', $request->file_name)->where('file_dir', $destination_path[3] . '/' . $destination_path[5])->first();

        if ($chapter_file) {

            if (file_exists(storage_path('app/public/' . $chapter_file->file_dir . '/' . $chapter_file->name))) {

                unlink(storage_path('app/public/' . $chapter_file->file_dir . '/' . $chapter_file->name));
            }

            $chapter_file->delete();

            return response()->json(['success' => 'Files has been removed.']);
        }

        return response()->json(['error' => 'File not found.']);
    }

    public function download(Request $request, Chapter $chapter)
    {
        $directory = 'storage\\chapter\\' . $chapter->id ?? 0 . '\\';

        return Zip::create(str_replace(' ', '-', $chapter->name) . '.zip', File::files(public_path($directory)));
    }
}

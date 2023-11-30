<?php

namespace App\Http\Controllers;

use App\Models\Chapter;
use App\Models\ChapterFiles;
use App\Models\Enote;
use App\Models\Quiz;
use App\Models\StudentYear;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use STS\ZipStream\ZipStream;
use STS\ZipStream\ZipStreamFacade;

class ChapterController extends Controller
{
    /**
     * Display the index page for student courses, showing a list of student years and associated chapters.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        $student_year = StudentYear::all();
        $chapters = Chapter::get()->groupBy('student_year_id');

        return view('student.course.index', compact('student_year', 'chapters'));
    }

    /**
     * Display the form for creating a new course.
     *
     * @return \Illuminate\View\View
     */
    public function create(): View
    {
        return view('student.course.create');
    }

    /**
     * Store a new chapter and associated files based on the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $chapter = Chapter::firstOrNew(['name' => $request->name]);

        if (! $chapter->exists) {
            $chapter->fill($request->all())->save();
        }

        if ($request->hasFile('file')) {
            foreach ($request->file('file') as $key => $file) {
                $destinationPath = "chapter/{$chapter->id}/";
                $fileName = $file->getClientOriginalName();
                $file->storeAs($destinationPath, $fileName);

                ChapterFiles::create([
                    'name' => $fileName,
                    'file_dir' => $destinationPath,
                    'chapter_id' => $chapter->id,
                ]);
            }
        }

        return redirect()->route('chapter.index')->with('success', 'Chapter has been stored.');
    }

    /**
     * Display the details of a specific chapter, including associated files, quiz, and e-notes.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Chapter  $chapter
     * @return \Illuminate\View\View
     */
    public function show(Request $request, Chapter $chapter): View
    {
        $chapter_files = ChapterFiles::where('chapter_id', $chapter->id)->get();

        $quiz_available = Quiz::where('chapter_id', $chapter->id)->first();

        $enotes_available = Enote::where('chapter_id', $chapter->id)->first();

        return view('student.course.show', compact('chapter', 'chapter_files', 'quiz_available', 'enotes_available'));
    }

    /**
     * Display a preview of the files associated with a specific chapter.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Chapter  $chapter
     * @return \Illuminate\Http\JsonResponse
     */
    public function preview(Request $request, Chapter $chapter): JsonResponse
    {
        $chapterFiles = ChapterFiles::where('chapter_id', $chapter->id)->get();

        $chapterFiles->transform(function ($chapterFile) {
            $chapterFile->url = asset("storage/{$chapterFile->file_dir}/{$chapterFile->name}");

            return $chapterFile;
        });

        return response()->json(['success' => 'Preview displayed.', 'chapter_files' => $chapterFiles]);
    }

    /**
     * Display the form for editing details of a specific chapter, including associated files.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Chapter  $chapter
     * @return \Illuminate\View\View
     */
    public function edit(Request $request, Chapter $chapter): View
    {
        $chapter_files = ChapterFiles::where('chapter_id', $chapter->id)->get();

        return view('student.course.edit', compact('chapter', 'chapter_files'));
    }

    /**
     * Update the details of a specific chapter based on the incoming request data.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Chapter  $chapter
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Chapter $chapter): RedirectResponse
    {
        $chapter->update($request->all());

        return back()->with('success', 'Chapter has been stored.');
    }

    /**
     * Store a file associated with a specific chapter, and update associated records if necessary.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Chapter  $chapter
     * @return \Illuminate\Http\JsonResponse
     */
    public function file(Request $request, Chapter $chapter): JsonResponse
    {
        $destinationPath = "chapter/{$chapter->id}/";
        $fileName = $request->file('file')->getClientOriginalName();

        $request->file('file')->storeAs($destinationPath, $fileName);

        $chapterFile = ChapterFiles::firstOrNew(['name' => $fileName]);

        $chapterFile->fill([
            'name' => $fileName,
            'file_dir' => $destinationPath,
            'chapter_id' => $chapter->id,
        ])->save();

        if ($request->file('file')->getClientOriginalExtension() == 'pdf') {
            Enote::create([
                'name' => $fileName,
                'description' => '',
                'chapter_id' => $chapter->id,
            ]);
        }

        return response()->json(['success' => 'File has been stored.']);
    }

    /**
     * Read and retrieve information about files associated with a specific chapter.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Chapter  $chapter
     * @return \Illuminate\Http\JsonResponse
     */
    public function read_files(Request $request, Chapter $chapter): JsonResponse
    {
        $directory = "storage/chapter/{$chapter->id}/";
        $filesInfo = [];
        $allowedExtensions = ['png', 'jpg', 'jpeg', 'pdf'];

        if (Storage::exists($directory)) {
            foreach (Storage::allFiles($directory) as $file) {
                $extension = strtolower(pathinfo($file, PATHINFO_EXTENSION));

                if (in_array($extension, $allowedExtensions)) {
                    $filename = pathinfo($file, PATHINFO_FILENAME);
                    $size = Storage::size($file);
                    $sizeInMB = round($size / (1000 * 1024), 2);

                    if ($sizeInMB <= 2) {
                        $filesInfo[] = [
                            'name' => $filename,
                            'size' => $size,
                            'path' => Storage::url($file),
                        ];
                    }
                }
            }
        }

        return response()->json($filesInfo);
    }

    /**
     * Remove a specific file associated with a chapter and delete its record.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Chapter  $chapter
     * @return \Illuminate\Http\JsonResponse
     */
    public function remove_files(Request $request, Chapter $chapter): JsonResponse
    {
        $destinationPath = preg_split('#/#', $request->file_dir);
        $fileDir = $destinationPath[3] . '/' . $destinationPath[5];

        $chapterFile = ChapterFiles::where('chapter_id', $chapter->id)
            ->where('name', $request->file_name)
            ->where('file_dir', $fileDir)
            ->first();

        if ($chapterFile) {
            $filePath = Storage::path("public/{$chapterFile->file_dir}/{$chapterFile->name}");

            if (Storage::exists($filePath)) {
                Storage::delete($filePath);
            }

            $chapterFile->delete();

            return response()->json(['success' => 'File has been removed.']);
        }

        return response()->json(['error' => 'File not found.']);
    }

    /**
     * Create and download a ZIP archive containing files associated with a specific chapter.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Chapter  $chapter
     * @return STS\ZipStream\ZipStream
     */
    public function download(Request $request, Chapter $chapter): ZipStream
    {
        $directory = 'storage\\chapter\\' . ($chapter->id ?? 0) . '\\';

        return ZipStreamFacade::create(str_replace(' ', '-', $chapter->name) . '.zip', File::files(public_path($directory)));
    }

    /**
     * Remove a specific chapter, including associated files, and delete its records.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Chapter  $chapter
     * @return \Illuminate\Http\RedirectResponse
     */
    public function remove(Request $request, Chapter $chapter)
    {
        foreach ($chapter->chapter_files as $chapter_file) {
            $filePath = "{$chapter_file->file_dir}/{$chapter_file->name}";

            if (Storage::exists($filePath)) {
                Storage::delete($filePath);
            }
        }

        $directoryPath = "public/{$chapter->id}";
        Storage::deleteDirectory($directoryPath);

        $chapter->delete();

        return back()->with('success', 'Chapter has been deleted.');
    }
}

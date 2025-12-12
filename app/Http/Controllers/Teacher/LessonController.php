<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Lesson;
use App\Models\Course;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    public function index()
    {
        $lessons = Lesson::whereHas('course', function($q) {
            $q->where('teacher_id', auth()->id());
        })->with('course')->get();
        
        return view('teacher.lessons.index', compact('lessons'));
    }

    public function create()
    {
        $courses = Course::where('teacher_id', auth()->id())->get();
        return view('teacher.lessons.create', compact('courses'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'course_id' => 'required|exists:courses,id',
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'video_url' => 'nullable|string',
            'duration' => 'nullable|integer',
        ]);

        Lesson::create($validated);
        return redirect('/teacher/lessons');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lesson;
use App\Models\Course;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    public function index()
    {
        $lessons = Lesson::with('course')->get();
        return view('admin.lessons.index', compact('lessons'));
    }

    public function create()
    {
        $courses = Course::all();
        return view('admin.lessons.create', compact('courses'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'video_url' => 'nullable|string',
            'duration' => 'nullable|integer',
            'course_id' => 'required|exists:courses,id',
        ]);

        Lesson::create($validated);
        return redirect('/admin/lessons');
    }

    public function edit($id)
    {
        $lesson = Lesson::findOrFail($id);
        $courses = Course::all();
        return view('admin.lessons.edit', compact('lesson', 'courses'));
    }

    public function update(Request $request, $id)
    {
        $lesson = Lesson::findOrFail($id);
        
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'video_url' => 'nullable|string',
            'duration' => 'nullable|integer',
            'course_id' => 'required|exists:courses,id',
        ]);

        $lesson->update($validated);
        return redirect('/admin/lessons');
    }

    public function destroy($id)
    {
        Lesson::findOrFail($id)->delete();
        return redirect('/admin/lessons');
    }
}

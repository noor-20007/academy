<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\Lesson;
use App\Models\TaskSubmission;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::whereHas('lesson.course', function($q) {
            $q->where('teacher_id', auth()->id());
        })->with('lesson.course')->get();
        
        return view('teacher.tasks.index', compact('tasks'));
    }

    public function create()
    {
        $lessons = Lesson::whereHas('course', function($q) {
            $q->where('teacher_id', auth()->id());
        })->with('course')->get();
        
        return view('teacher.tasks.create', compact('lessons'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'lesson_id' => 'required|exists:lessons,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
        ]);

        Task::create($validated);
        return redirect('/teacher/tasks');
    }

    public function submissions($id)
    {
        $task = Task::with('lesson.course')->findOrFail($id);
        $submissions = TaskSubmission::where('task_id', $id)->with('student')->get();
        return view('teacher.tasks.submissions', compact('task', 'submissions'));
    }

    public function feedback(Request $request, $id)
    {
        $submission = TaskSubmission::findOrFail($id);
        
        $validated = $request->validate([
            'feedback' => 'nullable|string',
            'score' => 'required|integer|min:0|max:100',
        ]);

        $submission->update($validated);
        return back()->with('success', 'تم حفظ التقييم');
    }
}

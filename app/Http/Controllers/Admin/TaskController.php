<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\Lesson;
use App\Models\TaskSubmission;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::with('lesson.course')->get();
        return view('admin.tasks.index', compact('tasks'));
    }

    public function create()
    {
        $lessons = Lesson::with('course')->get();
        return view('admin.tasks.create', compact('lessons'));
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
        return redirect('/admin/tasks');
    }

    public function submissions($id)
    {
        $task = Task::with('lesson.course')->findOrFail($id);
        $submissions = TaskSubmission::where('task_id', $id)->with('student')->get();
        return view('admin.tasks.submissions', compact('task', 'submissions'));
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

    public function destroy($id)
    {
        Task::findOrFail($id)->delete();
        return redirect('/admin/tasks');
    }
}

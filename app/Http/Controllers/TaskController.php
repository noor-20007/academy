<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TaskSubmission;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $enrollments = auth()->user()->enrollments()->with('course.lessons.tasks')->get();
        $tasks = [];
        
        foreach ($enrollments as $enrollment) {
            foreach ($enrollment->course->lessons as $lesson) {
                foreach ($lesson->tasks as $task) {
                    $submission = TaskSubmission::where('task_id', $task->id)
                        ->where('student_id', auth()->id())
                        ->first();
                    
                    $tasks[] = [
                        'task' => $task,
                        'course' => $enrollment->course,
                        'lesson' => $lesson,
                        'submission' => $submission
                    ];
                }
            }
        }
        
        return view('tasks.index', compact('tasks'));
    }

    public function submit(Request $request, $id)
    {
        $validated = $request->validate([
            'github_link' => 'required|url',
        ]);

        TaskSubmission::updateOrCreate(
            ['task_id' => $id, 'student_id' => auth()->id()],
            ['github_link' => $validated['github_link']]
        );

        return redirect('/tasks')->with('success', 'تم تسليم المهمة بنجاح');
    }
}

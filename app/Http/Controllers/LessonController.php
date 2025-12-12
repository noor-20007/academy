<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lesson;

class LessonController extends Controller
{
    public function show($id)
    {
        $lesson = Lesson::with('course.lessons')->findOrFail($id);

        $user = auth()->user();

        // Allow access for admins and teachers
        if ($user->role === 'admin' || $user->role === 'teacher') {
            return view('lessons.show', compact('lesson'));
        }

        // For students, ensure they are approved and enrolled in the course
        if (! $user->approved) {
            return redirect('/')->withErrors(['account' => 'حسابك لم يتم الموافقة عليه بعد من قبل الإدارة.']);
        }

        $enrolled = $user->enrolledCourses()->where('courses.id', $lesson->course->id)->exists();
        if (! $enrolled) {
            return redirect('/courses/' . $lesson->course->id)->withErrors(['enroll' => 'يجب عليك الانضمام للكورس لمشاهدة الدروس.']);
        }

        return view('lessons.show', compact('lesson'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    public function store(Request $request)
    {
        $exists = Enrollment::where('student_id', auth()->id())
            ->where('course_id', $request->course_id)
            ->exists();

        if (!$exists) {
            Enrollment::create([
                'student_id' => auth()->id(),
                'course_id' => $request->course_id,
                'progress_percentage' => 0,
                'completed' => false,
            ]);
        }

        return redirect()->route('courses.show', $request->course_id);
    }
}

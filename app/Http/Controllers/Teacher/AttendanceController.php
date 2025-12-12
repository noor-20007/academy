<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Lesson;
use App\Models\Attendance;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function show($lessonId)
    {
        $lesson = Lesson::with(['course.students' => function($q) {
            $q->where('role', 'student');
        }])->findOrFail($lessonId);

        $attendances = [];
        foreach ($lesson->course->students as $student) {
            $attendance = Attendance::where('lesson_id', $lessonId)
                ->where('student_id', $student->id)
                ->first();

            $attendances[] = [
                'student' => $student,
                'attended' => $attendance ? $attendance->attended : false,
                'attended_at' => $attendance ? $attendance->attended_at : null,
                'late' => $attendance ? ($attendance->late ? true : false) : false,
            ];
        }

        return view('teacher.attendance.show', compact('lesson', 'attendances'));
    }

    public function update(Request $request, $lessonId)
    {
        $lesson = Lesson::findOrFail($lessonId);

        foreach ($request->attendance as $studentId => $attended) {
            // allow teacher to provide a specific attended_at per student via request
            $providedTime = $request->input('attended_at.' . $studentId, null);

            // read late checkbox value (default 0)
            $lateVal = $request->input('late.' . $studentId, 0);

            if ($attended == '1') {
                // determine timestamp: provided by teacher or now()
                if (!empty($providedTime)) {
                    try {
                        $dt = \Carbon\Carbon::parse($providedTime);
                    } catch (\Exception $e) {
                        $dt = now();
                    }
                } else {
                    $dt = now();
                }

                Attendance::updateOrCreate(
                    ['lesson_id' => $lessonId, 'student_id' => $studentId],
                    ['attended' => true, 'attended_at' => $dt, 'late' => (bool)$lateVal]
                );
            } else {
                Attendance::updateOrCreate(
                    ['lesson_id' => $lessonId, 'student_id' => $studentId],
                    ['attended' => false, 'attended_at' => null, 'late' => false]
                );
            }
        }

        return back()->with('success', 'تم حفظ الحضور');
    }
}

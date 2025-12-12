<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\TaskSubmission;
use App\Models\Attendance;
use App\Models\User;

class Leaderboard extends Model
{
    use HasFactory;

    protected $fillable = ['student_id', 'score'];

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    /**
     * Recalculate scores for all students and store them in leaderboards table.
     *
     * Scoring rules (defaults):
     * - task score: sum of TaskSubmission.score
     * - attendance: present on-time = 5 points, late = 2 points, absent = 0
     *
     * You can change weights by passing alternatives.
     */
    public static function recalculateAllScores(array $weights = [])
    {
        $taskWeight = $weights['task'] ?? 1; // task scores are taken as-is (multiplied by this)
        $presentPoints = $weights['present'] ?? 5;
        $latePoints = $weights['late'] ?? 2;

        $students = User::where('role', 'student')->get();

        foreach ($students as $student) {
            $taskScore = TaskSubmission::where('student_id', $student->id)->sum('score');
            $presentCount = Attendance::where('student_id', $student->id)->where('attended', 1)->where(function($q){ $q->whereNull('late')->orWhere('late', 0); })->count();
            $lateCount = Attendance::where('student_id', $student->id)->where('attended', 1)->where('late', 1)->count();

            $attendanceScore = ($presentCount * $presentPoints) + ($lateCount * $latePoints);

            $total = ($taskScore * $taskWeight) + $attendanceScore;

            self::updateOrCreate(
                ['student_id' => $student->id],
                ['score' => round($total, 2)]
            );
        }
    }
}

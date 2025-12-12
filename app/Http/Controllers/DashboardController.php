<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Enrollment;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        if ($user->role == 'student') {
            $enrollments = $user->enrollments()->with('course.teacher')->get();
            $enrolledCourses = $enrollments->count();
            $completedCourses = $enrollments->where('completed', true)->count();
            $points = $user->leaderboard->score ?? 0;
            $rank = null;
            
            return view('dashboard', compact('enrollments', 'enrolledCourses', 'completedCourses', 'points', 'rank'));
        }
        
        return view('dashboard');
    }
}

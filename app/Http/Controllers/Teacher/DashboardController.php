<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $courses = Auth::user()->coursesTaught()->withCount('lessons')->get();
        return view('teacher.dashboard', compact('courses'));
    }
}

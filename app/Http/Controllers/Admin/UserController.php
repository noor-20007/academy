<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    // Approve a pending student request
    public function approve($id)
    {
        $user = User::findOrFail($id);
        if ($user->requested_course_id) {
            // Enroll the student
            \App\Models\Enrollment::create([
                'student_id' => $user->id,
                'course_id' => $user->requested_course_id,
                'progress_percentage' => 0,
                'completed' => false,
            ]);
            $user->requested_course_id = null;
        }
        $user->approved = true;
        $user->save();

        return redirect('/admin/users');
    }

    // Reject a pending student request (clear requested course)
    public function reject($id)
    {
        $user = User::findOrFail($id);
        $user->requested_course_id = null;
        $user->approved = false;
        $user->save();
        return redirect('/admin/users');
    }

    public function create()
    {
        $courses = \App\Models\Course::all();
        return view('admin.users.create', compact('courses'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'role' => 'required|in:student,teacher,admin',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
        ]);

        if ($validated['role'] == 'student' && $request->has('courses')) {
            foreach ($request->courses as $courseId) {
                \App\Models\Enrollment::create([
                    'student_id' => $user->id,
                    'course_id' => $courseId,
                    'progress_percentage' => 0,
                    'completed' => false,
                ]);
            }
        }

        return redirect('/admin/users');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $courses = \App\Models\Course::all();
        return view('admin.users.edit', compact('user', 'courses'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|min:6',
            'role' => 'required|in:student,teacher,admin',
        ]);

        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->role = $validated['role'];

        if ($request->filled('password')) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        return redirect('/admin/users');
    }

    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        return redirect('/admin/users');
    }
}

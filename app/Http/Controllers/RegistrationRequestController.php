<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RegistrationRequest;
use App\Models\Course;

class RegistrationRequestController extends Controller
{
    public function create()
    {
        $courses = Course::all();
        return view('registration-request', compact('courses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'mobile' => 'required|string|max:20',
            'email' => 'required|email|unique:registration_requests,email',
            'age' => 'required|integer|min:10|max:100',
            'course_id' => 'required|exists:courses,id'
        ]);

        RegistrationRequest::create($request->all());

        return redirect()->back()->with('success', 'تم إرسال طلبك بنجاح! سيتم مراجعته من قبل الإدارة.');
    }
}

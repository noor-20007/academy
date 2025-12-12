<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RegistrationRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegistrationRequestController extends Controller
{
    public function index()
    {
        $requests = RegistrationRequest::with('course')->orderBy('created_at', 'desc')->get();
        return view('admin.registration-requests.index', compact('requests'));
    }

    public function approve(RegistrationRequest $request)
    {
        // إنشاء المستخدم
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'age' => $request->age,
            'password' => Hash::make('123456'), // كلمة مرور افتراضية
            'role' => 'student',
            'approved' => true
        ]);

        // تحديث حالة الطلب
        $request->update(['status' => 'approved']);

        return redirect()->back()->with('success', 'تم قبول الطلب وإنشاء الحساب بنجاح');
    }

    public function reject(RegistrationRequest $request)
    {
        $request->update(['status' => 'rejected']);
        return redirect()->back()->with('success', 'تم رفض الطلب');
    }
}

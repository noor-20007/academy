@extends('layouts.app')

@section('title', 'إنشاء حساب')

@section('content')
<div class="max-w-md mx-auto px-4">
    <div class="bg-white rounded-lg shadow-lg p-8">
        <h1 class="text-3xl font-bold text-center mb-6">إنشاء حساب جديد</h1>

        <form method="POST" action="/register">
            @csrf

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">الاسم</label>
                <input type="text" name="name" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-600">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">البريد الإلكتروني</label>
                <input type="email" name="email" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-600">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">رقم الموبايل</label>
                <input type="text" name="mobile" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-600">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">السن</label>
                <input type="number" name="age" min="10" max="120" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-600">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">الكورس الذي ترغب الانضمام إليه</label>
                <select name="requested_course_id" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-600">
                    <option value="">لا أريد الانضمام الآن</option>
                    @foreach($courses as $course)
                        <option value="{{ $course->id }}">{{ $course->title }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">كلمة المرور</label>
                <input type="password" name="password" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-600">
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 font-semibold mb-2">تأكيد كلمة المرور</label>
                <input type="password" name="password_confirmation" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-600">
            </div>

            <button type="submit" class="w-full bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700 font-semibold">إنشاء حساب</button>
        </form>

        <p class="text-center mt-4 text-gray-600">
            لديك حساب بالفعل؟ <a href="/login" class="text-blue-600 hover:underline">تسجيل الدخول</a>
        </p>
    </div>
</div>
@endsection

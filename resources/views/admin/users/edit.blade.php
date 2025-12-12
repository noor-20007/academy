@extends('layouts.admin')

@section('title', 'تعديل مستخدم')
@section('header', 'تعديل مستخدم')

@section('content')
<div class="max-w-2xl mx-auto mt-8">
    <div class="bg-white rounded-lg shadow p-6">
        <form method="POST" action="/admin/users/{{ $user->id }}">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">الاسم</label>
                <input type="text" name="name" value="{{ $user->name }}" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-primary">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">البريد الإلكتروني</label>
                <input type="email" name="email" value="{{ $user->email }}" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-primary">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">كلمة المرور (اتركها فارغة للإبقاء على القديمة)</label>
                <input type="password" name="password" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-primary">
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 font-semibold mb-2">الدور</label>
                <select name="role" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-primary">
                    <option value="student" {{ $user->role == 'student' ? 'selected' : '' }}>طالب</option>
                    <option value="teacher" {{ $user->role == 'teacher' ? 'selected' : '' }}>مدرس</option>
                    <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>مدير</option>
                </select>
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 font-semibold mb-2">الكورسات (للطلاب فقط)</label>
                <div class="border rounded-lg p-4 max-h-48 overflow-y-auto">
                    @foreach($courses as $course)
                    <label class="flex items-center mb-2">
                        <input type="checkbox" name="courses[]" value="{{ $course->id }}" class="ml-2" {{ $user->enrolledCourses->contains($course->id) ? 'checked' : '' }}>
                        <span>{{ $course->title }}</span>
                    </label>
                    @endforeach
                </div>
            </div>

            <div class="flex gap-3">
                <button type="submit" class="bg-primary text-white px-6 py-2 rounded hover:bg-opacity-90">تحديث</button>
                <a href="/admin/users" class="bg-gray-300 text-gray-700 px-6 py-2 rounded hover:bg-gray-400">إلغاء</a>
            </div>
        </form>
    </div>
</div>
@endsection

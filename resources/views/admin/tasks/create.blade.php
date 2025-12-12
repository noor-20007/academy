@extends('layouts.admin')

@section('title', 'إضافة مهمة')
@section('header', 'إضافة مهمة جديدة')

@section('content')
<div class="max-w-2xl mx-auto mt-8">
    <div class="bg-white rounded-lg shadow p-6">
        <form method="POST" action="/admin/tasks">
            @csrf

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">الدرس</label>
                <select name="lesson_id" required class="w-full px-4 py-2 border rounded-lg">
                    <option value="">اختر الدرس</option>
                    @foreach($lessons as $lesson)
                    <option value="{{ $lesson->id }}">{{ $lesson->course->title }} - {{ $lesson->title }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">العنوان</label>
                <input type="text" name="title" required class="w-full px-4 py-2 border rounded-lg">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">الوصف</label>
                <textarea name="description" rows="4" class="w-full px-4 py-2 border rounded-lg"></textarea>
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 font-semibold mb-2">موعد التسليم</label>
                <input type="date" name="due_date" class="w-full px-4 py-2 border rounded-lg">
            </div>

            <div class="flex gap-3">
                <button type="submit" class="bg-primary text-white px-6 py-2 rounded">حفظ</button>
                <a href="/admin/tasks" class="bg-gray-300 text-gray-700 px-6 py-2 rounded">إلغاء</a>
            </div>
        </form>
    </div>
</div>
@endsection

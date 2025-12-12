@extends('layouts.admin')

@section('title', 'تعديل درس')
@section('header', 'تعديل درس')

@section('content')
<div class="max-w-2xl mx-auto mt-8">
    <div class="bg-white rounded-lg shadow p-6">
        <form method="POST" action="/admin/lessons/{{ $lesson->id }}">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">العنوان</label>
                <input type="text" name="title" value="{{ $lesson->title }}" required class="w-full px-4 py-2 border rounded-lg">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">الكورس</label>
                <select name="course_id" required class="w-full px-4 py-2 border rounded-lg">
                    @foreach($courses as $course)
                    <option value="{{ $course->id }}" {{ $lesson->course_id == $course->id ? 'selected' : '' }}>{{ $course->title }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">المحتوى</label>
                <textarea name="content" rows="4" class="w-full px-4 py-2 border rounded-lg">{{ $lesson->content }}</textarea>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">رابط الفيديو</label>
                <input type="text" name="video_url" value="{{ $lesson->video_url }}" class="w-full px-4 py-2 border rounded-lg">
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 font-semibold mb-2">المدة</label>
                <input type="number" name="duration" value="{{ $lesson->duration }}" class="w-full px-4 py-2 border rounded-lg">
            </div>

            <div class="flex gap-3">
                <button type="submit" class="bg-primary text-white px-6 py-2 rounded">تحديث</button>
                <a href="/admin/lessons" class="bg-gray-300 text-gray-700 px-6 py-2 rounded">إلغاء</a>
            </div>
        </form>
    </div>
</div>
@endsection

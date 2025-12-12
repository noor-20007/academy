@extends('layouts.admin')

@section('title', 'إضافة درس')
@section('header', 'إضافة درس جديد')

@section('content')
<div class="max-w-2xl mx-auto mt-8">
    <div class="bg-white rounded-lg shadow p-6">
        <form method="POST" action="/admin/lessons">
            @csrf

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">العنوان</label>
                <input type="text" name="title" required class="w-full px-4 py-2 border rounded-lg">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">الكورس</label>
                <select name="course_id" required class="w-full px-4 py-2 border rounded-lg">
                    <option value="">اختر الكورس</option>
                    @foreach($courses as $course)
                    <option value="{{ $course->id }}">{{ $course->title }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">المحتوى</label>
                <textarea name="content" rows="4" class="w-full px-4 py-2 border rounded-lg"></textarea>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">رابط الفيديو</label>
                <input type="text" name="video_url" class="w-full px-4 py-2 border rounded-lg">
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 font-semibold mb-2">المدة (بالدقائق)</label>
                <input type="number" name="duration" class="w-full px-4 py-2 border rounded-lg">
            </div>

            <div class="flex gap-3">
                <button type="submit" class="bg-primary text-white px-6 py-2 rounded">حفظ</button>
                <a href="/admin/lessons" class="bg-gray-300 text-gray-700 px-6 py-2 rounded">إلغاء</a>
            </div>
        </form>
    </div>
</div>
@endsection

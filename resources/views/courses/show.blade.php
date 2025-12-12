@extends('layouts.app')

@section('title', $course->title)

@section('content')
<div class="max-w-7xl mx-auto px-4 pt-8 pb-16">
    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <img src="{{ $course->thumbnail ?? 'https://via.placeholder.com/1200x400' }}" alt="{{ $course->title }}" class="w-full h-64 object-cover">

        <div class="p-8">
            <div class="flex justify-between items-start mb-6">
                <div>
                    @unless(auth()->check() && auth()->user()->role === 'student')
                        <span class="text-sm text-blue-600 font-semibold">{{ $course->category->name ?? 'عام' }}</span>
                    @endunless
                    <h1 class="text-4xl font-bold mt-2">{{ $course->title }}</h1>
                    <p class="text-gray-600 mt-2">بواسطة: {{ $course->teacher->name ?? 'مدرس' }}</p>
                </div>
                <div class="flex gap-3">
                    @if($course->roadmap && count($course->roadmap) > 0)
                        <a href="{{ route('courses.roadmap', $course->id) }}" class="bg-indigo-600 text-white px-6 py-3 rounded-lg hover:bg-indigo-700">Roadmap</a>
                    @endif
                    @auth
                        <form method="POST" action="/enroll" class="inline">
                            @csrf
                            <input type="hidden" name="course_id" value="{{ $course->id }}">
                            <button class="bg-primary text-white px-6 py-3 rounded-lg hover:bg-opacity-90">اشترك الآن</button>
                        </form>
                    @else
                        <a href="/login" class="bg-primary text-white px-6 py-3 rounded-lg hover:bg-opacity-90">سجل للاشتراك</a>
                    @endauth
                </div>
            </div>

            <div class="mb-8">
                <h2 class="text-2xl font-bold mb-4">عن الكورس</h2>
                <p class="text-gray-700 leading-relaxed">{{ $course->description }}</p>
            </div>

            <div class="mb-8">
                <h2 class="text-2xl font-bold mb-4">الدروس ({{ $course->lessons->count() }})</h2>
                <div class="space-y-3">
                    @foreach($course->lessons as $lesson)
                    <div class="border rounded-lg p-4 hover:bg-gray-50 transition">
                        <div class="flex justify-between items-center">
                            <div>
                                <h3 class="font-semibold">{{ $lesson->title }}</h3>
                                <p class="text-sm text-gray-600">{{ $lesson->duration }} دقيقة</p>
                            </div>
                            <a href="{{ route('lessons.show', $lesson->id) }}" class="text-blue-600 hover:text-blue-700">مشاهدة</a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    </div>
@endsection

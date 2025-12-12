@extends('layouts.app')

@section('title', 'لوحة المدرس')

@section('content')
<div class="max-w-7xl mx-auto px-4">
    <h1 class="text-4xl font-bold mb-8">لوحة المدرس</h1>

    <div class="grid md:grid-cols-3 gap-6 mb-8">
        <a href="/teacher/lessons" class="bg-white rounded-lg shadow-lg p-6 hover:shadow-xl transition text-center">
            <div class="text-4xl mb-3 text-primary"><i class="fas fa-video"></i></div>
            <h3 class="text-xl font-bold">الدروس</h3>
        </a>
        <a href="/teacher/tasks" class="bg-white rounded-lg shadow-lg p-6 hover:shadow-xl transition text-center">
            <div class="text-4xl mb-3 text-secondary"><i class="fas fa-tasks"></i></div>
            <h3 class="text-xl font-bold">المهام</h3>
        </a>
        <a href="/teacher/lessons" class="bg-white rounded-lg shadow-lg p-6 hover:shadow-xl transition text-center">
            <div class="text-4xl mb-3 text-accent"><i class="fas fa-user-check"></i></div>
            <h3 class="text-xl font-bold">الحضور</h3>
        </a>
    </div>

    <div class="bg-white rounded-lg shadow-lg p-6">
        <h2 class="text-2xl font-bold mb-6">كورساتي</h2>
        <div class="space-y-4">
            @foreach($courses as $course)
            <div class="border rounded-lg p-4">
                <h3 class="font-bold text-lg">{{ $course->title }}</h3>
                <p class="text-sm text-gray-600">عدد الدروس: {{ $course->lessons_count }}</p>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection

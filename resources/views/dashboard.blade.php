@extends('layouts.app')

@section('title', 'لوحة التحكم')

@section('content')
<div class="max-w-7xl mx-auto px-4">
    <h1 class="text-4xl font-bold mb-8">لوحة التحكم</h1>

    <div class="grid md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-lg shadow-lg p-6">
            <div class="text-3xl mb-2 text-blue-600"><i class="fas fa-book"></i></div>
            <h3 class="text-gray-600 text-sm">الكورسات المسجلة</h3>
            <p class="text-3xl font-bold text-blue-600">{{ $enrolledCourses ?? 0 }}</p>
        </div>
        <div class="bg-white rounded-lg shadow-lg p-6">
            <div class="text-3xl mb-2 text-green-600"><i class="fas fa-check-circle"></i></div>
            <h3 class="text-gray-600 text-sm">الكورسات المكتملة</h3>
            <p class="text-3xl font-bold text-green-600">{{ $completedCourses ?? 0 }}</p>
        </div>
        <div class="bg-white rounded-lg shadow-lg p-6">
            <div class="text-3xl mb-2 text-yellow-500"><i class="fas fa-star"></i></div>
            <h3 class="text-gray-600 text-sm">النقاط</h3>
            <p class="text-3xl font-bold text-yellow-600">{{ $points ?? 0 }}</p>
        </div>
        <div class="bg-white rounded-lg shadow-lg p-6">
            <div class="text-3xl mb-2 text-purple-600"><i class="fas fa-trophy"></i></div>
            <h3 class="text-gray-600 text-sm">الترتيب</h3>
            <p class="text-3xl font-bold text-purple-600">#{{ $rank ?? '-' }}</p>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-lg p-6">
        <h2 class="text-2xl font-bold mb-6">كورساتي</h2>
        <div class="space-y-4">
            @forelse($enrollments ?? [] as $enrollment)
            <div class="border rounded-lg p-4 hover:shadow-md transition">
                <div class="flex justify-between items-center mb-3">
                    <div>
                        <h3 class="font-bold text-lg">{{ $enrollment->course->title }}</h3>
                        <p class="text-sm text-gray-600">{{ $enrollment->course->teacher->name ?? 'مدرس' }}</p>
                    </div>
                    <a href="{{ route('courses.show', $enrollment->course->id) }}" class="bg-primary text-white px-4 py-2 rounded hover:bg-opacity-90">متابعة</a>
                </div>
                <div class="flex items-center gap-3">
                    <div class="flex-1 bg-gray-200 rounded-full h-2">
                        <div class="bg-primary h-2 rounded-full" style="width: {{ $enrollment->progress_percentage }}%"></div>
                    </div>
                    <span class="text-sm font-semibold text-gray-600">{{ $enrollment->progress_percentage }}%</span>
                </div>
            </div>
            @empty
            <p class="text-center text-gray-500 py-8">لم يتم تسجيلك في أي كورس بعد</p>
            @endforelse
        </div>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('title', $category->name)

@section('content')
<div class="max-w-7xl mx-auto px-4">
    <h1 class="text-4xl font-bold mb-8">{{ $category->name }}</h1>

    <div class="grid md:grid-cols-3 gap-6">
        @forelse($courses as $course)
        <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition">
            <img src="{{ $course->thumbnail ?? 'https://via.placeholder.com/400x200' }}" alt="{{ $course->title }}" class="w-full h-48 object-cover">
            <div class="p-6">
                <h3 class="text-xl font-bold mt-2 mb-2">{{ $course->title }}</h3>
                <p class="text-gray-600 text-sm mb-4">{{ Str::limit($course->description, 100) }}</p>
                <div class="flex justify-between items-center">
                    <span class="text-gray-500 text-sm">{{ $course->teacher->name ?? 'مدرس' }}</span>
                    <a href="{{ route('courses.show', $course->id) }}" class="bg-primary text-white px-4 py-2 rounded hover:bg-opacity-90">عرض</a>
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-3 text-center py-12">
            <p class="text-gray-500 text-xl">لا توجد كورسات في هذا التصنيف</p>
        </div>
        @endforelse
    </div>
</div>
@endsection

@extends('layouts.app')

@section('title', 'الكورسات')

@section('content')
<div class="max-w-7xl mx-auto px-4 pt-8 pb-16">
    <h1 class="text-4xl font-bold mb-8 mt-4 text-center bg-gradient-to-r from-orange-500 to-red-500 bg-clip-text text-transparent animate-pulse">جميع الكورسات</h1>

    <div class="grid md:grid-cols-3 gap-6">
        @forelse($courses as $course)
        <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-2xl hover:scale-105 transition-all duration-300 transform hover:-translate-y-2 group">
            <div class="relative overflow-hidden">
                <img src="{{ $course->thumbnail ?? 'https://via.placeholder.com/400x200' }}" alt="{{ $course->title }}" class="w-full h-48 object-cover group-hover:scale-110 transition-transform duration-300">
                <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
            </div>
            <div class="p-6">
                @unless(auth()->check() && auth()->user()->role === 'student')
                    <span class="text-sm text-orange-600 font-semibold bg-orange-100 px-2 py-1 rounded-full animate-bounce">{{ $course->category->name ?? 'عام' }}</span>
                @endunless
                <h3 class="text-xl font-bold mt-2 mb-2 group-hover:text-orange-600 transition-colors duration-300">{{ $course->title }}</h3>
                <p class="text-gray-600 text-sm mb-4 leading-relaxed">{{ Str::limit($course->description, 100) }}</p>
                <div class="flex justify-between items-center">
                    <span class="text-gray-500 text-sm flex items-center">
                        <svg class="w-4 h-4 ml-1 text-orange-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                        </svg>
                        {{ $course->teacher->name ?? 'مدرس' }}
                    </span>
                    <a href="{{ route('courses.show', $course->id) }}" class="bg-gradient-to-r from-orange-500 to-red-500 text-white px-6 py-2 rounded-full hover:from-orange-600 hover:to-red-600 transform hover:scale-110 transition-all duration-300 shadow-lg hover:shadow-xl font-semibold">عرض</a>
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-3 text-center py-12">
            <p class="text-gray-500 text-xl">لا توجد كورسات متاحة حالياً</p>
        </div>
        @endforelse
    </div>
</div>
@endsection

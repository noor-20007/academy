@extends('layouts.app')

@section('title', 'التصنيفات')

@section('content')
<div class="max-w-7xl mx-auto px-4">
    <h1 class="text-4xl font-bold mb-8">التصنيفات</h1>

    <div class="grid md:grid-cols-4 gap-6">
        @foreach($categories as $category)
        <a href="/categories/{{ $category->id }}/courses" class="bg-white rounded-lg shadow-lg p-6 hover:shadow-xl transition text-center">
            <div class="text-4xl mb-3 text-primary"><i class="fas fa-folder-open"></i></div>
            <h3 class="text-xl font-bold mb-2">{{ $category->name }}</h3>
            <p class="text-gray-600 text-sm">{{ $category->courses_count }} كورس</p>
        </a>
        @endforeach
    </div>
</div>
@endsection

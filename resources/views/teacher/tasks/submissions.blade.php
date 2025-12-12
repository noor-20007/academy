@extends('layouts.app')

@section('title', 'تسليمات المهمة')

@section('content')
<div class="max-w-7xl mx-auto px-4">
    <h1 class="text-3xl font-bold mb-2">{{ $task->title }}</h1>
    <p class="text-gray-600 mb-8">{{ $task->lesson->course->title }} - {{ $task->lesson->title }}</p>

    <div class="space-y-4">
        @forelse($submissions as $submission)
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex justify-between items-start mb-4">
                <div>
                    <h3 class="text-xl font-bold">{{ $submission->student->name }}</h3>
                    <a href="{{ $submission->github_link }}" target="_blank" class="text-blue-600 hover:underline text-sm mt-2 inline-block">
                        <i class="fab fa-github ml-1"></i> {{ $submission->github_link }}
                    </a>
                </div>
                @if($submission->score)
                <span class="bg-green-100 text-green-600 px-4 py-2 rounded font-semibold">{{ $submission->score }}/100</span>
                @endif
            </div>

            <form method="POST" action="/teacher/tasks/submissions/{{ $submission->id }}/feedback" class="border-t pt-4">
                @csrf
                
                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2">الملاحظات</label>
                    <textarea name="feedback" rows="3" class="w-full px-4 py-2 border rounded-lg">{{ $submission->feedback }}</textarea>
                </div>

                <div class="flex gap-3 items-end">
                    <div class="flex-1">
                        <label class="block text-gray-700 font-semibold mb-2">الدرجة (من 100)</label>
                        <input type="number" name="score" value="{{ $submission->score }}" min="0" max="100" required class="w-full px-4 py-2 border rounded-lg">
                    </div>
                    <button type="submit" class="bg-primary text-white px-6 py-2 rounded">حفظ</button>
                </div>
            </form>
        </div>
        @empty
        <div class="bg-white rounded-lg shadow p-12 text-center">
            <p class="text-gray-500">لا توجد تسليمات</p>
        </div>
        @endforelse
    </div>
</div>
@endsection

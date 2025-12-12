@extends('layouts.app')

@section('title', 'المهام')

@section('content')
<div class="max-w-7xl mx-auto px-4">
    <h1 class="text-4xl font-bold mb-8">المهام</h1>

    <div class="space-y-4">
        @forelse($tasks as $item)
        <div class="bg-white rounded-lg shadow-lg p-6">
            <div class="flex justify-between items-start mb-4">
                <div>
                    <h3 class="text-xl font-bold">{{ $item['task']->title }}</h3>
                    <p class="text-sm text-gray-600">{{ $item['course']->title }} - {{ $item['lesson']->title }}</p>
                    @if($item['task']->due_date)
                    <p class="text-sm text-gray-500 mt-1">موعد التسليم: {{ $item['task']->due_date }}</p>
                    @endif
                </div>
                @if($item['submission'])
                    @if($item['submission']->score)
                    <span class="bg-green-100 text-green-600 px-4 py-2 rounded font-semibold">
                        الدرجة: {{ $item['submission']->score }}
                    </span>
                    @else
                    <span class="bg-blue-100 text-blue-600 px-4 py-2 rounded">تم التسليم</span>
                    @endif
                @else
                <span class="bg-red-100 text-red-600 px-4 py-2 rounded">لم يتم التسليم</span>
                @endif
            </div>

            @if($item['task']->description)
            <p class="text-gray-700 mb-4">{{ $item['task']->description }}</p>
            @endif

            @if($item['submission'])
                <div class="border-t pt-4">
                    <p class="text-sm text-gray-600 mb-2">رابط GitHub: 
                        <a href="{{ $item['submission']->github_link }}" target="_blank" class="text-blue-600 hover:underline">
                            {{ $item['submission']->github_link }}
                        </a>
                    </p>
                    @if($item['submission']->feedback)
                    <div class="bg-yellow-50 border border-yellow-200 rounded p-3 mt-2">
                        <p class="text-sm font-semibold text-yellow-800">ملاحظات المدرس:</p>
                        <p class="text-sm text-yellow-700">{{ $item['submission']->feedback }}</p>
                    </div>
                    @endif
                </div>
            @else
                <form method="POST" action="/tasks/{{ $item['task']->id }}/submit" class="mt-4">
                    @csrf
                    <div class="flex gap-3">
                        <input type="url" name="github_link" placeholder="رابط GitHub" required class="flex-1 px-4 py-2 border rounded-lg">
                        <button type="submit" class="bg-primary text-white px-6 py-2 rounded hover:bg-opacity-90">تسليم</button>
                    </div>
                </form>
            @endif
        </div>
        @empty
        <div class="bg-white rounded-lg shadow-lg p-12 text-center">
            <p class="text-gray-500 text-xl">لا توجد مهام متاحة</p>
        </div>
        @endforelse
    </div>
</div>
@endsection

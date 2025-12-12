@extends('layouts.app')

@section('title', 'المهام')

@section('content')
<div class="max-w-7xl mx-auto px-4">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-4xl font-bold">المهام</h1>
        <a href="/teacher/tasks/create" class="bg-primary text-white px-4 py-2 rounded hover:bg-opacity-90"><i class="fas fa-plus ml-1"></i> إضافة مهمة</a>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-6 py-3 text-right">العنوان</th>
                    <th class="px-6 py-3 text-right">الدرس</th>
                    <th class="px-6 py-3 text-right">الكورس</th>
                    <th class="px-6 py-3 text-right">الإجراءات</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tasks as $task)
                <tr class="border-t">
                    <td class="px-6 py-4">{{ $task->title }}</td>
                    <td class="px-6 py-4">{{ $task->lesson->title }}</td>
                    <td class="px-6 py-4">{{ $task->lesson->course->title }}</td>
                    <td class="px-6 py-4">
                        <a href="/teacher/tasks/{{ $task->id }}/submissions" class="text-green-600 hover:underline">التسليمات</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

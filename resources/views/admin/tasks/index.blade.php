@extends('layouts.admin')

@section('title', 'إدارة المهام')
@section('header', 'إدارة المهام')

@section('content')
<div class="mb-4">
    <a href="/admin/tasks/create" class="bg-primary text-white px-4 py-2 rounded hover:bg-opacity-90"><i class="fas fa-plus ml-1"></i> إضافة مهمة</a>
</div>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="w-full">
        <thead class="bg-gray-100">
            <tr>
                <th class="px-6 py-3 text-right">العنوان</th>
                <th class="px-6 py-3 text-right">الدرس</th>
                <th class="px-6 py-3 text-right">الكورس</th>
                <th class="px-6 py-3 text-right">موعد التسليم</th>
                <th class="px-6 py-3 text-right">الإجراءات</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tasks as $task)
            <tr class="border-t">
                <td class="px-6 py-4">{{ $task->title }}</td>
                <td class="px-6 py-4">{{ $task->lesson->title }}</td>
                <td class="px-6 py-4">{{ $task->lesson->course->title }}</td>
                <td class="px-6 py-4">{{ $task->due_date ?? '-' }}</td>
                <td class="px-6 py-4">
                    <a href="/admin/tasks/{{ $task->id }}/submissions" class="text-green-600 hover:underline ml-3">التسليمات</a>
                    <form method="POST" action="/admin/tasks/{{ $task->id }}" class="inline">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('متأكد من الحذف؟')" class="text-red-600 hover:underline">حذف</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

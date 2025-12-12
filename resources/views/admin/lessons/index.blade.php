@extends('layouts.admin')

@section('title', 'إدارة الدروس')
@section('header', 'إدارة الدروس')

@section('content')
<div class="mb-4">
    <a href="/admin/lessons/create" class="bg-primary text-white px-4 py-2 rounded hover:bg-opacity-90"><i class="fas fa-plus ml-1"></i> إضافة درس</a>
</div>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="w-full">
        <thead class="bg-gray-100">
            <tr>
                <th class="px-6 py-3 text-right">العنوان</th>
                <th class="px-6 py-3 text-right">الكورس</th>
                <th class="px-6 py-3 text-right">المدة</th>
                <th class="px-6 py-3 text-right">الإجراءات</th>
            </tr>
        </thead>
        <tbody>
            @foreach($lessons as $lesson)
            <tr class="border-t">
                <td class="px-6 py-4">{{ $lesson->title }}</td>
                <td class="px-6 py-4">{{ $lesson->course->title ?? '-' }}</td>
                <td class="px-6 py-4">{{ $lesson->duration }} دقيقة</td>
                <td class="px-6 py-4">
                    <a href="/admin/lessons/{{ $lesson->id }}/edit" class="text-blue-600 hover:underline ml-3">تعديل</a>
                    <form method="POST" action="/admin/lessons/{{ $lesson->id }}" class="inline">
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

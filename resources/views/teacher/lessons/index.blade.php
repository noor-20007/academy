@extends('layouts.app')

@section('title', 'دروسي')

@section('content')
<div class="max-w-7xl mx-auto px-4">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-4xl font-bold">دروسي</h1>
        <a href="/teacher/lessons/create" class="bg-primary text-white px-4 py-2 rounded hover:bg-opacity-90"><i class="fas fa-plus ml-1"></i> إضافة درس</a>
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
                    <td class="px-6 py-4">{{ $lesson->course->title }}</td>
                    <td class="px-6 py-4">{{ $lesson->duration }} دقيقة</td>
                    <td class="px-6 py-4">
                        <a href="/teacher/attendance/{{ $lesson->id }}" class="text-green-600 hover:underline">الحضور</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

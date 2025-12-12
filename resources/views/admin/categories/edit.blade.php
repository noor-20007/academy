@extends('layouts.admin')

@section('title', 'تعديل تصنيف')
@section('header', 'تعديل تصنيف')

@section('content')
<div class="max-w-2xl mx-auto mt-8">
    <div class="bg-white rounded-lg shadow p-6">
        <form method="POST" action="/admin/categories/{{ $category->id }}">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">الاسم</label>
                <input type="text" name="name" value="{{ $category->name }}" required class="w-full px-4 py-2 border rounded-lg">
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 font-semibold mb-2">الوصف</label>
                <textarea name="description" rows="4" class="w-full px-4 py-2 border rounded-lg">{{ $category->description }}</textarea>
            </div>

            <div class="flex gap-3">
                <button type="submit" class="bg-primary text-white px-6 py-2 rounded">تحديث</button>
                <a href="/admin/categories" class="bg-gray-300 text-gray-700 px-6 py-2 rounded">إلغاء</a>
            </div>
        </form>
    </div>
</div>
@endsection

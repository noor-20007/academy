@extends('layouts.admin')

@section('title', 'إضافة تصنيف')
@section('header', 'إضافة تصنيف جديد')

@section('content')
<div class="max-w-2xl mx-auto mt-8">
    <div class="bg-white rounded-lg shadow p-6">
        <form method="POST" action="/admin/categories">
            @csrf

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">الاسم</label>
                <input type="text" name="name" required class="w-full px-4 py-2 border rounded-lg">
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 font-semibold mb-2">الوصف</label>
                <textarea name="description" rows="4" class="w-full px-4 py-2 border rounded-lg"></textarea>
            </div>

            <div class="flex gap-3">
                <button type="submit" class="bg-primary text-white px-6 py-2 rounded">حفظ</button>
                <a href="/admin/categories" class="bg-gray-300 text-gray-700 px-6 py-2 rounded">إلغاء</a>
            </div>
        </form>
    </div>
</div>
@endsection

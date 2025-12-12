@extends('layouts.app')

@section('title', 'طلب إنشاء حساب - CoreHouse Academy')

@section('content')
<style>
.form-bg {
    background: url('/home.png') center/cover no-repeat;
    position: relative;
    min-height: 100vh;
}
.form-bg::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(255, 255, 255, 0.7);
    backdrop-filter: blur(3px);
}
</style>
<div class="form-bg flex items-center">
<div class="max-w-2xl mx-auto px-4 relative z-10">
    <div class="bg-white rounded-lg shadow-lg p-8">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-2">طلب إنشاء حساب</h1>
            <p class="text-gray-600">املأ البيانات التالية وسيتم مراجعة طلبك من قبل الإدارة</p>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('registration.store') }}">
            @csrf
            
            <div class="mb-6">
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">الاسم الكامل</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" 
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary" required>
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="mobile" class="block text-sm font-medium text-gray-700 mb-2">رقم الموبايل</label>
                <input type="text" id="mobile" name="mobile" value="{{ old('mobile') }}" 
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary" required>
                @error('mobile')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">البريد الإلكتروني</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" 
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary" required>
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="age" class="block text-sm font-medium text-gray-700 mb-2">العمر</label>
                <input type="number" id="age" name="age" value="{{ old('age') }}" min="10" max="100"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary" required>
                @error('age')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="course_id" class="block text-sm font-medium text-gray-700 mb-2">الكورس المطلوب</label>
                <select id="course_id" name="course_id" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary" required>
                    <option value="">اختر الكورس</option>
                    @foreach($courses as $course)
                        <option value="{{ $course->id }}" {{ old('course_id') == $course->id ? 'selected' : '' }}>
                            {{ $course->title }}
                        </option>
                    @endforeach
                </select>
                @error('course_id')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" 
                    class="w-full bg-primary text-white py-3 px-4 rounded-md hover:bg-opacity-90 transition font-semibold">
                إرسال الطلب
            </button>
        </form>
    </div>
</div>
</div>
@endsection
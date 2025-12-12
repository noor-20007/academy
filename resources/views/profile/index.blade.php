@extends('layouts.app')

@section('title', 'الملف الشخصي')

@section('content')
<div class="max-w-7xl mx-auto px-4">
    <div class="grid md:grid-cols-3 gap-6">
        <div class="md:col-span-1">
            <div class="bg-white rounded-lg shadow-lg p-6 text-center">
                <div class="w-24 h-24 bg-blue-600 rounded-full mx-auto mb-4 flex items-center justify-center text-white text-3xl font-bold">
                    {{ substr(auth()->user()->name, 0, 1) }}
                </div>
                <h2 class="text-2xl font-bold mb-2">{{ auth()->user()->name }}</h2>
                <p class="text-gray-600 mb-4">{{ auth()->user()->email }}</p>
                <span class="inline-block bg-blue-100 text-blue-600 px-4 py-1 rounded-full text-sm font-semibold">
                    @if(auth()->user()->role == 'teacher')
                        مدرس
                    @elseif(auth()->user()->role == 'admin')
                        مدير
                    @else
                        طالب
                    @endif
                </span>
            </div>
        </div>

        <div class="md:col-span-2">
            <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
                <h2 class="text-2xl font-bold mb-4">تعديل الملف الشخصي</h2>
                @if(session('status'))
                    <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">{{ session('status') }}</div>
                @endif
                <form method="POST" action="{{ route('profile.update') }}">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium mb-1">الاسم</label>
                            <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}" class="w-full border rounded px-3 py-2" required>
                            @error('name') <div class="text-red-600 text-sm mt-1">{{ $message }}</div> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-1">البريد الإلكتروني</label>
                            <input type="email" name="email" value="{{ old('email', auth()->user()->email) }}" class="w-full border rounded px-3 py-2" required>
                            @error('email') <div class="text-red-600 text-sm mt-1">{{ $message }}</div> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-1">كلمة المرور (اختياري)</label>
                            <input type="password" name="password" class="w-full border rounded px-3 py-2">
                            @error('password') <div class="text-red-600 text-sm mt-1">{{ $message }}</div> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-1">تأكيد كلمة المرور</label>
                            <input type="password" name="password_confirmation" class="w-full border rounded px-3 py-2">
                        </div>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">حفظ</button>
                    </div>
                </form>
            </div>

            <!-- Courses list removed per request; profile edit only -->
        </div>
    </div>
</div>
@endsection

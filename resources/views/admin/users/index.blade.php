@extends('layouts.admin')

@section('title', 'إدارة المستخدمين')
@section('header', 'إدارة المستخدمين')

@section('content')
<div class="mb-4">
    <a href="/admin/users/create" class="bg-primary text-white px-4 py-2 rounded hover:bg-opacity-90"><i class="fas fa-plus ml-1"></i> إضافة مستخدم</a>
</div>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="w-full">
        <thead class="bg-gray-100">
            <tr>
                <th class="px-6 py-3 text-right">الاسم</th>
                <th class="px-6 py-3 text-right">البريد</th>
                <th class="px-6 py-3 text-right">الدور</th>
                <th class="px-6 py-3 text-right">الإجراءات</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr class="border-t">
                <td class="px-6 py-4">{{ $user->name }}</td>
                <td class="px-6 py-4">{{ $user->email }}</td>
                <td class="px-6 py-4">
                    <span class="px-2 py-1 rounded text-sm {{ $user->role == 'admin' ? 'bg-red-100 text-red-600' : ($user->role == 'teacher' ? 'bg-blue-100 text-blue-600' : 'bg-green-100 text-green-600') }}">
                        {{ $user->role == 'admin' ? 'مدير' : ($user->role == 'teacher' ? 'مدرس' : 'طالب') }}
                    </span>
                </td>
                <td class="px-6 py-4">
                    <a href="/admin/users/{{ $user->id }}/edit" class="text-blue-600 hover:underline ml-3">تعديل</a>
                    @if(!$user->approved && $user->requested_course_id && $user->role == 'student')
                        <form method="POST" action="/admin/users/{{ $user->id }}/approve" class="inline">
                            @csrf
                            <button onclick="return confirm('هل تريد قبول هذا الطالب؟')" class="text-green-600 hover:underline ml-2">قبول</button>
                        </form>
                        <form method="POST" action="/admin/users/{{ $user->id }}/reject" class="inline">
                            @csrf
                            <button onclick="return confirm('هل تريد رفض طلب الانضمام؟')" class="text-yellow-600 hover:underline ml-2">رفض</button>
                        </form>
                    @endif
                    <form method="POST" action="/admin/users/{{ $user->id }}" class="inline">
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

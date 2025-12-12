@extends('layouts.app')

@section('title', 'الحضور')

@section('content')
<div class="max-w-4xl mx-auto px-4">
    <h1 class="text-3xl font-bold mb-2">{{ $lesson->title }}</h1>
    <p class="text-gray-600 mb-8">{{ $lesson->course->title }}</p>

    <div class="bg-white rounded-lg shadow p-6">
        <form method="POST" action="/teacher/attendance/{{ $lesson->id }}">
            @csrf

            <div class="space-y-3 mb-6">
                @foreach($attendances as $item)
                <label class="flex items-center justify-between p-4 border rounded-lg hover:bg-gray-50">
                    <div>
                        <div class="font-semibold">{{ $item['student']->name }}</div>
                        <div class="text-sm text-gray-500">
                            @if($item['attended_at'])
                                وقت الحضور: {{ \Carbon\Carbon::parse($item['attended_at'])->translatedFormat('H:i d/m/Y') }}
                            @else
                                <span class="text-gray-400">لم يتم تسجيل وقت الحضور</span>
                            @endif
                            <div class="text-sm text-gray-500 mb-2">
                                @php
                                    $localVal = '';
                                    if(!empty($item['attended_at'])){
                                        try{
                                            $localVal = \Carbon\Carbon::parse($item['attended_at'])->format('Y-m-d\\TH:i');
                                        } catch(\Exception $e){
                                            $localVal = '';
                                        }
                                    }
                                @endphp
                                @if($item['attended_at'])
                                    وقت الحضور: {{ \Carbon\Carbon::parse($item['attended_at'])->translatedFormat('H:i d/m/Y') }}
                                @else
                                    <span class="text-gray-400">لم يتم تسجيل وقت الحضور</span>
                                @endif
                            </div>
                            <div class="flex items-center gap-2">
                                <input id="attended_at_{{ $item['student']->id }}" type="datetime-local" name="attended_at[{{ $item['student']->id }}]" value="{{ $localVal }}" class="border rounded px-2 py-1" />
                                <button type="button" class="text-sm px-2 py-1 bg-gray-100 rounded set-now" data-target="attended_at_{{ $item['student']->id }}">الآن</button>
                            </div>
                            <div class="mt-2">
                                <label class="flex items-center gap-2">
                                    <input type="checkbox" name="late[{{ $item['student']->id }}]" value="1" {{ !empty($item['late']) ? 'checked' : '' }} class="ml-2">
                                    <span class="text-yellow-600">متأخر</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="flex gap-4">
                        <label class="flex items-center">
                            <input type="radio" name="attendance[{{ $item['student']->id }}]" value="1" {{ $item['attended'] ? 'checked' : '' }} class="ml-2">
                            <span class="text-green-600">حاضر</span>
                        </label>
                        <label class="flex items-center">
                            <input type="radio" name="attendance[{{ $item['student']->id }}]" value="0" {{ !$item['attended'] ? 'checked' : '' }} class="ml-2">
                            <span class="text-red-600">غائب</span>
                        </label>
                    </div>
                </label>
                @endforeach
            </div>

            <button type="submit" class="bg-primary text-white px-6 py-3 rounded w-full">حفظ الحضور</button>
        </form>
    </div>
</div>
<script>
document.addEventListener('click', function(e){
    if(e.target && e.target.classList.contains('set-now')){
        var target = e.target.getAttribute('data-target');
        var input = document.getElementById(target);
        if(!input) return;
        var now = new Date();
        function pad(n){ return n < 10 ? '0' + n : n }
        var year = now.getFullYear();
        var month = pad(now.getMonth() + 1);
        var day = pad(now.getDate());
        var hours = pad(now.getHours());
        var minutes = pad(now.getMinutes());
        input.value = year + '-' + month + '-' + day + 'T' + hours + ':' + minutes;

        // also mark the student as present (if radio exists)
        var parts = target.split('_');
        var sid = parts[parts.length - 1];
        var radios = document.getElementsByName('attendance[' + sid + ']');
        if(radios){
            for(var i=0;i<radios.length;i++){
                if(radios[i].value === '1') radios[i].checked = true;
            }
        }
    }
});
</script>
@endsection

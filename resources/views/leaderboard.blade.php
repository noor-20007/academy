@extends('layouts.app')

@section('title', 'Champions Leaderboard')

@section('content')
{{-- فصل المتصدرين عن الباقي داخل القالب مباشرة --}}
@php
    $topThree = $leaderboard->take(3);
    $rest = $leaderboard->skip(3);
@endphp

<div class="min-h-screen bg-gray-50 pb-20">
    {{-- Header Section with Gradient --}}
    <div class="bg-indigo-900 relative overflow-hidden pb-32">
        <div class="absolute inset-0 bg-gradient-to-br from-indigo-600 to-purple-700 opacity-90"></div>
        {{-- Decorative Circles --}}
        <div class="absolute top-0 left-0 -translate-x-1/2 -translate-y-1/2 w-64 h-64 bg-purple-500 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob"></div>
        <div class="absolute bottom-0 right-0 translate-x-1/2 translate-y-1/2 w-64 h-64 bg-indigo-500 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob animation-delay-2000"></div>

        <div class="relative max-w-5xl mx-auto px-4 pt-12 pb-10 text-center text-white">
            <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight mb-4">
                <i class="fas fa-trophy text-yellow-400 animate-bounce mr-3"></i> white hats 
            </h1>
            <p class="text-indigo-100 text-lg max-w-2xl mx-auto">
                أقوى الطلاب أداءً وإنجازاً. المنافسة تشتعل!
            </p>
            <div class="mt-6">
                <a href="/leaderboard?recalc=1" class="inline-flex items-center px-6 py-3 border border-transparent text-sm font-medium rounded-full shadow-sm text-indigo-700 bg-white hover:bg-indigo-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all transform hover:scale-105">
                    <i class="fas fa-sync-alt mr-2 animate-spin-slow"></i> تحديث النتائج
                </a>
            </div>
        </div>
    </div>

    <div class="max-w-5xl mx-auto px-4 -mt-24 relative z-10">
        
        {{-- TOP 3 PODIUM SECTION --}}
        @if($topThree->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12 items-end">
            
            {{-- Rank 2 (Silver) --}}
            @if(isset($topThree[1]))
            <div class="order-2 md:order-1 bg-white rounded-2xl shadow-xl p-6 flex flex-col items-center transform transition duration-500 hover:-translate-y-2 border-b-4 border-gray-300 relative overflow-hidden group">
                <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition">
                    <i class="fas fa-medal text-6xl text-gray-400"></i>
                </div>
                <div class="relative">
                    <div class="w-20 h-20 rounded-full border-4 border-gray-300 flex items-center justify-center bg-gray-50 text-2xl font-bold text-gray-500 shadow-lg mb-4">
                        {{ strtoupper(substr($topThree[1]->student->name ?? 'S',0,1)) }}
                    </div>
                    <div class="absolute -bottom-2 -right-2 w-8 h-8 bg-gray-300 rounded-full flex items-center justify-center text-white font-bold border-2 border-white">2</div>
                </div>
                <h3 class="font-bold text-gray-800 text-lg truncate w-full text-center">{{ $topThree[1]->student->name ?? 'Student' }}</h3>
                <div class="mt-2 px-4 py-1 bg-gray-100 rounded-full text-gray-600 font-bold text-sm">
                    {{ $topThree[1]->score }} XP
                </div>
            </div>
            @endif

            {{-- Rank 1 (Gold) --}}
            @if(isset($topThree[0]))
            <div class="order-1 md:order-2 bg-white rounded-2xl shadow-2xl p-8 flex flex-col items-center transform transition duration-500 hover:-translate-y-3 border-b-4 border-yellow-400 relative overflow-hidden z-20 ring-4 ring-yellow-400/20">
                <div class="absolute top-0 inset-x-0 h-1 bg-gradient-to-r from-yellow-300 via-yellow-500 to-yellow-300"></div>
                <div class="mb-4 relative">
                     <i class="fas fa-crown text-4xl text-yellow-500 absolute -top-10 left-1/2 -translate-x-1/2 animate-pulse"></i>
                    <div class="w-24 h-24 rounded-full border-4 border-yellow-400 flex items-center justify-center bg-yellow-50 text-3xl font-bold text-yellow-600 shadow-lg">
                        {{ strtoupper(substr($topThree[0]->student->name ?? 'S',0,1)) }}
                    </div>
                    <div class="absolute -bottom-3 -right-3 w-10 h-10 bg-yellow-500 rounded-full flex items-center justify-center text-white font-bold border-2 border-white text-lg">1</div>
                </div>
                <h3 class="font-bold text-gray-900 text-xl truncate w-full text-center">{{ $topThree[0]->student->name ?? 'Champion' }}</h3>
                <p class="text-xs text-gray-500 mb-3">{{ $topThree[0]->student->email ?? '' }}</p>
                <div class="mt-2 px-6 py-2 bg-yellow-100 text-yellow-800 rounded-full font-extrabold text-lg shadow-sm">
                    {{ $topThree[0]->score }} XP
                </div>
            </div>
            @endif

            {{-- Rank 3 (Bronze) --}}
            @if(isset($topThree[2]))
            <div class="order-3 bg-white rounded-2xl shadow-xl p-6 flex flex-col items-center transform transition duration-500 hover:-translate-y-2 border-b-4 border-orange-300 relative overflow-hidden group">
                <div class="absolute top-0 left-0 p-4 opacity-10 group-hover:opacity-20 transition">
                    <i class="fas fa-medal text-6xl text-orange-400"></i>
                </div>
                <div class="relative">
                    <div class="w-20 h-20 rounded-full border-4 border-orange-300 flex items-center justify-center bg-orange-50 text-2xl font-bold text-orange-500 shadow-lg mb-4">
                        {{ strtoupper(substr($topThree[2]->student->name ?? 'S',0,1)) }}
                    </div>
                    <div class="absolute -bottom-2 -right-2 w-8 h-8 bg-orange-400 rounded-full flex items-center justify-center text-white font-bold border-2 border-white">3</div>
                </div>
                <h3 class="font-bold text-gray-800 text-lg truncate w-full text-center">{{ $topThree[2]->student->name ?? 'Student' }}</h3>
                <div class="mt-2 px-4 py-1 bg-orange-50 rounded-full text-orange-600 font-bold text-sm">
                    {{ $topThree[2]->score }} XP
                </div>
            </div>
            @endif
        </div>
        @endif

        {{-- REST OF THE LIST --}}
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100">
            <div class="p-6 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
                <h2 class="font-bold text-gray-700 text-lg">بقية المنافسين</h2>
                <span class="text-sm text-gray-500 bg-white px-3 py-1 rounded-full border shadow-sm">{{ $leaderboard->count() }} طالب</span>
            </div>
            
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-100">
                    <thead class="bg-gray-50">
                        <tr class="text-xs uppercase tracking-wider text-gray-500">
                            <th class="px-6 py-4 text-center w-24">المركز</th>
                            <th class="px-6 py-4 text-left">الطالب</th>
                            <th class="px-6 py-4 text-right">النقاط (Score)</th>
                            <th class="px-6 py-4 text-center">الإنجاز</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50 bg-white">
                        @forelse($rest as $entry)
                        <tr class="hover:bg-indigo-50/50 transition duration-150 group">
                            <td class="px-6 py-4 text-center whitespace-nowrap">
                                <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-gray-100 text-gray-600 font-bold text-sm group-hover:bg-indigo-100 group-hover:text-indigo-600 transition">
                                    {{ $loop->iteration + 3 }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10 rounded-full bg-gradient-to-br from-indigo-400 to-purple-500 flex items-center justify-center text-white font-bold text-sm shadow-sm">
                                        {{ strtoupper(substr($entry->student->name ?? 'S',0,1)) }}
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-semibold text-gray-900 group-hover:text-indigo-700 transition">{{ $entry->student->name ?? 'Student' }}</div>
                                        <div class="text-xs text-gray-500">{{ $entry->student->email ?? '' }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-sm font-bold bg-green-100 text-green-800">
                                    {{ $entry->score }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500">
                                {{-- Placeholder for progress bar --}}
                                <div class="w-24 bg-gray-200 rounded-full h-2 mx-auto overflow-hidden">
                                    <div class="bg-indigo-500 h-2 rounded-full" style="width: {{ rand(40, 90) }}%"></div>
                                </div>
                            </td>
                        </tr>
                        @empty
                            @if($topThree->count() == 0)
                            <tr>
                                <td colspan="4" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center justify-center">
                                        <i class="fas fa-ghost text-4xl text-gray-300 mb-3"></i>
                                        <p class="text-gray-500">لا يوجد بيانات حالياً.</p>
                                        <a href="/leaderboard?recalc=1" class="text-indigo-600 hover:text-indigo-800 font-medium mt-2">ابدأ الحساب الآن</a>
                                    </div>
                                </td>
                            </tr>
                            @endif
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@extends('layouts.app')

@section('title', $course->title . ' - Roadmap')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-orange-50 via-white to-orange-50 py-16">
    <div class="max-w-6xl mx-auto px-4">

        {{-- Header --}}
        <div class="text-center mb-20">
            <div class="inline-block mb-4">
                <span class="px-4 py-2 bg-orange-100 text-orange-600 rounded-full text-sm font-semibold">Learning Path</span>
            </div>
            <h1 class="text-5xl font-bold text-gray-900 mb-4">{{ $course->title }}</h1>
            <p class="text-gray-600 text-xl mb-6">Follow your journey to mastery, one step at a time</p>
            <a href="/courses/{{ $course->id }}" class="inline-flex items-center text-orange-600 hover:text-orange-700 font-medium transition group">
                <svg class="w-5 h-5 mr-2 transform group-hover:-translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Back to course
            </a>
        </div>

        @if($course->roadmap && count($course->roadmap) > 0)

        <div class="relative">

            {{-- Vertical Gradient Line --}}
            <div class="absolute left-1/2 transform -translate-x-1/2 h-full w-1 bg-gradient-to-b from-orange-400 via-orange-500 to-orange-600 rounded-full shadow-lg"></div>

            <div class="space-y-16">
                @foreach($course->roadmap as $i => $level)

                @php
                    $isLeft = $i % 2 == 0;
                @endphp

                {{-- Timeline Item --}}
                <div class="flex {{ $isLeft ? 'justify-start' : 'justify-end' }} items-center w-full">

                    <div class="relative {{ $isLeft ? 'pr-12' : 'pl-12' }}" style="width: calc(50% - 1rem);">

                        {{-- Animated Dot on Center Line --}}
                        <div class="absolute top-8 {{ $isLeft ? 'right-[-13px]' : 'left-[-13px]' }}
                                    w-7 h-7 bg-gradient-to-br from-orange-400 to-orange-600 rounded-full
                                    border-4 border-white shadow-xl z-10
                                    hover:scale-125 transition-transform duration-300 cursor-pointer
                                    animate-pulse">
                        </div>

                        {{-- Connector Line to Card --}}
                        <div class="absolute top-8 {{ $isLeft ? 'right-0' : 'left-0' }}
                                    {{ $isLeft ? 'w-12' : 'w-12' }} h-0.5 bg-gradient-to-{{ $isLeft ? 'l' : 'r' }}
                                    from-orange-300 to-transparent"></div>

                        {{-- Card --}}
                        <div class="bg-white rounded-2xl p-8 border-2 border-orange-100
                                    hover:border-orange-300 hover:shadow-2xl
                                    transition-all duration-300 transform hover:-translate-y-1
                                    group relative overflow-hidden">

                            {{-- Decorative Corner --}}
                            <div class="absolute top-0 {{ $isLeft ? 'right-0' : 'left-0' }}
                                        w-20 h-20 bg-gradient-to-br from-orange-100 to-transparent
                                        rounded-{{ $isLeft ? 'bl' : 'br' }}-full opacity-50"></div>

                            <div class="flex items-start gap-5 relative z-10">

                                {{-- Level Number Badge --}}
                                <div class="flex-shrink-0">
                                    <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-orange-500 to-orange-600
                                                text-white flex items-center justify-center font-bold text-2xl
                                                shadow-lg group-hover:scale-110 transition-transform duration-300">
                                        {{ $level['level'] }}
                                    </div>
                                </div>

                                {{-- Content --}}
                                <div class="flex-1 pt-1">
                                    <div class="flex items-center gap-2 mb-3">
                                        <h3 class="text-2xl font-bold text-gray-900 group-hover:text-orange-600 transition">
                                            {{ $level['title'] }}
                                        </h3>
                                    </div>

                                    @if(!empty($level['description']))
                                    <p class="text-gray-600 leading-relaxed text-base">
                                        {{ $level['description'] }}
                                    </p>
                                    @endif

                                    {{-- Progress Indicator --}}
                                    <div class="mt-4 flex items-center gap-2 text-sm">
                                        <div class="w-2 h-2 bg-orange-500 rounded-full animate-pulse"></div>
                                        <span class="text-gray-500 font-medium">Level {{ $level['level'] }}</span>
                                    </div>
                                </div>

                            </div>

                            {{-- Hover Glow Effect --}}
                            <div class="absolute inset-0 bg-gradient-to-br from-orange-400/0 to-orange-600/0
                                        group-hover:from-orange-400/5 group-hover:to-orange-600/5
                                        rounded-2xl transition-all duration-300 pointer-events-none"></div>
                        </div>

                    </div>

                </div>

                @endforeach
            </div>

            {{-- End Badge --}}
            <div class="flex justify-center mt-16">
                <div class="w-16 h-16 rounded-full bg-gradient-to-br from-orange-500 to-orange-600
                            flex items-center justify-center shadow-2xl border-4 border-white">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                    </svg>
                </div>
            </div>

        </div>

        @else
        <div class="bg-white rounded-2xl shadow-lg p-12 text-center border-2 border-orange-100">
            <div class="w-20 h-20 bg-orange-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-10 h-10 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
            </div>
            <h3 class="text-xl font-semibold text-gray-800 mb-2">No Roadmap Available</h3>
            <p class="text-gray-500">This course doesn't have a defined roadmap yet.</p>
        </div>
        @endif

    </div>
</div>
@endsection

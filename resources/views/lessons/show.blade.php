@extends('layouts.app')

@section('title', $lesson->title)

@section('content')
<div class="max-w-7xl mx-auto px-4">
    <div class="grid md:grid-cols-3 gap-6">
        <div class="md:col-span-2">
            <div class="bg-white rounded-lg shadow-lg overflow-hidden mb-6">
                <div class="bg-black aspect-video flex items-center justify-center">
                    @if($lesson->video_url)
                        @php
                            $videoUrl = $lesson->video_url;
                            $embed = $videoUrl;

                            // Convert common YouTube URLs to embed format
                            if (str_contains($videoUrl, 'youtube.com/watch')) {
                                $query = parse_url($videoUrl, PHP_URL_QUERY);
                                parse_str($query ?? '', $qs);
                                if (!empty($qs['v'])) {
                                    $embed = 'https://www.youtube.com/embed/' . $qs['v'];
                                }
                            } elseif (str_contains($videoUrl, 'youtu.be/')) {
                                if (preg_match('%youtu\.be/([A-Za-z0-9_-]+)%', $videoUrl, $m)) {
                                    $embed = 'https://www.youtube.com/embed/' . $m[1];
                                }
                            }
                        @endphp

                        <iframe src="{{ $embed }}" class="w-full h-full" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    @else
                        <p class="text-white">الفيديو غير متاح</p>
                    @endif
                </div>

                <div class="p-6">
                    <h1 class="text-3xl font-bold mb-2">{{ $lesson->title }}</h1>
                    <p class="text-gray-600 mb-4">{{ $lesson->duration }} دقيقة</p>
                    <div class="prose max-w-none">
                        <p>{{ $lesson->content }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div>
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h2 class="text-xl font-bold mb-4">دروس الكورس</h2>
                <div class="space-y-2">
                    @foreach($lesson->course->lessons as $item)
                    <a href="{{ route('lessons.show', $item->id) }}"
                       class="block p-3 rounded {{ $item->id == $lesson->id ? 'bg-blue-100 border-r-4 border-blue-600' : 'hover:bg-gray-50' }}">
                        <p class="font-semibold text-sm">{{ $item->title }}</p>
                        <p class="text-xs text-gray-600">{{ $item->duration }} دقيقة</p>
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('title', 'Barangay Bulletin – Purok Hisu-an')

@section('content')
<div class="relative board-frame rounded-2xl p-4 sm:p-10 my-3 max-w-4xl mx-auto">
    <div class="mb-6">
        <a href="{{ route('posts.index') }}" class="inline-flex items-center text-sm sm:text-base font-bold text-stone-900 bg-[#fdfaf5] hover:bg-white px-5 py-2.5 rounded-lg shadow-md border-2 border-stone-400 transition">
            📌 &larr; Back to Bulletin Board
        </a>
    </div>

    <div class="relative max-w-3xl mx-auto">
        <div class="absolute -top-4 left-1/2 -translate-x-1/2 z-20 text-3xl pin-head">
            @if ($post->is_pinned)
                <span>📌</span>
            @else
                <span>📍</span>
            @endif
        </div>

        <article class="bg-[#fefdfa] border-2 border-stone-300 rounded-2xl p-6 sm:p-10 shadow-2xl relative">
            <div class="flex flex-wrap items-center justify-between gap-3 mb-6 pb-4 border-b-2 border-stone-200">
                <span class="font-bold px-3.5 py-1 bg-amber-100 text-amber-950 rounded-md border border-amber-300 text-xs sm:text-sm tracking-wide">
                    {{ $post->category }}
                </span>

                <div class="flex items-center space-x-2">
                    @if ($post->is_pinned)
                        <span class="bg-red-700 text-white font-black px-3 py-1 rounded text-xs shadow-xs tracking-wider">
                            📌 OFFICIAL PINNED ADVISORY
                        </span>
                    @endif
                    <span class="text-stone-600 text-xs sm:text-sm font-semibold">
                        {{ $post->published_at ? $post->published_at->format('F d, Y \a\t h:i A') : 'Draft' }}
                    </span>
                </div>
            </div>

            <h1 class="text-2xl sm:text-4xl font-black text-stone-950 tracking-tight leading-tight mb-6">
                {{ $post->title }}
            </h1>

            <div class="text-stone-900 text-base sm:text-lg leading-relaxed whitespace-pre-line mb-8 border-l-4 border-amber-600/70 pl-4 py-1">
                {{ $post->body }}
            </div>

            <div class="pt-4 border-t-2 border-stone-200 flex items-center justify-between text-xs sm:text-sm font-bold text-stone-700">
                <span class="bg-stone-200/80 text-stone-900 px-3 py-1 rounded-md">
                    Author ID: #{{ $post->author_id }}
                </span>
                <span class="bg-stone-100 text-stone-900 px-3 py-1 rounded-md border border-stone-300">
                    👀 {{ $post->views }} Views
                </span>
            </div>
        </article>
    </div>
</div>
@endsection

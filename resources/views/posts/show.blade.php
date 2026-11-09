@extends('layouts.app')

@section('title', 'Barangay Bulletin – Purok Hisu-an')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="mb-6">
        <a href="{{ route('posts.index') }}" class="inline-flex items-center text-sm font-medium text-indigo-600 hover:text-indigo-800 transition">
            &larr; Back to all announcements
        </a>
    </div>

    <article class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="p-6 sm:p-8 border-b border-slate-100">
            <div class="flex flex-wrap items-center gap-2 mb-4 text-xs">
                <span class="font-semibold px-3 py-1 bg-indigo-50 text-indigo-700 rounded-full border border-indigo-100">
                    {{ $post->category }}
                </span>
                @if ($post->is_pinned)
                    <span class="bg-amber-100 text-amber-800 font-bold px-3 py-1 rounded-full">
                        📌 Pinned Announcement
                    </span>
                @endif
                <span class="text-slate-400">
                    Published {{ $post->published_at ? $post->published_at->format('F d, Y \a\t h:i A') : 'Draft' }}
                </span>
            </div>

            <h1 class="text-2xl sm:text-4xl font-extrabold text-slate-900 tracking-tight leading-tight mb-4">
                {{ $post->title }}
            </h1>

            <div class="flex items-center justify-between text-xs sm:text-sm text-slate-500 pt-4 border-t border-slate-100">
                <div>
                    <span class="font-medium text-slate-700">Author ID: #{{ $post->author_id }}</span>
                </div>
                <div class="flex items-center space-x-1 font-medium">
                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                    <span>{{ $post->views }} views</span>
                </div>
            </div>
        </div>

        <div class="p-6 sm:p-8">
            <div class="prose max-w-none text-slate-700 leading-relaxed text-base whitespace-pre-line">
                {{ $post->body }}
            </div>
        </div>
    </article>
</div>
@endsection


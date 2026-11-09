@extends('layouts.app')

@section('title', 'Barangay Bulletin – Purok Hisu-an')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="mb-6 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Barangay Announcements</h1>
            <p class="text-slate-500 mt-1">Official bulletins, advisories, and community updates.</p>
        </div>
    </div>

    <!-- Step 17 Search & Filter Form -->
    <div class="bg-white p-4 rounded-xl border border-slate-200 shadow-sm mb-6">
        <form method="GET" action="{{ route('posts.index') }}" class="flex flex-col sm:flex-row gap-3">
            <input 
                type="text" 
                name="q" 
                value="{{ request('q') }}" 
                placeholder="Search title..." 
                class="flex-1 px-4 py-2 border border-slate-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
            >
            <select 
                name="category" 
                class="px-4 py-2 border border-slate-300 rounded-lg text-sm bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
            >
                <option value="">All Categories</option>
                @foreach ($categories as $c)
                    <option value="{{ $c }}" {{ request('category') === $c ? 'selected' : '' }}>
                        {{ $c }}
                    </option>
                @endforeach
            </select>
            <button 
                type="submit" 
                class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium px-5 py-2 rounded-lg text-sm transition cursor-pointer shadow-sm"
            >
                Filter
            </button>
            @if(request()->filled('q') || request()->filled('category'))
                <a 
                    href="{{ route('posts.index') }}" 
                    class="inline-flex items-center justify-center px-4 py-2 border border-slate-300 text-slate-600 hover:bg-slate-50 rounded-lg text-sm font-medium transition"
                >
                    Reset
                </a>
            @endif
        </form>
    </div>

    <!-- Posts Grid / List -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
        @forelse ($posts as $post)
            <article class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden flex flex-col justify-between hover:shadow-md transition relative">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-3 text-xs gap-2">
                        <span class="font-semibold px-2.5 py-1 bg-indigo-50 text-indigo-700 rounded-full border border-indigo-100">
                            {{ $post->category }}
                        </span>

                        <div class="flex items-center space-x-2">
                            @if ($post->is_pinned)
                                <span class="bg-amber-100 text-amber-800 font-bold px-2.5 py-0.5 rounded-full text-xs inline-flex items-center shadow-xs">
                                    📌 Pinned
                                </span>
                            @endif
                            <span class="text-slate-400">
                                {{ $post->published_at ? $post->published_at->format('M d, Y') : 'Draft' }}
                            </span>
                        </div>
                    </div>

                    <h2 class="text-xl font-bold text-slate-800 line-clamp-2 mb-2 hover:text-indigo-600 transition">
                        <a href="{{ route('posts.show', $post->id) }}">
                            {{ $post->title }}
                        </a>
                    </h2>

                    <p class="text-slate-600 text-sm line-clamp-3 mb-4">
                        {{ $post->body }}
                    </p>
                </div>

                <div class="px-6 py-4 bg-slate-50 border-t border-slate-100 flex items-center justify-between text-xs text-slate-500">
                    <div>
                        <span class="text-slate-500">Author ID: #{{ $post->author_id }}</span>
                    </div>
                    <div class="flex items-center space-x-1 text-slate-500">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                        <span>{{ $post->views }} views</span>
                    </div>
                </div>
            </article>
        @empty
            <div class="col-span-full p-8 bg-white rounded-xl shadow-sm border border-slate-200 text-center">
                <p class="text-slate-600 font-medium">No posts match your search.</p>
                <p class="text-slate-400 text-sm mt-1">Try searching with another keyword or resetting the filter.</p>
            </div>
        @endforelse
    </div>

    <!-- Pagination & Stats -->
    <div class="mt-6 flex flex-col md:flex-row items-center justify-between gap-4">
        <p class="text-sm text-slate-500 order-2 md:order-1">
            @if ($posts->total() > 0)
                Showing {{ $posts->firstItem() }}–{{ $posts->lastItem() }} of {{ $posts->total() }} posts
            @endif
        </p>
        <div class="order-1 md:order-2 w-full md:w-auto">
            {{ $posts->links() }}
        </div>
    </div>
</div>
@endsection

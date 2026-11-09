@extends('layouts.app')

@section('title', 'Barangay Bulletin – Purok Hisu-an')

@section('content')
<div class="relative board-frame rounded-2xl p-4 sm:p-8 my-3">
    <div class="relative mx-auto max-w-2xl text-center mb-8 bg-[#2d1708] text-amber-50 py-4 px-6 rounded-lg shadow-lg border-2 border-amber-900/80">
        <span class="absolute -top-3 left-6 text-xl pin-head">📌</span>
        <span class="absolute -top-3 right-6 text-xl pin-head">📌</span>

        <h1 class="text-2xl sm:text-3xl font-black tracking-wide uppercase text-amber-100">
            BARANGAY BULLETIN BOARD
        </h1>
        <p class="text-xs sm:text-sm text-amber-300 font-semibold tracking-wider mt-1">
            PUROK HISU-AN &bull; OFFICIAL COMMUNITY NOTICES & ANNOUNCEMENTS
        </p>
    </div>

    <div class="relative max-w-4xl mx-auto mb-8 bg-[#fdfaf5] p-4 sm:p-5 rounded-xl shadow-md border-2 border-stone-300">
        <div class="absolute -top-3 left-1/2 -translate-x-1/2 text-xl pin-head">📍</div>

        <form method="GET" action="{{ route('posts.index') }}" class="flex flex-col sm:flex-row gap-3 pt-1">
            <div class="relative flex-1">
                <label for="q" class="sr-only">Search notices</label>
                <input 
                    type="text" 
                    id="q"
                    name="q" 
                    value="{{ request('q') }}" 
                    placeholder="Search by announcement title..." 
                    class="w-full px-4 py-2.5 bg-white border-2 border-stone-400 rounded-lg text-base text-stone-900 placeholder-stone-500 font-medium focus:outline-none focus:ring-2 focus:ring-amber-700 focus:border-amber-700"
                >
            </div>
            
            <div class="sm:w-64">
                <label for="category" class="sr-only">Category</label>
                <select 
                    id="category"
                    name="category" 
                    class="w-full px-4 py-2.5 bg-white border-2 border-stone-400 rounded-lg text-base text-stone-900 font-semibold focus:outline-none focus:ring-2 focus:ring-amber-700 focus:border-amber-700 cursor-pointer"
                >
                    <option value="">All Categories</option>
                    @foreach ($categories as $c)
                        <option value="{{ $c }}" {{ request('category') === $c ? 'selected' : '' }}>
                            {{ $c }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button 
                type="submit" 
                class="bg-[#4a260d] hover:bg-[#2e1605] text-white font-bold px-7 py-2.5 rounded-lg text-base transition shadow cursor-pointer border border-[#2e1605]"
            >
                Filter
            </button>

            @if(request()->filled('q') || request()->filled('category'))
                <a 
                    href="{{ route('posts.index') }}" 
                    class="inline-flex items-center justify-center px-5 py-2.5 bg-stone-200 hover:bg-stone-300 text-stone-800 rounded-lg text-base font-bold transition border border-stone-400"
                >
                    Reset
                </a>
            @endif
        </form>
    </div>

    @php
        $paperStyles = [
            0 => ['bg' => 'bg-[#fffbeb]', 'border' => 'border-amber-300', 'badge' => 'bg-amber-100 text-amber-950 border-amber-300'],
            1 => ['bg' => 'bg-[#f0fdf4]', 'border' => 'border-emerald-300', 'badge' => 'bg-emerald-100 text-emerald-950 border-emerald-300'],
            2 => ['bg' => 'bg-[#f8fafc]', 'border' => 'border-slate-300', 'badge' => 'bg-slate-200 text-slate-900 border-slate-300'],
            3 => ['bg' => 'bg-[#fef7ee]', 'border' => 'border-orange-200', 'badge' => 'bg-orange-100 text-orange-950 border-orange-300'],
        ];
    @endphp

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4 sm:gap-5 mb-8">
        @forelse ($posts as $index => $post)
            @php
                $style = $paperStyles[$index % 4];
            @endphp
            <div class="relative group">
                <div class="absolute -top-3.5 left-1/2 -translate-x-1/2 z-10 text-xl pin-head">
                    @if ($post->is_pinned)
                        <span title="Pinned Announcement">📌</span>
                    @else
                        <span title="Notice">📍</span>
                    @endif
                </div>

                <article class="{{ $style['bg'] }} {{ $style['border'] }} rounded-xl p-4 sm:p-5 pt-6 border-2 shadow-md hover:shadow-xl flex flex-col justify-between min-h-[300px] relative transition-all">
                    <div>
                        <div class="flex items-center justify-between mb-2 text-xs font-bold gap-1">
                            <span class="px-2 py-0.5 rounded border text-[11px] {{ $style['badge'] }}">
                                {{ $post->category }}
                            </span>

                            <div class="flex items-center space-x-1">
                                @if ($post->is_pinned)
                                    <span class="bg-red-700 text-white font-black px-1.5 py-0.5 rounded text-[10px] tracking-wide">
                                        📌 PINNED
                                    </span>
                                @endif
                                <span class="text-stone-600 font-semibold text-[11px]">
                                    {{ $post->published_at ? $post->published_at->format('M d, Y') : 'Draft' }}
                                </span>
                            </div>
                        </div>

                        <h2 class="text-base sm:text-lg font-black text-stone-950 leading-snug mb-2 hover:text-amber-800 transition line-clamp-2">
                            <a href="{{ route('posts.show', $post->id) }}" class="hover:underline">
                                {{ $post->title }}
                            </a>
                        </h2>

                        <p class="text-stone-800 text-xs sm:text-sm line-clamp-4 leading-relaxed font-normal mb-3">
                            {{ $post->body }}
                        </p>
                    </div>

                    <div class="pt-2 border-t-2 border-stone-200/80 flex items-center justify-between text-xs font-bold text-stone-700">
                        <span class="bg-stone-200/80 text-stone-800 px-2 py-0.5 rounded text-[11px]">
                            ID: #{{ $post->author_id }}
                        </span>
                        
                        <div class="flex items-center space-x-1 text-stone-900 bg-stone-100 px-2 py-0.5 rounded border border-stone-200 text-[11px]">
                            <svg class="w-3.5 h-3.5 text-stone-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            <span>{{ $post->views }}</span>
                        </div>
                    </div>
                </article>
            </div>
        @empty
            <div class="col-span-full relative max-w-lg mx-auto my-6 bg-white p-8 rounded-xl border-2 border-dashed border-stone-400 text-center shadow-lg">
                <span class="absolute -top-3 left-1/2 -translate-x-1/2 text-2xl pin-head">📌</span>
                <p class="text-stone-900 font-black text-xl mb-1">No posts match your search.</p>
                <p class="text-stone-600 text-base font-medium">Please check your keywords or reset the category filter.</p>
            </div>
        @endforelse
    </div>

    <div class="mt-8 bg-[#fdfaf5] p-4 sm:p-5 rounded-xl border-2 border-stone-300 shadow-md flex flex-col md:flex-row items-center justify-between gap-4">
        <p class="text-sm sm:text-base font-bold text-stone-800 order-2 md:order-1">
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

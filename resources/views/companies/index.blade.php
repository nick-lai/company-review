@extends('layouts.app')

@section('content')
    <h1 class="mb-10 text-2xl">Company Reviews</h1>

    <form method="GET" action="{{ route('companies.index') }}" class="mb-4 flex items-center space-x-2">
        <input
            type="text"
            name="name"
            placeholder="公司名稱搜尋"
            value="{{ request('name') }}"
            class="input h-10"
        />
        <input type="hidden" name="sort_by" value="{{ request('sort_by') }}" />
        <button type="submit" class="btn h-10 whitespace-pre">搜尋</button>
        <a href="{{ route('companies.index') }}" class="btn h-10 whitespace-pre">清除</a>
    </form>

    <p class="my-2">公司排序方式:</p>

    <div class="filter-container mb-4 flex">
        @php
            $sortingOptions = [
                '' => '最新建立的公司',
                'name_asc' => '名稱正序',
                'name_desc' => '名稱倒序',
                'latest_reviewed' => '最新評論',
                'oldest_reviewed' => '最舊評論',
                'highest_rated' => '最高平均評分',
                'lowest_rated' => '最低平均評分',
            ];

            $sortBy = request('sort_by', '');
        @endphp

        @foreach ($sortingOptions as $key => $label)
            <a
                href="{{ route('companies.index', [...request()->query(), 'sort_by' => $key]) }}"
                class="{{ $sortBy === $key ? 'filter-item-active' : 'filter-item hover:bg-slate-200' }}"
            >
                {{ $label }}
            </a>
        @endforeach
    </div>

    @if ($companies->count())
        <nav class="my-4">
            {{ $companies->appends(request()->all())->links() }}
        </nav>
    @endif

    <ul class="my-4">
        @forelse ($companies as $company)
            <li class="mb-4">
                <div class="book-item hover:bg-slate-100">
                    <div class="flex flex-wrap items-center justify-between">
                        <div class="w-full flex-grow sm:w-auto">
                            <a href="{{ route('companies.show', $company) }}" class="book-title">{{ $company->name }}</a>
                            <span class="book-author">負責人: {{ $company->owner }}</span>
                        </div>
                        <div>
                            <div class="book-rating">
                                <x-start-rating :rating="$company->reviews_avg_rating" />
                            </div>
                            <div class="book-review-count">
                                共 {{ $company->reviews_count }} 筆評論
                            </div>
                        </div>
                    </div>
                </div>
            </li>
        @empty
            <li class="mb-4">
                <div class="empty-book-item">
                    <p class="empty-text">沒有找到公司</p>
                    <a href="{{ route('companies.index') }}" class="reset-link">重置搜尋</a>
                </div>
            </li>
        @endforelse
    </ul>

    @if ($companies->count())
        <nav class="mt-4">
            {{ $companies->appends(request()->all())->links() }}
        </nav>
    @endif
@endsection

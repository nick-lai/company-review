@extends('layouts.app')

@section('content')
    <h1 class="mb-10 text-2xl">Company Reviews</h1>

    <form method="GET" action="{{ route('companies.index') }}" class="mb-4 flex items-center space-x-2">
        <input
            type="text"
            name="name"
            placeholder="Search by name"
            value="{{ request('name') }}"
            class="input h-10"
        />
        <input type="hidden" name="filter" value="{{ request('filter') }}" />
        <button type="submit" class="btn h-10">Search</button>
        <a href="{{ route('companies.index') }}" class="btn h-10">Clear</a>
    </form>

    <div class="filter-container mb-4 flex">
        @php
            $filters = [
                '' => 'Latest',
                'name_asc' => '依名稱由小到大',
                'name_desc' => '依名稱由大到小',
                'latest_reviewed' => '依評論建立時間由新到舊',
                'oldest_reviewed' => '依評論建立時間由舊到新',
                'highest_rated' => '依評分由高到低',
                'lowest_rated' => '依評分由低到高',
            ];

            $filter = request('filter', '');
        @endphp

        @foreach ($filters as $key => $label)
            <a
                href="{{ route('companies.index', [...request()->query(), 'filter' => $key]) }}"
                class="{{ $filter === $key ? 'filter-item-active' : 'filter-item' }}"
            >
                {{ $label }}
            </a>
        @endforeach
    </div>

    <ul>
        @forelse ($companies as $company)
            <li class="mb-4">
                <div class="book-item">
                    <div class="flex flex-wrap items-center justify-between">
                        <div class="w-full flex-grow sm:w-auto">
                            <a href="{{ route('companies.show', $company) }}" class="book-title">{{ $company->name }}</a>
                            <span class="book-author">by {{ $company->owner }}</span>
                        </div>
                        <div>
                            <div class="book-rating">
                                <x-start-rating :rating="$company->reviews_avg_rating" />
                            </div>
                            <div class="book-review-count">
                                out of {{ $company->reviews_count }} {{ Str::plural('review', $company->reviews_count) }}
                            </div>
                        </div>
                    </div>
                </div>
            </li>
        @empty
            <li class="mb-4">
                <div class="empty-book-item">
                    <p class="empty-text">No companies found</p>
                    <a href="{{ route('companies.index') }}" class="reset-link">Reset criteria</a>
                </div>
            </li>
        @endforelse
    </ul>
@endsection

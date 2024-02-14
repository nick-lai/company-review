@extends('layouts.app')

@section('content')
    <div class="mb-4">
        <h1 class="mb-2 text-2xl">{{ $company->name }}</h1>

        <div class="book-info">
            <div class="book-author mb-4 text-lg font-semibold">by {{ $company->owner }}</div>
            <div class="book-rating flex items-center">
                <div class="mr-2 text-sm font-medium text-slate-700">
                    <x-start-rating :rating="$company->reviews_avg_rating" />
                </div>
                <span class="book-review-count text-sm text-gray-500">
                    {{ $company->reviews_count }} {{ Str::plural('review', $company->reviews_count) }}
                </span>
            </div>
        </div>
    </div>


    <div class="mb-4">
        <a href="{{ route('companies.reviews.create', $company) }}" class="reset-link">
            Add a review!
        </a>
    </div>

    <div>
        <h2 class="mb-4 text-xl font-semibold">Reviews</h2>
        <ul>
            @forelse ($company->reviews as $review)
                <li class="book-item mb-4">
                    <div>
                        <div class="mb-2 flex items-center justify-between">
                            <x-start-rating :rating="$review->rating" />
                            <div class="book-review-count">
                                {{ $review->created_at->format('M j, Y') }}</div>
                        </div>
                        <p class="text-gray-700">{{ $review->review }}</p>
                    </div>
                </li>
            @empty
                <li class="mb-4">
                    <div class="empty-book-item">
                        <p class="empty-text text-lg font-semibold">No reviews yet</p>
                    </div>
                </li>
            @endforelse
        </ul>
    </div>
@endsection

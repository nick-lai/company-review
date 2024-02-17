@extends('layouts.app')

@section('content')
    <div class="mb-4">
        <div class="mb-4">
            <a href="{{ route('companies.index') }}" class="btn">返回</a>
        </div>

        <h1 class="mb-2 text-2xl">{{ $company->name }}</h1>

        <div class="book-info">
            <div class="book-author mb-4 text-lg font-semibold">負責人: {{ $company->owner }}</div>
            <div class="book-rating flex items-center">
                <div class="mr-2 text-sm font-medium text-slate-700">
                    <x-start-rating :rating="$company->reviews_avg_rating" />
                </div>
            </div>
        </div>
    </div>


    <div class="mb-4 float-right">
        <a href="{{ route('companies.reviews.create', $company, false) }}" class="btn">新增評論</a>
    </div>

    <div>
        <h2 class="mb-4 text-xl font-semibold">所有評論:</h2>

        @if ($reviews->count())
            <nav class="my-4">
                {{ $reviews->appends(request()->all())->links() }}
            </nav>
        @endif

        <ul>
            @forelse ($reviews as $review)
                <li class="book-item mb-4">
                    <div>
                        <div class="mb-2 flex items-center justify-between">
                            <x-start-rating :rating="$review->rating" />
                            <div class="book-review-count">
                                建立時間: {{ $review->created_at->format('Y-m-d H:i:s') }}
                            </div>
                        </div>
                        <p class="text-gray-700">{{ $review->review }}</p>
                        <div class="mt-2 flex">
                            <a
                                class="w-1/2 mx-1 btn hover-underline hover:decoration-green-500"
                                href="{{ route('companies.reviews.edit', ['company' => $company, 'review' => $review]) }}"
                            >
                                修改評論
                            </a>
                            <form
                                class="w-1/2 mx-1"
                                action="{{ route('companies.reviews.destroy', ['company' => $company, 'review' => $review]) }}"
                                method="POST"
                            >
                                @csrf
                                @method('DELETE')
                                <button class="btn w-full	 hover-underline hover:decoration-pink-500">刪除評論</button>
                            </form>
                        </div>
                    </div>
                </li>
            @empty
                <li class="mb-4">
                    <div class="empty-book-item">
                        <p class="empty-text text-lg font-semibold">尚無評論</p>
                    </div>
                </li>
            @endforelse
        </ul>

        @if ($reviews->count())
            <nav class="my-4">
                {{ $reviews->appends(request()->all())->links() }}
            </nav>
        @endif
    </div>
@endsection

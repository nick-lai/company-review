@extends('layouts.app')

@section('content')
    <div class="mb-4">
        <a href="{{ route('companies.show', $company) }}" class="btn">返回</a>
    </div>

    <h1 class="mb-10 text-2xl">新增 {{ $company->name }} 的評論</h1>

    <form method="POST" action="{{ route('companies.reviews.store', $company) }}">
        @csrf
        <label for="review">評論</label>
        <textarea name="review" id="review" required class="input mb-4">{{ old('review') }}</textarea>
        @error('review')
            <p class="error">{{ $message }}</p>
        @enderror

        <label for="rating">評分</label>

        <select name="rating" id="rating" class="input mb-4" required>
            <option hidden disabled selected>選擇評分</option>
            @for ($i = 1; $i <= 10; $i++)
                <option value="{{ $i }}">{{ $i }}</option>
            @endfor
        </select>
        @error('rating')
            <p class="error">{{ $message }}</p>
        @enderror

        <button type="submit" class="btn">新增評論</button>
    </form>
@endsection
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Company extends Model
{
    use HasFactory;

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    public function scopeName(Builder $query, string $name): Builder
    {
        return $query->where('name', 'LIKE', "%{$name}%");
    }

    public function scopeWithMaxReviewedAt(Builder $query, $from = null, $to = null): Builder
    {
        return $query->withMax([
            'reviews' => fn (Builder $q) => $this->dateRangeFilter($q, $from, $to),
        ], 'created_at');
    }

    public function scopeLatestReviewed(Builder $query, $from = null, $to = null): Builder
    {
        return $query->withMaxReviewedAt($from, $to)
            ->orderBy('reviews_max_created_at', 'DESC');
    }

    public function scopeWithMinReviewedAt(Builder $query, $from = null, $to = null): Builder
    {
        return $query->withMin([
            'reviews' => fn (Builder $q) => $this->dateRangeFilter($q, $from, $to),
        ], 'created_at');
    }

    public function scopeOldestReviewed(Builder $query, $from = null, $to = null): Builder
    {
        return $query->withMinReviewedAt($from, $to)
            ->orderBy('reviews_min_created_at', 'ASC');
    }

    public function scopeWithAvgRating(Builder $query, $from = null, $to = null): Builder
    {
        return $query->withAvg([
            'reviews' => fn (Builder $q) => $this->dateRangeFilter($q, $from, $to),
        ], 'rating');
    }

    public function scopeHighestRated(Builder $query, $from = null, $to = null): Builder
    {
        return $query->withAvgRating($from, $to)
            ->orderBy('reviews_avg_rating', 'DESC');
    }

    public function scopeLowestRated(Builder $query, $from = null, $to = null): Builder
    {
        return $query->withAvgRating($from, $to)
            ->orderBy('reviews_avg_rating', 'ASC');
    }

    public function scopeWithReviewsCount(Builder $query, $from = null, $to = null): Builder
    {
        return $query->withCount([
            'reviews' => fn (Builder $q) => $this->dateRangeFilter($q, $from, $to),
        ]);
    }

    public function scopePopular(Builder $query, $from = null, $to = null): Builder
    {
        return $query->withReviewsCount($from, $to)
            ->orderBy('reviews_count', 'DESC');
    }

    protected function dateRangeFilter(Builder $query, $from = null, $to = null): void
    {
        if ($from && $to) {
            $query->whereBetween('created_at', [$from, $to]);
            return;
        }

        if ($from) {
            $query->where('created_at', '>=', $from);
        }

        if ($to) {
            $query->where('created_at', '<=', $from);
        }
    }
}

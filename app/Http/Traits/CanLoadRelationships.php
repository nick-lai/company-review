<?php

namespace App\Http\Traits;

use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Query\Builder as QueryBuilder;

trait CanLoadRelationships
{
    protected function loadRelationships(
        Model|EloquentBuilder|QueryBuilder|HasMany $for,
        ?array $allowedRelations = null
    ): Model|EloquentBuilder|QueryBuilder|HasMany {
        $allowedRelations = $allowedRelations ?? $this->allowedRelations ?? [];

        $relations = array_filter(
            $this->getIncludeRelations(),
            fn ($relation) => in_array($relation, $allowedRelations)
        );

        return $for instanceof Model
            ? $for->load($relations)
            : $for->with($relations);
    }

    protected function getIncludeRelations(): array
    {
        $include = request()->query('include');

        return $include ? array_map('trim', explode(',', $include)) : [];
    }
}

<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CompanyResource extends JsonResource
{
    protected string $dateFormat = 'Y-m-d H:i:s';

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name'=> $this->name,
            'address' => $this->address,
            'phone_number' => $this->phone_number,
            'owner' => $this->owner,
            'created_at' => $this->created_at->format($this->dateFormat),
            'updated_at'=> $this->updated_at->format($this->dateFormat),
            'reviews_avg_rating' => $this->whenNotNull($this->reviews_avg_rating),
            'reviews_max_created_at' => $this->whenNotNull($this->reviews_max_created_at),
            'reviews_min_created_at' => $this->whenNotNull($this->reviews_min_created_at),
            'reviews_count' => $this->whenNotNull($this->reviews_count),
            'reviews' => ReviewResource::collection($this->whenLoaded('reviews')),
        ];
    }
}

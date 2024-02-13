<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReviewResource extends JsonResource
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
            'company_id'=> $this->company_id,
            'user_id' => $this->user_id,
            'review' => $this->review,
            'rating' => $this->rating,
            'created_at' => $this->created_at->format($this->dateFormat),
            'updated_at'=> $this->updated_at->format($this->dateFormat),
            'company' => CompanyResource::make($this->whenLoaded('company')),
            'user' => UserResource::make($this->whenLoaded('user')),
        ];
    }
}

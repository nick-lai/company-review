<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'name' => $this->name,
            'email' => $this->email,
            'created_at' => $this->created_at->format($this->dateFormat),
            'updated_at'=> $this->updated_at->format($this->dateFormat),
            'reviews' => ReviewResource::collection($this->whenLoaded('reviews')),
        ];
    }
}

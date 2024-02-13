<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ReviewResource;
use App\Http\Traits\CanLoadRelationships;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    use CanLoadRelationships;

    protected array $allowedRelations = [
        'company',
        'user',
    ];

    public function __construct()
    {
        $this->middleware('auth:sanctum')->except([
            'index',
            'show',
        ]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = Review::query();

        $this->loadRelationships($query);

        return ReviewResource::collection(
            $query->paginate()
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Review $review)
    {
        $this->loadRelationships($review);

        return ReviewResource::make($review);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Review $review)
    {
        $result = $review->update(
            $request->validate([
                'review' => 'required',
                'rating'=> 'required|min:1|max:10|integer',
            ])
        );

        if (!$result) {
            return response(status: 500);
        }

        $this->loadRelationships($review);

        return ReviewResource::make($review);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Review $review)
    {
        return response(status: $review->delete() ? 204 : 500);
    }
}

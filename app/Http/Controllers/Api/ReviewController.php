<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ReviewResource;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ReviewResource::collection(Review::paginate());
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

        return $result
            ? ReviewResource::make($review)
            : response(status: 500);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Review $review)
    {
        return response(status: $review->delete() ? 204 : 500);
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ReviewResource;
use App\Http\Traits\CanLoadRelationships;
use App\Models\Company;
use App\Models\Review;
use Illuminate\Http\Request;

class CompanyReviewController extends Controller
{
    use CanLoadRelationships;

    protected array $allowedRelations = [
        'company',
        'user',
    ];

    /**
     * Display a listing of the resource.
     */
    public function index(Company $company)
    {
        $reviews = $company->reviews();

        $this->loadRelationships($reviews);

        return ReviewResource::collection(
            $reviews->latest()->paginate()
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Company $company)
    {
        $review = $company->reviews()->create([
            ...$request->validate([
                'review' => 'required',
                'rating'=> 'required|min:1|max:10|integer',
            ]),
            'user_id' => 1,
        ]);

        $this->loadRelationships($review);

        return ReviewResource::make($review);
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company, Review $review)
    {
        $this->loadRelationships($review);

        return ReviewResource::make($review);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Company $company, Review $review)
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
    public function destroy(Company $company, Review $review)
    {
        return response(status: $review->delete() ? 204 : 500);
    }
}

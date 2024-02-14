<?php

namespace App\Http\Controllers;

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
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Company $company)
    {
        return view('companies.reviews.create', ['company' => $company]);
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
            'user_id' => $request->user()->id,
        ]);

        $this->loadRelationships($review);

        return redirect()->route('companies.show', $company);
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company, Review $review)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company, Review $review)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Company $company, Review $review)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company, Review $review)
    {
        //
    }
}

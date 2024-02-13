<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Review;
use Illuminate\Http\Request;

class CompanyReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Company $company)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Company $company)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company, Review $review)
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

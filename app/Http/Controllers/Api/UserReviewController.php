<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;

class UserReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(User $user)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, User $user)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user, Review $review)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user, Review $review)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user, Review $review)
    {
        //
    }
}

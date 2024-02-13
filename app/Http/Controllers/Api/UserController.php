<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Http\Traits\CanLoadRelationships;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use CanLoadRelationships;

    protected array $allowedRelations = [
        'reviews',
        'reviews.company',
        'reviews.user',
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
        $query = User::query();

        $this->loadRelationships($query);

        return UserResource::collection(
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
    public function show(User $user)
    {
        $this->loadRelationships($user);

        return UserResource::make($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}

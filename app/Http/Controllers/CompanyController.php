<?php

namespace App\Http\Controllers;

use App\Http\Traits\CanLoadRelationships;
use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    use CanLoadRelationships;

    protected array $allowedRelations = [
        'reviews',
        'reviews.company',
        'reviews.user',
    ];

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $name = $request->input('name');
        $sortBy = $request->input('sort_by', '');

        $query = Company::query()
            ->withReviewsCount()
            ->withAvgRating();

        if (isset($name[0])) {
            $query->name($name);
        }

        match ($sortBy) {
            'name_asc' => $query->orderBy('name', 'ASC'),
            'name_desc' => $query->orderBy('name', 'DESC'),
            'latest_reviewed' => $query->latestReviewed(),
            'oldest_reviewed' => $query->oldestReviewed(),
            'highest_rated' => $query->highestRated(),
            'lowest_rated' => $query->lowestRated(),
            default => $query->latest(),
        };

        $this->loadRelationships($query);

        return view('companies.index', ['companies' => $query->paginate(10)]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
    public function show(int $id)
    {
        $company = Company::query()
            ->withReviewsCount()
            ->withAvgRating()
            ->findOrFail($id);

        return view('companies.show', [
            'company' => $company,
            'reviews' => $company->reviews()->latest()->paginate(10),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Company $company)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        //
    }
}

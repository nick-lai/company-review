<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $companies = Company::all();

        foreach (User::get()->shuffle()->all() as $user) {
            // create 0~3 good reviews
            foreach ($companies->random(rand(0, 3)) as $company) {
                Review::factory()
                    ->good()
                    ->for($company)
                    ->for($user)
                    ->create();
            }

            // create 1~3 neutral reviews
            foreach ($companies->random(rand(1, 3)) as $company) {
                Review::factory()
                    ->neutral()
                    ->for($company)
                    ->for($user)
                    ->create();
            }

            // create 0~1 bad reviews
            foreach ($companies->random(rand(0, 1)) as $company) {
                Review::factory()
                    ->bad()
                    ->for($company)
                    ->for($user)
                    ->create();
            }
        }
    }
}

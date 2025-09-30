<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Employer;
use App\Models\Tag;
use App\Models\Job;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Employer::factory(5)->create();
        $tags = Tag::factory(10)->create();

        Job::factory(20)->create()->each(function ($job) use ($tags) {
            $job->tags()->attach($tags->random(2)->pluck('id')->toArray());
        });
    }
}

<?php

use Illuminate\Support\Facades\Route;
use App\Models\Job;
use App\Models\Employer;
use App\Models\Tag;
use Illuminate\Http\Request;

Route::get('/', fn() => redirect('/jobs'));

// Jobs index
Route::get('/jobs', function () {
    $jobs = Job::with(['employer', 'tags'])->paginate(10);
    return view('jobs.index', compact('jobs'));
});

// Create form
Route::get('/jobs/create', function () {
    $employers = Employer::all();
    $tags = Tag::all();
    return view('jobs.create', compact('employers', 'tags'));
});

// Store
Route::post('/jobs', function (Request $request) {
    $validated = $request->validate([
        'title'       => 'required|string|min:3',
        'salary'      => 'required|string',
        'employer_id' => 'required|exists:employers,id',
        'tags'        => 'array',
        'tags.*'      => 'exists:tags,id',
    ]);

    $job = Job::create($validated);

    if (!empty($validated['tags'])) {
        $job->tags()->attach($validated['tags']);
    }

    return redirect('/jobs');
});

// Show
Route::get('/jobs/{job}', fn(Job $job) => view('jobs.show', compact('job')));

// Edit form
Route::get('/jobs/{job}/edit', function (Job $job) {
    $employers = Employer::all();
    $tags = Tag::all();
    return view('jobs.edit', compact('job','employers','tags'));
});

// Update
Route::patch('/jobs/{job}', function (Request $request, Job $job) {
    $validated = $request->validate([
        'title'       => 'required|string|min:3',
        'salary'      => 'required|string',
        'employer_id' => 'required|exists:employers,id',
        'tags'        => 'array',
        'tags.*'      => 'exists:tags,id',
    ]);

    $job->update($validated);
    $job->tags()->sync($validated['tags'] ?? []);

    return redirect('/jobs/' . $job->id);
});

// Delete
Route::delete('/jobs/{job}', fn(Job $job) => tap($job)->delete()) && redirect('/jobs');

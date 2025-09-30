<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Employer;
use App\Models\Tag;
use Illuminate\Http\Request;

class JobController extends Controller
{
    // Show all jobs
    public function index()
    {
        $jobs = Job::with(['employer', 'tags'])->paginate(10);
        return view('jobs.index', compact('jobs'));
    }

    // Show create form
    public function create()
    {
        $employers = Employer::all();
        $tags = Tag::all();
        return view('jobs.create', compact('employers', 'tags'));
    }

    // Store a new job
    public function store(Request $request)
    {
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
    }

    // Show a single job
    public function show(Job $job)
    {
        return view('jobs.show', compact('job'));
    }

    // Show edit form
    public function edit(Job $job)
    {
        $employers = Employer::all();
        $tags = Tag::all();
        return view('jobs.edit', compact('job', 'employers', 'tags'));
    }

    // Update an existing job
    public function update(Request $request, Job $job)
    {
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
    }

    // Delete a job
    public function destroy(Job $job)
    {
        $job->delete();
        return redirect('/jobs');
    }
}

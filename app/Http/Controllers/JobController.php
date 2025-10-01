<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Employer;
use App\Models\Tag;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function index()
    {
        $jobs = Job::with(['employer', 'tags'])->paginate(10);
        return view('jobs.index', compact('jobs'));
    }

    public function create()
    {
        $employers = Employer::all();
        $tags = Tag::all();
        return view('jobs.create', compact('employers', 'tags'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'required|string|min:3',
            'salary'      => 'required|string',
            'employer_id' => 'required|exists:employers,id',
            'tags'        => 'required|array|min:1',   // ✅ must select at least one
            'tags.*'      => 'exists:tags,id',
        ]);

        $job = Job::create([
            'title'       => $validated['title'],
            'salary'      => $validated['salary'],
            'employer_id' => $validated['employer_id'],
        ]);

        $job->tags()->attach($validated['tags']);

        return redirect()->route('jobs.index');
    }

    public function show(Job $job)
    {
        return view('jobs.show', compact('job'));
    }

    public function edit(Job $job)
    {
        $employers = Employer::all();
        $tags = Tag::all();
        return view('jobs.edit', compact('job', 'employers', 'tags'));
    }

    public function update(Request $request, Job $job)
    {
        $validated = $request->validate([
            'title'       => 'required|string|min:3',
            'salary'      => 'required|string',
            'employer_id' => 'required|exists:employers,id',
            'tags'        => 'required|array|min:1',   // ✅ must select at least one
            'tags.*'      => 'exists:tags,id',
        ]);

        $job->update([
            'title'       => $validated['title'],
            'salary'      => $validated['salary'],
            'employer_id' => $validated['employer_id'],
        ]);

        $job->tags()->sync($validated['tags']);

        return redirect()->route('jobs.show', $job);
    }

    public function destroy(Job $job)
    {
        $job->delete();
        return redirect()->route('jobs.index');
    }
}

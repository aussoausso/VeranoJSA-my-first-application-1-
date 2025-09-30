<x-layout>
    <x-slot:heading>{{ $job->title }}</x-slot:heading>

    <p>Salary: {{ $job->salary }}</p>
    <p>Employer: {{ $job->employer->name }}</p>

    <div>
        @foreach ($job->tags as $tag)
            <span class="bg-gray-200 px-2 py-1 text-xs rounded">{{ $tag->name }}</span>
        @endforeach
    </div>

    <a href="/jobs/{{ $job->id }}/edit" class="text-blue-500">Edit</a>
</x-layout>

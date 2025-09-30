<x-layout>
    <x-slot:heading>Jobs</x-slot:heading>

    <a href="/jobs/create" class="text-blue-500">+ Create Job</a>

    <div class="mt-4">
        @foreach ($jobs as $job)
            <div class="border p-4 mb-2">
                <a href="/jobs/{{ $job->id }}" class="text-indigo-700 font-semibold">
                    {{ $job->title }}
                </a>
                <p>Salary: {{ $job->salary }}</p>
                <p>Employer: {{ $job->employer->name }}</p>
                <div>
                    @foreach ($job->tags as $tag)
                        <span class="bg-gray-200 px-2 py-1 text-xs rounded">{{ $tag->name }}</span>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>

    {{ $jobs->links() }}
</x-layout>

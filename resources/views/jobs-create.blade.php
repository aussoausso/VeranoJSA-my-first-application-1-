<x-layout>
    <x-slot:heading>
        Create Job
    </x-slot:heading>

    <form method="POST" action="/jobs" class="space-y-4">
        @csrf

        <div>
            <label class="block">Job Title:</label>
            <input type="text" name="title" class="border p-2 w-full" required>
        </div>

        <div>
            <label class="block">Salary:</label>
            <input type="text" name="salary" class="border p-2 w-full" required>
        </div>

        <div>
            <label class="block">Employer:</label>
            <select name="employer_id" class="border p-2 w-full" required>
                <option value="">-- Select Employer --</option>
                @foreach ($employers as $employer)
                    <option value="{{ $employer->id }}">{{ $employer->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block">Tags:</label>
            <div class="flex flex-wrap gap-2">
                @foreach ($tags as $tag)
                    <label>
                        <input type="checkbox" name="tags[]" value="{{ $tag->id }}">
                        {{ $tag->name }}
                    </label>
                @endforeach
            </div>
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">
            Create Job
        </button>
    </form>
</x-layout>

<x-layout>
    <x-slot:heading>Edit Job</x-slot:heading>

    <form method="POST" action="/jobs/{{ $job->id }}" class="space-y-4">
        @csrf
        @method('PATCH')

        <!-- Job Title -->
        <input 
            name="title" 
            class="border p-2 w-full" 
            value="{{ old('title', $job->title) }}" 
            placeholder="Job Title"
        >
        @error('title')
            <p class="text-red-600 text-sm">{{ $message }}</p>
        @enderror

        <!-- Salary -->
        <input 
            name="salary" 
            class="border p-2 w-full" 
            value="{{ old('salary', $job->salary) }}" 
            placeholder="Salary"
        >
        @error('salary')
            <p class="text-red-600 text-sm">{{ $message }}</p>
        @enderror

        <!-- Employer -->
        <select name="employer_id" class="border p-2 w-full">
            <option value="" disabled>-- Select Employer --</option>
            @foreach ($employers as $employer)
                <option value="{{ $employer->id }}" 
                    {{ old('employer_id', $job->employer_id) == $employer->id ? 'selected' : '' }}>
                    {{ $employer->name }}
                </option>
            @endforeach
        </select>
        @error('employer_id')
            <p class="text-red-600 text-sm">{{ $message }}</p>
        @enderror

        <!-- Job Tags -->
        <div>
            <p class="font-semibold mb-2 @error('tags') text-red-600 text-sm @enderror">
                Job Tags (select at least one):
            </p>
            @foreach ($tags as $tag)
                <label class="mr-4">
                    <input 
                        type="checkbox" 
                        name="tags[]" 
                        value="{{ $tag->id }}"
                        {{ in_array($tag->id, old('tags', $job->tags->pluck('id')->toArray())) ? 'checked' : '' }}
                    >
                    {{ $tag->name }}
                </label>
            @endforeach
        </div>
        @error('tags')
            <p class="text-red-600 text-sm">{{ $message }}</p>
        @enderror

        <button class="bg-indigo-600 text-white px-4 py-2">Update</button>
    </form>

    <form method="POST" action="/jobs/{{ $job->id }}" class="mt-4">
        @csrf
        @method('DELETE')
        <button class="text-red-600">Delete</button>
    </form>
</x-layout>

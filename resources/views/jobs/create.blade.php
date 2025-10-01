<x-layout>
    <x-slot:heading>Create Job</x-slot:heading>

    <form method="POST" action="{{ route('jobs.store') }}" class="space-y-4">
        @csrf

        {{-- Title --}}
        <input 
            name="title" 
            class="border p-2 w-full" 
            value="{{ old('title') }}" 
            placeholder="Job Title"
        >
        @error('title') 
            <p class="text-red-600 text-sm">{{ $message }}</p> 
        @enderror

        {{-- Salary --}}
        <input 
            name="salary" 
            class="border p-2 w-full" 
            value="{{ old('salary') }}" 
            placeholder="Salary"
        >
        @error('salary') 
            <p class="text-red-600 text-sm">{{ $message }}</p> 
        @enderror

        {{-- Employer --}}
        <select name="employer_id" class="border p-2 w-full">
            <option value="" disabled {{ old('employer_id') ? '' : 'selected' }}>-- Select Employer --</option>
            @foreach ($employers as $employer)
                <option value="{{ $employer->id }}" 
                    {{ old('employer_id') == $employer->id ? 'selected' : '' }}>
                    {{ $employer->name }}
                </option>
            @endforeach
        </select>
        @error('employer_id') 
            <p class="text-red-600 text-sm">{{ $message }}</p> 
        @enderror

        {{-- Tags --}}
        <div>
            <p class="font-semibold mb-2">Select at least one Tag:</p>
            <div class="space-y-2">
                @foreach ($tags as $tag)
                    <label class="mr-4">
                        <input 
                            type="checkbox" 
                            name="tags[]" 
                            value="{{ $tag->id }}" 
                            {{ in_array($tag->id, old('tags', [])) ? 'checked' : '' }}
                        >
                        {{ $tag->name }}
                    </label>
                @endforeach
            </div>
        </div>
        @error('tags') 
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p> 
        @enderror

        <button class="bg-indigo-600 text-white px-4 py-2">Create</button>
    </form>
</x-layout>
    
<x-layout>
    <x-slot:heading>Edit Job</x-slot:heading>

    <form method="POST" action="/jobs/{{ $job->id }}" class="space-y-4">
        @csrf
        @method('PATCH')

        <input name="title" class="border p-2 w-full" value="{{ old('title', $job->title) }}">
        <input name="salary" class="border p-2 w-full" value="{{ old('salary', $job->salary) }}">

        <select name="employer_id" class="border p-2 w-full">
            @foreach ($employers as $employer)
                <option value="{{ $employer->id }}" {{ $job->employer_id == $employer->id ? 'selected' : '' }}>
                    {{ $employer->name }}
                </option>
            @endforeach
        </select>

        <div>
            @foreach ($tags as $tag)
                <label>
                    <input type="checkbox" name="tags[]" value="{{ $tag->id }}"
                        {{ in_array($tag->id, $job->tags->pluck('id')->toArray()) ? 'checked' : '' }}>
                    {{ $tag->name }}
                </label>
            @endforeach
        </div>

        <button class="bg-indigo-600 text-white px-4 py-2">Update</button>
    </form>

    <form method="POST" action="/jobs/{{ $job->id }}" class="mt-4">
        @csrf
        @method('DELETE')
        <button class="text-red-600">Delete</button>
    </form>
</x-layout>

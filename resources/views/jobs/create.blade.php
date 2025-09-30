<x-layout>
    <x-slot:heading>Create Job</x-slot:heading>

    <form method="POST" action="/jobs" class="space-y-4">
        @csrf

        <input name="title" placeholder="Title" class="border p-2 w-full" value="{{ old('title') }}">
        <input name="salary" placeholder="Salary" class="border p-2 w-full" value="{{ old('salary') }}">

        <select name="employer_id" class="border p-2 w-full">
            <option value="">Choose Employer</option>
            @foreach ($employers as $employer)
                <option value="{{ $employer->id }}">{{ $employer->name }}</option>
            @endforeach
        </select>

        <div>
            @foreach ($tags as $tag)
                <label>
                    <input type="checkbox" name="tags[]" value="{{ $tag->id }}">
                    {{ $tag->name }}
                </label>
            @endforeach
        </div>

        <button class="bg-indigo-600 text-white px-4 py-2">Save</button>
    </form>
</x-layout>

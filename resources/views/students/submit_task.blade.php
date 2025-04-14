<x-app-layout>
    <p>Title: {{ $task->title }}</p>
    <p>Teacher: {{ $task->teacher->name }}</p>

    <form action="{{ route('tasksubmission.upload', $task->id) }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mt-2">
            <label for="file">File:</label>
            <input type="file" name="file" class="form-control" required>
        </div>

        @error('file')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror

        <div class="mt-2">
            <button class="btn btn-success">Submit</button>
        </div>
    </form>
</x-app-layout>

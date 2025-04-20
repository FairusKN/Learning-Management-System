<x-app-layout>
    <div class="max-w-2xl mx-auto py-10 px-6 shadow-md rounded-md bg-gray-800 m-5 mt-44">
        <h1 class="text-2xl font-bold mb-4" style="color : rgb(217, 234, 253)">{{ $task->title }}</h1>
        <p class=" mb-2" style="color: rgb(217, 234, 253)">{{ $task->description }}</p>
        <p class=" mb-2" style="color : rgb(217, 234, 253)"><span class="font-semibold">Teacher:</span> {{ $task->teacher->name }}</p>

        <form action="{{ route('student.tasksubmission.upload', $task->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6 mt-6">
            @csrf

            <div>
                <label for="file" class="block text-sm font-medium" style="color : rgb(248, 250, 252)">Upload File</label>
                <input type="file" name="file" required
                       class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" style="color : rgb(248, 250, 252)">

                @error('file')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <button type="submit"
                        class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500" style="color : rgb(248, 250, 252)">
                    Submit Task
                </button>
            </div>
        </form>
    </div>
</x-app-layout>

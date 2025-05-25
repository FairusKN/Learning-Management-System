<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Grade Submissions</h2>
    </x-slot>

    <div class="max-w-4xl mx-auto py-6">
        <label for="classroom" class="block mb-2 text-sm font-medium text-gray-700">Choose Class:</label>
        <select id="classroom" name="classroom" class="w-full border-gray-300 rounded-md shadow-sm"
            onchange="filterSubmissions(this.value)">
            <option value="">-- Show All Classes --</option>
            @foreach ($task->classes as $class)
                <option value="{{ $class->name }}">{{ $class->name }}</option>
            @endforeach
        </select>

        <!-- All submissions -->
        <div id="submission-list" class="mt-8">
            <h3 class="text-lg font-bold mb-4">Student Submissions</h3>

            <div class="space-y-4">
                @foreach ($submissions as $submission)
                    <div class="submission bg-white p-4 rounded shadow" data-class="{{ $submission->student->classes[0]->name }}">
                        <p class="font-medium">Student: {{ $submission->student->name }}</p>
                        <p class="text-sm text-gray-500">Class: {{ $submission->student->classes[0]->name }}</p>
                        <a href="{{ route('teacher.grading', [$task, $submission->id]) }}" class="text-blue-600 hover:underline">📝 Grade</a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <script>
        function filterSubmissions(className) {
            const submissions = document.querySelectorAll('.submission');

            submissions.forEach(sub => {
                const classMatch = sub.dataset.class === className;

                if (!className || classMatch) {
                    sub.classList.remove('hidden');
                } else {
                    sub.classList.add('hidden');
                }
            });
        }
    </script>
</x-app-layout>

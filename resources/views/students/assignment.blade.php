<x-app-layout>
    <main class="px-6 py-10 lg:px-16 bg-gray-100 min-h-screen">

        {{-- Flash Success Message --}}
        @session("success")
        <div class="mb-6 p-4 text-xl font-medium text-green-800 bg-green-100 rounded shadow-sm">
            {{ $value }}
        </div>
        @endsession
    
        @props(['tasks', 'tasks_history'])
    
        {{-- Two-Column Grid --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
    
            {{-- Assignments Section (Left Column) --}}
            <section>
                <h2 class="text-2xl font-bold text-gray-800 mb-6">📘 Assignments</h2>
                <div class="grid grid-cols-1 gap-6">
                    @forelse ($tasks as $task)
                        <div class="bg-white shadow-md rounded-lg p-5 flex flex-col justify-between h-60 hover:shadow-lg transition">
                            <div>
                                <h3 class="text-xl font-semibold text-gray-900">{{ $task->title }}</h3>
                                <p class="text-gray-600 mt-2 text-sm line-clamp-4">{{ $task->description }}</p>
                            </div>
                            <div class="mt-4 text-sm text-gray-700 space-y-1">
                                <p><strong>Teacher:</strong> {{ $task->teacher->name }}</p>
                                <a href="{{ route('student.tasksubmission', $task) }}" class="text-blue-600 hover:underline">📝 Submit</a>
                                @if ($task->resource)
                                    <a href="{{ $task->resource }}" target="_blank" class="text-blue-600 hover:underline block">📎 Resource</a>
                                @endif
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-600">No assignments available at the moment.</p>
                    @endforelse
                </div>
            </section>
    
            {{-- History Section (Right Column) --}}
            <section>
                <h2 class="text-2xl font-bold text-gray-800 mb-6">📜 History</h2>
                <div class="grid grid-cols-1 gap-6">
                    @forelse ($tasks_history as $history)
                            <div class="bg-white shadow-md rounded-lg p-5 flex flex-col justify-between h-60 hover:shadow-lg transition">
                                <div>
                                    <h3 class="text-xl font-semibold text-gray-900">{{ $history->task->title }}</h3>
                                    <p class="text-gray-600 mt-2 text-sm line-clamp-4">{{ $history->task->description }}</p>
                                </div>
                                <div class="mt-4 text-sm text-gray-700 space-y-1">
                                    <p><strong>Teacher:</strong> {{ $history->task->teacher->name }}</p>
                                    <p><strong>Grade:</strong> {{ $history->grade }}</p>
                                    <p>
                                        <strong>Status:</strong>
                                        @if ($history->grade >= 76)
                                            <span class="text-green-600">Passed</span>
                                        @elseif($history->grade === 0)
                                            <span class="text-black"> Not Graded Yet</span>
                                        @else
                                            <span class="text-red-600">Failed</span>
                                        @endif
                                    </p>
                                </div>
                            </div>
                    @empty
                        <p class="text-gray-600">No history yet.</p>
                    @endforelse
                </div>
            </section>
    
        </div>
    
    </main>    
</x-app-layout>
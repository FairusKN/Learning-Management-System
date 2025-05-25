<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Assignments') }}
        </h2>
    </x-slot>

    <main class="px-4 py-10 lg:px-16 bg-gray-100 min-h-screen">

        {{-- Flash Success Message --}}
        @session("success")
        <div class="mb-6 p-4 text-xl font-medium text-green-800 bg-green-100 rounded shadow-sm">
            {{ $value }}
        </div>
        @endsession

        @props(['tasks'])

        <section>
            <h2 class="text-2xl font-bold text-gray-800 mb-6">📘 Assignments</h2>

            <div class="flex flex-col gap-6">
                @forelse ($tasks as $task)
                    <div class="bg-white shadow-md rounded-lg p-6 flex flex-col justify-between hover:shadow-lg transition">
                        <div>
                            <h3 class="text-2xl font-semibold text-gray-900">{{ $task->title }}</h3>
                            <p class="text-gray-600 mt-2 text-base">{{ $task->description }}</p>
                        </div>
                        <div class="mt-6 text-sm text-gray-700 space-y-1">
                            <p><strong>Class:</strong>
                                @foreach ($task->classes as $class)
                                    {{ $class->name}}
                                    @if (!$loop->last)
                                        , 
                                    @endif 
                                @endforeach
                            </p>
                            <div class="mt-20">
                                <a href="{{ route('student.tasksubmission', $task) }}" class="text-blue-600 hover:underline">📝 Grade</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-600">No assignments available at the moment.</p>
                @endforelse
            </div>
        </section>

    </main>
</x-app-layout>

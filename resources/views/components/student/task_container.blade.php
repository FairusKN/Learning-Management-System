<main class="m-5">

@session("success")
<div class=" text-2xl">
    {{ $value }}
</div>
@endsession

    <!-- First Row -->
    <div class="mt-10">
        <!-- Title Row -->
        <div class="flex items-center mb-4">
            <p class="text-white text-xl font-semibold">Assignment</p>
        </div>

        @props(['tasks', 'tasks_history'])

        <!-- Grid Layout -->
        <div class="grid grid-cols-1 gap-4 lg:grid-cols-3 lg:gap-8 bg-">
            @foreach ($tasks as $task)
                <div class="rounded shadow p-4 flex flex-col justify-between h-56 bg-slate-300">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800">{{ $task->title }}</h2>
                        <p class="text-sm text-gray-600 mt-1 line-clamp-4">{{ $task->description }}</p>
                    </div>
                    
                    <div class="mt-4 text-sm text-gray-500">
                        <p><span class="font-semibold">Teacher:</span> {{ $task->teacher->name }}</p>
                        <a href="{{ route('tasksubmission', $task->id ) }}"  class="mt-1 inline-block text-blue-600 hover:underline">Submit</a>
                        @if ($task->resource)
                            <a href="{{ $task->resource }}" target="_blank" class="mt-1 inline-block text-blue-600 hover:underline">
                                📎 Resource
                            </a>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Second Row -->
    <div class="mt-20">
        <!-- Title Row -->
        <div class="flex items-center mb-4">
            <p class="text-white text-xl font-semibold">History</p>
        </div>

        <!-- Grid Layout -->
        <div class="grid grid-cols-1 gap-4 lg:grid-cols-3 lg:gap-8 bg-">
            @foreach ($tasks_history as $history)
                @if ($history->grade > 0)
                    <div class="rounded shadow p-4 flex flex-col justify-between h-56 bg-slate-300">
                        <div>
                            <h2 class="text-2xl font-bold text-gray-800">{{ $history->task->title }}</h2>
                            <p class="text-sm text-gray-600 mt-1 line-clamp-4">{{ $history->task->description }}</p>
                        </div>
                        
                        <div class="mt-4 text-sm text-gray-500">
                            <p><span class="font-semibold">Teacher:</span> {{ $task->teacher->name }}</p>
                            @if ($history->grade)
                                <span>Nilai : {{$history->grade}}</span>
                                @if ($history->grade >= 76)
                                    <span>Status : Lulus</span>
                                @else
                                    <span>Status : Remed</span>
                                @endif
                            @endif
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</main>

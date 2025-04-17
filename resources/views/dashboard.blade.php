<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    @auth
        @if(Auth::user()->hasRole('student'))
            <x-student.task_container :tasks="$tasks" :tasks_history="$tasks_history" />
        @elseif(Auth::user()->hasRole('teacher'))
            <x-teacher.dashboard />
        @endif
    @endauth
</x-app-layout>

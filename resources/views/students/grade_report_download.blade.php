<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Grade Report Receipt</title>
    <style>
        body { font-family: 'DejaVu Sans', sans-serif; }
    </style>
</head>
<body>

    <div class="max-w-3xl mx-auto border border-gray-300 p-8 rounded-lg shadow-lg mt-28">
        <h1 class="text-2xl font-bold text-center mb-6">Grade Report Receipt</h1>

        <div class="mb-4">
            <p><strong>Name:</strong> {{ $student->name }}</p>
            <p><strong>Username:</strong> {{ $student->username }}</p>
            <p><strong>Class:</strong> {{ $classroom->name }}</p>
        </div>

        <table class="w-full table-auto border-collapse mt-6">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border px-4 py-2 text-left">Task</th>
                    <th class="border px-4 py-2 text-left">Submitted</th>
                    <th class="border px-4 py-2 text-left">Grade</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $total = 0;
                    $count = 0;
                @endphp

                @foreach($grades as $submission)
                    @php
                        $total += $submission->grade;
                        $count++;
                    @endphp
                    <tr class="hover:bg-gray-50">
                        <td class="border px-4 py-2">{{ $submission->task->title }}</td>
                        <td class="border px-4 py-2">{{ $submission->created_at->format('d M Y') }}</td>
                        <td class="border px-4 py-2">{{ $submission->grade }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        @php
            $average = $count > 0 ? round($total / $count, 2) : 0;
        @endphp

        <div class="mt-6 text-right">
            <p class="text-lg font-semibold">Average Grade: <span class="text-blue-600">{{ $average }}</span></p>
        </div>

        <p class="mt-8 text-sm text-gray-500 text-center">
            Generated on {{ now()->format('d M Y H:i') }}
        </p>
    </div>

</body>
</html>
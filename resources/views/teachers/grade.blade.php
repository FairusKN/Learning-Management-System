

<x-app-layout>
      @php
            $filePath = $submission->file_path;
      @endphp
      <div class="bg-white p-4 rounded shadow">
            <p   class="font-medium">Student: {{ $submission->student->name }}</p>

            @if(Str::endsWith($filePath, ['.jpg', '.jpeg', '.png', '.gif']))
                  <p class="text-gray-600 mb-2">Answer (Image):</p>
                  <img src="{{ asset('storage/' . $filePath) }}" alt="Student submission" class="max-w-full h-auto rounded border" />
                  
            @elseif(Str::endsWith($filePath, '.pdf'))
                  <p class="text-gray-600 mb-2">Answer (PDF):</p>
                  <iframe src="{{ asset('viewerjs/#../' . $filePath) }}" width="100%" height="600" class="border"></iframe>

            @else
                  <p class="text-gray-500 italic">No viewable submission uploaded.</p>
            @endif

            <form action="{{ route('teacher.submit_grade'), $submission->id }}" method="POST">
                  @csrf
                  <label class="block mt-4 text-sm font-medium text-gray-700">Grade:</label>
                  <input
                        type="number"
                        name="grade"
                        max="100"
                        min="0"
                        class="mt-1 block w-24 border-gray-300 rounded-md shadow-sm"
                  />
                  <button
                        type="submit"
                        class="mt-2 bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700"
                  >
                        Submit Grade
                  </button>
            </form>
      </div>  
</x-app-layout>
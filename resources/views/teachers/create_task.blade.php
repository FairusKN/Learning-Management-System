{{-- Push Wont Work --}}
{{-- @push('custom-css')
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush --}}

<x-app-layout>
    <div class="max-w-2xl mx-auto px-4 py-8 bg-white dark:bg-gray-800 rounded-lg shadow mt-20">
  
      <!-- Page Header -->
      <h1 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">Add Task</h1>
  
      <!-- Form -->
      <form action="{{route('teacher.task_store')}} " method="POST" enctype="multipart/form-data"> 
        @csrf

        @error('create_task')
          <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
  
        <!-- Title -->
        <div class="mb-4">
          <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title</label>
          <input type="text" id="title" name="title" class="block w-full px-3 py-2 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg text-sm text-gray-900 dark:text-white focus:ring-blue-500 focus:border-blue-500" placeholder="Enter product title" required>
        </div>
  
        <!-- Description -->
        <div class="mb-4">
          <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
          <textarea id="description" name="description" rows="4" class="block w-full px-3 py-2 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg text-sm text-gray-900 dark:text-white focus:ring-blue-500 focus:border-blue-500" placeholder="Enter product description" required></textarea>
        </div>
  
        <!-- File Upload -->
        <div class="mb-6">
          <label for="file" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Upload File (Optional) </label>
          <input type="file" id="file" name="file" class="block w-full text-sm text-gray-900 dark:text-gray-300 file:mr-4 file:py-2 file:px-4 file:border file:border-gray-300 file:rounded-md file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 dark:bg-gray-700">
        </div>

        <!-- Class Type Checkboxes -->   
        <select class="js-example-basic-multiple mb-6 w-full px-3 py-2 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg text-sm text-gray-900 dark:text-white focus:ring-blue-500 focus:border-blue-500" name="states[]" multiple="multiple">
          @foreach ($classes as $class)
            <option value="{{$class->id}}">{{$class->name}} </option>
          @endforeach
        </select>
  
        <!-- Submit -->
        <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mt-5">
          Add Product
        </button>
      </form>
    </div>
</x-app-layout>

{{-- Push Wont work --}}
{{-- @push('cdn')
  <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endpush

@push('custom-scipts')
  <script>
    $(document).ready(function() {
        $('.js-example-basic-multiple').select2();
    });
  </script>
@endpush --}}
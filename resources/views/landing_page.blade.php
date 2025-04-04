<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-gray-900 antialiased bg-white dark:bg-gray-900">
    <section class="bg-white lg:grid lg:h-screen lg:place-content-center dark:bg-gray-900">
        <div class="mx-auto w-screen max-w-screen-xl px-4 py-16 sm:px-6 sm:py-24 lg:px-8 lg:py-32">
          <div class="mx-auto max-w-prose text-center">
            <h1 class="text-4xl font-bold text-gray-900 sm:text-5xl dark:text-white">
              Understand user flow and
              <strong class="text-indigo-600"> increase </strong>
              conversions
            </h1>
      
            <p class="mt-4 text-base text-pretty text-gray-700 sm:text-lg/relaxed dark:text-gray-200">
              Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eaque, nisi. Natus, provident
              accusamus impedit minima harum corporis iusto.
            </p>
      
            <div class="mt-4 flex justify-center gap-4 sm:mt-6">
              <a
                class="inline-block rounded border border-indigo-600 bg-indigo-600 px-5 py-3 font-medium text-white shadow-sm transition-colors hover:bg-indigo-700"
                href="{{ url('/login') }}"
              >
                Login
              </a>
            </div>
          </div>
        </div>
      </section>
</body>
</html>
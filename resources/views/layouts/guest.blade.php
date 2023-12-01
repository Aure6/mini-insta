<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-gray-900 antialiased">
    <div class="min-h-screen flex flex-col pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">
        <div class="container mx-auto flex flex-col space-y-10">
            <nav class="flex justify-between items-center py-2">
                <div>
                    <a href="/"
                        class="group font-bold text-3xl flex items-center space-x-4 hover:text-red-600 transition ">
                        <x-application-logo
                            class="w-10 h-10 fill-current text-gray-500 group-hover:text-red-500 transition" />
                        {{-- <span>Mon blog</span> --}}
                        <span>The New Gram</span>
                    </a>
                </div>
                {{-- <div class="flex items-center space-x-4 justify-end"> --}}
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    {{-- <a class="font-bold hover:text-red-600 transition" href="/">Posts</a> --}}
                    <a class="font-bold hover:text-red-600 transition" href="/login">Login</a>
                    <a class="font-bold hover:text-red-600 transition" href="/register">Sign up</a>
                </div>
            </nav>

            <main>
                {{ $slot }}
            </main>

            <!-- Footer -->
            <footer class="flex justify-between items-center py-2 gap-x-10">
                {{-- <!-- Facebook -->
                <a href="#" class="">

                </a>

                <!-- Twitter -->
                <a href="#" class="">
                    <x-si-x class="mr-4 w-12 transition hover:scale-125" />
                </a>

                <!-- Instagram -->
                <a href="#" class="text-pink-600 hover:text-pink-500">
                    <x-si-instagram class="hover:scale-125 mr-4 w-12 transition" />
                </a> --}}

                <p class="m-auto">{{ date('Y') }} &copy; The New Gram</p>
            </footer>
            <!-- End of footer -->

        </div>
    </div>
</body>

</html>

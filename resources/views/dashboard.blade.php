<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>

    <div>
        {{-- @if (session()->has('message')) --}}
        {{-- <h1 class="font-bold text-xl mb-4">Liste des posts / Votre feed</h1>
        <ul class="grid sm:grid-cols-2 lg:grid-cols-3 2xl:grid-cols-4 gap-8">
            @foreach ($posts as $post)
                <li>
                    <a class="flex flex-col	flex-wrap bg-white rounded-md  shadow-md p-5 w-full hover:shadow-lg hover:scale-105 transition"
                        href="#">
                        <p>{{ $post->caption }}</p>
                        <p class="text-sm">{{ $post->user_id }}</p>
                    </a>
                </li>
            @endforeach
        </ul> --}}

        {{-- Check Data Availability:

        Before rendering the posts in the view, you may want to check if $posts is not empty to avoid errors. --}}
        @if ($posts->count() > 0)
            {{-- Render posts --}}
        @else
            <p>No posts available.</p>
        @endif
        {{-- <h1 class="font-bold text-xl mb-4">Liste des posts</h1>
        <ul class="grid sm:grid-cols-2 lg:grid-cols-3 2xl:grid-cols-4 gap-8">
            @foreach ($posts as $post)
                <li>
                    <x-post-card :post="$post" />
                </li>
            @endforeach
        </ul>

        <div class="mt-8">
            {{ $posts->links() }}
        </div> --}}
    </div>
</x-app-layout>

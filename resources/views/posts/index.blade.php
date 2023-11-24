{{-- app layout et pas guest layout car on est connecté --}}
<x-app-layout>
    {{-- Search input / search bar --}}
    {{-- TODO --}}

    <!-- Display success message if it exists in the session -->
    @if (session('success'))
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
                <p class="font-bold">Success</p>
                <p>{{ session('success') }}</p>
            </div>
        </div>
    @endif

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-12">
        <h1 class="font-bold text-xl mb-4">Liste des posts</h1>
        <ul class="grid sm:grid-cols-2 lg:grid-cols-3 2xl:grid-cols-4 gap-8">
            @foreach ($posts as $post)
                <li>
                    <x-post-card :post="$post" />
                </li>
            @endforeach
        </ul>

        <div class="mt-8">
            {{ $posts->links() }}
        </div>
    </div>
</x-app-layout>

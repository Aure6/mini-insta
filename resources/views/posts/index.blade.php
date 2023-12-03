{{-- app layout et pas guest layout car on est connecté --}}
<x-app-layout>
    {{-- Search input / search bar --}}
    {{-- TODO --}}

    <!-- Display success message if it exists in the session -->
    @if (session('success'))
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
                <p class="font-bold">Succès</p>
                <p>{{ session('success') }}</p>
            </div>
        </div>
    @endif

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-8">
        {{-- Barre de reherche --}}
        <form action="{{ route('posts.index') }}" method="GET" class="mb-4">
            <div class="flex items-center justify-center">
                <input type="text" name="search" id="search" placeholder="Rechercher un post ou un utilisateur"
                    class="flex-grow border border-gray-300 rounded shadow px-4 py-2 mr-4 max-w-xs"
                    value="{{ request()->search }}" autofocus />
                <button type="submit" class="bg-white text-gray-600 px-4 py-2 rounded-lg shadow">
                    <x-heroicon-o-magnifying-glass class="h-5 w-5" />
                </button>
            </div>
        </form>

        {{-- Liste des posts --}}
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

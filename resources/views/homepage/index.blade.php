<x-guest-layout>
    <div class="flex items-center space-x-4 justify-center text-5xl	">
        <a class="font-bold hover:text-emerald-600 transition" href="/login">Login</a>
        <a class="font-bold hover:text-emerald-600 transition" href="/register">Sign up</a>
    </div>
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
</x-guest-layout>

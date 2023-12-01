<x-app-layout>
    <div class="max-w-7xl mx-auto">
        <!-- Display success message if it exists in the session -->
        @if (session('success'))
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
                    <p class="font-bold">Succès</p>
                    <p>{{ session('success') }}</p>
                </div>
            </div>
        @endif

        <div class="max-w-xl mx-auto m-1">
            {{-- <h1 class="font-bold text-xl mb-4">{!! \nl2br($post->caption) !!}</h1> --}}
            {{-- semble fonctionner aussi <img class="flex-grow text-sm text-justify" src="{{ asset('storage/' . $post->img_path) }}"> --}}
            {{-- méthode du cours: --}}
            <img class="{{-- max-w-2xl --}} object-contain flex-grow text-sm text-justify"
                src="{{ Storage::url($post->img_path) }}" alt="illustration du post">
            {{-- <p class="text-sm">{{ $post->user->name }}</p> --}}
            <div class="flex mt-8 mb-4">
                <a class="flex hover:-translate-y-1 transition
    " href="{{ route('profile.show', $post->user) }}">
                    <x-avatar class="h-20 w-20" :user="$post->user" />
                    <div class="ml-4 flex flex-col justify-center">
                        <div class="text-gray-700">{{ $post->user->name }}</div>
                        {{-- <div class="text-gray-500">{{ $post->user->email }}</div> --}}
                    </div>
                </a>
            </div>
            <div class="mb-4 text-xs text-gray-500">
                {{ $post->published_at }}
            </div>
            <div class="mb-4">
                {!! \nl2br($post->caption) !!}
            </div>
            {{-- Like et compteur de likes --}}
            <form method="POST" action="{{ route('posts.like', $post->id) }}" class="mb-4">
                @csrf
                {{-- button to like --}}
                <button type="submit" class="flex gap-x-2 font-bold hover:text-red-500 transition">
                    {{-- ternary Unlike Like --}}
                    {{ $post->isLikedByUser(auth()->user()) ? 'Unlike ' : 'Like' }}
                    {{-- Icon thumbs up --}}
                    @if ($post->isLikedByUser(auth()->user()))
                        <x-heroicon-s-hand-thumb-up class="h-6 w-6 m-auto" /> {{-- full icon --}}
                    @else
                        <x-heroicon-o-hand-thumb-up class="h-6 w-6 m-auto" /> {{-- empty icon --}}
                    @endif
                    {{-- display likes count --}}
                    ({{ $post->likes->count() }})
                </button>
            </form>
            <a class="font-bold my-4 hover:text-red-500 transition" href="{{ route('posts.index') }}">Retour à
                la
                liste
                des
                posts</a>
            {{-- <a class="font-bold hover:text-emerald-600 transition" href="{{ route('/') }}">Retour à la liste des
            posts</a> --}}
        </div>
        {{-- Section commentaires --}}
        <div class="mt-8">
            <h2 class="font-bold text-xl mb-4">Commentaires</h2>

            <div class="flex-col space-y-4">
                {{-- Publier un commentaire --}}
                <div class="flex bg-white rounded-md shadow p-4 space-x-4">
                    <div class="flex flex-col justify-center w-full">
                        <div class="text-gray-700">
                            <form method="POST" action="{{ route('comments.store', ['post' => $post->id]) }}"
                                class="flex flex-col space-y-4 text-gray-500" enctype="multipart/form-data">
                                @csrf
                                <label for="body" class="text-gray-700">Publier un commentaire:</label>
                                <input type="text" placeholder="Publier un commentaire" name="body"
                                    class="text-gray-700">
                                @if ($errors->any())
                                    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded">Publier</button>
                            </form>
                        </div>
                    </div>
                </div>
                @forelse ($post->comments as $comment)
                    <div class="flex bg-white rounded-md shadow p-4 space-x-4">
                        <a class="flex justify-start items-start h-full"
                            href="{{ route('profile.show', $comment->user) }}">
                            <x-avatar class="h-10 w-10" :user="$comment->user" />
                        </a>
                        <div class="flex flex-col justify-center">
                            <a class="text-gray-700" href="{{ route('profile.show', $comment->user) }}">
                                {{ $comment->user->name }}
                            </a>
                            <div class="text-gray-500">
                                {{ $comment->created_at->diffForHumans() }}
                            </div>
                            <div class="text-gray-700">
                                {{ $comment->body }}
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="flex bg-white rounded-md shadow p-4 space-x-4">
                        Aucun commentaire pour l'instant
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>

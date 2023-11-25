<x-app-layout>
    <div class="max-w-7xl mx-auto">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8 py-8">
            {{-- <h1 class="font-bold text-xl mb-4">{!! \nl2br($post->caption) !!}</h1> --}}
            {{-- semble fonctionner aussi <img class="flex-grow text-sm text-justify" src="{{ asset('storage/' . $post->img_path) }}"> --}}
            {{-- méthode du cours: --}}
            <img class="{{-- max-w-2xl --}} object-contain flex-grow text-sm text-justify"
                src="{{ Storage::url($post->img_path) }}" alt="illustration du post">
            {{-- <p class="text-sm">{{ $post->user->name }}</p> --}}
            <div class="flex mt-8">
                <x-avatar class="h-20 w-20" :user="$post->user" />
                <div class="ml-4 flex flex-col justify-center">
                    <div class="text-gray-700">{{ $post->user->name }}</div>
                    {{-- <div class="text-gray-500">{{ $post->user->email }}</div> --}}
                </div>
            </div>
            <div class="mb-4 text-xs text-gray-500">
                {{ $post->published_at }}
            </div>
            <div class="my-4">
                {!! \nl2br($post->caption) !!}
            </div>
            <div>
                <a class="font-bold my-4 hover:text-emerald-600 transition" href="{{ route('posts.index') }}">Retour à
                    la
                    liste
                    des
                    posts</a>
                {{-- <a class="font-bold hover:text-emerald-600 transition" href="{{ route('/') }}">Retour à la liste des
            posts</a> --}}
            </div>
        </div>
        {{-- Section commentaires --}}
        <div class="mt-8">
            <h2 class="font-bold text-xl mb-4">Commentaires</h2>

            <div class="flex-col space-y-4">
                @forelse ($post->comments as $comment)
                    <div class="flex bg-white rounded-md shadow p-4 space-x-4">
                        <div class="flex justify-start items-start h-full">
                            <x-avatar class="h-10 w-10" :user="$comment->user" />
                        </div>
                        <div class="flex flex-col justify-center">
                            <div class="text-gray-700">
                                {{ $comment->user->name }}
                            </div>
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

<x-guest-layout>
    <h1 class="font-bold text-xl mb-4">{{ $post->caption }}</h1>
    {{-- semble fonctionner aussi <img class="flex-grow text-sm text-justify" src="{{ asset('storage/' . $post->img_path) }}"> --}}
    <img class="object-contain flex-grow text-sm text-justify" src="{{ Storage::url($post->img_path) }}"
        alt="illustration de l'article">
    <p class="text-sm">{{ $post->user->name }}</p>
    <div class="mb-4 text-xs text-gray-500">
        {{ $post->published_at }}
    </div>
    <div>
        {!! \nl2br($post->caption) !!}
    </div>
    <div>
        <a class="font-bold hover:text-emerald-600 transition" href="{{ route('posts.index') }}">Retour à la liste des
            posts</a>
        {{-- <a class="font-bold hover:text-emerald-600 transition" href="{{ route('/') }}">Retour à la liste des
            posts</a> --}}
    </div>

</x-guest-layout>

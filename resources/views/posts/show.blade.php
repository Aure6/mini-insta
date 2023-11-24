<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-12">
        <h1 class="font-bold text-xl mb-4">{{ $post->caption }}</h1>
        {{-- semble fonctionner aussi <img class="flex-grow text-sm text-justify" src="{{ asset('storage/' . $post->img_path) }}"> --}}
        {{-- méthode du cours: --}}
        <img class="object-contain flex-grow text-sm text-justify" src="{{ Storage::url($post->img_path) }}"
            alt="illustration du post">
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
        <div>
            {!! \nl2br($post->caption) !!}
        </div>
        <div>
            <a class="font-bold hover:text-emerald-600 transition" href="{{ route('posts.index') }}">Retour à la liste
                des
                posts</a>
            {{-- <a class="font-bold hover:text-emerald-600 transition" href="{{ route('/') }}">Retour à la liste des
            posts</a> --}}
        </div>
    </div>
</x-app-layout>

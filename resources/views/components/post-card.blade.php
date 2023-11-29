<a class="flex flex-col	flex-wrap bg-white rounded-md  shadow-md p-5 w-full hover:shadow-lg hover:scale-105 transition"
    href="{{ route('posts.show', $post) }}">
    <img class="object-contain flex-grow text-sm text-justify" src="{{ Storage::url($post->img_path) }}"
        alt="illustration de l'article">
    <p>{{ $post->caption }}</p>
    <p class="text-sm">{{ $post->user->name }}</p>
    <p class="text-xs text-gray-500">
        {{ $post->published_at }}
    </p>
    {{-- Like et compteur de likes --}}
    <form method="POST" action="{{ route('posts.like', $post->id) }}">
        @csrf
        <button type="submit" class="font-bold hover:text-emerald-600 transition">
            {{ $post->isLikedByUser(auth()->user()) ? 'Unlike' : 'Like' }}
            ({{ $post->likes->count() }})
        </button>
        {{-- Sans icon --}}
        {{-- <button type="submit" class="font-bold mt-2 hover:text-emerald-600 transition">
            {{ $post->isLikedByUser(auth()->user()) ? 'Unlike' : 'Like' }} ({{ $post->likes->count() }})
        </button> --}}
    </form>
</a>

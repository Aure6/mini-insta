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
    <div class="flex justify-between">
        <form method="POST" action="{{ route('posts.like', $post->id) }}">
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
        <div class="flex gap-x-2">
            {{ $post->comments->count() }}<x-heroicon-o-chat-bubble-oval-left class="h-6 w-6" />
        </div>
    </div>
</a>

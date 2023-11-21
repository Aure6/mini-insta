<a class="flex flex-col	flex-wrap bg-white rounded-md  shadow-md p-5 w-full hover:shadow-lg hover:scale-105 transition"
    href="{{ route('posts.show', $post) }}">
    <p>{{ $post->caption }}</p>
    <p class="text-sm">{{ $post->user->name }}</p>
    <p class="mb-4 text-xs text-gray-500">
        {{ $post->published_at }}
    </p>
</a>
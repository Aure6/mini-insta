<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-8">

        <div class="flex w-full">
            <x-avatar class="h-20 w-20" :user="$user" />
            <div class="ml-4 flex flex-col">
                <div class="text-gray-800 font-bold">{{ $user->name }}</div>
                <div class="text-gray-500 text-xs">
                    Membre depuis {{ $user->created_at->diffForHumans() }}
                </div>
            </div>
            {{-- follow form --}}
            {{-- @if (isset($user_id))
                    <p>User ID: {{ $user_id }}</p>
                @else
                    <p>User ID is not defined</p>
                @endif --}}
            <form method="POST" action="{{ route('profile.follow', $user_id) }}" class="ml-4">
                @csrf
                <div class="text-grey-700 mt-2 flex justify-end">
                    <button type="submit" class="flex font-bold text-grey-800 hover:text-red-500 transition">
                        {{-- @if ($this->isFollowing($user_id)) --}}
                        @if (app('App\\Http\\Controllers\\ProfileController')->isFollowing($user_id))
                            <x-heroicon-s-hand-thumb-up class="mr-1 h-6 w-6 m-auto" />
                            Unfollow
                        @else
                            <x-heroicon-o-hand-thumb-up class="mr-1 h-6 w-6 m-auto" />
                            Follow
                        @endif
                        {{-- {{ $totalFollows . ' - ' . $totalFollowers }} --}}
                    </button>
                </div>
            </form>

            {{-- {{ dd($followCount) }} --}}
            {{-- <form method="POST" action="{{ route('profile.follow', $user) }}" class="">
                    @csrf
                    <div class="text-grey-700 mt-2 flex justify-end">
                        <button type="submit"
                            class="font-bold bg-white text-grey-800 hover:text-emerald-600 transition">
                            @if ($followCount == 1)
                                <x-heroicon-s-hand-thumb-up class="h6 w6" />
                            @else
                                <x-heroicon-o-hand-thumb-up class="h6 w6" />
                            @endif
                            {{ $totalFollows . ' - ' . $totalFollowers }}
                        </button>
                    </div>
                </form> --}}


            {{-- @if (auth()->user()->isFollowing($user))
                    <form method="POST" action="{{ route('users.unfollow', $user) }}">
                        @csrf
                        <button type="submit">Unfollow</button>
                    </form>
                @else
                    <form method="POST" action="{{ route('users.follow', $user) }}">
                        @csrf
                        <button type="submit">Follow</button>
                    </form>
                @endif --}}
        </div>
        {{-- Bio --}}
        <div class="flex w-full mt-4">
            <h2 class="font-bold text-xl mb-4">Bio:</h2>
            <div class="ml-4 flex flex-col">
                <div class="text-gray-800">{{ $user->bio }}</div>
            </div>
        </div>

        <div class="mt-8">
            <h2 class="font-bold text-xl mb-4">Posts</h2>
            <ul class="grid sm:grid-cols-2 gap-8">
                @forelse ($posts as $post)
                    <li>
                        <x-post-card :post="$post" />
                    </li>
                @empty
                    <div class="text-gray-700">Aucun post</div>
                @endforelse
            </ul>
        </div>

        <div class="mt-8">
            <h2 class="font-bold text-xl mb-4">Commentaires</h2>

            <div class="flex-col space-y-4">
                @forelse ($comments as $comment)
                    <div class="flex bg-white rounded-md shadow p-4 space-x-4">
                        <div class="flex justify-start items-start h-full">
                            <x-avatar class="h-10 w-10" :user="$comment->user" />
                        </div>
                        <div class="flex flex-col justify-center w-full space-y-4">
                            <div class="flex justify-between">
                                <div class="flex space-x-4 items-center justify-center">
                                    <div class="flex flex-col justify-center">
                                        <div class="text-gray-700">{{ $comment->user->name }}</div>
                                        <div class="text-gray-500 text-sm">
                                            {{ $comment->created_at->diffForHumans() }}
                                        </div>
                                    </div>
                                </div>
                                <div class="flex justify-center">
                                    @can('delete', $comment)
                                        <button x-data="{ id: {{ $comment->id }} }"
                                            x-on:click.prevent="window.selected = id; $dispatch('open-modal', 'confirm-comment-deletion');"
                                            type="submit"
                                            class="font-bold bg-white text-gray-700 px-4 py-2 rounded shadow">
                                            <x-heroicon-o-trash class="h-5 w-5" />
                                        </button>
                                    @endcan
                                </div>
                            </div>
                            <div class="flex flex-col justify-center w-full text-gray-700">
                                <p class="border bg-gray-100 rounded-md p-4">
                                    {{ $comment->body }}
                                </p>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="flex bg-white rounded-md shadow p-4 space-x-4">
                        Aucun commentaire pour l'instant
                    </div>
                @endforelse
            </div>
            <x-modal name="confirm-comment-deletion" focusable>
                <form method="post"
                    onsubmit="event.target.action= '/posts/{{ $post->id ?? 1 }}/comments/' + window.selected"
                    class="p-6">
                    @csrf @method('DELETE')

                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                        Êtes-vous sûr de vouloir supprimer ce commentaire ?
                    </h2>

                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        Cette action est irréversible. Toutes les données seront supprimées.
                    </p>

                    <div class="mt-6 flex justify-end">
                        <x-secondary-button x-on:click="$dispatch('close')">
                            Annuler
                        </x-secondary-button>

                        <x-danger-button class="ml-3" type="submit">
                            Supprimer
                        </x-danger-button>
                    </div>
                </form>
            </x-modal>
        </div>

    </div>
</x-app-layout>

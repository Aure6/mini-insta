<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Articles') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-12">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
            <div class="flex justify-between mt-8">
                <div class=" text-2xl">
                    Créer un post
                </div>
            </div>

            <form method="POST" action="{{ route('posts.store') }}" class="flex flex-col space-y-4 text-gray-500">

                @csrf

                <div>
                    <x-input-label for="caption" :value="__('Caption')" />
                    <x-text-input id="caption" class="block mt-1 w-full" type="text" name="caption"
                        :value="old('caption')" autofocus />
                    <x-input-error :messages="$errors->get('caption')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="published_at" :value="__('Date de publication')" />
                    <x-text-input id="published_at" class="block mt-1 w-full" type="date" name="published_at"
                        :value="old('published_at')" />
                    <x-input-error :messages="$errors->get('published_at')" class="mt-2" />
                </div>

                {{-- <div>
                    <x-input-label for="body" :value="__('Texte de l\'post')" />
                    <textarea id="body"
                        class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                        name="body" rows="10">{{ old('body') }}</textarea>
                    <x-input-error :messages="$errors->get('body')" class="mt-2" />
                </div> --}}

                <div class="flex justify-end">
                    <x-primary-button type="submit">
                        {{ __('Créer') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>

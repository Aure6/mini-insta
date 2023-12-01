<div {{ $attributes->merge(['class' => 'rounded-full overflow-hidden']) }}>
    @if ($user->avatar_path)
        <img class=" aspect-square object-cover object-center" src="{{ asset('storage/' . $user->avatar_path) }}"
            alt="{{ $user->name }}" />
    @else
        <div class="flex items-center justify-center bg-indigo-100">
            <span class="text-2xl font-medium text-indigo-800 h-full">
                {{ $user->name[0] }}
            </span>
        </div>
    @endif
</div>

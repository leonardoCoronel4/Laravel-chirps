<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Chirps') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('chirps.store') }}">
                        @csrf
                        <textarea name="message"
                            class="block w-full rounded-md border-gray-300 bg-white shadow-sm  transition-colors duration-300 focus:border-indigo-200 focus:ring-opacity-50 dark:border-gray-600 dark:bg-gray-800 dark:text-white dark:focus:border-indigo-300 dark:focus:ring-indigo-200 dark:focus:ring-opacity-50"
                            placeholder="{{__('What\'s on your mind?')}}">{{ old('message') }}</textarea>
                        <x-input-error :messages="$errors->get('message')" class="mt-2" />
                        <x-primary-button class="mt-4">
                            {{ __('Chirp') }}
                        </x-primary-button>
                    </form>
                </div>
            </div>
            <div class="mt-6 bg-white dark:bg-gray-800 rounded-lg divide-y shadow-sm dark:divide-gray-900">
                @foreach ($chirps as $chirp)
                    <div class="p-6 flex space-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="h-6 w-6 text-gray-600 dark:text-gray-400 -scale-x-100">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M8.625 12a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H8.25m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H12m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0h-.375M21 12c0 4.556-4.03 8.25-9 8.25a9.764 9.764 0 0 1-2.555-.337A5.972 5.972 0 0 1 5.41 20.97a5.969 5.969 0 0 1-.474-.065 4.48 4.48 0 0 0 .978-2.025c.09-.457-.133-.901-.467-1.226C3.93 16.178 3 14.189 3 12c0-4.556 4.03-8.25 9-8.25s9 3.694 9 8.25Z" />
                        </svg>

                        <div class="flex-1">
                            <div class="flex justify-between items-center">
                                <div>
                                    <span class="text-gray-800 dark:text-gray-200">
                                        {{ $chirp->user->name }}
                                    </span>
                                    <small class="ml=2 text-sm text-gray-600 dark:text-gray-400">
                                        {{ $chirp->updated_at->format('j M Y, g:i a') }}
                                    </small>
                                    @unless ($chirp->created_at->eq($chirp->updated_at))
                                        <small class="ml=2 text-sm text-gray-600 dark:text-gray-400">
                                            &middot; {{ __('edited')}}
                                        </small>
                                    @endunless ($chirp->created_at != $chirp->updated_at)
                                </div>
                            </div>
                            <p class="mt-4 text-lg text-gray-900 dark:text-gray-100">
                                {{ $chirp->message }}
                            </p>
                        </div>
                        @can('update', $chirp)
                            <x-dropdown>
                                <x-slot name="trigger">
                                    <button>
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor"
                                            class="w-5 h-5 text-gray-500 dark:text-gray-300">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                                        </svg>
                                    </button>
                                </x-slot>
                                <x-slot name="content">
                                    <x-dropdown-link :href="route('chirps.edit', $chirp)">
                                        {{ __('Edit Chirp') }}
                                    </x-dropdown-link>
                                    <form method="POST" action="{{ route('chirps.destroy', $chirp) }}">
                                        @csrf @method('DELETE')
                                        <x-dropdown-link :href="route('chirps.destroy', $chirp)"
                                            onclick="event.preventDefault(); this.closest('form').submit();">
                                            {{ __('Delete Chirp') }}
                                        </x-dropdown-link>
                                    </form>
                                </x-slot>
                            </x-dropdown>
                        @endcan
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>

<x-jet-dropdown align="right" width="48">
    <x-slot name="trigger">

        <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition duration-150 ease-in-out">
            <i class="h-8 w-8 rounded-full object-cover round-flag-icon round-flag-{{ $current_locale_icon_suffix }}"></i>
        </button>

    </x-slot>
    <x-slot name="content">
        @foreach ($locales as $index => $locale)
        <x-jet-dropdown-link href="{{ route('locale', $locale->locale) }}">
            <i class="h-4 w-4 rounded-full object-cover round-flag-icon round-flag-{{ $locale->icon_suffix }}"></i> {{$locale->locale_name}}
        </x-jet-dropdown-link>
        @endforeach
    </x-slot>
</x-jet-dropdown>



<div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
    <x-jet-nav-link href="{{ route('assemblies.index') }}"
                    :active="request()->routeIs('assemblies.index')">
        {{ __('Informations') }}
    </x-jet-nav-link>
    <x-jet-nav-link href="{{ route('categories.index') }}"
                    :active="request()->routeIs('categories.index')">
        {{ __('Criteria') }}
    </x-jet-nav-link>
    <x-jet-nav-link href="{{ route('category-values.index') }}"
                    :active="request()->routeIs('category-values.index')">
        {{ __('Criteria Data') }}
    </x-jet-nav-link>
    <x-jet-nav-link href="{{ route('assemblies.index') }}"
                    :active="request()->routeIs('assemblies.index')">
        {{ __('Manage') }}
    </x-jet-nav-link>
</div>

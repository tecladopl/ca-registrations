<div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
    <x-jet-nav-link href="{{ route('questionnaires.index') }}"
                    :active="request()->routeIs('questionnaires.index')">
        {{ __('Questionnaires') }}
    </x-jet-nav-link>
    <x-jet-nav-link href="{{ route('questionnaires_pages.index') }}"
                    :active="request()->routeIs('questionnaires_pages.index')">
        {{ __('Questionnaire Pages') }}
    </x-jet-nav-link>
    <x-jet-nav-link href="{{ route('questions.index') }}"
                    :active="request()->routeIs('questions.index')">
        {{ __('Question') }}
    </x-jet-nav-link>
    <x-jet-nav-link href="{{ route('answers.index') }}"
                    :active="request()->routeIs('answers.index')">
        {{ __('Answer') }}
    </x-jet-nav-link>
    <x-jet-nav-link href="{{ route('questionnaires.settings') }}"
                    :active="request()->routeIs('questionnaires.settings')">
        {{ __('Questionnaire settings') }}
    </x-jet-nav-link>
    <x-jet-nav-link href="{{ route('validations.index') }}"
                    :active="request()->routeIs('validations.index')">
        {{ __('Validations') }}
    </x-jet-nav-link>
</div>

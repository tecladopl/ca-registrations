<div>
    <x-jet-button wire:click="modalEdit">
        {{ __('Edit') }}
    </x-jet-button>
    <x-jet-dialog-modal wire:model="modalEdit">
        <form wire:submit.prevent="save">
            <x-slot name="title">
                {{ __('Editing Questionnaire Page') }}
            </x-slot>

            <x-slot name="content">
                <!-- Name -->
                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="page" value="{{ __('Page') }}" />
                    <x-jet-input id="page" type="number" step="1" min="1" class="mt-1 block w-full" wire:model="questionnaire_page.page" wire:model.defer="questionnaire_page.page" autocomplete="questionnaire_page.page" />
                    <p>{{__('Determine order of pages. Must be consecutive, unique numbers.')}}</p>
                </div>
                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="title" value="{{ __('Title') }}" />
                    <x-jet-input id="title" type="text" class="mt-1 block w-full" wire:model="questionnaire_page.title" wire:model.defer="questionnaire_page.title" autocomplete="questionnaire_page.title" />
                    <p>{{__('Displays at the top of page.')}}</p>
                </div>
                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="description" value="{{ __('Description') }}" />
                    <x-inputs.textarea wire:model="questionnaire_page.description" wire:model.defer="questionnaire_page.description" />
                    <p>{{__('Displays after title.')}}</p>
                </div>
            </x-slot>

            <x-slot name="footer">
                <x-jet-secondary-button wire:click="$toggle('modalEdit')" wire:loading.attr="disabled">
                    {{ __('Cancel') }}
                </x-jet-secondary-button>

                <x-jet-danger-button  type="submit" class="ml-2" wire:click="editQuestionnairePage" wire:loading.attr="disabled">
                    {{ __('Save') }}
                </x-jet-danger-button>
            </x-slot>
        </form>
    </x-jet-dialog-modal>
</div>

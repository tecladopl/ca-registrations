<div class="mt-8">
    <x-jet-action-section>
        <x-slot name="title">
            {{ __('Add Questionnaire Page') }}
        </x-slot>

        <x-slot name="description">
            {{ __('Add new Questionnaire Page') }}
        </x-slot>

        <x-slot name="content">

            <div class="mt-5">
                <x-jet-button wire:click="modal" wire:loading.attr="disabled">
                    {{ __('Add Questionnaire Page') }}
                </x-jet-button>
            </div>

            <x-jet-dialog-modal wire:model="modal">
                <form wire:submit.prevent="save">
                    <x-slot name="title">
                        {{ __('Adding Questionnaire Page') }}
                    </x-slot>

                    <x-slot name="content">
                        <!-- Name -->
                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-label for="page" value="{{ __('Page') }}" />
                            <x-jet-input id="page" type="number" step="1" min="1" class="mt-1 block w-full" wire:model="page" wire:model.defer="page" autocomplete="page" />
                            <p>{{__('Determine order of pages. Must be consecutive, unique numbers.')}}</p>
                        </div>
                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-label for="title" value="{{ __('Title') }}" />
                            <x-jet-input id="title" type="text" class="mt-1 block w-full" wire:model="title" wire:model.defer="title" autocomplete="title" />
                            <p>{{__('Displays at the top of page.')}}</p>
                        </div>
                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-label for="description" value="{{ __('Description') }}" />
                            <x-inputs.textarea wire:model="description" wire:model.defer="description" />
                            <p>{{__('Displays after title.')}}</p>
                        </div>
                    </x-slot>

                    <x-slot name="footer">
                        <x-jet-secondary-button wire:click="$toggle('modal')" wire:loading.attr="disabled">
                            {{ __('Cancel') }}
                        </x-jet-secondary-button>

                        <x-jet-danger-button  type="submit" class="ml-2" wire:click="addQuestionnairePage" wire:loading.attr="disabled">
                            {{ __('Save') }}
                        </x-jet-danger-button>
                    </x-slot>
                </form>
            </x-jet-dialog-modal>
        </x-slot>
    </x-jet-action-section>
</div>

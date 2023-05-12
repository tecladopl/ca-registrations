<div>
    <x-jet-button wire:click="modalEdit">
        {{ __('Edit') }}
    </x-jet-button>
    <x-jet-dialog-modal wire:model="modalEdit">
        <form wire:submit.prevent="save">
            <x-slot name="title">
                {{ __('Editing Questionnaire') }}
            </x-slot>
            <x-slot name="content">
                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="name" value="{{ __('Name') }}" />
                    <x-jet-input id="name" type="text" class="mt-1 block w-full" wire:model="questionnaire.name" />
                    <p>{{__('Displays only in admin panel')}}</p>
                </div>
                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="description" value="{{ __('Description') }}" />
                    <x-inputs.textarea wire:model="questionnaire.description" wire:model.defer="questionnaire.description" />
                    <p>{{__('Displays only in admin panel')}}</p>
                </div>
                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="path" value="{{ __('Path') }}" />
                    <x-jet-input id="path" type="text" x-ref="path" class="mt-1 block w-full" wire:model="path"
                                wire:model.defer="path" autocomplete="path" />
                            <x-jet-input-error for="path" class="mt-2" />
                    <p>{{__('Questionnaire URL')}}</p>
                </div>
                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="start" value="{{ __('Starts at') }}" />
                    <x-jet-input data-input id="start" type="text" class="mt-1 block w-full calendar2" wire:model="questionnaire.start" wire:model.defer="questionnaire.start" autocomplete="questionnaire.start" />
                    <p>{{__('Determine when questionnaire is available')}}</p>
                </div>
                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="end" value="{{ __('Ends at') }}" />
                    <x-jet-input data-input id="end" type="text" class="mt-1 block w-full calendar3" wire:model="questionnaire.end" wire:model.defer="questionnaire.end" autocomplete="questionnaire.end" />
                    <p>{{__('Determine when questionnaire is available')}}</p>
                </div>
            </x-slot>
            <x-slot name="footer">
                <x-jet-secondary-button wire:click="$toggle('modalEdit')" wire:loading.attr="disabled">
                    {{ __('Cancel') }}
                </x-jet-secondary-button>

                <x-jet-danger-button  type="submit" class="ml-2" wire:click="editQuestionnaire" wire:loading.attr="disabled">
                    {{ __('Save') }}
                </x-jet-danger-button>
            </x-slot>
        </form>
    </x-jet-dialog-modal>
</div>

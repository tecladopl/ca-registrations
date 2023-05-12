<div class="mt-8">
    <x-jet-action-section>
        <x-slot name="title">
            {{ __('Add Questionnaire') }}
        </x-slot>

        <x-slot name="description">
            {{ __('Add new Questionnaire') }}
        </x-slot>

        <x-slot name="content">

            <div class="mt-5">
                <x-jet-button wire:click="modal" wire:loading.attr="disabled">
                    {{ __('Add Questionnaire') }}
                </x-jet-button>
            </div>

            <x-jet-dialog-modal wire:model="modal">
                <form wire:submit.prevent="save">
                    <x-slot name="title">
                        {{ __('Adding Questionnaire') }}
                    </x-slot>
                
                    <x-slot name="content">

                        <div class="col-span-6 sm:col-span-4">
                        </div>
                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-label for="name" value="{{ __('Name') }}" />
                            <x-jet-input id="name" type="text" class="mt-1 block w-full" wire:model="name"
                               wire:model.defer="name" x-ref="name" autocomplete="name" />
                            <x-jet-input-error for="name" class="mt-2" />
                        </div>
                        <div class="col-span-6 sm:col-span-4">
                            <x-head.tinymce-config/>
                            <x-jet-label for="description" value="{{ __('Description') }}" />
                           <x-inputs.tinymce-editor wire:model="description" x-ref="description"
                                wire:model.defer="description" autocomplete="description" />
                            <x-jet-input-error for="description" class="mt-2" />
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
                            <x-jet-input data-input id="start" x-ref="start" type="text"
                                class="mt-1 block w-full calendar2" wire:model="start" wire:model.defer="start"
                                autocomplete="start" />
                                <x-jet-input-error for="start" class="mt-2" />
                            <p>{{__('Determine when questionnaire is available')}}</p>
                        </div>
                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-label for="end" value="{{ __('Ends at') }}" />
                            <x-jet-input data-input id="end" x-ref="end" type="text" class="mt-1 block w-full calendar3"
                                wire:model="end" wire:model.defer="end" autocomplete="end" />
                                <x-jet-input-error for="end" class="mt-2" />
                            <p>{{__('Determine when questionnaire is available')}}</p>
                        </div>

                    </x-slot>

                    <x-slot name="footer">
                        <x-jet-secondary-button wire:click="$toggle('modal')" wire:loading.attr="disabled">
                            {{ __('Cancel') }}
                        </x-jet-secondary-button>

                        <x-jet-danger-button type="submit" class="ml-2" wire:click="addQuestionnaire"
                            wire:loading.attr="disabled">
                            {{ __('Save') }}
                        </x-jet-danger-button>
                    </x-slot>
                </form>
                
            </x-jet-dialog-modal>
        </x-slot>
    </x-jet-action-section>
</div>
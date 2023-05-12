<div class="mt-8">
    <x-jet-action-section>
        <x-slot name="title">
            {{ __('Add Assembly') }}
        </x-slot>

        <x-slot name="description">
            {{ __('Add new Assembly') }}
        </x-slot>

        <x-slot name="content">

            <div class="mt-5">
                <x-jet-button wire:click="modal" wire:loading.attr="disabled">
                    {{ __('Add Assembly') }}
                </x-jet-button>
            </div>

            <x-jet-dialog-modal wire:model="modal">
                <form wire:submit.prevent="save">
                    <x-slot name="title">
                        {{ __('Adding Assembly') }}
                    </x-slot>

                    <x-slot name="content">


                        <!-- Name -->
                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-label for="name" value="{{ __('Name') }}" />
                            <x-jet-input id="name" type="text" class="mt-1 block w-full" wire:model="name" wire:model.defer="name" autocomplete="name" />
                        </div>
                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-label for="description" value="{{ __('Description') }}" />
                            <x-inputs.textarea wire:model="description" wire:model.defer="description" />
                        </div>

                    </x-slot>

                    <x-slot name="footer">
                        <x-jet-secondary-button wire:click="$toggle('modal')" wire:loading.attr="disabled">
                            {{ __('Cancel') }}
                        </x-jet-secondary-button>

                        <x-jet-danger-button  type="submit" class="ml-2" wire:click="addAssembly" wire:loading.attr="disabled">
                            {{ __('Save') }}
                        </x-jet-danger-button>
                    </x-slot>
                </form>
            </x-jet-dialog-modal>
        </x-slot>
    </x-jet-action-section>
</div>

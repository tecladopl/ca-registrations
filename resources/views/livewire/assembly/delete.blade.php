<div>
    <x-jet-danger-button wire:click="modalDelete">
        {{ __('Delete') }}
    </x-jet-danger-button>
    <x-jet-dialog-modal wire:model="modalDelete">
        <form wire:submit.prevent="save">
            <x-slot name="title">
                {{ __('Deleting Assembly') }}
            </x-slot>
            <x-slot name="content">
                <p>{{ __('Assembly') }}: {{$assembly->name}}</p>
                <p>{{__('Are you sure?')}}</p>
            </x-slot>
            <x-slot name="footer">
                <x-jet-secondary-button wire:click="$toggle('modalDelete')" wire:loading.attr="disabled">
                    {{ __('Cancel') }}
                </x-jet-secondary-button>

                <x-jet-danger-button  type="submit" class="ml-2" wire:click="deleteAssembly" wire:loading.attr="disabled">
                    {{ __('Delete') }}
                </x-jet-danger-button>
            </x-slot>
        </form>
    </x-jet-dialog-modal>
</div>

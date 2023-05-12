<div>
    <x-jet-button wire:click="modalEdit">
        {{ __('Edit') }}
    </x-jet-button>
    <x-jet-dialog-modal wire:model="modalEdit">
        <form wire:submit.prevent="save">
            <x-slot name="title">
                {{ __('Editing Criterion Data') }}
            </x-slot>
            <x-slot name="content">
                <div class="p-2 grid grid-cols-12 gap-2">
                    <div class="col-span-2">{{ __('Criterion') }} :</div>
                    <div class="col-span-10 font-bold">{{$criterion->name}}</div>
                </div>

                @if($criterion->category_type->type=='choise')
                    <div class="col-span-6 sm:col-span-4 mt-2">
                        <p>{{ __('Value of Criterion Data field') }}</p>
                        <x-jet-label for="value" value="{{ __('Value') }}" />
                        <x-jet-input name="value" type="text" class="mt-1 block w-full" wire:model="criterionData.value" />
                        <x-jet-input-error for="value" class="mt-2" />
                    </div>
                @else
                    <div class="col-span-6 sm:col-span-4 mt-2">
                        <p>{{ __('Minimum value for range') }}</p>
                        <x-jet-label for="min" value="{{ __('Minimum') }}" />
                        <x-jet-input name="min" type="number" class="mt-1 block w-full" wire:model="criterionData.min" />
                        <x-jet-input-error for="min" class="mt-2" />
                    </div>
                    <div class="col-span-6 sm:col-span-4 mt-2">
                        <p>{{ __('Maximum value for range') }}</p>
                        <x-jet-label for="max" value="{{ __('Maximum') }}" />
                        <x-jet-input name="max" type="number" class="mt-1 block w-full" wire:model="criterionData.max" />
                        <x-jet-input-error for="max" class="mt-2" />
                    </div>
                @endif
                <div class="col-span-6 sm:col-span-4 mt-2">
                    <p>{{ __('Number of appearances in data set') }}</p>
                    <x-jet-label for="amount" value="{{ __('Amount') }}" />
                    <x-jet-input name="amount" type="number" min="0" step="1" class="mt-1 block w-full" wire:model="criterionData.amount" />
                    <x-jet-input-error for="amount" class="mt-2" />
                </div>
            </x-slot>
            <x-slot name="footer">
                <x-jet-secondary-button wire:click="$toggle('modalEdit')" wire:loading.attr="disabled">
                    {{ __('Cancel') }}
                </x-jet-secondary-button>

                <x-jet-danger-button  type="submit" class="ml-2" wire:click="EditCriterionData" wire:loading.attr="disabled">
                    {{ __('Save') }}
                </x-jet-danger-button>
            </x-slot>
        </form>
    </x-jet-dialog-modal>
</div>

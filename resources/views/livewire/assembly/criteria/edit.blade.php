<div>
    <x-jet-button wire:click="modalEdit">
        {{ __('Edit') }}
    </x-jet-button>
    <x-jet-dialog-modal wire:model="modalEdit">
        <form wire:submit.prevent="save">
            <x-slot name="title">
                {{ __('Editing Criterion') }}
            </x-slot>
            <x-slot name="content">
                <div>
                    <x-jet-label for="name" value="{{ __('Name') }}" />
                    <x-jet-input id="name" type="text" class="mt-1 block w-full" wire:model="criterion.name" />
                    <x-jet-input-error for="name" class="mt-2" />
                </div>
                <div>
                    <x-jet-label for="category_type_id" value="{{ __('Criterion type') }}" />
                    <select name="criterion.category_type_id" class="form-input rounded-md shadow-sm mt-1 block w-full" wire:model="criterion.category_type_id">
                        <option>{{__('-- pick right option --')}}</option>
                        @foreach($category_types as $type)
                            <option @if($criterion->category_type_id == $type->id) selected="selected" @endif value="{{$type->id}}">{{$type->type}}</option>
                        @endforeach
                    </select>
                    <x-jet-input-error for="category_type_id" class="mt-2" />
                </div>
                <div>
                    <x-jet-label for="priority" value="{{ __('Priority') }}" />
                    <p>{{ __('Minimum and default is 1. Lower value means more important criterion.') }}</p>
                    <x-jet-input id="priority" type="number" min="1" step="1" class="mt-1 block w-full" wire:model="criterion.priority" />
                    <x-jet-input-error for="priority" class="mt-2" />
                </div>
            </x-slot>
            <x-slot name="footer">
                <x-jet-secondary-button wire:click="$toggle('modalEdit')" wire:loading.attr="disabled">
                    {{ __('Cancel') }}
                </x-jet-secondary-button>

                <x-jet-danger-button  type="submit" class="ml-2" wire:click="EditCriterion" wire:loading.attr="disabled">
                    {{ __('Save') }}
                </x-jet-danger-button>
            </x-slot>
        </form>
    </x-jet-dialog-modal>
</div>

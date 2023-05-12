<div class="mt-8">
    <x-jet-action-section>
        <x-slot name="title">
            {{ __('Add Assembly Criterion') }}
        </x-slot>

        <x-slot name="description">
            {{ __('Add new Assembly Criterion') }}
        </x-slot>

        <x-slot name="content">

            <div class="mt-5">
                <x-jet-button wire:click="modal" wire:loading.attr="disabled">
                    {{ __('Add Assembly Criterion') }}
                </x-jet-button>
            </div>

            <x-jet-dialog-modal wire:model="modal">
                <form wire:submit.prevent="save">
                    <x-slot name="title">
                        {{ __('Adding Assembly Criterion') }}
                    </x-slot>

                    <x-slot name="content">

                        <div>
                            <x-jet-label for="name" value="{{ __('Name') }}" />
                            <x-jet-input id="name" type="text" class="mt-1 block w-full" wire:model="name" />
                            <x-jet-input-error for="name" class="mt-2" />
                        </div>
                        <div>
                            <x-jet-label for="category_type_id" value="{{ __('Criterion type') }}" />
                            <select id="category_type_id" name="category_type_id" class="form-input rounded-md shadow-sm mt-1 block w-full" wire:model="category_type_id">
                                <option>{{__('-- pick right option --')}}</option>
                                @foreach($category_types as $type)
                                    <option value="{{$type->id}}">{{$type->type}}</option>
                                @endforeach
                            </select>
                            <x-jet-input-error for="category_type_id" class="mt-2" />
                        </div>
                        <div>
                            <x-jet-label for="priority" value="{{ __('Priority') }}" />
                            <p>{{ __('Minimum and default is 1. Lower value means more important criterion.') }}</p>
                            <x-jet-input id="priority" type="number" min="1" step="1" class="mt-1 block w-full" wire:model="priority" />
                            <x-jet-input-error for="priority" class="mt-2" />
                        </div>



                    </x-slot>

                    <x-slot name="footer">
                        <x-jet-secondary-button wire:click="$toggle('modal')" wire:loading.attr="disabled">
                            {{ __('Cancel') }}
                        </x-jet-secondary-button>

                        <x-jet-button  type="submit" class="ml-2" wire:click="addCriterion" wire:loading.attr="disabled">
                            {{ __('Save') }}
                        </x-jet-button>
                    </x-slot>
                </form>
            </x-jet-dialog-modal>
        </x-slot>
    </x-jet-action-section>
</div>

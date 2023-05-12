<div class="mt-8">
    <x-jet-action-section>
        <x-slot name="title">
            {{ __('Add Answer') }}
        </x-slot>

        <x-slot name="description">
            {{ __('Add new Answer') }}
        </x-slot>

        <x-slot name="content">

            <div class="mt-5">
                <x-jet-button wire:click="modal" wire:loading.attr="disabled">
                    {{ __('Add Answer') }}
                </x-jet-button>
            </div>

            <x-jet-dialog-modal wire:model="modal">
                <form wire:submit.prevent="save">
                    <x-slot name="title">
                        {{ __('Adding Answer') }}
                    </x-slot>

                    <x-slot name="content">
                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-label for="path" value="{{ __('Page') }}" />
                            <select id="question_id" name="question_id" class="form-input rounded-md shadow-sm mt-1 block w-full" wire:model="question_id">
                                <option>{{__('-- pick right option --')}}</option>
                                @foreach($questions as $question)
                                    <option value="{{$question->id}}">{{$question->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <!-- Name -->
                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-label for="order" value="{{ __('Order') }}" />
                            <x-jet-input id="order" type="number" step="1" min="1" class="mt-1 block w-full" wire:model="order" wire:model.defer="order" autocomplete="order" />
                            <x-jet-input-error for="order" class="mt-2" />
                        </div>
                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-label for="points" value="{{ __('Points') }}" />
                            <x-jet-input id="points" type="number" step="1" min="1" class="mt-1 block w-full" wire:model="points" wire:model.defer="points" autocomplete="points" />
                            <x-jet-input-error for="points" class="mt-2" />
                        </div>
                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-label for="text" value="{{ __('Text') }}" />
                            <x-jet-input id="text" type="text" class="mt-1 block w-full" wire:model="text" wire:model.defer="text" autocomplete="text" />
                            <x-jet-input-error for="text" class="mt-2" />
                        </div>
                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-label for="subtext" value="{{ __('Subtext') }}" />
                            <x-inputs.textarea wire:model="subtext" wire:model.defer="subtext" />
                            <x-jet-input-error for="subtext" class="mt-2" />
                        </div>
                    </x-slot>

                    <x-slot name="footer">
                        <x-jet-secondary-button wire:click="$toggle('modal')" wire:loading.attr="disabled">
                            {{ __('Cancel') }}
                        </x-jet-secondary-button>

                        <x-jet-danger-button  type="submit" class="ml-2" wire:click="addAnswer" wire:loading.attr="disabled">
                            {{ __('Save') }}
                        </x-jet-danger-button>
                    </x-slot>
                </form>
            </x-jet-dialog-modal>
        </x-slot>
    </x-jet-action-section>
</div>

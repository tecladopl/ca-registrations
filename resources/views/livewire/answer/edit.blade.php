<div>
    <x-jet-button wire:click="modalEdit">
        {{ __('Edit') }}
    </x-jet-button>
    <x-jet-dialog-modal wire:model="modalEdit">
        <form wire:submit.prevent="save">
            <x-slot name="title">
                {{ __('Editing Assembly') }}
            </x-slot>
            <x-slot name="content">
                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="path" value="{{ __('Page') }}" />
                    <select id="question_id" name="question_id" class="form-input rounded-md shadow-sm mt-1 block w-full" wire:model="answer.question_id">
                        <option>{{__('-- pick right option --')}}</option>
                        @foreach($questions as $question)
                            <option value="{{$question->id}}">{{$question->name}}</option>
                        @endforeach
                    </select>
                </div>
                <!-- Name -->
                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="order" value="{{ __('Order') }}" />
                    <x-jet-input id="order" type="number" step="1" min="1" class="mt-1 block w-full" wire:model="answer.order" wire:model.defer="answer.order" autocomplete="answer.order" />
                </div>
                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="points" value="{{ __('Points') }}" />
                    <x-jet-input id="points" type="number" class="mt-1 block w-full" wire:model="answer.points" wire:model.defer="answer.points" autocomplete="answer.points" />
                </div>
                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="text" value="{{ __('Text') }}" />
                    <x-jet-input id="text" type="text" class="mt-1 block w-full" wire:model="answer.text" wire:model.defer="answer.text" autocomplete="answer.text" />
                </div>
                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="subtext" value="{{ __('Subtext') }}" />
                    <x-inputs.textarea wire:model="answer.subtext" wire:model.defer="answer.subtext" />
                </div>
            </x-slot>
            <x-slot name="footer">
                <x-jet-secondary-button wire:click="$toggle('modalEdit')" wire:loading.attr="disabled">
                    {{ __('Cancel') }}
                </x-jet-secondary-button>

                <x-jet-danger-button  type="submit" class="ml-2" wire:click="editAnswer" wire:loading.attr="disabled">
                    {{ __('Save') }}
                </x-jet-danger-button>
            </x-slot>
        </form>
    </x-jet-dialog-modal>
</div>

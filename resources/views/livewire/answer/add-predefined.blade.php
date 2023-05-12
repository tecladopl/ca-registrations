<div class="mt-8">
    <x-jet-action-section>
        <x-slot name="title">
            {{ __('Add Predefined Answers') }}
        </x-slot>

        <x-slot name="description">
            {{ __('Add new Predefined Answers') }}
        </x-slot>

        <x-slot name="content">

            <div class="mt-5">
                <x-jet-button wire:click="modalAddPredefined" wire:loading.attr="disabled">
                    {{ __('Add Predefined Answers') }}
                </x-jet-button>
            </div>

            <x-jet-dialog-modal wire:model="modalAddPredefined">
                <form wire:submit.prevent="save">
                    <x-slot name="title">
                        {{ __('Add Predefined Answers') }}
                    </x-slot>

                    <x-slot name="content">
                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-label for="path" value="{{ __('Question') }}"/>
                            <select id="question_id" name="question_id"
                                    class="form-input rounded-md shadow-sm mt-1 block w-full" wire:model="question_id">
                                <option>{{__('-- pick right option --')}}</option>
                                @foreach($questions as $question)
                                    <option value="{{$question->id}}">{{$question->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-label for="path" value="{{ __('Answers Type') }}"/>
                            <select id="predefined_answers_id" name="predefined_answers_id"
                                    class="form-input rounded-md shadow-sm mt-1 block w-full"
                                    wire:model="predefined_answers_id">
                                <option>{{__('-- pick right option --')}}</option>
                                <option value="1">{{ __('Three-hundredth scale') }}</option>
                                <option value="2">{{ __('Five-hundredth scale') }}</option>
                            </select>
                        </div>
                    </x-slot>

                    <x-slot name="footer">
                        <x-jet-secondary-button wire:click="$toggle('modal')" wire:loading.attr="disabled">
                            {{ __('Cancel') }}
                        </x-jet-secondary-button>

                        <x-jet-danger-button type="submit" class="ml-2" wire:click="addPredefinedAnswers"
                                             wire:loading.attr="disabled">
                            {{ __('Save') }}
                        </x-jet-danger-button>
                    </x-slot>
                </form>
            </x-jet-dialog-modal>
        </x-slot>
    </x-jet-action-section>
</div>

<div>
    <textarea
        {{ $attributes->except('class') }}
        {{ $attributes->merge(['class' => 'form-input rounded-md shadow-sm mt-1 block w-full']) }}
        ></textarea>
</div>
<form method="post">
   <textarea
        {{ $attributes->except('class') }}
        {{ $attributes->merge(['class' => 'tinymce form-input rounded-md shadow-sm mt-1 block w-full']) }}
        ></textarea>
 </form>

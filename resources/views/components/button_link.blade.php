@props([
'link', 'styling', 'id', 'title', 'icon'
])
<a href="{{ $link }}">
    <button class="{{ $styling }} flex items-center gap-2 p-4 font-normal border-2 border-gray-300 w-full">
        <i class="{{ $icon }} mt-1"></i>
        {{ $title }}
    </button>
</a>
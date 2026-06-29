@props([
'link', 'styling', 'id', 'title', 'icon'
])
<a href="{{ $link }}">
    <button class="{{ $styling }} flex gap-2 p-4 rounded-none border-2 border-gray-300">
        <i class="{{ $icon }}"></i>
        {{ $title }}
    </button>
</a>
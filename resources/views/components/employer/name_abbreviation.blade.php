@props([
'name',
'applicationStatus'
])

@php
$statusStyles = [
'applied' => 'bg-blue-700 text-white',
'shortlisted' => 'bg-green-500 text-white',
'interview' => 'bg-[#ffdbcf] text-amber-900',
];

// Fallback style if status isn't matched
$style = $statusStyles[$applicationStatus] ?? 'bg-gray-200 text-gray-800';
@endphp

<span class="w-10 h-10 flex items-center justify-center rounded-lg font-medium {{ $style }}">
    {{ $name }}
</span>
@props([
'application_status'
])

@php
$applicationStatusStyles = [
'applied' => 'bg-[#eff6ff] text-blue-700',
'shortlisted' => 'bg-[#f0fdf4] text-green-800',
'interview' => 'bg-[#fff7ed] text-amber-900'
];
$style = $applicationStatusStyles[$application_status] ?? 'bg-gray-200 text-gray-800';
@endphp
<span class="p-2 {{ $style }}">{{ $application_status === 'applied' ? 'New' : $application_status }}</span>
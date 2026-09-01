@props([
'company'
])
@php
$companyJobCount = $company->careers->count();
@endphp
<main class="w-[250px] md:w-full flex flex-col gap-2 md:gap-4 py-5 border border-gray-300 bg-white hover:border-blue-800 rounded group cursor-pointer">
    <div class="px-2 flex gap-2 justify-center items-center text-description text-sm capitalize font-medium">
        <span class="hidden md:block text-gray-600">Industry:</span>
        <span class=" text-blue-800 text-lg md:text-sm flex justify-center items-center w-fit"> {{ $company->industry }} </span>
    </div>
    <div class="flex gap-2 items-center justify-center text-heading text-[12px] md:text-[15px] px-4">
        <i class="fi fi-rs-building"></i>
        <h1>{{ $company->company_name }}</h1>
    </div>
    <div class="hidden md:flex gap-2 items-center justify-center text-description font-medium text-sm">
        <span>Available Positions: </span>
        <span>{{ $companyJobCount }} Post{{ $companyJobCount > 1 ? 's':'' }}</span>
    </div>
    <div class="md:hidden flex gap-2 items-center justify-center text-description font-medium text-sm">
        <span>Available: </span>
        <span>{{ $companyJobCount }} Position{{ $companyJobCount > 1 ? 's':'' }}</span>
    </div>
</main>
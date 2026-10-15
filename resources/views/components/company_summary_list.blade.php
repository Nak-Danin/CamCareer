@props([
'company'
])
@php
$companyLogo = $company->logo_url;
$companyName = $company->company_name;
$industry = $company->industry;
$jobCount = $company->careers->count();
$location = $company->location;
$description = $company->description;
$companyId = $company->company_id;
@endphp
<main class="w-full flex gap-3 p-3 bg-white rounded-md">
    <img class="w-[60px] h-[60px] rounded-xl border-4 border-gray-300" src="{{ $companyLogo?? Vite::asset('resources/images/image.png') }}" alt="Company_logo">
    <aside class="w-full flex flex-col gap-1">
        <div class="grid grid-cols-[5fr_1fr]">
            <section class="w-full flex flex-col gap-1">
                <h1 class="text-heading text-xl">{{ $companyName }}</h1>
                <div class="flex gap-3 font-semibold font-sans">
                    <span class="text-blue-800">{{ $industry }}</span>
                    <span class="text-gray-600"><i class="fi fi-rs-marker text-xs"></i> {{ $location }}</span>
                </div>
            </section>
            <section class="flex items-start justify-end">
                <span class="h-fit bg-blue-100 text-blue-800 font-semibold px-2 py-1">{{ $jobCount }} Open Jobs</span>
            </section>
        </div>
        <div class="grid grid-cols-[5fr_1fr]">
            <span class="text-description text-sm font-serif">{{ $description }}</span>
            <a class="flex justify-end" href=""><button class="px-3 py-1 bg-blue-700 text-white rounded-md">View Profile</button></a>
        </div>
    </aside>
</main>
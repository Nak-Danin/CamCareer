@php
$bgCover = $company->cover_pic;
$companyLogo = $company->logo_url;
@endphp
<x-layouts.master-layout>
    <main class="w-full flex flex-col gap-4 md:gap-10">
        <section class="w-full flex justify-between px-4 py-1 md:px-10 md:py-4 bg-white">
            <aside class="flex gap-1 items-center font-medium text-md">
                <a href="{{ route('seeker.companies') }}" class="flex gap-2 items-center text-blue-900">
                    <i class="fi fi-br-arrow-small-left mt-1"></i>
                    <span>Back to Companies</span>
                </a>
                <span>/ {{ $company->company_name }} /</span>
                <span class="text-gray-700">Profile</span>
            </aside>
            <aside class="flex gap-3 justify-end font-medium">
                <span class="flex gap-1 items-center px-2 h-fit rounded bg-indigo-100 text-blue-800"><i class="fi fi-rr-shield-trust mt-1"></i> Verified Corporate Employer</span>
                <span class="text-gray-700">Member since {{ Illuminate\Support\Facades\Date::parse($company->created_at)->format('M, Y') }}</span>
            </aside>
        </section>
        <section class="flex flex-col md:px-10 px-4">
            <aside class="relative w-full h-60">
                <div class="absolute top-0 right-0 z-20 w-full h-full bg-black opacity-50 backdrop-blur-md
                [mask-image:linear-gradient(to_top,black,transparent)]"></div>
                <img class="absolute top-0 right-0 z-10 w-full h-full rounded-t-md object-cover" src="{{ $bgCover ?? Vite::asset('resources/images/company-cover.jpg') }}" alt="Company Cover Pic">
            </aside>
            <aside class="grid grid-cols-2 h-50 w-full bg-white p-8">
                <div class="flex gap-5 items-center">
                    <img class="rounded-md border-4 border-gray-400 object-cover h-30 w-30" src="{{ $companyLogo ?? Vite::asset('resources/images/image.png') }}" alt="">
                    <div class="flex flex-col gap-2 font-medium text-gray-700">
                        <div class="flex gap-2 items-center">
                            <h1 class="text-3xl">{{ $company->company_name }}</h1>
                            <span class="flex gap-1 items-center px-2 h-fit rounded bg-indigo-100 text-blue-800"><i class="fi fi-rr-shield-trust mt-1"></i> Verified</span>
                        </div>
                        <div class="flex gap-4">
                            <span class="flex gap-2">
                                <i class="fi fi-bs-marker text-blue-800 mt-0.5"></i>
                                {{ $company->location }}
                            </span>
                            <span class="flex gap-2">
                                <i class="fi fi-ss-building text-blue-800 mt-0.5"></i>
                                {{ $company->industry }}
                            </span>
                        </div>
                        <a href="https://{{ $company->website }}" target="_blank" class="flex gap-2 text-blue-800">
                            <i class="fi fi-sr-globe mt-0.5"></i>
                            {{ $company->website }}
                        </a>
                    </div>
                </div>
                <div class="flex flex-col gap-5 justify-center items-end">
                    <span class="font-medium text-gray-700">Total Jobs Posted ( {{ $totalJobsPost }} Positions )</span>
                    <a href="" class="flex gap-3 px-5 py-3 bg-blue-700 text-white font-medium rounded">
                        <i class="fi fi-sr-briefcase mt-0.5"></i>
                        <span>View {{ $availableJobsCount }} Open Jobs</span>
                    </a>
                </div>
            </aside>

        </section>
    </main>
</x-layouts.master-layout>
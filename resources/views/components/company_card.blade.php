@props([
'company'
])
@php
use Illuminate\Support\Facades\Vite;
$company_name = $company->company_name;
$company_website = $company->website;
$company_description = $company->description;
$company_careers_count = $company->careers->count();
$industry = $company->industry;
$location = $company->location;
$cover_pic = $company->cover_pic;
$logo = $company->logo_url;
@endphp
<main class="w-full h-[500px] flex flex-col rounded-xl shadow shadow-gray-500">
    <section class="relative w-full h-1/2">
        <div class="z-11 absolute bg-black w-full h-full opacity-30 rounded-t-xl"></div>
        <img class="z-10 absolute w-full h-full rounded-t-xl" src="{{ $cover_pic ?? Vite::asset('resources/images/company-cover.jpg') }}" alt="">
        <div class="z-12 absolute right-3 top-3 rounded px-2 bg-white">
            <div class="flex items-center gap-1 text-blue-800">
                <i class="fi fi-rr-circle-star"></i>
                <span class="font-medium mb-1">Featured</span>
            </div>
        </div>
        <div class="z-12 absolute bottom-3 left-3">
            <div class="flex gap-2 items-center">
                <img class="w-[60px] h-[60px] rounded-xl" src="{{ $logo ?? Vite::asset('resources/images/image.png') }}" alt="">
                <div class="flex flex-col">
                    <h1 class="font-semibold text-2xl text-white text-shadow-md text-shadow-gray-500">{{ $company_name }}</h1>
                    <a class="font-medium text-sm text-gray-200" target="_blank" href="{{ $company_website }}">View Company Website <i class="fi fi-rr-share-square"></i></a>
                </div>
            </div>
        </div>
    </section>
    <section class="h-1/2 w-full p-5 flex flex-col gap-5">
        <p class="text-gray-600 text-lg line-clamp-2">
            {{ $company_description }}
        </p>
        <div class="flex gap-3 items-center">
            <span class="px-2 py-1 bg-[#e9e9f7] text-lg text-gray-600 font-medium rounded">{{ $industry }}</span>
            <span class="px-2 py-1 bg-[#e9e9f7] text-lg text-gray-600 font-medium rounded">{{ $location }}</span>
        </div>
        <div class="grid grid-cols-[4fr_1fr] gap-3 w-full">
            <a class="bg-blue-800 text-xl font-semibold text-center py-2 rounded-md text-white" href="">Browse {{ $company_careers_count }} Jobs</a>
            <a class="py-2 flex items-center justify-center bg-gray-300 rounded-md" href=""><i class="fi fi-br-up-right-from-square text-xl"></i></a>
        </div>
    </section>

</main>
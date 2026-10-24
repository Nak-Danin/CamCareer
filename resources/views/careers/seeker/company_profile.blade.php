@php
$bgCover = $company->cover_pic;
$companyLogo = $company->logo_url;
@endphp
<x-layouts.master-layout>
    <main class="w-full flex flex-col gap-4 md:gap-10 mb-10">
        <!-- NavaBar-->
        <section class="w-full flex justify-between px-4 py-4 md:py-1 md:px-10 md:py-4 bg-white">
            <aside class="flex gap-1 items-center font-medium text-md">
                <a href="{{ route('seeker.companies') }}" class="flex gap-2 items-center text-blue-900">
                    <span>Companies</span>
                </a>
                <span>/ {{ $company->company_name }} /</span>
                <span class="text-gray-700">Profile</span>
            </aside>
            <aside class="hidden md:flex gap-3 justify-end text-sm md:text-base">
                <span class="flex gap-1 items-center px-2 h-fit rounded bg-indigo-100 text-blue-800"><i class="fi fi-rr-shield-trust mt-1"></i> Verified Corporate Employer</span>
                <span class="text-gray-700 italic">Member since {{ Illuminate\Support\Facades\Date::parse($company->created_at)->format('M, Y') }}</span>
            </aside>
        </section>
        <!-- Profile -->
        <section class="flex flex-col md:px-10 md:py-0 px-4">
            <aside class="relative w-full h-30 md:h-60">
                <div class="absolute top-0 right-0 z-20 w-full h-full bg-black opacity-50 backdrop-blur-md
                [mask-image:linear-gradient(to_top,black,transparent)]"></div>
                <img class="absolute top-0 right-0 z-10 rounded-t-md w-full h-full object-cover" src="{{ $bgCover ?? Vite::asset('resources/images/company-cover.jpg') }}" alt="Company Cover Pic">
            </aside>
            <aside class="grid grid-cols-1 items-center md:grid-cols-2 w-full bg-white h-30 md:h-50 p-2 md:p-8 rounded-b-md ">
                <div class="flex gap-2 md:gap-5 items-center w-full ">
                    <img class="rounded-md border-3 md:border-4 border-gray-200 object-cover h-20 w-20 md:h-30 md:w-30" src="{{ $companyLogo ?? Vite::asset('resources/images/image.png') }}" alt="">
                    <div class="flex flex-col gap-1 font-medium text-gray-700">
                        <div class="flex gap-2 items-center">
                            <h1 class="text-lg md:text-2xl">{{ $company->company_name }}</h1>
                            <span class="flex gap-1 items-center px-2 h-fit rounded bg-indigo-100 text-blue-800 text-xs md:text-base"><i class="fi fi-rr-shield-trust mt-1"></i> Verified</span>
                        </div>
                        <div class="flex gap-4 text-xs md:text-base">
                            <span class="flex gap-2">
                                <i class="fi fi-bs-marker text-blue-800 mt-0.5"></i>
                                {{ $company->location }}
                            </span>
                            <span class="flex gap-2">
                                <i class="fi fi-ss-building text-blue-800 mt-0.5"></i>
                                {{ $company->industry }}
                            </span>
                        </div>
                        <a href="https://{{ $company->website }}" target="_blank" class="text-xs md:text-base flex gap-2 text-blue-800">
                            <i class="fi fi-sr-globe mt-0.5"></i>
                            {{ $company->website }}
                        </a>
                    </div>
                </div>
                <div class="hidden md:flex flex-col gap-5 justify-center items-end">
                    <span class="font-medium text-gray-700">Total Jobs Posted ( {{ $totalJobsPost }} Positions )</span>
                    <a href="#openJobs" class="flex gap-3 px-5 py-3 bg-blue-800 text-white font-medium rounded">
                        <i class="fi fi-sr-briefcase mt-0.5"></i>
                        <span>View {{ $availableJobsCount }} Open Jobs</span>
                    </a>
                </div>
            </aside>
        </section>
        <!-- Main Content -->
        <section class="grid grid-cols-1 md:grid-cols-[2fr_1fr] gap-4 md:gap-10 px-4 py-1 md:px-10 bg-gray-100">
            <!-- About and Open Jobs -->
            <aside class="flex flex-col gap-1 md:gap-4 bg-white p-4 md:p-8 h-fit pb-10 rounded-md">
                <main class="flex items-center justify-between font-medium ">
                    <h1 class="text-lg md:text-2xl flex gap-2 md:gap-3 text-gray-700"> <i class="fi fi-rs-info mt-0.5 text-blue-800"></i> About Company</h1>
                    <span class="text-gray-600 flex gap-2 text-sm md:text-lg"><i class="fi fi-rs-marker mt-0.5"></i> {{ $company->location }}</span>
                </main>
                <span class="text-gray-700 text-sm md:text-lg italic">{{ $company->description }}</span>
                <div id="openJobs" class="flex flex-col gap-2 mt-4 scroll-mt-24">
                    <div class="flex gap-2 items-center font-medium">
                        <h1 class="text-lg md:text-2xl text-gray-700 flex gap-3"><i class="fi fi-sr-briefcase text-blue-800"></i> Open Positions</h1>
                        <span class="text-blue-800 bg-indigo-100 px-2 py-1 rounded-lg text-xs md:text-base">{{ $availableJobsCount }} Active</span>
                    </div>
                    <span class="text-gray-700 text-sm md:text-lg">Join {{ $company->company_name }} and shape the future of asynchronous work</span>
                    <div class="flex flex-col gap-3">
                        @foreach ($availableJobs as $job)
                        <x-seeker.featured_job_list class="featured_job_list" :job="$job" :seeker="$seeker" />
                        @endforeach
                    </div>
                </div>
            </aside>
            <!-- Company Snapshot and Similar Companies -->
            <aside class="flex flex-col gap-4">
                <!-- Company Snapshot -->
                <div class="flex flex-col gap-4 bg-white p-4 md:p-8 rounded-md">
                    <h1 class="flex gap-3 items-center text-lg md:text-2xl text-gray-700 font-medium"><i class="fi fi-sr-stats text-blue-800"></i> Company Snapshot</h1>
                    <ul class="flex flex-col gap-3">
                        <li class="text-sm flex justify-between md:text-lg border-b-2 border-gray-200">
                            <span class="text-gray-600">Company</span>
                            <span>{{ $company->company_name }}</span>
                        </li>
                        <li class="text-sm flex justify-between md:text-lg border-b-2 border-gray-200">
                            <span class="text-gray-600">Industry</span>
                            <span>{{ $company->industry }}</span>
                        </li>
                        <li class="text-sm flex justify-between md:text-lg border-b-2 border-gray-200">
                            <span class="text-gray-600">Headquarters</span>
                            <span>{{ $company->location }}</span>
                        </li>
                        <li class="text-sm flex justify-between md:text-lg border-b-2 border-gray-200">
                            <span class="text-gray-600">Primary Languages</span>
                            <span>English & Khmer</span>
                        </li>
                        <li class="text-sm flex justify-between md:text-lg border-b-2 border-gray-200">
                            <span class="text-gray-600">Founded</span>
                            <span>{{ Illuminate\Support\Facades\Date::parse($company->created_at)->format('d M Y')}}</span>
                        </li>
                        <li class="text-sm flex justify-between md:text-lg text-blue-800 font-medium">
                            <span>Active Job Listings</span>
                            <span>{{ $availableJobsCount }} Openings</span>
                        </li>
                    </ul>
                </div>
                <!-- Similar Companies -->
                <div class="flex flex-col gap-4 bg-white p-4 md:p-8 rounded-md  font-medium">
                    <h1 class="flex gap-3 items-center text-lg md:text-2xl text-gray-700"><i class="fi fi-ss-building text-blue-800"></i> Similar Companies</h1>
                    <ul class="flex flex-col gap-3">
                        @if ($similarCompanies->count() == 0)
                        <span class="text-gray-600">No similar companies available at the moment.</span>
                        @else
                        @foreach ($similarCompanies as $similarCompany)
                        <a href="{{ route('seeker.company.show', ['company' => $similarCompany]) }}" class="group/company flex justify-between hover:bg-gray-100 py-1 px-1">
                            <aside class="flex gap-2">
                                <img class="w-12 h-12 rounded-md border-2 border-gray-300" src="{{ $company->logo_url ?? Vite::asset('resources/images/image.png') }}" alt="Company Profile">
                                <div class="flex flex-col gap-1 text-sm">
                                    <h1>{{ $company->company_name }}</h1>
                                    <span class="text-gray-600">{{ $company->industry }}</span>
                                </div>
                            </aside>
                            <aside class="flex flex-col justify-end items-end text-blue-800 mr-1">
                                <i class="fi fi-rr-arrow-right hidden group-hover/company:inline-block"></i>
                                <span>{{ $similarCompany->careers()->availableCareers()->count() }} Jobs</span>
                            </aside>
                        </a>
                        @endforeach
                        @endif
                    </ul>
                    <a
                        class="flex justify-center items-center gap-3 text-blue-800 w-full text-sm md:text-lg border-2 border-gray-300 rounded-md transition-colors duration-100 py-2 hover:bg-blue-800 hover:text-white "
                        href="{{ route('seeker.companies') }}">
                        Explore All Companies
                    </a>
                </div>

            </aside>
        </section>
    </main>
</x-layouts.master-layout>
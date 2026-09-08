<x-master-layout heading="">
    <main class="grid grid-cols-[2fr_1fr] gap-5 p-10">
        <section class="flex flex-col gap-5">
            <div class="flex flex-col gap-5 w-full">
                <a class="flex gap-2 text-blue-800 font-medium text-lg" href="{{ url()->previous() }}">
                    <i class="fi fi-rr-arrow-small-left text-2xl"></i>
                    <span>Back to Search</span>
                </a>
                <section class="flex justify-between items-baseline bg-white px-10 py-5 border-2 border-gray-300 rounded-md">
                    <x-job_heading :career="$career" />
                    <div class="flex gap-3">
                        @if (!$isAlreadyApplied)
                        <form action="{{ route('application.store', ['career' => $career]) }}" method="POST">
                            @csrf @method("PATCH")
                            <button class="bg-blue-800 rounded-md text-white font-medium px-6 py-2 cursor-pointer" type="submit"> Apply Now </button>
                        </form>
                        @else
                        <button class="bg-green-200 rounded-md text-green-600 font-medium px-9 py-2"> Applied </button>
                        @endif
                    </div>
                </section>
                <section class="w-full bg-white border-2 border-gray-300 pb-5 rounded-t-md">
                    <h1 class="w-full p-5 bg-[#f3f3fd] text-xl font-medium border-b-2 border-gray-200">Job Description</h1>
                    <div class="flex flex-col gap-5 p-10">
                        <section class="flex flex-col gap-2">
                            <h1 class="text-blue-700 text-lg uppercase font-semibold">About this Role</h1>
                            <span>{{ $career->description }}</span>
                        </section>
                        <section class="flex flex-col gap-2">
                            <h1 class="text-blue-700 text-lg uppercase font-semibold">Key Qualifications</h1>
                            <ul class="flex flex-col gap-3">
                                @foreach ($career->requirements as $requirement)
                                <li class="flex gap-2 items-baseline"><i class="fi fi-ss-circle text-gray-500 text-[6px]"></i>{{ $requirement }}</li>
                                @endforeach
                            </ul>
                        </section>
                        <section class="flex flex-col gap-2">
                            <h1 class="text-blue-700 text-lg uppercase font-semibold">Job Responsibilities</h1>
                            <ul class="flex flex-col gap-3">
                                @foreach ($career->responsibilities as $responsibility)
                                <li class="flex gap-2 items-baseline"><i class="fi fi-ss-circle text-gray-500 text-[6px]"></i>{{ $responsibility }}</li>
                                @endforeach
                            </ul>
                        </section>
                        <section class="flex flex-col gap-2">
                            <h1 class="text-blue-700 text-lg uppercase font-semibold">Job Benefits</h1>
                            <ul class="flex flex-col gap-3">
                                @foreach ($career->benefits as $benefit)
                                <li class="flex gap-2 items-baseline"><i class="fi fi-ss-circle text-gray-500 text-[6px]"></i>{{ $benefit }}</li>
                                @endforeach
                            </ul>
                        </section>
                    </div>
                    <div class="grid grid-cols-3 gap-5 p-5">
                        <x-job_description_card
                            title="Compensation"
                            :value="'$ ' . $career->salary_range . ' (USD)'" />
                        <x-job_description_card
                            title="Employment Type"
                            :value="$career->career_type" />
                        <x-job_description_card
                            title="Location"
                            :value="$career->location" />
                    </div>
                </section>
            </div>
        </section>
        <section class="flex flex-col gap-5 mt-13">
            <ul class="p-5 flex flex-col gap-4 bg-white rounded border-2 border-gray-300 font-medium text-gray-600/90">
                <li class="text-xl text-black">Quick facts</li>
                <li class="py-2 flex justify-between border-b border-gray-200">
                    <span>Salary Range</span>
                    <span class="text-black">{{ $career->salary_range }}</span>
                </li>
                <li class="py-2 flex justify-between border-b border-gray-200">
                    <span>Job Type</span>
                    <span class="capitalize text-black">{{ $career->career_type }}</span>
                </li>
                <li class="py-2 flex justify-between border-b border-gray-200">
                    <span>Category</span>
                    <span class="text-black">{{ $career->category->category_name }}</span>
                </li>
                <li class="py-2 flex justify-between border-b border-gray-200">
                    <span>Location</span>
                    <span class="text-black">{{ $career->location }}</span>
                </li>
                <li class="py-2 flex justify-between">
                    <span>Company</span>
                    <span class="text-black">{{ $career->company->company_name }}</span>
                </li>
            </ul>
            <div class="w-full relative rounded border-2 border-gray-300">
                <img class="w-full h-[200px] object-cover border-b-2 border-gray-300" src="{{ Vite::asset('resources/images/company-bg.jpg') }}" alt="Company-bg">
                @php
                $company_logo = $career->company->company_logo;
                @endphp
                <img class="absolute top-1/2 -translate-y-1/2 left-10 w-[60px] h-[60px] bg-gray-300 border-2 border-gray-300 rounded" src="{{$company_logo? $company_logo : Vite::asset('resources/images/image.png') }}" />
                <div class="flex flex-col gap-4 bg-white p-6">
                    <h1 class="text-heading text-2xl mt-6">{{ $career->company->company_name }}</h1>
                    <span>{{ $career->company->description }}</span>
                    <a class="text-blue-800 font-medium" href="">View Company Profile <i class="fi fi-rr-share-square"></i></a>
                </div>
            </div>
            <div class="p-4 bg-white border-2 border-gray-300 rounded group">
                <x-similar_jobs :category="$career->category" />
            </div>
        </section>
    </main>
</x-master-layout>
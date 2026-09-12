<x-master-layout>
    <!-- Desktop View -->
    <section class="hidden md:block relative z-10 bg-blue-900 min-h-[400px] md:h-[700px] w-full">
        <main class="hidden md:grid grid-cols-2 gap-12 absolute -translate-y-1/2 top-1/2 left-1/2 w-[85%] h-[500px] -translate-x-1/2">
            <aside class="min-w-0 flex flex-col gap-10 justify-center">
                <h1 class="text-heading text-5xl text-white">Empowering Careers in Cambodia.</h1>
                <span class="text-lg text-gray-300 w-full md:w-[90%]">Access the Kingdom's most prestigious job opportunities and talent pool with Camcareer</span>
                <form class="bg-white p-4 rounded-md grid grid-cols-[3fr_1fr] gap-4" action="{{ route('seeker.filterJobs') }}" method="GET">
                    <div class="grid grid-cols-2 gap-2">
                        <div class="flex gap-1 items-center border-r border-gray-400">
                            <i class="fi fi-rr-briefcase text-xl"></i>
                            <input name="keyword" class="w-full text-lg border-0 outline-0 focus:ring-0 p-2" type="text" placeholder="Job title">
                        </div>
                        <div class="flex gap-1 items-center">
                            <i class="fi fi-rs-marker text-xl"></i>
                            <input name="location" class="w-full text-lg border-0 outline-0 focus:ring-0 p-2" type="text" placeholder="Location">
                        </div>
                    </div>
                    <button class="w-full bg-blue-800 text-white rounded-md text-lg flex gap-3 items-center justify-center cursor-pointer" type="submit">Search <i class="fi fi-rr-search text-sm"></i></button>
                </form>
            </aside>
            <img class="hidden md:block w-full h-full object-cover border-4 rounded-md border-blue-800" src="{{ Vite::asset('resources/images/hero-image.jpg') }}" alt="Hero Pic">
        </main>
    </section>
    <!-- Mobile View -->
    <section class="md:hidden p-5 flex flex-col gap-3">
        <h1 class="text-heading text-2xl">Find your dream job in Cambodia</h1>
        <span class="text-description text-[16px]">Connecting high-level talent with Cambodia's leading enterprises.</span>
        <form class="bg-white border border-gray-300 rounded p-5 flex flex-col gap-3" action="#" method="GET">
            <div class="relative h-[45px]">
                <input class="absolute top-0 left-0 py-2 ps-12 border border-gray-300 rounded text-description text-[16px] w-full" name="job_title" type="text" placeholder="Job title or Keyword">
                <i class="absolute left-4 top-1/2 -translate-y-2/5 fi fi-rr-briefcase text-[16px]"></i>
            </div>
            <div class="relative h-[45px]">
                <input class="absolute top-0 left-0 py-2 ps-12 border border-gray-300 rounded text-description text-[16px] w-full" name="location" type="text" placeholder="Location">
                <i class="absolute left-4 top-1/2 -translate-y-2/5 fi fi-rs-marker text-[16px]"></i>
            </div>
            <button class="bg-blue-800 text-white rounded-md text-lg flex gap-3 items-center justify-center cursor-pointer py-2" type="submit">Search Jobs <i class="fi fi-rr-search text-sm"></i></button>
        </form>
    </section>
    <section class="md:px-20 pt-15 flex flex-col gap-2 bg-[#F4F5F7]">
        <div class="px-5 flex justify-between">
            <h1 class="text-heading text-2xl md:text-4xl">Browse by Category</h1>
            <a href="{{ route('seeker.exploreByCategory') }}" class="flex md:hidden gap-3 items-center text-blue-800 font-medium">View All</a>
        </div>
        <div class="hidden md:flex justify-between items-center text-description">
            <span>Explore thousands of jobs across industry sectors</span>
            <a href="{{ route('seeker.exploreByCategory') }}" class="flex gap-3 items-center text-blue-800 font-medium">View All <i class="fi fi-rr-arrow-right mt-1"></i></a>
        </div>
        <div class="outer-container w-full overflow-x-scroll md:overflow-hidden">
            @php
            $width = $categories->count() * 160;
            @endphp
            <div style="width: {{ $width }}px;" class=" px-5 md:w-full flex md:grid grid-cols-4 gap-4 mt-4">
                @foreach ($categories as $category)
                <x-category href="/findjobs/filter?category={{ $category->category_id }}" :badge="$category->icon" :categoryName="$category->category_name" :jobs_count="$category->careers->count()" />
                @endforeach
            </div>
        </div>
    </section>
    <section class="px-5 pt-5 md:px-20 md:pt-20 flex flex-col gap-6 bg-[#F4F5F7]">
        <div class="flex flex-col gap-2 justify-center items-baseline md:items-center">
            <h1 class="text-heading text-2xl md:text-4xl">Featured Opportunities</h1>
            <span class="text-[16px] md:text-[18px] text-gray-600">Top-tier positions from leading organizations</span>
        </div>
        <ul class="flex flex-col gap-4">
            @foreach ($featuredJobs as $featuredJob)
            <x-featured_job_list :job="$featuredJob" :seeker="$seeker" />
            @endforeach
        </ul>
        <div class="flex justify-center">
            <a href="{{ route('seeker.filterJobs') }}" class="py-1 px-6 md:py-3 md:px-10 border-2 border-blue-800 text-blue-800 font-medium rounded hover:bg-blue-800 hover:text-white transition-colors cursor-pointer">Explore All {{ $allJobs->count() }} Jobs</a>
        </div>
    </section>
    <section class="py-5 md:px-20 md:py-20 flex flex-col gap-6 bg-[#F4F5F7]">
        <div class="px-5 flex flex-col gap-2 justify-center items-baseline md:items-center">
            <h1 class="text-heading text-2xl md:text-4xl">Top Company</h1>
            <span class="text-[18px] text-gray-600">Work with the best company in Cambodia </span>
        </div>
        <div class="ps-5 outer-container w-full overflow-x-scroll md:overflow-hidden">
            @php
            $fcWidth = $featuredCompanies->count() * 270;
            @endphp
            <div style="width: {{ $fcWidth }}px;" class="flex md:w-full md:grid grid-cols-5 gap-4">
                @foreach ($featuredCompanies as $featuredCompany)
                <x-featured_company_list :company="$featuredCompany" />
                @endforeach
            </div>
        </div>
    </section>
    <section class="p-5 md:p-0">
        <div class="bg-gray-800 px-5 py-10 rounded md:p-0 md:rounded-none md:bg-blue-900 md:h-[300px] w-full flex flex-col gap-4 justify-center items-center">
            <h1 class="text-heading text-white text-2xl md:text-4xl text-center md:text-start">Land your next role faster</h1>
            <span class="md:w-1/2 text-gray-300 text-[16px] md:text-lg text-center">Upload your CV to be seen by HR and increase your chance of getting hired.</span>
            <a class="flex gap-2 text-blue-900 md:text-blue-800 px-6 py-2 bg-blue-100 md:bg-white w-fit font-medium rounded hover:bg-blue-800 hover:text-white border-2 border-blue-800 hover:border-gray-200 transition-all" href="#"><i class="fi fi-rr-upload"></i>Upload Resume</a>
        </div>
    </section>
</x-master-layout>
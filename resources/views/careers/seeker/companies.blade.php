<x-master-layout>
    <main class="flex flex-col">
        <section class="w-full h-[500px] flex flex-col justify-center items-center gap-10 bg-[#1C398E]">
            <h1 class="w-[60%] text-heading font-semibold text-6xl text-white text-center leading-16">Discover Great Place to Work in Cambodia</h1>
            <span class="w-1/2 text-center text-gray-200 text-2xl">Explore leading employers, company culture, employee reviews, and open vacancies across Phnom Penh, Siem Reap, and beyond.</span>
            <form class="bg-white p-4 rounded-md grid grid-cols-[4fr_1fr] gap-4" action="{{ route('seeker.filterJobs') }}" method="GET">
                <div class="grid grid-cols-3 gap-2">
                    <div class="flex gap-1 items-center border-r border-gray-400">
                        <i class="fi fi-rs-building text-xl"></i>
                        <input name="company" class="w-full text-lg border-0 outline-0 focus:ring-0 p-2" type="text" placeholder="Company">
                    </div>
                    <div class="flex gap-1 items-center border-r border-gray-400">
                        <i class="fi fi-rs-marker text-xl"></i>
                        <input name="location" class="w-full text-lg border-0 outline-0 focus:ring-0 p-2" type="text" placeholder="Location">
                    </div>
                    <div class="flex gap-1 items-center">
                        <i class="fi fi-rs-category text-xl"></i>
                        <input name="industry" class="w-full text-lg border-0 outline-0 focus:ring-0 p-2" type="text" placeholder="Industry">
                    </div>
                </div>
                <button class="w-full bg-blue-800 text-white rounded-md text-lg flex gap-3 items-center justify-center cursor-pointer" type="submit">Search <i class="fi fi-rr-search text-sm"></i></button>
            </form>
        </section>
        <section class="md:px-20 pt-15 flex flex-col gap-5 bg-[#F4F5F7]">
            <h1 class="text-heading text-2xl md:text-4xl">Featured Top Employers in Cambodia</h1>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 justify-evenly w-full">
                @foreach ($topCompanies as $topCompany)
                    <x-company_card :company="$topCompany" />
                @endforeach
            </div>
        </section>
    </main>
</x-master-layout>
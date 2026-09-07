<x-master-layout>
    <main class="flex flex-col gap-6 md:gap-10 justify-center items-center p-5 md:p-20">
        <section class="flex flex-col items-center gap-2 md:gap-6">
            <h1 class="text-heading text-2xl md:text-5xl">Explore Jobs by Category</h1>
            <span class="text-description text-[14px] md:text-lg text-center">Discover thousands of opportunities tailored to your expertise.</span>
        </section>
        <section class="flex gap-4 items-center w-[95%] md:w-[60%] border border-gray-300 px-5 py-3 bg-white text-gray-800">
            <i class="fi fi-rr-search md:text-lg"></i>
            <input class="hidden md:block w-full focus:border-0 focus:ring-0 focus:outline-none md:text-lg" type="text" placeholder="Search categories, industries, or keywords...">
            <input class="md:hidden w-full focus:border-0 focus:ring-0 focus:outline-none md:text-lg" type="text" placeholder="Search categories, industries...">
        </section>
        <section class="grid grid-cols-2 md:grid-cols-4 justify-evenly gap-4 w-full">
            @foreach ($categories as $category)
            @php
            $jobCount = $category->careers->count();
            @endphp
            <div class="flex justify-center">
                <x-category class="w-[150px] text-[12px]" :badge="$category->icon" :categoryName="$category->category_name" :jobs_count="$jobCount" />
            </div>
            @endforeach
        </section>
    </main>
</x-master-layout>
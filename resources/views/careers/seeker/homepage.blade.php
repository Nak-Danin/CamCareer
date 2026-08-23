<x-master-layout>
    <section class="relative z-10 bg-blue-900 h-[700px] w-full">
        <main class="grid grid-cols-2 gap-12 absolute -translate-y-1/2 top-1/2 left-1/2 w-[80%] h-[500px] -translate-x-1/2">
            <aside class="min-w-0 flex flex-col gap-10 justify-center">
                <h1 class="text-heading text-5xl text-white">Empowering Careers in Cambodia.</h1>
                <span class="text-lg text-gray-300">Access the Kingdom's most prestigious job opportunities and talent pool with Camcareer</span>
                <form class="bg-white p-4 rounded-md grid grid-cols-[2fr_1fr] gap-4" action="#" method="POST">
                    <div class="flex gap-3 items-center border-r-2 border-gray-400">
                        <i class="fi fi-rr-briefcase text-xl"></i>
                        <input name="searchedJob" class="text-lg border-0 outline-0 focus:ring-0 p-2" type="text" placeholder="e.g. Software Engineer">
                    </div>
                    <button class="bg-blue-800 text-white rounded-md text-lg flex gap-3 items-center justify-center cursor-pointer" type="submit">Search <i class="fi fi-rr-search text-sm"></i></button>
                </form>
            </aside>
            <img class="w-full h-full object-cover border-4 rounded-md border-blue-800" src="{{ Vite::asset('resources/images/hero-image.jpg') }}" alt="Hero Pic">
        </main>
    </section>
    <section class="p-10 flex flex-col gap-4">
        <h1 class="text-heading">Browse by Category</h1>
        <div class="flex justify-between items-center text-description">
            <span class="">Explore thousands of jobs across industry sectors</span>
            <a class="flex gap-3 items-center text-blue-800 font-medium" href="">View All <i class="fi fi-rr-arrow-right mt-1"></i></a>
        </div>
        <div class="grid grid-cols-4 gap-4"></div>
    </section>

</x-master-layout>
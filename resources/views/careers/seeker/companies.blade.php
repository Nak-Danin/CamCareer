<x-master-layout>
    <main class="flex flex-col gap-5 px-4 md:px-0">
        <section class="w-full h-[500px] hidden md:flex flex-col justify-center items-center gap-10 bg-[#1C398E]">
            <h1 class="w-full md:w-[60%] text-heading font-semibold text-3xl md:text-6xl text-white text-center leading-8 md:leading-16">Discover Great Place to Work in Cambodia</h1>
            <span class="w-full md:w-1/2 text-center text-gray-200 text-2xl">Explore leading employers, company culture, employee reviews, and open vacancies across Phnom Penh, Siem Reap, and beyond.</span>
        </section>
        <section class="md:px-20 pt-5 md:pt-15 flex flex-col gap-5 bg-[#F4F5F7]">
            <h1 class="text-heading text-2xl md:text-4xl">Featured Top Employers in Cambodia</h1>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 justify-evenly w-full">
                @foreach ($topCompanies as $topCompany)
                <x-company_card :company="$topCompany" />
                @endforeach
            </div>
        </section>
        <section id="featured-companies" class="w-full mx-auto px-0 md:px-20 py-4 md:py-8 scroll-mt-24">
            <div class="grid grid-cols-1 md:grid-cols-[380px_1fr] gap-4 md:gap-8">
                {{-- ===================== FILTER SIDEBAR ===================== --}}
                <div class="flex flex-col gap-2">
                    <div class="md:hidden flex items-center justify-end">
                        <i id="toggleBtn" class="px-2 py-1 text-blue-800 bg-indigo-100 rounded-md fi fi-rr-filter-list"></i>
                    </div>
                    <aside id="filterTab" class="hidden md:block bg-white border border-gray-200 rounded-xl p-5 h-fit">
                        <div class="flex items-center justify-between mb-6">
                            <h2 class="text-xl font-semibold text-gray-900">Filters</h2>
                            <a href="{{ route('seeker.companies') }}#featured-companies"
                                class="text-sm text-blue-600 hover:text-blue-700 font-medium">
                                Clear all
                            </a>
                        </div>

                        <form
                            action="{{ route('seeker.companies') }}#featured-companies"
                            method="GET"
                            class="space-y-6"
                            onsubmit="
                            this.querySelectorAll('input, select').forEach(e =>{
                                if(!e.value){
                                    e.removeAttribute('name');
                                }
                            })
                        ">

                            {{-- Keyword --}}
                            <x-input-field label="Company" name="company" :value="$filters['company'] ?? ''" placeholder="Apple.inc" />

                            {{-- location --}}
                            <x-input-field label="Location" name="location" :value="$filters['location'] ?? ''" placeholder="Remote, Hybrid, City..." />

                            {{-- industry --}}
                            <x-input-field label="Industry" name="industry" :value="$filters['industry'] ?? ''" placeholder="Technology, Education, Banking..." />
                            <button type="submit"
                                class="w-full bg-blue-800 hover:bg-blue-900 text-white text-sm font-medium
                               py-2.5 rounded-lg transition-colors">
                                Apply Filters
                            </button>
                        </form>
                    </aside>
                </div>

                {{-- ===================== RESULTS ===================== --}}
                <div>
                    <div class="flex items-start justify-between mb-6">
                        <div>
                            @if(!empty($filters['company']))
                            <h1 class="text-2xl font-bold text-gray-900">{{ $filters['company'] ?? 'All Available Companies' }}</h1>
                            @else
                            <h1 class="text-2xl font-bold text-gray-900">All Available Companies</h1>
                            @endif
                            <p class="text-sm font-medium text-gray-500 mt-1">
                                Showing {{ $featuredCompanies->total() }} results
                            </p>
                        </div>
                    </div>

                    {{-- Job cards --}}
                    <div class="space-y-4">
                        @forelse ($featuredCompanies as $company)
                        <x-company_summary_list :company="$company" />
                        @empty
                        <div class="bg-white border border-gray-200 rounded-xl p-10 text-center text-gray-500">
                            No companys match your filters. Try adjusting them.
                        </div>
                        @endforelse
                    </div>

                    {{-- Pagination --}}
                    <div class="mt-8">
                        {{ $featuredCompanies->fragment('featured-companies')->links() }}
                    </div>
                </div>
            </div>
        </section>
    </main>
    <script>
        const toggleBtn = document.getElementById('toggleBtn');
        const filterTab = document.getElementById('filterTab');
        toggleBtn.addEventListener('click', () => {
            filterTab.classList.toggle('hidden');
        });
    </script>
</x-master-layout>
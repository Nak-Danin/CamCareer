<x-master-layout>
    <div class="w-full mx-auto px-5 md:px-10 py-8">
        <div class="grid grid-cols-1 md:grid-cols-[380px_1fr] gap-4 md:gap-8">
            {{-- ===================== FILTER SIDEBAR ===================== --}}
            <div class="flex flex-col gap-2">
                <div class="md:hidden flex justify-between">
                    <a href="{{ route('seeker.exploreByCategory') }}" class="flex gap-1 items-center font-medium text-blue-800"><i class="fi fi-br-angle-left text-xs"></i><span class="mb-1">Back</span></a>
                    <div class="flex items-center justify-end">
                        <i id="toggleBtn" class="px-2 py-1 text-blue-800 bg-indigo-100 rounded-md fi fi-rr-filter-list"></i>
                    </div>
                </div>
                <aside id="filterTab" class="hidden md:block bg-white border border-gray-200 rounded-xl p-5 h-fit">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-xl font-semibold text-gray-900">Filters</h2>
                        <a href="{{ route('seeker.filterJobs') }}"
                            class="text-sm text-blue-600 hover:text-blue-700 font-medium">
                            Clear all
                        </a>
                    </div>

                    <form
                        action="{{ route('seeker.filterJobs') }}"
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
                        <x-input-field label="Keywords" name="keyword" :value="$filters['keyword'] ?? ''" placeholder="Job title, skills..." />

                        {{-- location --}}
                        <x-input-field label="Location" name="location" :value="$filters['location'] ?? ''" placeholder="Remote, Hybrid, City..." />

                        {{-- Category --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Category</label>
                            <select name="category"
                                class="w-full py-2 px-3 text-sm border border-gray-300 rounded-lg bg-white
                                   focus:outline-none focus:ring-1 focus:ring-blue-300 focus:border-blue-300">
                                <option value="">All Categories</option>
                                @foreach ($categories as $cat)
                                <option value="{{ $cat->category_id }}"
                                    @selected(($filters['category'] ?? null)==$cat->category_id)>
                                    {{ $cat->category_name }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Employment Type (career_type column) --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Employment Type</label>
                            <div class="space-y-2">
                                @foreach (['full-time' => 'Full-time', 'part-time' => 'Part Time', 'internship' => 'Internship', 'contract' => 'Contract'] as $value => $label)
                                <label class="flex items-center gap-2 text-sm text-gray-700 cursor-pointer">
                                    <input
                                        type="checkbox"
                                        name="employment_type[]"
                                        value="{{ $value }}"
                                        @checked(in_array($value, $filters['employment_type'] ?? []))
                                        class="w-4 h-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                    {{ $label }}
                                </label>
                                @endforeach
                            </div>
                        </div>

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
                        @if(!empty($filters['keyword']))
                        <h1 class="text-2xl font-bold text-gray-900">{{ $filters['keyword'] ?? 'All Available Jobs' }}</h1>
                        @else
                        <h1 class="text-2xl font-bold text-gray-900">All Available Jobs</h1>
                        @endif
                        <p class="text-sm font-medium text-gray-500 mt-1">
                            Showing {{ $careers->total() }} results
                        </p>
                    </div>
                </div>

                {{-- Job cards --}}
                <div class="space-y-4">
                    @forelse ($careers as $career)
                    <x-featured_job_list :job="$career" :seeker="$seeker" />
                    @empty
                    <div class="bg-white border border-gray-200 rounded-xl p-10 text-center text-gray-500">
                        No careers match your filters. Try adjusting them.
                    </div>
                    @endforelse
                </div>

                {{-- Pagination --}}
                <div class="mt-8">
                    {{ $careers->links() }}
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            let isToggleBtn = true;
            const toggleBtn = document.getElementById("toggleBtn");
            const filterTab = document.getElementById("filterTab");
            toggleBtn.addEventListener('click', () => {
                filterTab.classList.toggle('hidden');
                if (isToggleBtn) {
                    isToggleBtn = false;
                    toggleBtn.classList.replace('fi-rr-filter-list', 'fi-rr-cross-small');
                } else {
                    isToggleBtn = true;
                    toggleBtn.classList.replace('fi-rr-cross-small', 'fi-rr-filter-list');
                }
            });
        })
    </script>
</x-master-layout>
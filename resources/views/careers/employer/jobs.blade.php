<x-employer-layout heading="Manage Job Listings">
    <div class="flex justify-between items-baseline mb-6">
        <span class="text-description">Track, edit, and manage all your available and past job postings.</span>

        {{-- Filter Buttons --}}
        <div class="flex gap-2 bg-[#f3f3fd] border border-gray-300 p-1 rounded-sm">
            <button type="button"
                onclick="filterJobs('all', this)"
                class="filter-tab px-4 py-1 text-base text-blue-800 border border-gray-300 bg-white font-medium rounded-sm cursor-pointer transition-colors">
                All ({{ $careers->count() }})
            </button>
            <button type="button"
                onclick="filterJobs('available', this)"
                class="filter-tab px-4 py-1 text-base text-gray-600 hover:text-blue-800 rounded-sm cursor-pointer transition-colors">
                Available ({{ $careers->where('status','available')->count() }})
            </button>
            <button type="button"
                onclick="filterJobs('unavailable', this)"
                class="filter-tab px-4 py-1 text-base text-gray-600 hover:text-blue-800 rounded-sm cursor-pointer transition-colors">
                Unavailable ({{ $careers->where('status','unavailable')->count() }})
            </button>
        </div>
    </div>

    {{-- Render ALL careers (no pagination needed) --}}
    <x-job_table :careers="$paginateAll" />
    {{-- Filter Script --}}
    <script>
        function filterJobs(status, selectedBtn) {
            // 1. Reset all button styles to default (inactive)
            const buttons = document.querySelectorAll('.filter-tab');
            buttons.forEach(btn => {
                btn.className = 'filter-tab px-4 py-1 text-base text-gray-600 hover:text-blue-800 rounded-sm cursor-pointer transition-colors';
            });

            // 2. Set selected button style to active
            selectedBtn.className = 'filter-tab px-4 py-1 text-base text-blue-800 border border-gray-300 bg-white font-medium rounded-sm cursor-pointer transition-color';

            // 3. Show/Hide rows based on data-status attribute
            const rows = document.querySelectorAll('.job-row');
            rows.forEach(row => {
                if (status === 'all' || row.dataset.status === status) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }
    </script>
</x-employer-layout>
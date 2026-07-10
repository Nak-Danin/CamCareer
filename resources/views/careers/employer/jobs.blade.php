<x-employer-layout heading="Manage Job Listings">
    <div class="flex justify-between items-baseline">
        <span class="text-description">Track, edit, and manage all your available and past job postings.</span>
        <div class="flex gap-2 bg-[#f3f3fd] border border-gray-300 p-1 rounded-sm">
            <span class="px-4 py-1 text-base text-blue-800 border border-gray-300 bg-white">All ({{ $careers->count() }})</span>
            <span class="px-4 py-1 text-base text-gray-600">Available ({{ $careers->where('status','available')->count() }})</span>
            <span class="px-4 py-1 text-base text-gray-600">Unavailable ({{ $careers->where('status','unavailable')->count() }})</span>
        </div>
    </div>
    <x-job_table :careers='$careers' />
</x-employer-layout>
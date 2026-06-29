<x-employer-layout heading="Manage Job Listings">
    <div class="flex justify-between items-baseline">
        <span class="text-description">Track, edit, and manage all your available and past job postings.</span>
        <div class="flex gap-2 bg-[#f3f3fd] border border-gray-300 p-1 rounded-sm">
            <span class="px-4 py-1 text-base text-blue-800 border border-gray-300 bg-white">All ({{ $careers->count() }})</span>
            <span class="px-4 py-1 text-base text-gray-600">Available ({{ $careers->where('status','available')->count() }})</span>
            <span class="px-4 py-1 text-base text-gray-600">Unavailable ({{ $careers->where('status','unavailable')->count() }})</span>
        </div>
    </div>
    <table class="border-collapse border-2 border-gray-300">
        <thead class="p-2">
            <tr class="bg-blue-800">
                <td class="p-3 uppercase text-white">Job Title</td>
                <td class="p-3 border-l border-gray-300 uppercase text-white">Date Posted</td>
                <td class="p-3 border-l border-gray-300 uppercase text-white">Status</td>
                <td class="p-3 border-l border-gray-300 uppercase text-white">Salary</td>
                <td class="p-3 border-l border-gray-300 uppercase text-white">Applications</td>
                <td class="p-3 border-l border-gray-300 uppercase text-white text-center">Actions</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($careers as $career)
            <tr class="border-t-2 border-gray-300 odd:bg-white even:bg-gray-100">
                <td class="p-3 flex flex-col">
                    <span class="font-medium">
                        {{ $career->title }}
                    </span>
                    <span class="text-sm flex gap-2">{{ $career->location }} ~ {{ $career->career_type }}</span>
                </td>
                <td class="p-3 text-gray-500">{{ $career->created_at->format('F j, Y') }}</td>
                <td class="p-3 rounded-md">
                    @if($career->status === 'available')
                    <span class="px-2 py-1 bg-blue-700/90 text-white rounded-md">{{ $career->status }}</span>
                    @else
                    <span class="px-2 py-1 bg-gray-500 bg-opacity-40 text-white rounded-md">{{ $career->status }}</span>
                    @endif
                </td>
                <td class="p-3">{{$career->salary_range}} {{ $career->salary_range ==='Negotiable' ? '':'USD' }}</td>
                <td class="p-3 font-medium">{{ $career->applications->count() }} <span>application(s)</span></td>
                <td>
                    <div class="flex items-center justify-evenly">
                        <a href="{{ route('employer.viewJob',['career' => $career->slug]) }}" class=" mt-3 text-green-600"><i class="fi fi-rs-eye"></i></a>
                        <a href="" class=" mt-3 text-yellow-600"><i class="fi fi-rr-edit"></i></a>
                        <a href="" class=" mt-3 text-red-600"><i class="fi fi-rr-trash"></i></a>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
        <div class="bg-slate-50 border-t border-gray-200 px-4 py-3 sm:px-6">
            {{ $careers->links() }}
        </div>
    </table>
</x-employer-layout>
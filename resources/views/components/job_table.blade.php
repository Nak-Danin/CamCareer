@props([
'careers'
])
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
                    <a href="{{ route('employer.viewJob',['career' => $career->slug]) }}" class=" mt-3 text-green-600 text-xl"><i class="fi fi-rs-eye"></i></a>
                    <a href="{{ route('careers.edit',['career' => $career->slug]) }}" class=" mt-3 text-yellow-600"><i class="fi fi-rr-edit"></i></a>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
    <div class="bg-slate-50 border-t border-gray-200 px-4 py-3 sm:px-6">
        {{ $careers->links() }}
    </div>
</table>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Monthly Recruitment Report</title>
    <!-- Tailwind CSS for styling -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;
        }
    </style>
</head>

<body class="p-8 text-gray-800 text-sm bg-white">

    <!-- Header Section -->
    <header class="mb-6">
        <h1 class="text-xl font-bold tracking-wider text-black">CAMCAREER</h1>
        <h2 class="text-base font-semibold text-gray-700 mt-1">MONTHLY RECRUITMENT REPORT</h2>
        <div class="mt-3 text-xs text-gray-600 space-y-0.5">
            <p><span class="font-semibold">Company:</span> {{ $company_name }}</p>
            <p><span class="font-semibold">Report Period:</span> {{ $report_period }}</p>
        </div>
    </header>

    <hr class="border-t border-dashed border-gray-400 my-4" />

    <!-- Application Overview -->
    <section class="mb-6">
        <h3 class="font-bold text-gray-900 tracking-wider mb-6">APPLICATION OVERVIEW</h3>

        <!-- Bar Chart -->
        <div class="w-2/3 my-4 pl-8">
            <p class="text-xs text-gray-500 mb-2">Number of Applications</p>

            @php
            $maxVal = max($weekly_applications) ?: 1;
            @endphp

            <div class="flex items-end h-40 border-l-2 border-b-2 border-gray-700 pl-4 pb-1 space-x-6">
                @foreach($weekly_applications as $week => $count)
                @php
                $percentage = round(($count / $maxVal) * 100);
                @endphp
                <div class="flex flex-col items-center justify-end flex-1 h-full">
                    <span class="text-xs font-semibold mb-1">{{ $count }}</span>
                    <div class="w-8 bg-gray-800 transition-all" style="height: {{ $percentage }}%;"></div>
                    <span class="text-xs text-gray-600 mt-2">{{ $week }}</span>
                </div>
                @endforeach
            </div>
        </div>

        <div class="mt-6 space-y-1 text-xs font-medium">
            <p>Total Applications: <span class="font-bold">{{ $total_applications }}</span></p>
            <p>Total Careers Posted: <span class="font-bold">{{ $total_careers_posted }}</span></p>
        </div>
    </section>

    <hr class="border-t border-dashed border-gray-400 my-4" />

    <!-- Career Summary Table -->
    <section class="mb-6">
        <h3 class="font-bold text-gray-900 tracking-wider mb-4">CAREER / CANDIDATE SUMMARY</h3>

        <table class="w-full text-left text-xs border-collapse">
            <thead>
                <tr class="border-b border-gray-700 text-gray-600">
                    <th class="py-2">Job Position</th>
                    <th class="py-2 text-center">Applied</th>
                    <th class="py-2 text-center">Selected</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach($career_summary as $summary)
                <tr>
                    <td class="py-2">{{ $summary['position'] }}</td>
                    <td class="py-2 text-center">{{ $summary['applied'] }}</td>
                    <td class="py-2 text-center">{{ $summary['selected'] }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </section>

    <hr class="border-t border-dashed border-gray-400 my-4" />

    <!-- Selected Candidates Table -->
    <section class="mb-6">
        <h3 class="font-bold text-gray-900 tracking-wider mb-4">SELECTED CANDIDATES</h3>

        <table class="w-full text-left text-xs border-collapse">
            <thead>
                <tr class="border-b border-gray-700 text-gray-600">
                    <th class="py-2">Position</th>
                    <th class="py-2">Candidate</th>
                    <th class="py-2">Email</th>
                    <th class="py-2">Phone</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach($selected_candidates as $candidate)
                <tr>
                    <td class="py-2">{{ $candidate['position'] }}</td>
                    <td class="py-2">{{ $candidate['name'] }}</td>
                    <td class="py-2">{{ $candidate['email'] }}</td>
                    <td class="py-2">{{ $candidate['phone'] }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </section>

    <hr class="border-t border-dashed border-gray-400 my-4" />

    <!-- Footer -->
    <footer class="mt-8 text-xs text-gray-500">
        Generated: {{ $generated_at }}
    </footer>

</body>

</html>
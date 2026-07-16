@php
$candidate_name = $application->seeker->first_name . ' ' . $application->seeker->last_name;
$jobTitle = $application->career->title;
@endphp
<x-employer-layout heading=''>
    <div class="bg-gray-50 flex items-center justify-center p-6">
        <div class="w-full max-w-៦xl bg-white rounded-xl shadow-md border border-gray-100 p-8">

            <!-- Form Header -->
            <div class="mb-8 border-b border-gray-100 pb-4">
                <h2 class="text-2xl font-bold text-gray-800">Create Interview Schedule</h2>
                <p class="text-sm text-gray-500 mt-1">Fill out the details below to schedule a new interview instance.</p>
            </div>

            <!-- Laravel Form Opening (Assumed standard POST structure) -->
            <form action="{{ route('employer.interviews.store', ['application' => $application]) }}" method="post" class="space-y-6">
                @csrf
                <!-- Row 1: Application ID & Status -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="job_title" class="block text-sm font-semibold text-gray-700 mb-2">Job Title</label>
                        <input
                            type="text"
                            id="job_title"
                            name="job_title"
                            disabled
                            @if ($jobTitle)
                            value="{{ $jobTitle }}"
                            @endif
                            class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-colors outline-none text-gray-800 placeholder-gray-400"
                            placeholder="Software Engineer">
                    </div>

                    <div>
                        <label for="candidate" class="block text-sm font-semibold text-gray-700 mb-2">Candidate</label>
                        <input
                            id="candidate"
                            name="candidate"
                            disabled
                            placeholder="John Doe"
                            @if ($candidate_name)
                            value="{{ $candidate_name }}"
                            @endif
                            class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-colors outline-none text-gray-800 bg-white">
                        </input>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="interview_date" class="block text-sm font-semibold text-gray-700 mb-2">Interview Date <span class="text-red-500">*</span></label>
                        <input
                            type="date"
                            id="interview_date"
                            name="interview_date"
                            required
                            class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-colors outline-none text-gray-800">
                    </div>

                    <div>
                        <label for="interview_time" class="block text-sm font-semibold text-gray-700 mb-2">Interview Time <span class="text-red-500">*</span></label>
                        <input
                            type="time"
                            id="interview_time"
                            name="interview_time"
                            required
                            class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-colors outline-none text-gray-800">
                    </div>
                </div>

                <hr class="border-gray-100 my-2" />

                <!-- Row 3: Physical Location (Nullable) -->
                <div>
                    <div class="flex justify-between items-center mb-2">
                        <label for="location" class="block text-sm font-semibold text-gray-700">Physical Location</label>
                        <span class="text-xs text-gray-400 font-normal">Optional</span>
                    </div>
                    <input
                        type="text"
                        id="location"
                        name="location"
                        class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-colors outline-none text-gray-800 placeholder-gray-400"
                        placeholder="e.g. Conference Room B, 4th Floor">
                </div>

                <!-- Row 4: Meeting Link (Nullable) -->
                <div>
                    <div class="flex justify-between items-center mb-2">
                        <label for="meeting_link" class="block text-sm font-semibold text-gray-700">Virtual Meeting Link</label>
                        <span class="text-xs text-gray-400 font-normal">Optional</span>
                    </div>
                    <input
                        type="url"
                        id="meeting_link"
                        name="meeting_link"
                        class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-colors outline-none text-gray-800 placeholder-gray-400"
                        placeholder="https://zoom.us/j/...">
                </div>

                <!-- Action Buttons -->
                <div class="flex items-center justify-end space-x-4 pt-4 border-t border-gray-100 mt-8">
                    <button
                        type="button"
                        class="px-5 py-2.5 rounded-lg border border-gray-300 text-sm font-medium text-gray-700 hover:bg-gray-50 transition-colors">
                        Cancel
                    </button>
                    <button
                        type="submit"
                        class="px-5 py-2.5 rounded-lg bg-blue-600 text-sm font-medium text-white hover:bg-blue-700 active:bg-blue-800 shadow-sm shadow-blue-500/10 transition-colors">
                        Save Schedule
                    </button>
                </div>

            </form>
        </div>
    </div>
</x-employer-layout>
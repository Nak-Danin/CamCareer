<x-employer-layout heading="Employer Settings">
    <div class="flex flex-col gap-5">
        <section class="flex justify-between">
            <span class="text-description">Configure your organization's global preferences and team settings.</span>
            <div class="flex gap-3 font-medium">
                <a href="{{ route('employer.settings.edit', ['company' => $company->company_id]) }}" class="bg-blue-800 text-white px-4 py-2 border-blue-800 cursor-pointer hover:bg-blue-800/90 rounded-md">Update Profile</a>
            </div>
        </section>
        <section class="flex flex-col gap-8">
            <main class="grid grid-cols-[5fr_2fr] gap-8">
                <aside class="p-5 flex flex-col gap-5 bg-white border-2 border-gray-100 rounded-md pb-10">
                    <h1 class="flex gap-3 items-center font-medium text-xl"><i class="fi fi-rr-user text-blue-800"></i>Account & Profile</h1>
                    <div class="grid grid-cols-[1fr_5fr] gap-8">
                        <aside class="flex flex-col gap-3 items-center">
                            <img class="w-full h-[110px] border-2 border-gray-200 object-cover rounded-lg" src="{{ $company->logo_url ? Storage::url($company->logo_url) : Vite::asset('resources/images/image.png') }}" alt="Company Logo">
                            <button class="text-blue-800 cursor-pointer font-medium">View Logo</button>
                        </aside>
                        <div class="flex flex-col gap-5">
                            <div class="grid grid-cols-2 gap-5">
                                <x-input-field disabled label="Company" name="companyName" :value="$company->company_name" />
                                <x-input-field disabled label="Industry" name="companyIndustry" :value="$company->industry" />
                            </div>
                            <div class="grid grid-cols-2 gap-5">
                                <x-input-field disabled label="Location" name="location" :value="$company->location" />
                                @php
                                $regdate = \Carbon\Carbon::parse($company->created_at)->format('j F Y');
                                @endphp
                                <x-input-field disabled label="Register Date" name="created_at" :value="$regdate" />
                            </div>
                        </div>
                    </div>
                </aside>
                <aside class="border-2 border-gray-100 bg-white rounded-md flex flex-col gap-5 p-5 pb-10">
                    <h1 class="text-xl font-medium flex items-center gap-2"><i class="fi fi-rr-broken-chain-link-wrong text-blue-800"></i>Contact Info</h1>
                    <x-input-field disabled label="Company Email" name="companyEmail" :value="$company->user->email" />
                    <x-input-field disabled label="Website" name="website" :value="$company->website" />
                </aside>
            </main>
        </section>
        <section class="flex flex-col gap-8">
            <main class="grid grid-cols-[3fr_2fr] gap-8">
                <aside class="border-2 border-gray-100 bg-white rounded-md flex flex-col gap-5 p-5 pb-10">
                    <h1 class="text-xl font-medium flex items-center gap-2"><i class="fi fi-rs-building text-blue-800"></i>Company & Branding</h1>
                    <h1 class="text-gray-700 font-medium">Company Description</h1>
                    <textarea disabled class="h-[100px] p-2 border-2 border-gray-200" name="" id="">{{ $company->description }}</textarea>
                </aside>
                <aside class="border-2 border-gray-100 bg-white rounded-md flex flex-col gap-5 p-5">
                    <h1 class="text-description font-medium flex items-center justify-between">Current Plan<span class="bg-blue-200/70 text-blue-800 rounded-md h-fit px-3 py-1 text-sm ">Enterprise</span></h1>
                    <span class="text-2xl font-semibold">$49.99 <span class="text-sm text-gray-700 font-medium">/ month</span></span>
                    <span class="text-gray-600">Next billing date: {{ \Carbon\Carbon::now()->addYear()->format('F j, Y') }}</span>
                    @php
                    $maxJob = 50;
                    $percentageActiveJobCount = $maxJob > 0 ? min(100,round(($activeJobCount / $maxJob) * 100)) : 0;
                    @endphp
                    <div class="flex flex-col gap-1">
                        <section class="flex justify-between">
                            <label for="">Active Job Posts</label>
                            <span>{{ $activeJobCount }} / {{ $maxJob }}</span>
                        </section>
                        <div class="relative w-full">
                            <span class="h-[10px] w-full rounded-md bg-gray-200 absolute top-0 z-1"></span>
                            <span class="h-[10px] rounded-md bg-blue-800 absolute top-0 z-10" style="width:{{ $percentageActiveJobCount }}%;"></span>
                        </div>
                    </div>
                    <a href="" class="text-center py-2 rounded-md font-medium text-md mt-3 bg-blue-800 hover:bg-blue-800/90 text-white">Manage Subscription</a>
                </aside>
            </main>
        </section>
    </div>
</x-employer-layout>
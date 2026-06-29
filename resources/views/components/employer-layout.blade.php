<?php

use Illuminate\Support\Facades\Auth;

$company = Auth::user()->company;
?>
<x-master-layout>
    <main class="flex h-full relative">
        <aside class="flex flex-col absolute h-[calc(100vh-60px)] top-0 left-0 gap-5 w-1/5 bg-[#f3f3fd] border-r border-gray-200 pt-5 px-3">
            <div class="flex gap-4">
                <img class="w-[45px] h-[45px]" src="{{ $company->logo_url ? Storage::url($company->logo_url) : Vite::asset('resources/images/image.png') }}" alt="Company Logo">
                <div class="flex flex-col">
                    <span class="text-heading text-lg">{{ $company->company_name }}</span>
                    <span class="text-description text-sm">{{ $company->industry ? $company->industry : 'Premium Recruiter' }}</span>
                </div>
            </div>
            <div class="flex flex-col gap-3">
                <x-sidebar-link class="flex gap-3 items-center" href="{{ route('employer.dashboard') }}" :active="request()->is('employer/dashboard')"><i class="fa-solid fa-cubes"></i>Dashboard</x-sidebar-link>
                <x-sidebar-link class="flex gap-3 items-center" href="{{ route('employer.jobs') }}" :active="request()->is('employer/jobs')"><i class="fi fi-ss-briefcase"></i>Jobs</x-sidebar-link>
                <x-sidebar-link class="flex gap-3 items-center" href="{{ route('employer.candidates') }}" :active="request()->is('employer/candidates')"><i class="fi fi-sr-users"></i>Candidates</x-sidebar-link>
                <x-sidebar-link class="flex gap-3 items-center" href="{{ route('employer.dashboard') }}" :active="request()->is('employer/can')"><i class="fi fi-rr-settings"></i>Settings</x-sidebar-link>
                <a class="flex gap-3 items-center btn-primary" href="{{ route('careers.create') }}" :active="request()->is('careers/create')"><i class="fi fi-br-plus"></i>Post New Job</a>
            </div>
        </aside>
        <aside class="flex flex-col absolute h-[calc(100vh-60px)] top-0 right-0 overflow-y-scroll gap-3 w-4/5 h-screeen pt-5 px-10 bg-[#faf8ff]">
            <h1 class="text-heading">{{ $heading }}</h1>
            {{ $slot }}
        </aside>
    </main>
</x-master-layout>
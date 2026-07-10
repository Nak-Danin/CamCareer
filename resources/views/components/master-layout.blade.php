<?php

use Illuminate\Support\Facades\Auth;

$company = Auth::user()->company;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    @can('create', App\Models\Career::class)
    <nav class="flex justify-between sticky items-center top-0 px-6 h-[60px] border-b-1 border-gray-200 bg-[#faf8ff]">
        <div class="flex gap-5">
            <img class="w-[80px] h-[40px]" src="{{ Vite::asset('resources/images/company_logo.png') }}" alt="Company Logo">
            <x-nav-link :active="request()->is('employer/dashboard')" href="{{ route('employer.dashboard') }}">Dashboard</x-nav-link>
            <x-nav-link :active="request()->is('employer/jobs')" href="{{ route('employer.jobs') }}">Jobs</x-nav-link>
            <x-nav-link :active="request()->is('employer/candidates')" href="{{ route('employer.candidates') }}">Candidates</x-nav-link>
            <x-nav-link :active="request()->is('employer/interviews')" href="{{ route('employer.interviews') }}">Interviews</x-nav-link>
        </div>
        <div class="flex gap-5 items-center">
            <i class="text-xl fa-regular fa-bell"></i>
            <i class="text-xl fa-regular fa-circle-question"></i>
            <i class="text-xl fa-solid fa-grip-lines-vertical"></i>
            <img class="w-[30px] h-[30px]" src="{{$company->logo_url ? Storage::url($company->logo_url) : Vite::asset('resources/images/image.png') }}" alt="Company Logo">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn-danger">Log Out</button>
            </form>
        </div>
    </nav>
    @endcan
    <main class="w-full h-full">
        {{ $slot }}
    </main>
</body>

</html>
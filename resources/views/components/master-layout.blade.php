<?php

use Illuminate\Support\Facades\Auth;

$seeker = Auth::user()->seeker;
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
    <main class="w-full h-screen">
        <nav class="flex justify-between sticky items-center top-0 px-6 h-[60px] border-b-2 border-gray-200 bg-[#faf8ff]">
            <img class="w-[80px] h-[40px]" src="{{ Vite::asset('resources/images/company_logo.png') }}" alt="Company Logo">
            <div class="flex gap-5 items-center">
                <i class="text-xl fa-regular fa-bell"></i>
                <i class="text-xl fa-regular fa-circle-question"></i>
                <i class="text-xl fa-solid fa-grip-lines-vertical"></i>
                <a href="{{ route('employer.settings') }}">
                    <img class="w-[30px] h-[30px] rounded-md" src="{{$company->logo_url ? Storage::url($company->logo_url) : Vite::asset('resources/images/image.png') }}" alt="Company Logo">
                </a>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="flex items-center gap-3 px-4 py-2.5 text-sm font-medium text-gray-500 rounded-lg hover:bg-red-50 hover:text-red-600 transition-all duration-200 cursor-pointer">
                        <span>Logout</span>
                        <i class="fi fi-rs-sign-out-alt"></i>
                    </button>
                </form>
            </div>
        </nav>
        <section class="w-full h-[calc(100vh-60px)]">
            {{ $slot }}
        </section>
    </main>
    @endcan
    @can('viewAny', App\Models\Career::class)
    <main class="w-full h-full relative">
        <nav class="flex justify-between sticky z-100 items-center top-0 px-6 h-[60px] border-b-2 border-gray-200 bg-[#faf8ff]">
            <img class="w-[80px] h-[40px]" src="{{ Vite::asset('resources/images/company_logo.png') }}" alt="Company Logo">
            <div class="hidden md:flex gap-5">
                <x-nav-link href="" :active="request()->is('/')">Home</x-nav-link>
                <x-nav-link href="" :active="request()->is('findjob')">Find Jobs</x-nav-link>
                <x-nav-link href="" :active="request()->is('companies')">Companies</x-nav-link>
            </div>
            <div class="flex gap-5 items-center">
                <i class="text-xl fa-regular fa-bell"></i>
                <i class="text-xl fa-regular fa-circle-question"></i>
                <i class="text-xl fa-solid fa-grip-lines-vertical"></i>
                <a href="">
                    <img class="w-[30px] h-[30px] rounded-md" src="{{$seeker->profile ? Storage::url($seeker->profile) : Vite::asset('resources/images/image.png') }}" alt="Seeker Profile">
                </a>
                <form class="hidden md:block" action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="flex items-center gap-3 px-4 py-2.5 text-sm font-medium text-gray-500 rounded-lg hover:bg-red-50 hover:text-red-600 transition-all duration-200 cursor-pointer">
                        <span>Logout</span>
                        <i class="fi fi-rs-sign-out-alt"></i>
                    </button>
                </form>
            </div>
        </nav>
        <section class="w-full h-full bg-[#F4F5F7]">
            {{ $slot }}
            <x-seeker_footer />
        </section>
        <footer class="md:hidden fixed bottom-0 left-0 z-100 h-[60px] w-full bg-white">
            <nav class="flex justify-evenly">
                <x-nav-link href="" :active="request()->is('/')">Home</x-nav-link>
                <x-nav-link href="" :active="request()->is('findjob')">Find Jobs</x-nav-link>
                <x-nav-link href="" :active="request()->is('companies')">Companies</x-nav-link>
            </nav>
        </footer>
    </main>
    @endcan
</body>

</html>
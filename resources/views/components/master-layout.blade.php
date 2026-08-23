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
    <main class="w-screen h-screen">
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
</body>

</html>
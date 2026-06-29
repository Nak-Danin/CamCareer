<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
    <style>
        .right-panel,
        .right-panel * {
            font-size: 1rem;
        }

        .right-panel h1 {
            font-size: 2rem;
        }
    </style>
</head>

<body>
    <div class="flex flex-row-reverse h-screen items-stretch">
        {{-- Left panel --}}
        <div class="hidden md:flex md:w-5/10 bg-[#1a3a8f] flex-col justify-between p-10 relative overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-br from-[#1a3a8f] to-[#0f2560] opacity-90"></div>

            <div class="relative z-10">
                <div class="flex items-center gap-2 mb-12">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 14.15v4.073a2.25 2.25 0 0 1-2.25 2.25h-12a2.25 2.25 0 0 1-2.25-2.25V14.15M16.5 6V4.5A2.25 2.25 0 0 0 14.25 2.25h-4.5A2.25 2.25 0 0 0 7.5 4.5V6m9 0H7.5m9 0h2.25A2.25 2.25 0 0 1 21 8.25v2.647M7.5 6H5.25A2.25 2.25 0 0 0 3 8.25v2.647m0 0a48.11 48.11 0 0 1 18 0" />
                    </svg>
                    <span class="text-white font-medium text-base">CamCareer</span>
                </div>

                <h2 class="text-white text-3xl font-medium leading-snug mb-4">
                    Join Cambodia's leading professional network.
                </h2>
                <p class="text-white/70 text-sm leading-relaxed">
                    Connect with top employers and unlock exclusive career opportunities in the Kingdom's fastest-growing sectors.
                </p>
            </div>

            <div class="relative z-10 flex gap-10">
                <div>
                    <p class="text-white text-xl font-medium">15k+</p>
                    <p class="text-white/60 text-xs tracking-widest mt-1 uppercase">Active Jobs</p>
                </div>
                <div>
                    <p class="text-white text-xl font-medium">2,500+</p>
                    <p class="text-white/60 text-xs tracking-widest mt-1 uppercase">Verified Companies</p>
                </div>
            </div>
        </div>

        {{-- Right panel --}}
        <div class="right-panel flex-1 flex items-center justify-center px-6 py-12 bg-white">
            <div class="w-full max-w-xl h-full bg-white">
                <h1 class="text-2xl font-medium text-gray-900 mb-1">Welcome Back</h1>
                <p class="text-sm text-gray-500 mb-6">We are happy to see you here agian. Please log into your account</p>

                {{-- OAuth buttons --}}
                <div class="flex gap-3 mb-4">

                    <a href=""
                        class="flex-1 flex items-center justify-center gap-2 py-2 px-3 text-sm border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors text-gray-700">
                        <svg class="w-4 h-4" viewBox="0 0 48 48">
                            <path fill="#EA4335" d="M24 9.5c3.54 0 6.71 1.22 9.21 3.6l6.85-6.85C35.9 2.38 30.47 0 24 0 14.62 0 6.51 5.38 2.56 13.22l7.98 6.19C12.43 13.72 17.74 9.5 24 9.5z" />
                            <path fill="#4285F4" d="M46.98 24.55c0-1.57-.15-3.09-.38-4.55H24v9.02h12.94c-.58 2.96-2.26 5.48-4.78 7.18l7.73 6c4.51-4.18 7.09-10.36 7.09-17.65z" />
                            <path fill="#FBBC05" d="M10.53 28.59c-.48-1.45-.76-2.99-.76-4.59s.27-3.14.76-4.59l-7.98-6.19C.92 16.46 0 20.12 0 24c0 3.88.92 7.54 2.56 10.78l7.97-6.19z" />
                            <path fill="#34A853" d="M24 48c6.48 0 11.93-2.13 15.89-5.81l-7.73-6c-2.15 1.45-4.92 2.3-8.16 2.3-6.26 0-11.57-4.22-13.47-9.91l-7.98 6.19C6.51 42.62 14.62 48 24 48z" />
                        </svg>
                        Google
                    </a>

                    <a href=""
                        class="flex-1 flex items-center justify-center gap-2 py-2 px-3 text-sm border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors text-gray-700">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="#0A66C2">
                            <path d="M20.45 20.45h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.354V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.284zM5.337 7.433a2.062 2.062 0 0 1-2.063-2.065 2.064 2.064 0 1 1 2.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z" />
                        </svg>
                        LinkedIn
                    </a>
                </div>

                <div class="flex items-center gap-3 mb-4">
                    <div class="flex-1 h-px bg-gray-200"></div>
                    <span class="text-xs text-gray-400 tracking-widest uppercase">Or with email</span>
                    <div class="flex-1 h-px bg-gray-200"></div>
                </div>

                {{-- Form --}}
                <form method="POST" class="flex flex-col gap-2" action="{{ route('auth.authenticate') }}">
                    @csrf
                    <input type="hidden" name="role" id="role" value="seeker">
                    {{-- Email --}}
                    <div class="mb-3 flex flex-col gap-2">
                        <label for="email" class="block text-xs text-gray-500 mb-1">Email Address</label>
                        <input type="email" id="email" name="email"
                            value="{{ old('email') }}"
                            placeholder="dara.sok@example.com"
                            class="w-full px-3 py-2 text-sm border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#1a3a8f]/30 focus:border-[#1a3a8f] transition @error('email') border-red-400 @enderror">
                        @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Password --}}
                    <div class="mb-3 flex flex-col gap-2">
                        <label for="password" class="block text-xs text-gray-500 mb-1">Password</label>
                        <div class="relative">
                            <input type="password" id="password" name="password"
                                placeholder="Enter your password"
                                class="w-full px-3 py-2 pr-9 text-sm border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#1a3a8f]/30 focus:border-[#1a3a8f] transition @error('password') border-red-400 @enderror">
                            <button type="button" onclick="togglePwd('password', 'eye1')"
                                class="absolute right-2.5 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600">
                                <svg id="eye1" xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                </svg>
                            </button>
                        </div>
                        <p class="text-xs text-gray-400 mt-1">Minimum 8 characters with a mix of letters and numbers</p>
                        @error('password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit"
                        class="w-full py-2.5 bg-[#1a3a8f] hover:bg-[#153180] text-white text-sm font-medium rounded-lg transition-colors">
                        Login
                    </button>
                </form>

                <p class="text-center text-sm text-gray-500 mt-4">
                    Doesn't have an account yet?
                    <a href="{{ route('register') }}" class="text-[#1a3a8f] font-medium hover:underline">Register</a>
                </p>
                <p class="text-center text-xs text-gray-400 mt-2">
                    By logging in, you agree to CamCareer
                    <a href="#" class="underline">Terms of Service</a> and
                    <a href="#" class="underline">Privacy Policy</a>.
                </p>

                <div class="flex justify-center gap-6 mt-4">
                    <span class="flex items-center gap-1.5 text-xs text-gray-400">
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                        </svg>
                        Secure SSL
                    </span>
                    <span class="flex items-center gap-1.5 text-xs text-gray-400">
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z" />
                        </svg>
                        GDPR Compliant
                    </span>
                </div>

            </div>
        </div>

    </div>

    <script>
        // Restore role from old input on validation failure
        const oldRole = "{{ old('role', 'seeker') }}";
        if (oldRole) setRole(oldRole);

        function setRole(role) {
            document.getElementById('role').value = role;
            const seekerBtn = document.getElementById('btn-seeker');
            const employerBtn = document.getElementById('btn-employer');
            const seekerFields = document.getElementById('seeker-fields');
            const employerFields = document.getElementById('employer-fields');

            if (role === 'seeker') {
                seekerBtn.classList.add('bg-[#1a3a8f]', 'text-white');
                seekerBtn.classList.remove('bg-transparent', 'text-gray-500');
                employerBtn.classList.add('bg-transparent', 'text-gray-500');
                employerBtn.classList.remove('bg-[#1a3a8f]', 'text-white');
                seekerFields.classList.remove('hidden');
                seekerFields.classList.add('flex');
                employerFields.classList.add('hidden');
            } else {
                employerBtn.classList.add('bg-[#1a3a8f]', 'text-white');
                employerBtn.classList.remove('bg-transparent', 'text-gray-500');
                seekerBtn.classList.add('bg-transparent', 'text-gray-500');
                seekerBtn.classList.remove('bg-[#1a3a8f]', 'text-white');
                seekerFields.classList.add('hidden');
                seekerFields.classList.remove('flex');
                employerFields.classList.remove('hidden');
            }
        }

        function togglePwd(inputId, iconId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);
            const isHidden = input.type === 'password';
            input.type = isHidden ? 'text' : 'password';
            // Swap between eye and eye-off paths
            icon.innerHTML = isHidden ?
                `<path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />` :
                `<path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />`;
        }
    </script>

</body>

</html>
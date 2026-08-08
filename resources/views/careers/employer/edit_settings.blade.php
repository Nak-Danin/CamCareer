<x-employer-layout heading="">
    <div class="w-full mx-auto p-6 mb-6 bg-white rounded-xl shadow-md border border-gray-100">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Update Company Profile</h2>

        {{-- Success Message --}}
        @if (session('success'))
        <div class="mb-4 p-4 text-sm text-green-700 bg-green-100 rounded-lg" role="alert">
            {{ session('success') }}
        </div>
        @endif

        <form action="{{ route('employer.settings.update', $company) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="space-y-5">
                <section class="flex justify-between gap-6">
                    {{-- 1. Company Name --}}
                    <x-input-field
                        label="Company Name"
                        name="company_name"
                        :value="old('company_name', $company->company_name)"
                        required />

                    {{-- 2. Industry --}}
                    <x-input-field
                        label="Industry"
                        name="industry"
                        :value="old('industry', $company->industry)" />
                </section>
                <section class="flex justify-between gap-6">
                    {{-- 3. Website --}}
                    <x-input-field
                        label="Website URL"
                        name="website"
                        type="text"
                        :value="old('website', $company->website)"
                        placeholder="https://example.com" />
                    {{-- 4. Location --}}
                    <x-input-field
                        label="Location"
                        name="location"
                        :value="old('location', $company->location)"
                        placeholder="e.g., New York, USA or Remote" />

                </section>

                <section class="grid grid-cols-2 gap-6">
                    {{-- 5. Logo File Upload --}}
                    <div>
                        <label for="logo_url" class="block text-sm font-medium text-gray-700 mb-1">Company Logo</label>
                        <section class="flex gap-3 items-center">
                            @if($company->logo_url)
                            <img src="{{ asset('storage/' . $company->logo_url) }}"
                                alt="Current Logo"
                                class="w-30 h-30 object-cover rounded-lg border border-gray-200">
                            @endif
                            <div class="flex flex-col gap-1">
                                <input type="file"
                                    name="logo_url"
                                    id="logo_url"
                                    accept="image/*"
                                    class="w-full text-sm text-gray-500 cursor-pointer file:cursor-pointer file:mr-4 file:py-1 file:px-2 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 border rounded-lg p-1.5 focus:outline-none @error('logo_url') border-red-500 @else border-gray-300 @enderror">
                                <p class="mt-1 text-xs text-gray-500">Accepted formats: PNG, JPG, JPEG, SVG, WEBP (Max: 2MB)</p>
                                @error('logo_url')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                        </section>
                    </div>
                    {{-- 6. Description --}}
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                        <textarea name="description"
                            id="description"
                            rows="4"
                            placeholder="Brief overview of the company..."
                            class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-100 focus:border-indigo-500 outline-none transition-colors @error('description') border-red-500 @else border-gray-300 @enderror">{{ old('description', $company->description) }}</textarea>
                        @error('description')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </section>


                {{-- Submit Button --}}
                <div class="flex justify-between">
                    <a href="{{ route('employer.settings') }}" class="w-fit px-10 cursor-pointer bg-red-600 text-white py-2 rounded-md hover:bg-red-700 transition font-medium">Go Back</a>
                    <button type="submit"
                        class="w-fit px-10 cursor-pointer bg-indigo-600 text-white py-2 rounded-md hover:bg-indigo-700 transition font-medium">
                        Update Profile
                    </button>
                </div>
            </div>
        </form>
    </div>
</x-employer-layout>
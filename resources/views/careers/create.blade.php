<x-employer-layout>
    <x-slot:heading>
        Create Career
    </x-slot:heading>

    <div class="w-full mx-auto bg-white p-6 rounded-lg shadow">
        <template id="minus-button-template">
            <x-minus_btn />
        </template>
        <form action="{{ route('careers.store') }}" method="POST" class="space-y-6">
            @csrf

            <x-input-field
                label="Job Title"
                name="title"
                maxlength="150"
                value="{{ old('title') }}"
                required />

            <div class="grid grid-cols-2 gap-10 items-center">
                <x-input-field
                    label="Salary Range"
                    name="salary_range"
                    value="{{ old('salary_range', 'Negotiable') }}" />
                <div class="flex flex-col gap-1">
                    <label class="text-sm font-medium text-slate-700" for="category_id">Category</label>
                    <select class="p-2 text-sm w-full rounded-md bg-gray-100/60 border border-slate-300 focus:border-indigo-500 focus:outline-none" name="category_id">
                        @foreach ($categories as $category)
                        <option value="{{ $category->category_id }}">
                            {{ Str::ucfirst($category->category_name) }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Description</label>
                <textarea name="description" id="description" rows="5"
                    class="p-3 mt-1 w-full rounded-md bg-gray-100/60 border border-slate-300 focus:border-indigo-500 focus:outline-none @error('description') border-red-500 @enderror"
                    required>{{ old('description') }}</textarea>
                @error('description')
                <span class="text-xs text-red-600 font-medium">{{ $message }}</span>
                @enderror
            </div>

            <div class="space-y-2">
                <label class="block text-sm font-medium text-gray-700">Responsibilities</label>

                <div id="responsibilities-container" class="space-y-2">
                    <div class="flex gap-2 items-end item-row">
                        <x-input-field name="responsibilities[]" required />
                        <x-minus_btn />
                    </div>
                </div>

                <button type="button" onclick="addField('responsibilities-container')"
                    class="mt-2 px-3 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition-colors text-sm font-medium cursor-pointer">
                    Add Responsibility
                </button>
            </div>

            <div class="space-y-2">
                <label class="block text-sm font-medium text-gray-700">Requirements</label>

                <div id="requirements-container" class="space-y-2">
                    <div class="flex gap-2 items-end item-row">
                        <x-input-field name="requirements[]" required />
                        <x-minus_btn />
                    </div>
                </div>

                <button type="button" onclick="addField('requirements-container')"
                    class="mt-2 px-3 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition-colors text-sm font-medium cursor-pointer">
                    Add Requirement
                </button>
            </div>

            <div class="space-y-2">
                <label class="block text-sm font-medium text-gray-700">Benefits</label>

                <div id="benefits-container" class="space-y-2">
                    <div class="flex gap-2 items-end item-row">
                        <x-input-field name="benefits[]" required />
                        <x-minus_btn />
                    </div>
                </div>

                <button type="button" onclick="addField('benefits-container')"
                    class="mt-2 px-3 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition-colors text-sm font-medium cursor-pointer">
                    Add Benefit
                </button>
            </div>

            <x-input-field
                label="Location"
                name="location"
                value="{{ old('location') }}"
                required />

            <div>
                <label class="block text-sm font-medium text-gray-700">Career Type</label>

                <input type="hidden" name="career_type" id="career_type" value="{{ old('career_type', '') }}" required>

                <div class="mt-1 relative w-full">
                    <button type="button" id="dropdown_button"
                        class="flex justify-between items-center p-2 w-full text-left rounded-md border border-gray-300 bg-white shadow-sm focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 text-sm text-gray-700">
                        <span id="dropdown_label">
                            @if(old('career_type') == 'full-time') Full Time
                            @elseif(old('career_type') == 'part-time') Part Time
                            @elseif(old('career_type') == 'internship') Internship
                            @elseif(old('career_type') == 'contract') Contract
                            @else Select Type
                            @endif
                        </span>
                        <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>

                    <div id="dropdown_menu" class="hidden mt-1 w-full rounded-md border border-gray-200 bg-white shadow-inner overflow-hidden">
                        <div class="p-1 space-y-1">
                            <button type="button" data-value="full-time" class="dropdown-item block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50 rounded-md">Full Time</button>
                            <button type="button" data-value="part-time" class="dropdown-item block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50 rounded-md">Part Time</button>
                            <button type="button" data-value="internship" class="dropdown-item block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50 rounded-md">Internship</button>
                            <button type="button" data-value="contract" class="dropdown-item block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50 rounded-md">Contract</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex justify-between">
                <a href="{{ url()->previous() }}" class="w-fit px-10 cursor-pointer bg-red-600 text-white py-2 rounded-md hover:bg-red-700 transition font-medium">Go Back</a>
                <button type="submit"
                    class="w-fit px-10 cursor-pointer bg-indigo-600 text-white py-2 rounded-md hover:bg-indigo-700 transition font-medium">
                    Create Career
                </button>
            </div>
        </form>
    </div>

    <script>
        function addField(containerId) {
            const container = document.getElementById(containerId);
            const fieldName = containerId.replace('-container', '') + '[]';
            const minusBtnHtml = document.getElementById('minus-button-template').innerHTML;
            const row = document.createElement('div');
            row.classList.add('flex', 'gap-2', 'items-end', 'item-row');

            // Generates a clean raw template replicating your x-input-field base design
            row.innerHTML = `
                <div class="flex flex-col gap-1.5 w-full">
                    <input type="text" name="${fieldName}"
                        class="w-full px-3 py-2 border border-slate-300 rounded-lg shadow-sm text-sm focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 transition-colors"
                        required>
                </div>
                ${minusBtnHtml}
            `;

            container.appendChild(row);
        }

        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-btn')) {
                const parent = e.target.closest('.item-row');
                const container = parent.parentElement;

                if (container.querySelectorAll('.item-row').length > 1) {
                    parent.remove();
                }
            }
        });
        document.addEventListener('DOMContentLoaded', function() {
            const button = document.getElementById('dropdown_button');
            const menu = document.getElementById('dropdown_menu');
            const hiddenInput = document.getElementById('career_type');
            const label = document.getElementById('dropdown_label');
            const items = document.querySelectorAll('.dropdown-item');

            // Toggle menu visibility
            button.addEventListener('click', () => {
                menu.classList.toggle('hidden');
            });

            // Handle item selection
            items.forEach(item => {
                item.addEventListener('click', () => {
                    const value = item.getAttribute('data-value');
                    const text = item.textContent;

                    hiddenInput.value = value; // Update the hidden input for form submission
                    label.textContent = text; // Update the button UI text
                    menu.classList.add('hidden'); // Close the menu
                });
            });

            // Close menu if clicked outside
            document.addEventListener('click', (e) => {
                if (!button.contains(e.target) && !menu.contains(e.target)) {
                    menu.classList.add('hidden');
                }
            });
        });
    </script>
</x-employer-layout>
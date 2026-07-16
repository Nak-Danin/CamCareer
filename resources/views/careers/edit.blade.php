<x-employer-layout>
    <x-slot:heading>
        Update Career
    </x-slot:heading>

    <div class="w-full mx-auto bg-white p-6 rounded-lg shadow mb-5">
        <template id="minus-btn-template">
            <x-minus_btn />
        </template>
        <form action="{{ route('careers.update',['career' => $career]) }}" method="POST" class="space-y-6">
            @csrf
            @method('PATCH')

            <x-input-field
                label="Job Title"
                name="title"
                maxlength="150"
                value="{{ old('title', $career->title) }}"
                required />

            <x-input-field
                label="Salary Range"
                name="salary_range"
                value="{{ old('salary_range', $career->salary_range ?? 'Negotiable') }}" />


            @if (!$career->applications->contains('status', 'offered'))
            <!-- Job Status Dropdown -->
            <div class="custom-dropdown">
                <label class="block text-sm font-medium text-gray-700">Job Status</label>

                <!-- Hidden input to store the status value for the form submission -->
                <input type="hidden" name="status" id="status_hidden" value="{{ old('status', $career->status ?? 'available') }}" required>

                <div class="mt-1 relative w-full">
                    <button type="button" id="status_button"
                        class="flex justify-between items-center p-2 w-full text-left rounded-md border border-gray-300 bg-white shadow-sm focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 text-sm text-gray-700">
                        <span id="status_label">
                            @php
                            $selectedStatus = old('status', $career->status ?? 'available');
                            @endphp
                            @if($selectedStatus == 'available')
                            Available
                            @elseif($selectedStatus == 'unavailable')
                            Unavailable
                            @else
                            Select Status
                            @endif
                        </span>
                        <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>

                    <div id="status_menu" class="hidden mt-1 w-full rounded-md border border-gray-200 bg-white shadow-inner overflow-hidden">
                        <div class="p-1 space-y-1">
                            <button type="button" data-value="available" class="dropdown-item-btn block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50 rounded-md">Available</button>
                            <button type="button" data-value="unavailable" class="dropdown-item-btn block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50 rounded-md">Unavailable</button>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <div>
                <label class="block text-sm font-medium text-gray-700">Description</label>
                <textarea name="description" id="description" rows="5"
                    class="p-3 mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('description') border-red-500 @enderror"
                    required>{{ old('description', $career->description) }}</textarea>
                @error('description')
                <span class="text-xs text-red-600 font-medium">{{ $message }}</span>
                @enderror
            </div>

            <!-- Responsibilities Section -->
            <div class="space-y-2">
                <label class="block text-sm font-medium text-gray-700">Responsibilities</label>

                <div id="responsibilities-container" class="space-y-2">
                    @forelse(old('responsibilities', $career->responsibilities ?? []) as $responsibility)
                    <div class="flex gap-2 items-end item-row">
                        <x-input-field name="responsibilities[]" value="{{ $responsibility }}" required />
                        <x-minus_btn />
                    </div>
                    @empty
                    <div class="flex gap-2 items-end item-row">
                        <x-input-field name="responsibilities[]" required />
                        <x-minus_btn />
                    </div>
                    @endforelse
                </div>

                <button type="button" onclick="addField('responsibilities-container')"
                    class="mt-2 px-3 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition-colors text-sm font-medium cursor-pointer">
                    Add Responsibility
                </button>
            </div>

            <!-- Requirements Section -->
            <div class="space-y-2">
                <label class="block text-sm font-medium text-gray-700">Requirements</label>

                <div id="requirements-container" class="space-y-2">
                    @forelse(old('requirements', $career->requirements ?? []) as $requirement)
                    <div class="flex gap-2 items-end item-row">
                        <x-input-field name="requirements[]" value="{{ $requirement }}" required />
                        <x-minus_btn />
                    </div>
                    @empty
                    <div class="flex gap-2 items-end item-row">
                        <x-input-field name="requirements[]" required />
                        <x-minus_btn />
                    </div>
                    @endforelse
                </div>

                <button type="button" onclick="addField('requirements-container')"
                    class="mt-2 px-3 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition-colors text-sm font-medium cursor-pointer">
                    Add Requirement
                </button>
            </div>

            <!-- Benefits Section -->
            <div class="space-y-2">
                <label class="block text-sm font-medium text-gray-700">Benefits</label>

                <div id="benefits-container" class="space-y-2">
                    @forelse(old('benefits', $career->benefits ?? []) as $benefit)
                    <div class="flex gap-2 items-end item-row">
                        <x-input-field name="benefits[]" value="{{ $benefit }}" required />
                        <x-minus_btn />
                    </div>
                    @empty
                    <div class="flex gap-2 items-end item-row">
                        <x-input-field name="benefits[]" required />
                        <x-minus_btn />
                    </div>
                    @endforelse
                </div>

                <button type="button" onclick="addField('benefits-container')"
                    class="mt-2 px-3 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition-colors text-sm font-medium cursor-pointer">
                    Add Benefit
                </button>
            </div>

            <x-input-field
                label="Location"
                name="location"
                value="{{ old('location', $career->location) }}"
                required />

            <!-- Career Type Dropdown -->
            <div class="custom-dropdown">
                <label class="block text-sm font-medium text-gray-700">Career Type</label>

                <input type="hidden" name="career_type" id="career_type" value="{{ old('career_type', $career->career_type) }}" required>

                <div class="mt-1 relative w-full">
                    <button type="button" id="dropdown_button"
                        class="flex justify-between items-center p-2 w-full text-left rounded-md border border-gray-300 bg-white shadow-sm focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 text-sm text-gray-700">
                        <span id="dropdown_label">
                            @php
                            $selectedType = old('career_type', $career->career_type);
                            @endphp
                            @if($selectedType == 'full-time') Full Time
                            @elseif($selectedType == 'part-time') Part Time
                            @elseif($selectedType == 'internship') Internship
                            @elseif($selectedType == 'contract') Contract
                            @else Select Type
                            @endif
                        </span>
                        <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>

                    <div id="dropdown_menu" class="hidden mt-1 w-full rounded-md border border-gray-200 bg-white shadow-inner overflow-hidden">
                        <div class="p-1 space-y-1">
                            <button type="button" data-value="full-time" class="dropdown-item-btn block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50 rounded-md">Full Time</button>
                            <button type="button" data-value="part-time" class="dropdown-item-btn block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50 rounded-md">Part Time</button>
                            <button type="button" data-value="internship" class="dropdown-item-btn block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50 rounded-md">Internship</button>
                            <button type="button" data-value="contract" class="dropdown-item-btn block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50 rounded-md">Contract</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex justify-between">
                <a href="{{ route('employer.viewJob', ['career' => $career->slug]) }}" class="w-fit px-10 bg-red-600 text-white py-2 rounded-md hover:bg-red-700 transition font-medium">Cancel</a>
                <button type="submit"
                    class="w-fit px-10 bg-indigo-600 text-white py-2 rounded-md hover:bg-indigo-700 transition font-medium cursor-pointer">
                    Update Career
                </button>
            </div>
        </form>
    </div>

    <script>
        function addField(containerId) {
            const container = document.getElementById(containerId);
            const fieldName = containerId.replace('-container', '') + '[]';
            const minusBtnHtml = document.getElementById('minus-btn-template').innerHTML;
            const row = document.createElement('div');

            row.classList.add('flex', 'gap-2', 'items-end', 'item-row');

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
            // Select all dropdown modules on the page
            const dropdowns = document.querySelectorAll('.custom-dropdown');

            dropdowns.forEach(dropdown => {
                // Find local parts belonging ONLY to this specific dropdown
                const button = dropdown.querySelector('button[type="button"]');
                const menu = dropdown.querySelector('div[id$="_menu"]'); // Find menu div ending with _menu
                const hiddenInput = dropdown.querySelector('input[type="hidden"]');
                const label = button.querySelector('span');
                const items = dropdown.querySelectorAll('.dropdown-item-btn');

                // Toggle local menu on button click
                button.addEventListener('click', (e) => {
                    e.stopPropagation(); // Stop click from propagating to the document listener

                    // Close other open custom dropdowns first
                    document.querySelectorAll('.custom-dropdown div[id$="_menu"]').forEach(otherMenu => {
                        if (otherMenu !== menu) otherMenu.classList.add('hidden');
                    });

                    menu.classList.toggle('hidden');
                });

                // Handle item selection locally
                items.forEach(item => {
                    item.addEventListener('click', (e) => {
                        e.stopPropagation();
                        const value = item.getAttribute('data-value');
                        const text = item.textContent;

                        hiddenInput.value = value; // Update input
                        label.textContent = text; // Update displayed option text
                        menu.classList.add('hidden'); // Close menu
                    });
                });
            });

            // Close any open dropdown menu when clicking completely outside of them
            document.addEventListener('click', () => {
                document.querySelectorAll('.custom-dropdown div[id$="_menu"]').forEach(menu => {
                    menu.classList.add('hidden');
                });
            });
        });
    </script>
</x-employer-layout>
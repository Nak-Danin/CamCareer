@props([
'icon', 'badgeText' => null, 'title', 'value'
])
<div class="p-6 bg-white border border-gray-100 rounded-xl shadow-sm flex flex-col gap-3 justify-between">
    <!-- Top Row: Icon and Badge -->
    <div class="flex items-center justify-between gap-12">
        <!-- Dynamic Icon Container -->
        <div class="p-3 bg-blue-50 rounded-lg text-blue-700 flex items-center justify-center text-xl">
            <!-- This renders your <i class="fi fi-rr-briefcase"></i> dynamically -->
            <i class="{{ $icon }}"></i>
        </div>
        <!-- Optional Green Badge -->
        @if($badgeText)
        <span class="px-2.5 py-1 text-xs font-semibold text-emerald-700 bg-emerald-50 rounded-md">
            {{ $badgeText }}
        </span>
        @endif
    </div>

    <!-- Bottom Content: Label and Count -->
    <div>
        <span class="text-xs font-semibold uppercase tracking-wider text-gray-400">
            {{ $title }}
        </span>
        <h2 class="text-3xl font-bold text-gray-900 mt-1">
            {{ $value }}
        </h2>
    </div>
</div>
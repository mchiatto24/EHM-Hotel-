@php
    use App\Models\Inventory;
    use Illuminate\Support\Carbon;

    // When was Reports last viewed? Default to "epoch" if not set
    $lastSeen = session('reports_last_seen', Carbon::createFromTimestamp(0));

    // Count items that crossed thresholds after $lastSeen
    $newAlerts = Inventory::where(function($q) {
            $q->whereColumn('quantity', '<=', 'reorder_level')
              ->orWhereColumn('quantity', '<=', 'low_stock_threshold');
        })
        ->where('updated_at', '>', $lastSeen)
        ->count();
@endphp

<aside class="hidden sm:flex flex-col w-64 bg-indigo-900 text-white">
    {{-- Logo + Title --}}
    <div class="flex items-start px-6 py-8">
        <img src="{{ asset('images/logo.png') }}" alt="EHM Logo" class="h-16 w-16 mr-4 mt-1" />
        <div>
            <h1 class="text-2xl font-bold">EHM</h1>
            <p class="text-sm opacity-75">Hotel Inventory System</p>
        </div>
    </div>

    {{-- Navigation Links --}}
    <nav class="flex-1 px-4 space-y-2 overflow-auto">
        {{-- Dashboard --}}
        <a href="{{ route('dashboard') }}"
           class="flex items-center px-4 py-2 rounded-lg transition
                  {{ request()->routeIs('dashboard') ? 'bg-indigo-800' : 'hover:bg-indigo-800' }}">
            <i class="fa fa-dashboard w-5"></i>
            <span class="ml-3">Dashboard</span>
        </a>

        {{-- Room Management --}}
        <a href="{{ route('rooms.index') }}"
           class="flex items-center px-4 py-2 rounded-lg transition
                  {{ request()->routeIs('rooms.*') ? 'bg-indigo-800' : 'hover:bg-indigo-800' }}">
            <i class="fa fa-bed w-5"></i>
            <span class="ml-3">Room Management</span>
        </a>

        {{-- Guest Information --}}
        <a href="{{ route('guests.index') }}"
           class="flex items-center px-4 py-2 rounded-lg transition
                  {{ request()->routeIs('guests.*') ? 'bg-indigo-800' : 'hover:bg-indigo-800' }}">
            <i class="fa fa-users w-5"></i>
            <span class="ml-3">Guest Information</span>
        </a>

        {{-- Bookings --}}
        <a href="{{ route('bookings.index') }}"
           class="flex items-center px-4 py-2 rounded-lg transition
                  {{ request()->routeIs('bookings.*') ? 'bg-indigo-800' : 'hover:bg-indigo-800' }}">
            <i class="fa fa-calendar-check w-5"></i>
            <span class="ml-3">Bookings</span>
        </a>

        {{-- Inventory Management --}}
        <a href="{{ route('inventory.index') }}"
           class="flex items-center px-4 py-2 rounded-lg transition
                  {{ request()->routeIs('inventory.*') ? 'bg-indigo-800' : 'hover:bg-indigo-800' }}">
            <i class="fa fa-box-open w-5"></i>
            <span class="ml-3">Inventory Management</span>
        </a>

        {{-- Inventory Logs --}}
        <a href="{{ route('inventory-logs.index') }}"
           class="flex items-center px-4 py-2 rounded-lg transition
                  {{ request()->routeIs('inventory-logs.*') ? 'bg-indigo-800' : 'hover:bg-indigo-800' }}">
            <i class="fa fa-box-open w-5"></i>
            <span class="ml-3">Inventory Logs</span>
        </a>

        {{-- Assigned Items --}}
        <a href="{{ route('assigned-items.index') }}"
           class="flex items-center px-4 py-2 rounded-lg transition
                  {{ request()->routeIs('assigned-items.*') ? 'bg-indigo-800' : 'hover:bg-indigo-800' }}">
            <i class="fa fa-clipboard-list w-5"></i>
            <span class="ml-3">Assigned Items</span>
        </a>

        {{-- Suppliers (Only Admins) --}}
        @if(Auth::user()->role == 'admin')
            <a href="{{ route('suppliers.index') }}"
               class="flex items-center px-4 py-2 rounded-lg transition
                      {{ request()->routeIs('suppliers.*') ? 'bg-indigo-800' : 'hover:bg-indigo-800' }}">
                <i class="fa fa-truck w-5"></i>
                <span class="ml-3">Suppliers</span>
            </a>
        @else
            <span class="flex items-center px-4 py-2 rounded-lg opacity-50 cursor-not-allowed">
                <i class="fa fa-truck w-5"></i>
                <span class="ml-3">Suppliers</span>
            </span>
        @endif

        {{-- Room Audits --}}
        <a href="{{ route('room_audits.index') }}"
           class="flex items-center px-4 py-2 rounded-lg transition
                  {{ request()->routeIs('room_audits.*') ? 'bg-indigo-800' : 'hover:bg-indigo-800' }}">
            <i class="fa fa-clipboard-check w-5"></i>
            <span class="ml-3">Room Audits</span>
        </a>

        {{-- Reports --}}
        <a href="{{ route('reports.index') }}"
           class="relative flex items-center px-4 py-2 rounded-lg transition
                  {{ request()->routeIs('reports.*') ? 'bg-indigo-800' : 'hover:bg-indigo-800' }}">
            <i class="fa fa-chart-line w-5"></i>
            <span class="ml-3 flex items-center">Reports

                {{-- Red dot badge --}}
                @if($newAlerts > 0)
                    <span class="ml-1 inline-block h-2 w-2 rounded-full bg-red-500"></span>
                @endif
            </span>
        </a>
    </nav>

    {{-- User Dropdown --}}
    <div class="px-4 py-6 border-t border-indigo-800">
        <x-dropdown align="bottom-left" width="48" drop-up="true">
            <x-slot name="trigger">
                <button class="flex items-center w-full text-left px-4 py-2 rounded-lg hover:bg-indigo-800 transition">
                    <span class="inline-block bg-blue-500 rounded-full h-8 w-8 text-center leading-8 text-white">
                        {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                    </span>
                    <span class="ml-3">{{ Auth::user()->name }}</span>
                    <i class="fa fa-chevron-down ml-auto"></i>
                </button>
            </x-slot>

            <x-slot name="content">
                <x-dropdown-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-dropdown-link>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-dropdown-link :href="route('logout')"
                                     onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-dropdown-link>
                </form>
            </x-slot>
        </x-dropdown>
    </div>
</aside>

{{-- Mobile Header (optional toggle) --}}
<div class="sm:hidden w-full bg-white dark:bg-gray-800 px-4 py-3 flex justify-between items-center">
    <button><!-- mobile menu toggle --></button>
    <img src="{{ asset('images/logo.png') }}" alt="EHM" class="h-8" />
    <button><!-- user avatar --></button>
</div>
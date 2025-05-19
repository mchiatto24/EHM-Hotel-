<x-app-layout>
    @slot('header')
        Dashboard
    @endslot

    <h1 class="text-2xl font-semibold text-white mb-6">Hotel Inventory Dashboard</h1>

    {{-- Stats Cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6 mb-8">
        <!-- Inventory Items -->
        <div class="bg-gray-800 text-white rounded-lg shadow p-4 flex items-center space-x-4">
            <div class="text-blue-400 text-3xl">
                <span class="material-icons">inventory</span>
            </div>
            <div>
                <div class="text-sm text-gray-400">Inventory Items</div>
                <div class="text-2xl font-semibold">{{ $inventoryCount }}</div>
            </div>
        </div>

        <!-- Low Stock -->
        <div class="bg-gray-800 text-white rounded-lg shadow p-4 flex items-center space-x-4">
            <div class="text-yellow-400 text-3xl">
                <span class="material-icons">warning</span>
            </div>
            <div>
                <div class="text-sm text-gray-400">Low Stock</div>
                <div class="text-2xl font-semibold">{{ $lowStockCount }}</div>
            </div>
        </div>

        <!-- Suppliers -->
        <div class="bg-gray-800 text-white rounded-lg shadow p-4 flex items-center space-x-4">
            <div class="text-green-400 text-3xl">
                <span class="material-icons">local_shipping</span>
            </div>
            <div>
                <div class="text-sm text-gray-400">Suppliers</div>
                <div class="text-2xl font-semibold">{{ $suppliersCount }}</div>
            </div>
        </div>

        <!-- Rooms Audited -->
        <div class="bg-gray-800 text-white rounded-lg shadow p-4 flex items-center space-x-4">
            <div class="text-purple-400 text-3xl">
                <span class="material-icons">check_box</span>
            </div>
            <div>
                <div class="text-sm text-gray-400">Rooms Audited</div>
                <div class="text-2xl font-semibold">{{ $roomsAuditedCount }}</div>
            </div>
        </div>
    </div>

    {{-- Accommodation Metrics --}}
    <div class="bg-gray-800 rounded-lg p-6 mb-8">
        <div class="grid grid-cols-4 gap-6 text-white">
            <!-- Occupancy Rate -->
            <div class="text-center p-4">
                <div class="text-2xl font-bold text-green-400">
                    {{ $occupancyRate }}%
                </div>
                <div class="text-sm text-gray-400">Occupancy Rate</div>
            </div>

            <!-- Available Rooms -->
            <div class="text-center p-4">
                <div class="text-2xl font-bold">
                    {{ $availableRooms }}
                </div>
                <div class="text-sm text-gray-400">Available Rooms</div>
            </div>

            <!-- Check-ins Today -->
            <div class="text-center p-4">
                <div class="text-2xl font-bold">
                    {{ $checkinsToday }}
                </div>
                <div class="text-sm text-gray-400">Check-ins Today</div>
            </div>

            <!-- Check-outs Today -->
            <div class="text-center p-4">
                <div class="text-2xl font-bold">
                    {{ $checkoutsToday }}
                </div>
                <div class="text-sm text-gray-400">Check-outs Today</div>
            </div>
        </div>
    </div>

    {{-- Room Management Section --}}
    <div class="bg-gray-800 rounded-lg p-6">
        {{-- Header Row --}}
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-semibold text-white">Room Management</h2>
            
            {{-- Search Bar aligned to the right --}}
            <form method="GET" action="{{ route('dashboard') }}" class="flex items-center space-x-4">
                <div class="w-64">
                    <input 
                        type="text" 
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Search rooms by No. or Type..." 
                        class="w-full px-4 py-2 rounded-lg bg-gray-700 text-white border border-gray-600 focus:border-blue-500 focus:ring-2 focus:ring-blue-500"
                    >
                </div>
            </form>
        </div>

        {{-- Rooms Table --}}
        <div class="overflow-x-auto">
            <table class="w-full text-white">
                <thead class="bg-gray-700">
                    <tr>
                        <th class="px-4 py-3 text-left">Room No.</th>
                        <th class="px-4 py-3 text-left">Type</th>
                        <th class="px-4 py-3 text-left">Status</th>
                        <th class="px-4 py-3 text-left">Rate</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($rooms as $room)
                        <tr class="hover:bg-gray-700 even:bg-gray-800 odd:bg-gray-900">
                            <td class="px-4 py-3">{{ $room->room_number }}</td>
                            <td class="px-4 py-3">{{ $room->room_type }}</td>
                            <td class="px-4 py-3">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium 
                                    {{ $room->room_status === 'available' ? 'bg-green-500 text-white' : 
                                       ($room->room_status === 'occupied' ? 'bg-red-500 text-white' : 'bg-yellow-500 text-gray-900') }}">
                                    {{ ucfirst($room->room_status) }}
                                </span>
                            </td>
                            <td class="px-4 py-3">₱{{ number_format($room->room_rate, 2) }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-4 py-3 text-center text-gray-400">No rooms found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="mt-6">
            {{ $rooms->links() }}
        </div>
    </div>
</x-app-layout>
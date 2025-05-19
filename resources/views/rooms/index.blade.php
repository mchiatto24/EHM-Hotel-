<x-app-layout>
    <x-slot name="header">
        Room Management
    </x-slot>

    <div class="mb-6 flex justify-between items-center">
        <h2 class="text-xl font-semibold text-white">Manage Rooms</h2>
        <a href="{{ route('rooms.create') }}" 
               class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg flex items-center">
                <span class="material-icons mr-2">add</span> Add New Room
            </a>
    </div>

    {{-- Search Bar --}}
    <form method="GET" action="{{ route('rooms.index') }}" class="mb-4">
        <input type="text" name="search" value="{{ request('search') }}"
               placeholder="Search rooms..."
               class="w-full px-4 py-2 rounded bg-gray-800 text-white border border-gray-600 focus:outline-none focus:border-blue-500" />
    </form>

    {{-- Table --}}
    <div class="overflow-x-auto bg-gray-800 rounded-lg shadow">
        <table class="min-w-full table-auto text-white">
            <thead class="bg-gray-700">
                <tr>
                    <th class="px-4 py-2 text-left">Room No.</th>
                    <th class="px-4 py-2 text-left">Type</th>
                    <th class="px-4 py-2 text-left">Status</th>
                    <th class="px-4 py-2 text-left">Rate</th>
                    <th class="px-4 py-2 text-left">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($rooms as $room)
                    <tr class="border-t border-gray-700 hover:bg-gray-700">
                        <td class="px-4 py-2">{{ $room->room_number }}</td>
                        <td class="px-4 py-2">{{ ucfirst($room->room_type) }}</td>
                        <td class="px-4 py-2">
                            <span class="px-2 py-1 rounded text-sm 
                                {{ $room->room_status === 'available' ? 'bg-green-600' : 
                                   ($room->room_status === 'occupied' ? 'bg-red-600' : 'bg-yellow-500') }}">
                                {{ ucfirst($room->room_status) }}
                            </span>
                        </td>
                        <td class="px-4 py-2">₱{{ number_format($room->room_rate, 2) }}</td>
                        <td class="px-4 py-2 space-x-2">
                        <a href="{{ route('rooms.edit', $room) }}"
                            class="text-blue-400 hover:text-blue-600">
                                <span class="material-icons">edit</span>
                            </a>
                            <form action="{{ route('rooms.destroy', $room) }}" method="POST" class="inline-block"
                                onsubmit="return confirm('Are you sure you want to delete this room?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-400 hover:text-red-600">
                                    <span class="material-icons">delete</span>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-4 text-gray-400">No rooms found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="mt-4">
        {{ $rooms->links() }}
    </div>
</x-app-layout>
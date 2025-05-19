<x-app-layout>
    <x-slot name="header">
        Inventory Management
    </x-slot>

    <div class="mb-6 flex justify-between items-center">
        <h2 class="text-xl font-semibold text-white">Manage Inventory Items</h2>
        <a href="{{ route('inventory.create') }}"  
           class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg flex items-center">
            <span class="material-icons mr-2">add</span> Add Item
        </a>
    </div>

    {{-- Search Bar --}}
    <form method="GET" action="{{ route('inventory.index') }}" class="mb-4">
        <input type="text" name="search" value="{{ request('search') }}"
               placeholder="Search inventory..."
               class="w-full px-4 py-2 rounded bg-gray-800 text-white border border-gray-600 focus:outline-none focus:border-blue-500"
               aria-label="Search inventory" />
    </form>

    {{-- Table --}}
    <div class="overflow-x-auto bg-gray-800 rounded-lg shadow">
        <table class="min-w-full table-auto text-white">
            <thead class="bg-gray-700">
                <tr>
                    <th class="px-4 py-2 text-left">Item Name</th>
                    <th class="px-4 py-2 text-left">Quantity</th>
                    <th class="px-4 py-2 text-left">Reorder Level</th>
                    <th class="px-4 py-2 text-left">Supplier</th>
                    <th class="px-4 py-2 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($inventoryItems as $item)
                    <tr class="border-t border-gray-700 hover:bg-gray-700">
                        <td class="px-4 py-2">{{ $item->name }}</td>
                        <td class="px-4 py-2">{{ $item->quantity }}</td>
                        <td class="px-4 py-2">{{ $item->reorder_level }}</td>
                        <td class="px-4 py-2">{{ $item->supplier->name ?? 'N/A' }}</td>
                        <td class="px-4 py-2">
                            <div class="flex items-center space-x-2">
                                <a href="{{ route('inventory.edit', $item) }}" class="text-blue-400 hover:text-blue-600">
                                    <span class="material-icons align-middle text-base">edit</span>
                                </a>
                                <form action="{{ route('inventory.destroy', $item) }}" method="POST"
                                      class="inline-block"
                                      onsubmit="return confirm('Are you sure you want to delete this item?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-400 hover:text-red-600">
                                        <span class="material-icons align-middle text-base">delete</span>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-4 text-gray-400">No inventory items found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="mt-4">
        {{ $inventoryItems->links() }}
    </div>
</x-app-layout>

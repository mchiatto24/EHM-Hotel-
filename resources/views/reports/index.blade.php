<x-app-layout>
    <x-slot name="header">Reports</x-slot>

    @if(session('success'))
        <div class="mb-4 bg-green-600 text-white px-4 py-2 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="mb-6 flex justify-between items-center">
        <h2 class="text-xl font-semibold text-white">Low Stock & Reorder Alerts</h2>
        @if(auth()->user()->role === 'admin')
            <form action="{{ route('reports.flush') }}" method="POST">
                @csrf
                <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg">
                    Clear Alerts
                </button>
            </form>
        @else
            <button type="button" class="bg-yellow-500 text-white px-4 py-2 rounded-lg opacity-50 cursor-not-allowed" disabled>
                Clear Alerts
            </button>
        @endif
    </div>

    <div class="overflow-x-auto bg-gray-800 rounded-lg shadow">
        <table class="min-w-full table-auto text-white">
            <thead class="bg-gray-700">
                <tr>
                    <th class="px-4 py-2 text-left">Item Name</th>
                    <th class="px-4 py-2 text-left">Alerts</th>
                    <th class="px-4 py-2 text-left">Current Qty</th>
                    <th class="px-4 py-2 text-left">Last Updated</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($lowStockItems as $item)
                    <tr class="border-t border-gray-700 hover:bg-gray-700">
                        <td class="px-4 py-2">{{ $item->name }}</td>
                        <td class="px-4 py-2 space-y-1">
                            @if($item->quantity <= $item->reorder_level)
                                <div>Needs reorder (≤ {{ $item->reorder_level }})</div>
                            @endif
                            @if($item->quantity <= $item->low_stock_threshold)
                                <div>Low stock (≤ {{ $item->low_stock_threshold }})</div>
                            @endif
                        </td>
                        <td class="px-4 py-2">{{ $item->quantity }}</td>
                        <td class="px-4 py-2">{{ $item->updated_at->format('Y-m-d H:i') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center py-4 text-gray-400">
                            No low-stock or reorder alerts at this time.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $lowStockItems->links() }}
    </div>
</x-app-layout>

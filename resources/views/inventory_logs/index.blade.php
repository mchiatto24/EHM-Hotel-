<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">Inventory Logs</h2>
    </x-slot>

    <div class="mb-6 flex justify-between items-center">
        <h2 class="text-xl font-semibold text-white">Manage Inventory Logs</h2>
    </div>

    <form method="GET" action="{{ route('inventory-logs.index') }}" class="mb-6">
        <div class="grid grid-cols-3 gap-4">
            <div>
                <label for="item_id" class="block text-white mb-2">Item</label>
                <select name="item_id" id="item_id" class="w-full px-4 py-2 rounded bg-gray-800 text-white border border-gray-600 focus:outline-none focus:border-blue-500">
                    <option value="">All Items</option>
                    @foreach ($items as $item)
                        <option value="{{ $item->id }}" {{ request('item_id') == $item->id ? 'selected' : '' }}>
                            {{ $item->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="action" class="block text-white mb-2">Action</label>
                <select name="action" id="action" class="w-full px-4 py-2 rounded bg-gray-800 text-white border border-gray-600 focus:outline-none focus:border-blue-500">
                    <option value="">All Actions</option>
                    <option value="add" {{ request('action') == 'add' ? 'selected' : '' }}>Add</option>
                    <option value="remove" {{ request('action') == 'remove' ? 'selected' : '' }}>Remove</option>
                    <option value="adjust" {{ request('action') == 'adjust' ? 'selected' : '' }}>Adjust</option>
                </select>
            </div>

            <div>
                <label for="from" class="block text-white mb-2">From Date</label>
                <input type="date" name="from" value="{{ request('from') }}" class="w-full px-4 py-2 rounded bg-gray-800 text-white border border-gray-600 focus:outline-none focus:border-blue-500">
            </div>

            <div>
                <label for="to" class="block text-white mb-2">To Date</label>
                <input type="date" name="to" value="{{ request('to') }}" class="w-full px-4 py-2 rounded bg-gray-800 text-white border border-gray-600 focus:outline-none focus:border-blue-500">
            </div>

            <div class="col-span-3 mt-4">
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg w-full">
                    Filter Logs
                </button>
            </div>
        </div>
    </form>

    <div class="overflow-x-auto bg-gray-800 rounded-lg shadow">
        <table class="min-w-full table-auto text-white">
            <thead class="bg-gray-700">
                <tr>
                    <th class="px-4 py-2 text-left">Item</th>
                    <th class="px-4 py-2 text-left">Action</th>
                    <th class="px-4 py-2 text-left">Quantity</th>
                    <th class="px-4 py-2 text-left">Staff</th>
                    <th class="px-4 py-2 text-left">Date</th>
                    <th class="px-4 py-2 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($logs as $log)
                    <tr class="border-t border-gray-700 hover:bg-gray-700">
                        <td class="px-4 py-2">{{ $log->item->name }}</td>
                        <td class="px-4 py-2 capitalize">{{ $log->action }}</td>
                        <td class="px-4 py-2">{{ $log->change_qty }}</td>
                        <td class="px-4 py-2">{{ $log->staff->name ?? 'N/A' }}</td>
                        <td class="px-4 py-2">{{ \Carbon\Carbon::parse($log->log_date)->format('Y-m-d H:i:s') }}</td>
                        <td class="px-4 py-2">
                            @if(auth()->user()->role === 'admin')
                                <form action="{{ route('inventory-logs.destroy', $log->log_id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this log?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg flex items-center justify-center space-x-2">
                                        <span class="material-icons">delete</span>
                                        <span>Delete</span>
                                    </button>
                                </form>
                            @else
                                <button type="button" class="bg-red-500 text-white px-4 py-2 rounded-lg opacity-50 cursor-not-allowed flex items-center justify-center space-x-2" disabled>
                                    <span class="material-icons">delete</span>
                                    <span>Delete</span>
                                </button>
                            @endif
                        </td>
                    </tr>
                @endforeach
                @if ($logs->isEmpty())
                    <tr>
                        <td colspan="6" class="text-center py-4 text-gray-400">No inventory logs found.</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $logs->links() }}
    </div>
</x-app-layout>

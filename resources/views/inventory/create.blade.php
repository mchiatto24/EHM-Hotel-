<x-app-layout>
    <x-slot name="header">
        Add New Inventory Item
    </x-slot>

    <div class="max-w-3xl mx-auto bg-gray-800 text-white p-6 rounded-lg shadow">
        <form action="{{ route('inventory.store') }}" method="POST">
            @csrf

            {{-- Item Name --}}
            <div class="mb-4">
                <label class="block mb-1">Item Name</label>
                <input type="text" name="name" class="w-full bg-gray-700 rounded px-4 py-2 border border-gray-600" required>
            </div>

            {{-- Category --}}
            <div class="mb-4">
                <label class="block mb-1">Category</label>
                <input type="text" name="category" class="w-full bg-gray-700 rounded px-4 py-2 border border-gray-600" required>
            </div>

            {{-- Quantity --}}
            <div class="mb-4">
                <label class="block mb-1">Quantity</label>
                <input type="number" name="quantity" class="w-full bg-gray-700 rounded px-4 py-2 border border-gray-600" min="0" required>
            </div>

            {{-- Reorder Level --}}
            <div class="mb-4">
                <label class="block mb-1">Reorder Level</label>
                <input type="number" name="reorder_level" class="w-full bg-gray-700 rounded px-4 py-2 border border-gray-600" min="0" required>
            </div>

            {{-- Reorder Quantity --}}
            <div class="mb-4">
                <label class="block mb-1">Reorder Quantity</label>
                <input type="number" name="reorder_quantity" class="w-full bg-gray-700 rounded px-4 py-2 border border-gray-600" min="0" required>
            </div>

            {{-- Low Stock Threshold --}}
            <div class="mb-4">
                <label class="block mb-1">Low Stock Threshold</label>
                <input type="number" name="low_stock_threshold" class="w-full bg-gray-700 rounded px-4 py-2 border border-gray-600" min="0" required>
            </div>

            {{-- Supplier --}}
            <div class="mb-6">
                <label class="block mb-1">Supplier</label>
                <select name="supplier_id" class="w-full bg-gray-700 rounded px-4 py-2 border border-gray-600" required>
                    <option value="">Select a supplier</option>
                    @foreach ($suppliers as $id => $name)
                        <option value="{{ $id }}">{{ $name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="flex justify-end space-x-4">
                    <a href="{{ route('inventory.index') }}" 
                        class="px-4 py-2 rounded bg-gray-600 text-white hover:bg-gray-700 transition">
                        Cancel
                    </a>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">Save Item</button>
            </div>
        </form>
    </div>
</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        Edit Inventory Item
    </x-slot>

    <div class="max-w-3xl mx-auto bg-gray-800 text-white p-6 rounded-lg shadow">
        <h2 class="text-xl font-semibold mb-6">✏️ Edit Inventory Item</h2>

        <form action="{{ route('inventory.update', $inventory) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- Item Name --}}
            <div class="mb-4">
                <label class="block mb-1" for="name">Item Name</label>
                <input 
                    id="name"
                    type="text" 
                    name="name" 
                    value="{{ old('name', $inventory->name) }}" 
                    class="w-full bg-gray-700 rounded px-4 py-2 border border-gray-600"
                    required
                >
            </div>

            {{-- Category --}}
            <div class="mb-4">
                <label class="block mb-1" for="category">Category</label>
                <input 
                    id="category"
                    type="text" 
                    name="category" 
                    value="{{ old('category', $inventory->category) }}" 
                    class="w-full bg-gray-700 rounded px-4 py-2 border border-gray-600"
                    required
                >
            </div>

            {{-- Quantity --}}
            <div class="mb-4">
                <label class="block mb-1" for="quantity">Quantity</label>
                <input 
                    id="quantity"
                    type="number" 
                    name="quantity" 
                    value="{{ old('quantity', $inventory->quantity) }}" 
                    class="w-full bg-gray-700 rounded px-4 py-2 border border-gray-600"
                    min="0"
                    required
                >
            </div>

            {{-- Reorder Level --}}
            <div class="mb-4">
                <label class="block mb-1" for="reorder_level">Reorder Level</label>
                <input 
                    id="reorder_level"
                    type="number" 
                    name="reorder_level" 
                    value="{{ old('reorder_level', $inventory->reorder_level) }}" 
                    class="w-full bg-gray-700 rounded px-4 py-2 border border-gray-600"
                    min="0"
                    required
                >
            </div>

            {{-- Reorder Quantity --}}
            <div class="mb-4">
                <label class="block mb-1" for="reorder_quantity">Reorder Quantity</label>
                <input 
                    id="reorder_quantity"
                    type="number" 
                    name="reorder_quantity" 
                    value="{{ old('reorder_quantity', $inventory->reorder_quantity) }}" 
                    class="w-full bg-gray-700 rounded px-4 py-2 border border-gray-600"
                    min="0"
                    required
                >
            </div>

            {{-- Low Stock Threshold --}}
            <div class="mb-4">
                <label class="block mb-1" for="low_stock_threshold">Low Stock Threshold</label>
                <input 
                    id="low_stock_threshold"
                    type="number" 
                    name="low_stock_threshold" 
                    value="{{ old('low_stock_threshold', $inventory->low_stock_threshold) }}" 
                    class="w-full bg-gray-700 rounded px-4 py-2 border border-gray-600"
                    min="0"
                    required
                >
            </div>

            {{-- Supplier --}}
            <div class="mb-6">
                <label class="block mb-1" for="supplier_id">Supplier</label>
                <select 
                    id="supplier_id"
                    name="supplier_id" 
                    class="w-full bg-gray-700 rounded px-4 py-2 border border-gray-600"
                    required
                >
                    @foreach ($suppliers as $id => $name)
                        <option 
                            value="{{ $id }}" 
                            {{ old('supplier_id', $inventory->supplier_id) == $id ? 'selected' : '' }}
                        >
                            {{ $name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Actions --}}
            <div class="flex justify-end space-x-4">
                <a 
                    href="{{ route('inventory.index') }}" 
                    class="px-4 py-2 rounded bg-gray-600 text-white hover:bg-gray-700 transition"
                >
                    Cancel
                </a>
                <button 
                    type="submit" 
                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded"
                >
                    Update Item
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
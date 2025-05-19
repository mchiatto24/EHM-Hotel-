<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Edit Inventory Log
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 p-6 shadow-sm sm:rounded-lg">
                <form method="POST" action="{{ route('inventory-logs.update', $inventoryLog) }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="item_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Item</label>
                        <select name="item_id" id="item_id" class="mt-1 block w-full">
                            @foreach ($items as $id => $name)
                                <option value="{{ $id }}" @selected($id == $inventoryLog->item_id)>{{ $name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="action" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Action</label>
                        <select name="action" id="action" class="mt-1 block w-full">
                            <option value="add" @selected($inventoryLog->action == 'add')>Add</option>
                            <option value="remove" @selected($inventoryLog->action == 'remove')>Remove</option>
                            <option value="adjust" @selected($inventoryLog->action == 'adjust')>Adjust</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="change_qty" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Quantity</label>
                        <input type="number" name="change_qty" id="change_qty" value="{{ $inventoryLog->change_qty }}" class="mt-1 block w-full" required>
                    </div>

                    <x-primary-button class="mt-4">Update Log</x-primary-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
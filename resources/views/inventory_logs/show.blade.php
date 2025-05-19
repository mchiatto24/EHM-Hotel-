<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Inventory Log Details
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 p-6 shadow-sm sm:rounded-lg">
                <p><strong>Item:</strong> {{ $inventoryLog->item->name }}</p>
                <p><strong>Action:</strong> {{ ucfirst($inventoryLog->action) }}</p>
                <p><strong>Quantity:</strong> {{ $inventoryLog->change_qty }}</p>
                <p><strong>Staff:</strong> {{ $inventoryLog->staff->name ?? 'N/A' }}</p>
                <p><strong>Date:</strong> {{ $inventoryLog->log_date }}</p>
            </div>
        </div>
    </div>
</x-app-layout>
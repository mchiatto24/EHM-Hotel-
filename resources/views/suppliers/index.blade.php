<x-app-layout>
    <x-slot name="header">
        Supplier Management
    </x-slot>

    @if(session('success'))
        <div class="bg-green-600 text-white p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="flex justify-between mb-4 items-center">
        <h2 class="text-xl text-white font-semibold">List of Suppliers</h2>
        <a href="{{ route('suppliers.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 flex items-center">
            <span class="material-icons mr-2">add</span> Add Supplier
        </a>
    </div>

    <div class="bg-gray-800 p-4 rounded shadow">
        <table class="w-full text-white table-auto">
            <thead>
                <tr class="bg-gray-700 text-left">
                    <th class="p-2">Name</th>
                    <th class="p-2">Contact Info</th>
                    <th class="p-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($suppliers as $supplier)
                    <tr class="border-t border-gray-600 hover:bg-gray-700">
                        <td class="p-2">{{ $supplier->name }}</td>
                        <td class="p-2">{{ $supplier->contact_info }}</td>
                        <td class="p-2">
                            <div class="flex items-center space-x-2">
                                <a href="{{ route('suppliers.edit', $supplier) }}" class="text-blue-400 hover:text-blue-600">
                                    <span class="material-icons align-middle text-base">edit</span>
                                </a>
                                <form action="{{ route('suppliers.destroy', $supplier) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure?')">
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
                        <td colspan="3" class="text-center text-gray-400 p-4">No suppliers found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $suppliers->links() }}
    </div>
</x-app-layout>

<x-app-layout>
    <x-slot name="header">Edit Supplier</x-slot>

    <form action="{{ route('suppliers.update', $supplier) }}" method="POST" class="bg-gray-800 p-6 rounded shadow text-white max-w-xl mx-auto">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="name" class="block mb-1">Supplier Name</label>
            <input type="text" name="name" id="name" value="{{ old('name', $supplier->name) }}" class="w-full p-2 bg-gray-700 rounded">
            @error('name') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label for="contact_info" class="block mb-1">Contact Info</label>
            <input type="text" name="contact_info" id="contact_info" value="{{ old('contact_info', $supplier->contact_info) }}" class="w-full p-2 bg-gray-700 rounded">
            @error('contact_info') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div class="flex justify-between items-center">
            <a href="{{ route('suppliers.index') }}"
                class="bg-gray-700 text-gray-200 hover:bg-gray-600 hover:text-white px-4 py-2 rounded">Cancel
            </a>
            <button type="submit" class="bg-blue-600 px-4 py-2 rounded hover:bg-blue-700">Update</button>
        </div>
    </form>
</x-app-layout>

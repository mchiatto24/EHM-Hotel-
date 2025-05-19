<x-app-layout>
    <x-slot name="header">
        Delete Room {{ $room->room_number }}
    </x-slot>

    <div class="max-w-lg mx-auto bg-gray-800 rounded-lg p-6">
        <h2 class="text-lg font-semibold text-white mb-4">
            Are you sure you want to delete room <span class="text-blue-400">{{ $room->room_number }}</span>?
        </h2>

        <p class="text-gray-400 mb-6">
            This action cannot be undone. All data associated with this room will be permanently removed.
        </p>

        <form action="{{ route('rooms.destroy', $room) }}" method="POST">
            @csrf
            @method('DELETE')

            <div class="flex justify-end space-x-4">
                <a href="{{ route('rooms.index') }}"
                   class="px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white rounded-lg">
                    Cancel
                </a>
                <button type="submit"
                        class="px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded-lg">
                    Yes, Delete
                </button>
            </div>
        </form>
    </div>
</x-app-layout>

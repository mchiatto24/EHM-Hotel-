<x-app-layout>
    <x-slot name="header">Add New Room</x-slot>

    <div class="max-w-lg mx-auto bg-gray-800 rounded-lg p-6">
        <form action="{{ route('rooms.store') }}" method="POST">
            @csrf

            {{-- Room Number --}}
            <div class="mb-4">
                <label for="room_number" class="block text-gray-200 mb-1">Room Number</label>
                <input type="text"
                       name="room_number"
                       id="room_number"
                       value="{{ old('room_number') }}"
                       class="w-full px-3 py-2 rounded-lg bg-gray-700 text-white focus:outline-none @error('room_number') border-red-500 @enderror">
                @error('room_number')
                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Room Type --}}
            <div class="mb-4">
                <label for="room_type" class="block text-gray-200 mb-1">Room Type</label>
                <input type="text"
                       name="room_type"
                       id="room_type"
                       value="{{ old('room_type') }}"
                       class="w-full px-3 py-2 rounded-lg bg-gray-700 text-white focus:outline-none @error('room_type') border-red-500 @enderror">
                @error('room_type')
                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Room Rate --}}
            <div class="mb-4">
                <label for="room_rate" class="block text-gray-200 mb-1">Room Rate</label>
                <input type="number" step="0.01"
                       name="room_rate"
                       id="room_rate"
                       value="{{ old('room_rate') }}"
                       class="w-full px-3 py-2 rounded-lg bg-gray-700 text-white focus:outline-none @error('room_rate') border-red-500 @enderror">
                @error('room_rate')
                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Room Status --}}
            <div class="mb-6">
                <label for="room_status" class="block text-gray-200 mb-1">Status</label>
                <select name="room_status"
                        id="room_status"
                        class="w-full px-3 py-2 rounded-lg bg-gray-700 text-white focus:outline-none">
                    @foreach(['available','occupied','maintenance'] as $status)
                        <option value="{{ $status }}"
                            {{ old('room_status') === $status ? 'selected' : '' }}>
                            {{ ucfirst($status) }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Buttons --}}
            <div class="flex justify-end space-x-4">
                <a href="{{ route('rooms.index') }}"
                   class="px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white rounded-lg">
                    Cancel
                </a>
                <button type="submit"
                        class="px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-lg">
                    Create Room
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
<x-app-layout>
    <x-slot name="header">Edit Audit</x-slot>

    <div class="max-w-lg mx-auto bg-gray-800 rounded-lg p-6">
        <form action="{{ route('room_audits.update', $roomAudit) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="room_id" class="block text-gray-200 mb-1">Room</label>
                <select name="room_id" id="room_id" class="w-full px-3 py-2 rounded bg-gray-700 text-white">
                    @foreach ($rooms as $room)
                        <option value="{{ $room->id }}" {{ $roomAudit->room_id == $room->id ? 'selected' : '' }}>
                            {{ $room->room_number }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="audit_date" class="block text-gray-200 mb-1">Audit Date</label>
                <input type="date" name="audit_date" id="audit_date" value="{{ old('audit_date', $roomAudit->audit_date) }}" class="w-full px-3 py-2 rounded bg-gray-700 text-white">
            </div>

            <div class="mb-4">
                <label for="notes" class="block text-gray-200 mb-1">Notes</label>
                <textarea name="notes" id="notes" rows="3" class="w-full px-3 py-2 rounded bg-gray-700 text-white">{{ old('notes', $roomAudit->notes) }}</textarea>
            </div>

            <div class="flex justify-end space-x-2">
                <a href="{{ route('room_audits.index') }}" class="px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white rounded">Cancel</a>
                <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded">Update</button>
            </div>
        </form>
    </div>
</x-app-layout>
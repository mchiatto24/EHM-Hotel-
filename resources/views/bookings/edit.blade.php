<x-app-layout>
  <x-slot name="header">Edit Booking</x-slot>

  <div class="max-w-lg mx-auto bg-gray-800 rounded-lg p-6">
    <form action="{{ route('bookings.update', $booking) }}" method="POST">
      @csrf
      @method('PUT')

      {{-- Guest --}}
      <div class="mb-4">
        <label class="block text-gray-200 mb-1">Guest</label>
        <select name="guest_id" class="w-full px-3 py-2 bg-gray-700 text-white rounded">
          @foreach(\App\Models\Guest::all() as $guest)
            <option value="{{ $guest->id }}" @if($guest->id == $booking->guest_id) selected @endif>
              {{ $guest->first_name }} {{ $guest->last_name }}
            </option>
          @endforeach
        </select>
      </div>

      {{-- Room --}}
      <div class="mb-4">
        <label class="block text-gray-200 mb-1">Room</label>
        <select name="room_id" class="w-full px-3 py-2 bg-gray-700 text-white rounded">
          @foreach(\App\Models\Room::where('room_status','available')->get() as $room)
            <option value="{{ $room->id }}" @if($room->id == $booking->room_id) selected @endif>
              {{ $room->room_number }}
            </option>
          @endforeach
        </select>
      </div>

      {{-- Dates --}}
      <div class="mb-4 grid grid-cols-2 gap-4">
        <div>
          <label class="block text-gray-200 mb-1">Check-In</label>
          <input type="date" name="check_in" value="{{ $booking->check_in->format('Y-m-d') }}" 
                 class="w-full px-3 py-2 rounded bg-gray-700 text-white">
        </div>
        <div>
          <label class="block text-gray-200 mb-1">Check-Out</label>
          <input type="date" name="check_out" value="{{ $booking->check_out->format('Y-m-d') }}" 
                 class="w-full px-3 py-2 rounded bg-gray-700 text-white">
        </div>
      </div>

      {{-- Status --}}
      <div class="mb-6">
        <label class="block text-gray-200 mb-1">Status</label>
        <select name="status" class="w-full px-3 py-2 bg-gray-700 text-white rounded">
          @foreach(['pending','confirmed','checked_in','checked_out','canceled'] as $s)
            <option value="{{ $s }}" @if($booking->status == $s) selected @endif>
              {{ ucfirst($s) }}
            </option>
          @endforeach
        </select>
      </div>

      <div class="flex justify-end space-x-4">
        <a href="{{ route('bookings.index') }}" class="px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white rounded">
          Cancel
        </a>
        <button type="submit" class="px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded">
          Update
        </button>
      </div>
    </form>
  </div>
</x-app-layout>

<x-app-layout>
  <x-slot name="header">Delete Booking</x-slot>

  <div class="max-w-lg mx-auto bg-gray-800 rounded-lg p-6">
    <form action="{{ route('bookings.destroy', $booking) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this booking?')">
      @csrf
      @method('DELETE')

      <div class="text-white mb-4">
        <p>Are you sure you want to delete the booking for {{ $booking->guest->first_name }} {{ $booking->guest->last_name }} in Room #{{ $booking->room->room_number }}?</p>
      </div>

      <div class="flex justify-end space-x-4">
        <a href="{{ route('bookings.index') }}" class="px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white rounded">
          Cancel
        </a>
        <button type="submit" class="px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded">
          Delete
        </button>
      </div>
    </form>
  </div>
</x-app-layout>

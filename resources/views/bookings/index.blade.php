<x-app-layout>
  <x-slot name="header">Manage Bookings</x-slot>

  <div class="flex justify-between mb-4">
    <h2 class="text-xl font-semibold text-white">Bookings</h2>
    <a href="{{ route('bookings.create') }}"
       class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
      <span class="material-icons align-middle">add</span>
      <span class="align-middle">New Booking</span>
    </a>
  </div>

  <form method="GET" action="{{ route('bookings.index') }}" class="mb-4">
    <input type="date" name="date" value="{{ request('date') }}"
           class="px-3 py-2 rounded bg-gray-700 text-white">
    <button type="submit" class="px-3 py-2 bg-blue-600 rounded text-white">
      Filter by Date
    </button>
  </form>

  <div class="overflow-x-auto bg-gray-800 rounded p-4">
    <table class="w-full text-white">
      <thead class="bg-gray-700">
        <tr>
          <th class="px-4 py-2 text-left">Guest</th>
          <th class="px-4 py-2 text-center">Room No.</th>
          <th class="px-4 py-2 text-center">Check-In</th>
          <th class="px-4 py-2 text-center">Check-Out</th>
          <th class="px-4 py-2 text-center">Status</th>
          <th class="px-4 py-2 text-center">Actions</th>
        </tr>
      </thead>
      <tbody>
        @forelse($bookings as $b)
        <tr class="hover:bg-gray-700 even:bg-gray-800 odd:bg-gray-900">
          <td class="px-4 py-2">{{ $b->guest->first_name }} {{ $b->guest->last_name }}</td>
          <td class="px-4 py-2 text-center">{{ $b->room->room_number }}</td>
          <td class="px-4 py-2 text-center">{{ $b->check_in->format('Y-m-d') }}</td>
          <td class="px-4 py-2 text-center">{{ $b->check_out->format('Y-m-d') }}</td>
          <td class="px-4 py-2 text-center">{{ ucfirst($b->status) }}</td>
          <td class="px-4 py-2 text-center">
            <a href="{{ route('bookings.edit',$b) }}" class="text-blue-400 mr-2">
              <span class="material-icons">edit</span>
            </a>
            <form action="{{ route('bookings.destroy',$b) }}" method="POST" class="inline"
                  onsubmit="return confirm('Delete this booking?')">
              @csrf @method('DELETE')
              <button class="text-red-400">
                <span class="material-icons">delete</span>
              </button>
            </form>
          </td>
        </tr>
        @empty
        <tr><td colspan="6" class="py-4 text-center text-gray-400">No bookings found.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>

  <div class="mt-4">{{ $bookings->links() }}</div>
</x-app-layout>
<x-app-layout>
    @slot('header')
        Guest Management
    @endslot

    <div class="mb-6">
        <a href="{{ route('guests.create') }}"
           class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg">
            <i class="material-icons align-middle">person_add</i> Add Guest
        </a>
    </div>

    @if (session('success'))
        <div class="bg-green-500 text-white px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto bg-gray-800 rounded-lg shadow p-4">
        <table class="min-w-full text-white">
            <thead class="bg-gray-700">
                <tr>
                    <th class="px-4 py-2 text-left">First Name</th>
                    <th class="px-4 py-2 text-left">Last Name</th>
                    <th class="px-4 py-2 text-left">Email</th>
                    <th class="px-4 py-2 text-left">Phone</th>
                    <th class="px-4 py-2 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($guests as $guest)
                    <tr class="hover:bg-gray-700 even:bg-gray-800 odd:bg-gray-900">
                        <td class="px-4 py-2">{{ $guest->first_name }}</td>
                        <td class="px-4 py-2">{{ $guest->last_name }}</td>
                        <td class="px-4 py-2">{{ $guest->email }}</td>
                        <td class="px-4 py-2">{{ $guest->phone }}</td>
                        <td class="px-4 py-2">
                            <a href="{{ route('guests.edit', $guest) }}"
                               class="text-blue-400 hover:text-blue-300 mr-2">
                                <span class="material-icons">edit</span>
                            </a>
                            <form action="{{ route('guests.destroy', $guest) }}"
                                  method="POST"
                                  class="inline-block"
                                  onsubmit="return confirm('Delete this guest?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-400 hover:text-red-300">
                                    <span class="material-icons">delete</span>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-gray-400 py-4">No guests found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="mt-6">
        {{ $guests->links() }}
    </div>
</x-app-layout>

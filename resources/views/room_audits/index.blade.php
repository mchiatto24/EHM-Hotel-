<x-app-layout>
    <x-slot name="header">
        Room Audits
    </x-slot>

    <div class="mb-6 flex justify-between items-center">
        <h2 class="text-xl font-semibold text-white">Audit Logs</h2>
        <a href="{{ route('room_audits.create') }}"  
           class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg flex items-center">
            <span class="material-icons mr-2">add</span> New Audit
        </a>
    </div>

    <div class="overflow-x-auto bg-gray-800 rounded-lg shadow">
        <table class="min-w-full table-auto text-white">
            <thead class="bg-gray-700">
                <tr>
                    <th class="px-4 py-2 text-left">Room Number</th>
                    <th class="px-4 py-2 text-left">Audit Date</th>
                    <th class="px-4 py-2 text-left">Notes</th>
                    <th class="px-4 py-2 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($audits as $audit)
                    <tr class="border-t border-gray-700 hover:bg-gray-700">
                        <td class="px-4 py-2">{{ $audit->room->room_number }}</td>
                        <td class="px-4 py-2">{{ $audit->audit_date }}</td>
                        <td class="px-4 py-2 max-w-xs whitespace-pre-line overflow-hidden overflow-ellipsis" style="word-wrap: break-word;">
                            {{ nl2br(e($audit->notes)) }}
                        </td>
                        <td class="px-4 py-2">
                            <div class="flex items-center space-x-2">
                                <a href="{{ route('room_audits.edit', $audit) }}" class="text-blue-400 hover:text-blue-600">
                                    <span class="material-icons align-middle text-base">edit</span>
                                </a>
                                <form action="{{ route('room_audits.destroy', $audit) }}" method="POST"
                                      class="inline-block"
                                      onsubmit="return confirm('Are you sure you want to delete this audit?')">
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
                        <td colspan="4" class="text-center py-4 text-gray-400">No room audits found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="mt-4">
        {{ $audits->links() }}
    </div>
</x-app-layout>

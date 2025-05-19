{{-- resources/views/components/stats-card.blade.php --}}
@props([
  'title' => '',
  'value' => '',
  'icon'  => '',  // expect e.g. "fa-box", "fa-truck", etc.
])

<div class="flex items-center bg-gray-800 rounded-lg shadow p-4 border-l-4 border-blue-500">
  {{-- icon container --}}
  <div class="text-blue-500 text-3xl">
    {{-- render the <i> tag instead of printing the class name --}}
    <i class="fa-solid {{ $icon }}" aria-hidden="true"></i>
  </div>

  {{-- text --}}
  <div class="ml-4">
    <p class="text-sm text-gray-400">{{ $title }}</p>
    <p class="text-2xl font-semibold text-white">{{ $value }}</p>
  </div>
</div>

{{-- Room Management Section --}}
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    {{-- Left Panel: Room Management Header & Add Room Button --}}
    <div class="col-span-1">
        <div class="bg-gray-800 rounded-lg shadow p-4">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-semibold text-white">Room Management</h2>
                <a href="{{ route('rooms.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded text-sm">
                    + Add New Room
                </a>
            </div>

            {{-- Search Box --}}
            <div class="mb-4">
                <label for="search" class="block text-sm text-gray-300 mb-1">Search Rooms</label>
                <input type="text" id="search" name="search" placeholder="Search by Room No, Type..."
                    class="w-full px-3 py-2 rounded bg-gray-700 text-white focus:outline-none focus:ring focus:border-blue-500">
            </div>
        </div>
    </div>

    {{-- Right Panel: Room Table --}}
    <div class="col-span-1 lg:col-span-2">
        <div class="bg-gray-800 rounded-lg shadow p-4">
            <h2 class="text-lg font-semibold text-white mb-4">Room List</h2>

            <div class="overflow-x-auto">
                <table class="w-full table-auto text-sm text-left text-white">
                    <thead>
                        <tr class="bg-gray-700 text-gray-300">
                            <th class="px-4 py-2">Room No.</th>
                            <th class="px-4 py-2">Type</th>
                            <th class="px-4 py-2">Status</th>
                            <th class="px-4 py-2">Rate</th>
                            <th class="px-4 py-2">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-700">
                        {{-- Example static rows – replace with @foreach later --}}
                        <tr>
                            <td class="px-4 py-2">101</td>
                            <td class="px-4 py-2">Single</td>
                            <td class="px-4 py-2">
                                <span class="px-2 py-1 bg-green-600 rounded-full text-xs">Available</span>
                            </td>
                            <td class="px-4 py-2">₱1,000</td>
                            <td class="px-4 py-2 space-x-2">
                                <a href="#" class="text-blue-400 hover:underline">Edit</a>
                                <a href="#" class="text-red-400 hover:underline">Delete</a>
                            </td>
                        </tr>
                        <tr>
                            <td class="px-4 py-2">102</td>
                            <td class="px-4 py-2">Double</td>
                            <td class="px-4 py-2">
                                <span class="px-2 py-1 bg-red-600 rounded-full text-xs">Occupied</span>
                            </td>
                            <td class="px-4 py-2">₱1,800</td>
                            <td class="px-4 py-2 space-x-2">
                                <a href="#" class="text-blue-400 hover:underline">Edit</a>
                                <a href="#" class="text-red-400 hover:underline">Delete</a>
                            </td>
                        </tr>
                        {{-- Add more rows dynamically --}}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<x-app-layout>
    <div class="container">
        <div class="bg-gray-800 rounded-lg shadow p-4">
            <h2 class="text-xl font-bold mb-4 text-white">Edit Guest</h2>

            <form action="{{ route('guests.update', $guest) }}" method="POST" class="space-y-4">
                @csrf
                @method('PUT')

                <div>
                    <label class="block font-semibold text-white">First Name</label>
                    <input type="text" name="first_name" value="{{ old('first_name', $guest->first_name) }}" required class="w-full border px-3 py-2 rounded text-black" />
                </div>

                <div>
                    <label class="block font-semibold text-white">Last Name</label>
                    <input type="text" name="last_name" value="{{ old('last_name', $guest->last_name) }}" required class="w-full border px-3 py-2 rounded text-black" />
                </div>

                <div>
                    <label class="block font-semibold text-white">Email</label>
                    <input type="email" name="email" value="{{ old('email', $guest->email) }}" class="w-full border px-3 py-2 rounded text-black" />
                </div>

                <div>
                    <label class="block font-semibold text-white">Phone</label>
                    <input type="text" name="phone" value="{{ old('phone', $guest->phone) }}" class="w-full border px-3 py-2 rounded text-black" />
                </div>

                <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded">Update Guest</button>
                <a href="{{ route('guests.index') }}" class="text-gray-300 ml-4">Cancel</a>
            </form>
        </div>
    </div>
</x-app-layout>

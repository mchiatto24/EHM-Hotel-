<form action="{{ route('inventory.destroy', $item) }}" method="POST"
      class="inline-block"
      onsubmit="return confirm('Are you sure you want to delete this item?')">
    @csrf
    @method('DELETE')
    <button type="submit" class="text-red-400 hover:text-red-600">
        <span class="material-symbols-outlined align-middle">delete</span>
    </button>
</form>
<div class="space-y-2">
    <h2 class="text-2xl font-semibold">📚 Manage Books</h2>

    <!-- Form -->
    <form wire:submit.prevent="store" class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <input type="text" wire:model.defer="title" placeholder="Title" class="input" />
        <input type="text" wire:model.defer="author" placeholder="Author" class="input" />
        <input type="text" wire:model.defer="category" placeholder="Category" class="input" />
        <input type="number" wire:model.defer="stock" placeholder="Stock" class="input" />
        <textarea wire:model.defer="description" placeholder="Description" class="input md:col-span-2"></textarea>
        <button type="submit" class="bg-blue-600 text-white py-2 px-4 rounded md:col-span-2">
            {{ $isEdit ? 'Update' : 'Add' }} Book
        </button>
    </form>

    <!-- Table -->
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-6">
        <table class="w-full text-sm text-left text-gray-700">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                    <th class="px-6 py-3">Title</th>
                    <th class="px-6 py-3">Author</th>
                    <th class="px-6 py-3">Stock</th>
                    <th class="px-6 py-3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($books as $book)
                    <tr class="bg-white border-b hover:bg-gray-50">
                        <td class="px-6 py-4">{{ $book->title }}</td>
                        <td class="px-6 py-4">{{ $book->author }}</td>
                        <td class="px-6 py-4">{{ $book->stock }}</td>
                        <td class="px-6 py-4">
                            <button wire:click="edit({{ $book->id }})" class="text-blue-600 hover:underline">Edit</button>
                            <button wire:click="delete({{ $book->id }})" class="text-red-600 hover:underline ml-2">Delete</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-4 text-center text-gray-500">No books available.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination Links -->
    <div class="mt-4">
        {{ $books->links('pagination::tailwind') }}
    </div>
</div>

@push('scripts')
<!-- SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    Livewire.on('popupMessage', message => {
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: message,
            confirmButtonColor: '#2563eb'
        });
    });

    Livewire.on('popupError', message => {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: message,
            confirmButtonColor: '#dc2626'
        });
    });
</script>
@endpush

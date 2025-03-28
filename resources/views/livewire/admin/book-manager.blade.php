<div>
    <h2 class="text-2xl font-semibold mb-4">Manage Books</h2>
    <form wire:submit.prevent="store" class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
        <input type="text" wire:model.defer="title" placeholder="Title" class="input" />
        <input type="text" wire:model.defer="author" placeholder="Author" class="input" />
        <input type="text" wire:model.defer="category" placeholder="Category" class="input" />
        <input type="number" wire:model.defer="stock" placeholder="Stock" class="input" />
        <textarea wire:model.defer="description" placeholder="Description" class="input col-span-2"></textarea>
        <button type="submit" class="bg-blue-600 text-white py-2 px-4 rounded col-span-2">
            {{ $isEdit ? 'Update' : 'Add' }} Book
        </button>
    </form>

    @if (session()->has('message'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('message') }}
        </div>
    @endif

    <table class="w-full text-left border">
        <thead class="bg-gray-100">
            <tr>
                <th class="p-2">Title</th>
                <th class="p-2">Author</th>
                <th class="p-2">Stock</th>
                <th class="p-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($books as $book)
                <tr class="border-t">
                    <td class="p-2">{{ $book->title }}</td>
                    <td class="p-2">{{ $book->author }}</td>
                    <td class="p-2">{{ $book->stock }}</td>
                    <td class="p-2">
                        <button wire:click="edit({{ $book->id }})" class="text-blue-600">Edit</button>
                        <button wire:click="delete({{ $book->id }})" class="text-red-600 ml-2">Delete</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>


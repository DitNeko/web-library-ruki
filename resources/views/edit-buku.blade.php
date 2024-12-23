<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Buku') }}
        </h2>
    </x-slot>

    <div class="max-w-md mx-auto mt-4">
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Error!</strong>
                <span class="block sm:inline">Silakan periksa kesalahan berikut:</span>
                <ul class="mt-2">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Error!</strong>
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('update.buku', $book->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            {{-- Kolom Kiri --}}
                            <div>
                                {{-- Judul Buku --}}
                                <div class="mb-4">
                                    <label for="title" class="block text-gray-700 font-bold mb-2">
                                        Judul Buku
                                    </label>
                                    <input type="text" name="title" id="title" value="{{ old('title', $book->title) }}"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                        placeholder="Masukkan judul buku" required>
                                </div>

                                {{-- Penulis --}}
                                <div class="mb-4">
                                    <label for="author" class="block text-gray-700 font-bold mb-2">
                                        Penulis
                                    </label>
                                    <input type="text" name="author" id="author" value="{{ old('author', $book->author) }}"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                        placeholder="Masukkan nama penulis" required>
                                </div>

                                {{-- Isbn --}}
                                <div class="mb-4">
                                    <label for="isbn" class="block text-gray-700 font-bold mb-2">
                                        Isbn
                                    </label>
                                    <input type="text" name="isbn" id="isbn" value="{{ old('isbn', $book->isbn) }}"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                        placeholder="Isbn" min="0" required>
                                </div>
                            </div>

                            {{-- Kolom Kanan --}}
                            <div>
                                {{-- Kategori --}}
                                <div class="mb-4">
                                    <label for="category" class="block text-gray-700 font-bold mb-2">
                                        Kategori
                                    </label>
                                    <select name="category_id" id="category"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                        required>
                                        <option value="">Pilih Kategori</option>
                                        @foreach ($categories as $category)
                                            <option {{ $category->id ==  $book->category_id ? 'selected' : '' }} value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- Stok --}}
                                <div class="mb-4">
                                    <label for="stock" class="block text-gray-700 font-bold mb-2">
                                        Stok Buku
                                    </label>
                                    <input type="number" name="stock" id="stock" value="{{ old('stock', $book->stock) }}"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                        placeholder="Jumlah buku" min="0" required>
                                </div>

                                {{-- Tahun Terbit --}}
                                <div class="mb-4">
                                    <label for="publication_year" class="block text-gray-700 font-bold mb-2">
                                        Tahun Terbit
                                    </label>
                                    <input type="number" name="publication_year" id="publication_year"
                                        value="{{ old('publication_year', $book->publication_year) }}"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                        placeholder="Tahun terbit buku" min="1900" max="{{ date('Y') }}"
                                        required>
                                </div>

                                {{-- Sampul Buku --}}
                                {{-- <div class="mb-4">
                                    <label for="cover" class="block text-gray-700 font-bold mb-2">
                                        Sampul Buku
                                    </label>
                                    <input type="file" name="cover" id="cover" 
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                                        accept="image/*">
                                    <p class="text-gray-600 text-sm mt-1">
                                        Ukuran maks: 2MB. Format: JPG, PNG
                                    </p>
                                </div> --}}
                            </div>
                        </div>

                        {{-- Deskripsi --}}
                        <div class="mb-4">
                            <label for="description" class="block text-gray-700 font-bold mb-2">
                                Deskripsi Buku
                            </label>
                            <textarea name="description" id="description"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                rows="4" placeholder="Tambahkan Deskripsi Baru">{{ old('description', $book->description) }}</textarea>
                        </div>

                        {{-- Tombol Aksi --}}
                        <div class="flex justify-end space-x-4 mt-6">
                            <a href="{{ route('manajemen.buku') }}"
                                class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300">
                                Batal
                            </a>
                            <button type="submit"
                                class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">
                                Simpan Buku
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

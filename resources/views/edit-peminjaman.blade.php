<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Peminjaman Buku') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('update.peminjaman', $loan->id) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')
                    <div class="grid grid-cols-2 gap-6">
                        <!-- Nama Peminjam -->
                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="nama_peminjam">
                                Nama Peminjam
                            </label>
                            <input type="text" 
                                   name="name" 
                                   id="nama_peminjam" 
                                   class="w-full border rounded py-2 px-3" 
                                   placeholder="Masukkan nama peminjam"
                                   value="{{ old('name', $loan->name) }}"
                                   required>
                        </div>

                        <!-- Buku -->
                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="buku_id">
                                Judul Buku
                            </label>
                            <select 
                                name="book_id" 
                                id="buku_id"
                                class="w-full border rounded py-2 px-3" 
                                required>
                                <option value="">Pilih Buku</option>
                                @foreach ($books as $index => $book)
                                    <option {{ $book->id == $loan->book_id ? 'selected' : ''}} value="{{ $book->id }}">{{ $book->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-6">
                        <!-- Tanggal Peminjaman -->
                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="tanggal_peminjaman">
                                Tanggal Peminjaman
                            </label>
                            <input type="date" 
                                   name="loan_date" 
                                   id="tanggal_peminjaman" 
                                   class="w-full border rounded py-2 px-3" 
                                   value="{{ old('loan_date', $loan->loan_date) }}" 
                                   required>
                        </div>

                        <!-- Tanggal Pengembalian -->
                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="tanggal_pengembalian">
                                Tanggal Pengembalian
                            </label>
                            <input type="date" 
                                   name="return_date" 
                                   id="tanggal_pengembalian" 
                                   class="w-full border rounded py-2 px-3" 
                                   value="{{ old('return_date', $loan->return_date) }}" 
                                   required>
                        </div>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="flex justify-between mt-6">
                        <a href="{{ route('peminjaman.buku') }}" 
                           class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                            Kembali
                        </a>
                        <button type="submit" 
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Simpan Peminjaman
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
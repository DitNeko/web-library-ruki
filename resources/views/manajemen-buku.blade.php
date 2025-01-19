<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manajemen Buku') }}
        </h2>
    </x-slot>

    <div class="py-12">
        {{-- pop up notifikasi --}}
        @if (session('success'))
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 1500
            });
        </script>
        @endif

        @if (session('info'))
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire({
                icon: 'info',
                title: 'Berhasil!',
                text: '{{ session('info') }}',
                showConfirmButton: false,
                timer: 1500
            });
        </script>
        @endif

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __('Manajemen Buku') }}

                    {{-- Statistik Buku --}}
                    <div class="grid grid-cols-4 gap-4 mt-6">
                        <div class="bg-blue-100 p-4 rounded-lg">
                            <h3 class="text-lg font-bold">Total Buku</h3>
                            <p class="text-2xl">{{ Number::abbreviate($books->count()) }}</p>
                        </div>
                        <div class="bg-green-100 p-4 rounded-lg">
                            <h3 class="text-lg font-bold">Buku Tersedia</h3>
                            <p class="text-2xl">{{ Number::abbreviate($sumStockBook) }}</p>
                        </div>
                        <div class="bg-yellow-100 p-4 rounded-lg">
                            <h3 class="text-lg font-bold">Kategori</h3>
                            <p class="text-2xl">{{ $category->count() }}</p>
                        </div>
                        <div class="bg-red-100 p-4 rounded-lg">
                            <h3 class="text-lg font-bold">Buku Dipinjam</h3>
                            <p class="text-2xl">30</p>
                        </div>
                    </div>

                    {{-- Tombol Aksi Utama --}}
                    <div class="mt-6 flex space-x-4">
                        <a href="{{ route('tambah.buku') }}"
                            class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                            Tambah Buku Baru
                        </a>
                    </div>

                    {{-- Tabel Buku dengan DataTables --}}
                    <div class="mt-8">
                        <h3 class="text-lg font-semibold mb-4">Daftar Buku</h3>
                        <table id="booksTable" class="display responsive nowrap w-full">
                            <thead>
                                <tr>
                                    <th>Judul</th>
                                    <th>Penulis</th>
                                    <th>Kategori</th>
                                    <th>Stok</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($books as $index => $book)
                                <tr>
                                    <td>{{ $book->title }}</td>
                                    <td>{{ $book->author }}</td>
                                    <td>{{ $book->category->name }}</td>
                                    <td>{{ $book->stock }}</td>
                                    <td class="flex">
                                        <a href="{{ route('edit.buku', $book->id) }}" class="text-blue-500 mr-2">Edit</a>
                                        <form id="myForm" action="{{ route('delete.buku', $book->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button class="text-red-500 mx-2" onclick="confirmSubmit(event)">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    {{-- Library DataTables --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmSubmit(event) {
            event.preventDefault();

            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data ini akan dihapus!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('myForm').submit();
                }
            });
        }
    </script>

    <script>
        $(document).ready(function() {
            $('#booksTable').DataTable({
                // Konfigurasi DataTables
                pageLength: 10,
                lengthMenu: [
                    [10, 25, 50, -1],
                    [10, 25, 50, "Semua"]
                ]
            });
        });
    </script>
</x-app-layout>

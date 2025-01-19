<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manajemen Peminjaman Buku') }}
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
            <!-- Statistik Singkat -->
            <div class="grid grid-cols-4 gap-4 mb-6">
                <div class="bg-white overflow-hidden shadow-sm rounded-lg p-4">
                    <div class="flex items-center">
                        <div class="mr-4">
                            <svg class="w-8 h-8 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Total Peminjaman</p>
                            <p class="text-2xl font-bold text-blue-500">{{ Number::abbreviate($loans->count()) }}</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm rounded-lg p-4">
                    <div class="flex items-center">
                        <div class="mr-4">
                            <svg class="w-8 h-8 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Selesai</p>
                            <p class="text-2xl font-bold text-green-500">30</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm rounded-lg p-4">
                    <div class="flex items-center">
                        <div class="mr-4">
                            <svg class="w-8 h-8 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Sedang Dipinjam</p>
                            <p class="text-2xl font-bold text-yellow-500">{{ Number::abbreviate($statusDipinjam) }}</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm rounded-lg p-4">
                    <div class="flex items-center">
                        <div class="mr-4">
                            <svg class="w-8 h-8 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Buku Tersedia</p>
                            <p class="text-2xl font-bold text-purple-500">{{ Number::abbreviate($booksAvailable) }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tombol Aksi -->
            <div class="flex justify-between mb-4">
                <div>
                    <a href="{{ route('tambah.peminjaman') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        + Tambah Peminjaman
                    </a>
                </div>
            </div>

            <!-- Tabel Peminjaman (sesuai versi sebelumnya) -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <table class="min-w-full" id="tabelPeminjaman">
                    <thead>
                        <tr>
                            <th class="px-4 py-2 text-left">Nama Anggota</th>
                            <th class="px-4 py-2 text-left">Judul Buku</th>
                            <th class="px-4 py-2 text-left">Tanggal Peminjaman</th>
                            <th class="px-4 py-2 text-left">Tanggal Pengembalian</th>
                            <th class="px-4 py-2 text-left">Status</th>
                            <th class="px-4 py-2 text-left">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($loans as $loan)
                        <tr>
                            <td class="border px-4 py-2">{{ $loan->name }}</td>
                            <td class="border px-4 py-2">{{ $loan->book->title }}</td>
                            <td class="border px-4 py-2">{{ $loan->loan_date }}</td>
                            <td class="border px-4 py-2">{{ $loan->return_date }}</td>
                            <td class="border px-4 py-2">
                                <span class="text-yellow-600">{{ $loan->status }}</span>
                            </td>
                            <td class="border px-4 py-2">
                                <div class="flex space-x-2">
                                    <a href="{{ route('edit.peminjaman', $loan->id) }}" class="text-blue-500 hover:text-blue-700">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                    </a>
                                    <form id="myForm" action="{{ route('delete.peminjaman', $loan->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700 delete-btn" onclick="confirmSubmit(event)">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <!-- DataTables JS -->
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
            $('#tabelPeminjaman').DataTable({
                responsive: true,
                language: {
                    search: "Cari:",
                    lengthMenu: "Tampilkan _MENU_ data",
                    info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
                    infoEmpty: "Tidak ada data yang tersedia",
                    infoFiltered: "(disaring dari _MAX_ total entri)",
                    paginate: {
                        first: "Pertama",
                        last: "Terakhir",
                        next: "Selanjutnya",
                        previous: "Sebelumnya"
                    }
                },
                columnDefs: [
                    { 
                        targets: -1, 
                        orderable: false 
                    }
                ]
            });
        });
    </script>
</x-app-layout>
<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Pengembalian Buku') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        {{-- Pop up notifikasi --}}
        @if (session('success'))
            <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: '{{ session('success') }}',
                    showConfirmButton: false,
                    timer: 1500,
                    background: '#f0f8ff',
                    iconColor: '#3b82f6'
                });
            </script>
        @endif

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Statistik Singkat -->
            <div class="grid grid-cols-4 gap-4 mb-6">
                <div class="bg-white overflow-hidden shadow-md rounded-lg p-4">
                    <div class="flex items-center">
                        <div class="mr-4">
                            <svg class="w-8 h-8 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Total Pengembalian</p>
                            <p class="text-2xl font-bold text-blue-600">45</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-md rounded-lg p-4">
                    <div class="flex items-center">
                        <div class="mr-4">
                            <svg class="w-8 h-8 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Tepat Waktu</p>
                            <p class="text-2xl font-bold text-green-600">35</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-md rounded-lg p-4">
                    <div class="flex items-center">
                        <div class="mr-4">
                            <svg class="w-8 h-8 text-yellow-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Terlambat</p>
                            <p class="text-2xl font-bold text-yellow-600">10</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-md rounded-lg p-4">
                    <div class="flex items-center">
                        <div class="mr-4">
                            <svg class="w-8 h-8 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v -1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Total Anggota Peminjam</p>
                            <p class="text-2xl font-bold text-pink-600">25</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tabel Pengembalian -->
            <div class="bg-white overflow-hidden shadow-md sm:rounded-lg p-6">
                <table class="min-w-full" id="tabelPengembalian">
                    <thead>
                        <tr>
                            <th class="px-4 py-2 text-left">No</th>
                            <th class="px-4 py-2 text-left">Nama Anggota</th>
                            <th class="px-4 py-2 text-left">Judul Buku</th>
                            <th class="px-4 py-2 text-left">Tanggal Peminjaman</th>
                            <th class="px-4 py-2 text-left">Tanggal Pengembalian</th>
                            <th class="px-4 py-2 text-left">Status</th>
                            <th class="px-4 py-2 text-left">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($loans as $index => $loan)
                            <tr>
                                <td class="border px-4 py-2">{{ $index + 1 }}</td>
                                <td class="border px-4 py-2">{{ $loan->name }}</td>
                                <td class="border px-4 py-2">{{ $loan->book->title }}</td>
                                <td class="border px-4 py-2">{{ $loan->loan_date }}</td>
                                <td class="border px-4 py-2">{{ $loan->return_date }}</td>
                                <td class="border px-4 py-2">
                                    <span class="text-red-600">{{ $loan->status }}</span>
                                </td>
                                <td class="border px-4 py-2">
                                    <div class="flex space-x-2">
                                        <form id="formReturn" action="{{ route('kembalikan.buku', $loan->id) }}" method="POST"
                                            class="inline-block">
                                            @csrf
                                            <button type="submit"
                                                onclick="confirmSubmit(event)"  class="bg-green-500 hover:bg-green-600 text-white font-bold py-1 px-3 rounded text-sm flex items-center">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4">
                                                    </path>
                                                </svg>
                                                Kembalikan.
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Tabel History Pengembalian -->
            <div class="bg-white overflow-hidden shadow-md sm:rounded-lg p-6 mt-6">
                <h3 class="text-xl font-semibold mb-4 text-gray-700">Riwayat Pengembalian Buku</h3>
                <table class="min-w-full" id="tabelHistoryPengembalian">
                    <thead>
                        <tr>
                            <th class="px-4 py-2 text-left">No</th>
                            <th class="px-4 py-2 text-left">Nama Anggota</th>
                            <th class="px-4 py-2 text-left">Judul Buku</th>
                            <th class="px-4 py-2 text-left">Tanggal Peminjaman</th>
                            <th class="px-4 py-2 text-left">Tanggal Pengembalian</th>
                            <th class="px-4 py-2 text-left">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($loanReturn as $index => $dataReturn)
                            <tr>
                                <td class="border px-4 py-2">{{ $index + 1 }}</td>
                                <td class="border px-4 py-2">{{ $dataReturn->name }}</td>
                                <td class="border px-4 py-2">{{ $dataReturn->book->title }}</td>
                                <td class="border px-4 py-2">{{ $dataReturn->loan_date }}</td>
                                <td class="border px-4 py-2">{{ $dataReturn->return_date }}</td>
                                <td class="border px-4 py-2">
                                    <span class="text-green-600">{{ $dataReturn->status }}</span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Script DataTables untuk Tabel History -->
            <script>
                $(document).ready(function() {
                    $('#tabelHistoryPengembalian').DataTable({
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
                        order: [
                            [4, 'desc']
                        ], // Urutkan berdasarkan tanggal pengembalian terbaru
                        columnDefs: [{
                            targets: [-1],
                            orderable: true
                        }]
                    });
                });
            </script>
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
                text: "Buku ini akan dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Kembalikan!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('formReturn').submit();
                }
            });
        }

        $(document).ready(function() {
            $('#tabelPengembalian').DataTable({
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
                columnDefs: [{
                    targets: -1,
                    orderable: false
                }]
            });
        });
    </script>

    <!-- Script DataTables untuk Tabel History -->
    <script>
        $(document).ready(function() {
            $('#tabelHistoryPengembalian').DataTable({
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
                order: [
                    [4, 'desc']
                ], // Urutkan berdasarkan tanggal pengembalian terbaru
                columnDefs: [{
                    targets: [-1, -2],
                    orderable: true
                }]
            });
        });
    </script>
</x-app-layout>

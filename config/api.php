<?php

return [
    'key' => env('ANTRIAN_API_KEY'),

    // Update this value whenever the public API behavior changes.
    'version' => '04-09-2026 10:24',

    'endpoints' => [
        [
            'id' => 'get-counters',
            'name' => 'Daftar Loket',
            'method' => 'GET',
            'path' => '/get-counters',
            'description' => 'Mengambil seluruh loket yang tersedia.',
            'parameters' => [],
            'response' => [
                'status' => 'success',
                'message' => 'Daftar loket berhasil diambil',
                'data' => [['id' => 1, 'name' => 'Loket 1']],
            ],
        ],
        [
            'id' => 'get-layanan',
            'name' => 'Daftar Layanan',
            'method' => 'GET',
            'path' => '/get-layanan',
            'description' => 'Mengambil seluruh layanan atau departemen yang tersedia.',
            'parameters' => [],
            'response' => [
                'status' => 'success',
                'message' => 'Daftar departemen berhasil diambil',
                'data' => [['id' => 1, 'name' => 'Layanan Umum', 'letter' => 'A']],
            ],
        ],
        [
            'id' => 'get-antrian',
            'name' => 'Ambil Nomor Antrean',
            'method' => 'GET',
            'path' => '/get-antrian',
            'description' => 'Membuat nomor antrean baru untuk layanan yang dipilih.',
            'parameters' => [
                ['name' => 'layanan_id', 'required' => false, 'type' => 'integer', 'description' => 'ID layanan. Default: 1.'],
            ],
            'response' => [
                'status' => 'success',
                'message' => 'Token berhasil dibuat',
                'data' => ['queue_id' => 15, 'number' => 4, 'call_number' => 'A-4', 'layanan_id' => 1, 'department' => 'Layanan Umum', 'total_waiting' => 3],
            ],
        ],
        [
            'id' => 'list-antrian',
            'name' => 'Daftar Antrean Menunggu',
            'method' => 'GET',
            'path' => '/list-antrian',
            'description' => 'Mengambil maksimal 5 antrean teratas yang masih menunggu hari ini, diurutkan dari antrean paling awal.',
            'parameters' => [
                ['name' => 'layanan_id', 'required' => false, 'type' => 'integer', 'description' => 'Filter berdasarkan ID layanan. Kosongkan untuk menampilkan semua layanan.'],
            ],
            'response' => [
                'status' => 'success',
                'message' => 'Daftar 5 antrean teratas berhasil diambil',
                'data' => [
                    ['queue_id' => 15, 'number' => 4, 'call_number' => 'A-4', 'layanan_id' => 1, 'department' => 'Layanan Umum', 'created_at' => '03-09-2026 16:45'],
                ],
            ],
        ],
        [
            'id' => 'call',
            'name' => 'Panggil Antrean Berikutnya',
            'method' => 'GET',
            'path' => '/call',
            'description' => 'Mengambil sekaligus memanggil antrean berikutnya, lalu menampilkannya pada layar antrean.',
            'parameters' => [
                ['name' => 'user_id', 'required' => false, 'type' => 'integer', 'description' => 'ID petugas. Default: 1.'],
                ['name' => 'counter_id', 'required' => false, 'type' => 'integer', 'description' => 'ID loket. Default: 1.'],
                ['name' => 'layanan_id', 'required' => false, 'type' => 'integer', 'description' => 'ID layanan. Default: 1.'],
            ],
            'response' => [
                'status' => 'success',
                'message' => 'Berhasil memanggil antrean',
                'data' => ['queue_id' => 15, 'number' => 4, 'call_number' => 'A-4', 'department' => 'Layanan Umum', 'counter' => 'Loket 1', 'user' => 'Administrator'],
            ],
        ],
        [
            'id' => 'recall',
            'name' => 'Panggil Ulang Antrean',
            'method' => 'GET',
            'path' => '/recall',
            'description' => 'Memanggil ulang antrean yang sebelumnya sudah dipanggil.',
            'parameters' => [
                ['name' => 'queue_id', 'required' => true, 'type' => 'integer', 'description' => 'ID antrean yang akan dipanggil ulang.'],
            ],
            'response' => [
                'status' => 'success',
                'message' => 'Memanggil ulang',
                'call_number' => 'A-4',
            ],
        ],
    ],
];

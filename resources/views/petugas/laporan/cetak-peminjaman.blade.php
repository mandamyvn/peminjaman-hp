<!DOCTYPE html>
<html>
<head>
    <title>{{ $title }}</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .header { text-align: center; margin-bottom: 30px; }
        .header h1 { margin: 0; font-size: 24px; }
        .header p { margin: 5px 0; color: #666; }
        .info { margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .footer { margin-top: 30px; text-align: right; }
        .badge { padding: 3px 8px; border-radius: 3px; font-size: 12px; }
        .badge-warning { background-color: #ffc107; color: #000; }
        .badge-success { background-color: #28a745; color: #fff; }
        .badge-danger { background-color: #dc3545; color: #fff; }
        .badge-info { background-color: #17a2b8; color: #fff; }
        .badge-secondary { background-color: #6c757d; color: #fff; }
    </style>
</head>
<body>
    <div class="header">
        <h1>{{ $title }}</h1>
        <p>Periode: {{ date('d/m/Y', strtotime($start_date)) }} - {{ date('d/m/Y', strtotime($end_date)) }}</p>
        <p>Tanggal Cetak: {{ date('d/m/Y H:i:s') }}</p>
    </div>

    <div class="info">
        <p><strong>Total Data:</strong> {{ $data->count() }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kode</th>
                <th>Peminjam</th>
                <th>Alat</th>
                <th>Tanggal Pinjam</th>
                <th>Tanggal Kembali</th>
                <th>Jumlah</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $key => $peminjaman)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $peminjaman->kode_peminjaman }}</td>
                <td>{{ $peminjaman->user->name }}</td>
                <td>{{ $peminjaman->alat->nama_alat }}</td>
                <td>{{ $peminjaman->tanggal_pinjam->format('d/m/Y') }}</td>
                <td>{{ $peminjaman->tanggal_kembali->format('d/m/Y') }}</td>
                <td>{{ $peminjaman->jumlah }}</td>
                <td>
                    @php
                        $statusColors = [
                            'pending' => 'warning',
                            'disetujui' => 'success',
                            'ditolak' => 'danger',
                            'dipinjam' => 'info',
                            'selesai' => 'secondary'
                        ];
                    @endphp
                    <span class="badge badge-{{ $statusColors[$peminjaman->status] ?? 'secondary' }}">
                        {{ $peminjaman->status }}
                    </span>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p>Dicetak oleh: {{ Auth::user()->name }}</p>
        <p>Petugas Peminjaman Alat</p>
    </div>

    <script>
        window.onload = function() {
            window.print();
        }
    </script>
</body>
</html>
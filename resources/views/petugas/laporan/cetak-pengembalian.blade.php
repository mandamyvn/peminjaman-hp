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
        .badge-success { background-color: #28a745; color: #fff; }
        .badge-warning { background-color: #ffc107; color: #000; }
        .badge-danger { background-color: #dc3545; color: #fff; }
        .total { font-weight: bold; font-size: 16px; margin-top: 20px; }
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
        <p><strong>Total Denda:</strong> Rp {{ number_format($total_denda, 0, ',', '.') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>ID</th>
                <th>Peminjaman</th>
                <th>Tanggal Kembali</th>
                <th>Jumlah Kembali</th>
                <th>Kondisi</th>
                <th>Denda</th>
                <th>Diterima Oleh</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $key => $pengembalian)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $pengembalian->id }}</td>
                <td>{{ $pengembalian->peminjaman->kode_peminjaman }}</td>
                <td>{{ $pengembalian->tanggal_kembali->format('d/m/Y') }}</td>
                <td>{{ $pengembalian->jumlah_kembali }}</td>
                <td>
                    <span class="badge badge-{{ $pengembalian->kondisi == 'baik' ? 'success' : ($pengembalian->kondisi == 'rusak_ringan' ? 'warning' : 'danger') }}">
                        {{ $pengembalian->kondisi }}
                    </span>
                </td>
                <td>Rp {{ number_format($pengembalian->denda, 0, ',', '.') }}</td>
                <td>{{ $pengembalian->diterimaOleh->name }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="total">
        <p>Total Denda: Rp {{ number_format($total_denda, 0, ',', '.') }}</p>
    </div>

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
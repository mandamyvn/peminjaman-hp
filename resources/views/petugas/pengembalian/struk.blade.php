<!DOCTYPE html>
<html>
<head>

<title>Struk Pembayaran</title>

<style>

body{
font-family:monospace;
width:300px;
margin:auto;
}

.center{
text-align:center;
}

.line{
border-top:1px dashed black;
margin:10px 0;
}

</style>

</head>

<body onload="window.print()">

<div class="center">
<h3>STRUK PEMBAYARAN</h3>
</div>

<div class="line"></div>

<p>Kode :
{{ $pengembalian->peminjaman->kode_peminjaman }}
</p>

<p>Peminjam :
{{ $pengembalian->peminjaman->user->name }}
</p>

<p>Alat :
{{ $pengembalian->peminjaman->alat->nama_alat }}
</p>

<div class="line"></div>

@php

$p = $pengembalian->peminjaman;

/* harga sewa perhari */
$harga = $p->alat->harga_sewa_perhari;

/* lama sewa mengikuti tanggal kembali yang disepakati */
$lama = $p->tanggal_pinjam->diffInDays($p->tanggal_kembali);

/* total sewa */
$totalSewa = $harga * $lama * $pengembalian->jumlah_kembali;

/* total bayar */
$totalBayar = $totalSewa + $pengembalian->denda;

@endphp

<p>Lama Sewa : {{ $lama }} Hari</p>

<p>Harga / Hari :
Rp {{ number_format($harga,0,',','.') }}
</p>

<p>Total Sewa :
Rp {{ number_format($totalSewa,0,',','.') }}
</p>

<p>Denda :
Rp {{ number_format($pengembalian->denda,0,',','.') }}
</p>

<div class="line"></div>

<h3>Total Bayar</h3>

<h2>
Rp {{ number_format($totalBayar,0,',','.') }}
</h2>

<div class="line"></div>

<div class="center">
Terima Kasih
</div>

</body>
</html>
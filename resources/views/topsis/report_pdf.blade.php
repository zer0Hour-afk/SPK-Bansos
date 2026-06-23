<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Resmi TOPSIS</title>
    <style>
        body { font-family: Arial, sans-serif; color: #111; margin: 0; padding: 24px; }
        .header { text-align: center; margin-bottom: 24px; }
        .header h1 { font-size: 20px; margin: 0; }
        .header p { margin: 4px 0; font-size: 12px; color: #555; }
        .section-title { font-size: 14px; font-weight: bold; margin: 20px 0 8px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 18px; }
        th, td { border: 1px solid #999; padding: 8px; font-size: 12px; }
        th { background: #f2f2f2; }
        .card { border: 1px solid #d1d5db; border-radius: 10px; padding: 16px; background: #f8fafc; margin-top: 12px; }
        .signature { display: flex; justify-content: space-between; gap: 16px; margin-top: 32px; }
        .signature div { width: 48%; }
        .signature .line { margin-top: 44px; border-bottom: 1px solid #999; }
    </style>
</head>
<body>
    <div class="header">
        <p style="font-size: 11px; letter-spacing: .1em; text-transform: uppercase; color: #555;">Pemerintah Desa Nightcity</p>
        <h1>Laporan Resmi Rekomendasi Prioritas Bansos</h1>
        <p>Hasil perhitungan TOPSIS untuk menentukan prioritas penerima bantuan sosial</p>
        <p>Tanggal: {{ now()->format('d F Y H:i') }}</p>
    </div>

    <div>
        <div class="section-title">Prioritas Utama</div>
        @php $top = $hasilAkhir[0] ?? null; @endphp
        @if($top)
            <div class="card">
                <p style="margin:0; font-size: 12px; color:#555;">Warga Prioritas #1</p>
                <p style="margin:8px 0 0; font-size: 18px; font-weight: 700;">{{ $top['nama'] }}</p>
                <p style="margin:4px 0 0; font-size: 12px; color:#333;">Nilai Preferensi: {{ number_format($top['nilai_preferensi'], 4) }}</p>
            </div>
        @else
            <p style="font-size: 12px; color:#555;">Belum ada data hasil TOPSIS.</p>
        @endif
    </div>

    <div>
        <div class="section-title">Daftar Ranking</div>
        <table>
            <thead>
                <tr>
                    <th>Ranking</th>
                    <th>NIK</th>
                    <th>Nama</th>
                    <th>Nilai Preferensi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($hasilAkhir as $index => $hasil)
                    @php $warga = $wargas->firstWhere('id', $hasil['warga_id']); @endphp
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $warga?->nik ?? '-' }}</td>
                        <td>{{ $hasil['nama'] }}</td>
                        <td>{{ number_format($hasil['nilai_preferensi'], 4) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="signature">
        <div>
            <p style="font-size: 12px; color:#555;">Disusun oleh:</p>
            <div class="line"></div>
            <p style="margin-top: 6px; font-size: 12px;">Admin / Perangkat Desa</p>
        </div>
        <div>
            <p style="font-size: 12px; color:#555;">Diketahui oleh:</p>
            <div class="line"></div>
            <p style="margin-top: 6px; font-size: 12px;">Kepala Desa</p>
        </div>
    </div>
</body>
</html>

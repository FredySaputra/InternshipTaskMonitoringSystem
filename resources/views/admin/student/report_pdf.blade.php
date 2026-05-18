<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Laporan Akumulasi Nilai Siswa PKL</title>
    <style>
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            color: #333;
            font-size: 12px;
            line-height: 1.4;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
        }
        .header h2 {
            margin: 0;
            text-transform: uppercase;
            font-size: 18px;
        }
        .header p {
            margin: 5px 0 0 0;
            font-size: 12px;
            color: #555;
        }
        .meta-info {
            margin-bottom: 15px;
            font-size: 11px;
            color: #666;
            text-align: right;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th {
            background-color: #343a40;
            color: #ffffff;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 11px;
            padding: 8px;
            border: 1px solid #dee2e6;
        }
        td {
            padding: 8px;
            border: 1px solid #dee2e6;
        }
        .text-center {
            text-align: center;
        }
        .text-start {
            text-align: left;
        }
        .fw-bold {
            font-weight: bold;
        }
        .badge-success { color: #198754; font-weight: bold; }
        .badge-warning { color: #ffc107; font-weight: bold; }
        .badge-danger { color: #dc3545; font-weight: bold; }

        /* Mengatur baris selang-seling abu-abu tipis (zebra stripe) */
        tr:nth-child(even) {
            background-color: #f8f9fa;
        }
    </style>
</head>
<body>

    <div class="header">
        <h2>Laboratorium Komputer</h2>
        <h2>Universitas Budi Luhur</h2>
        <p>Sistem Monitoring Penugasan Kerja Praktik / PKL Siswa SMK</p>
    </div>

    <div class="meta-info">
        <strong>Tanggal Cetak Laporan:</strong> {{ $datePrinted }}
    </div>

    <h3 style="margin-bottom: 10px; font-size: 14px;">Rekapitulasi Akumulasi Nilai Kelulusan Tugas</h3>

    <table>
        <thead>
            <tr>
                <th width="30">No</th>
                <th class="text-start">Nama Siswa</th>
                <th>Asal Sekolah</th>
                <th>Penempatan Lab</th>
                <th width="100">Rasio Sukses</th>
                <th width="80">Skor Akhir</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($students as $index => $student)
            <tr class="text-center">
                <td>{{ $index + 1 }}</td>
                <td class="text-start fw-bold">{{ $student->name }}</td>
                <td>{{ $student->school->name }}</td>
                <td>{{ $student->lab->name }}</td>
                <td>{{ $student->accepted_tasks }} / {{ $student->total_tasks }} Tugas</td>

                <td>
                    @if($student->grade_percentage >= 80)
                        <span class="badge-success">{{ $student->grade_percentage }}%</span>
                    @elseif($student->grade_percentage >= 50)
                        <span class="badge-warning">{{ $student->grade_percentage }}%</span>
                    @else
                        <span class="badge-danger">{{ $student->grade_percentage }}%</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <table style="width: 100%; border: none; margin-top: 50px;">
        <tr style="background: none;">
            <td style="border: none; width: 60%;"></td>
            <td style="border: none; text-align: center; font-size: 12px;">
                Jakarta, {{ now()->format('d F Y') }}<br>
                <strong>Supervisor Laboratorium ICT,</strong>
                <br><br><br><br><br>
                <u>( ___________________________ )</u><br>
                Universitas Budi Luhur
            </td>
        </tr>
    </table>

</body>
</html>

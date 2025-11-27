<!DOCTYPE html>
<html>

<head>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 8px;
            border: 1px solid #444;
            text-align: left;
        }

        th {
            background: #eee;
        }
    </style>
</head>

<body>
    <h2>Hasil Peramalan Jumlah Siswa Baru</h2>
    <table>
        <thead>
            <tr>
                <th>Tahun</th>
                <th>CF</th>
                <th>SES</th>
                <th>Regresi Linier</th>
            </tr>
        </thead>
        <tbody> @foreach ($data as $row) <tr>
            <td>{{ $row->tahun }}</td>
            <td>{{ number_format($row->CF, 2) }}</td>
            <td>{{ number_format($row->SES, 2) }}</td>
            <td>{{ number_format($row->regresi_linier, 2) }}</td>
        </tr> @endforeach </tbody>
    </table>
</body>

</html>
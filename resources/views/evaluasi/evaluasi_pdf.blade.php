<!DOCTYPE html>
<html>

<head>
    <title>Evaluasi Akurasi Peramalan</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #999;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <h2>Evaluasi Akurasi Peramalan</h2>
    <table>
        <thead>
            <tr>
                <th>Metode Peramalan</th>
                <th>MAPE (%)</th>
                <th>MSE</th>
                <th>MAD</th>
                <th>Kategori Akurasi</th>
            </tr>
        </thead>
        <tbody> @foreach ($evaluasi as $metode => $hasil) <tr>
            <td>{{ $metode }}</td>
            <td>{{ $hasil['MAPE'] }}</td>
            <td>{{ $hasil['MSE'] }}</td>
            <td>{{ $hasil['MAD'] }}</td>
            <td>{{ $hasil['Kategori'] }}</td>
        </tr> @endforeach </tbody>
    </table>
</body>

</html>
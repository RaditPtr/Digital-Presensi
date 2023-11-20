<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" conent="width=devicet-width, initial-scale=1.0">
    <style>
        body {
            font-family: sans-serif;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin: 20px 0;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #ddd;
        }

        .photo-container {
            display: flex;
            overflow: hidden;
            justify-content: center;
            align-items: center;
            overflow: hidden;
            width: 150px;
            height: 200px;
        }
    </style>
</head>

<body>

    <h1>Daftar Presensi</h1>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Siswa</th>
                <th>Kelas</th>
                <th>waktu</th>
                <th>Tanggal</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($presensi as $p)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{ $p->nama_siswa }}</td>
                <td>{{ $p->nama_kelas }}</td>
                <td>{{ $p->waktu_presensi }}</td>
                <td>{{ $p->tanggal_presensi }}</td>
                <td>{{ $p->status_hadir }}</td>

            </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>
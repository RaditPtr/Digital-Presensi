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

    </style>
</head>

<body>

    <h1>Daftar Kelas</h1>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Kelas</th>
                <th>Jurusan</th>
                <th>Tahun Masuk</th>
                <th>Wali Kelas</th>
                {{-- <th>Status</th> --}}
            </tr>
        </thead>
        <tbody>
            @foreach ($kelas as $k)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{ $k->nama_kelas }}</td>
                <td>{{ $k->nama_jurusan }}</td>
                <td>{{ $k->tahun_masuk }}</td>
                <td>{{ $k->nama_guru }}</td>
                {{-- <td>{{ $k->status_hadir }}</td> --}}

            </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>
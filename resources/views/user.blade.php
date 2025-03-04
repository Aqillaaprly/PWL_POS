<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data User</title>
    <style>
        table { width: 50%; border-collapse: collapse; margin: 20px 0; }
        th, td { border: 1px solid black; padding: 10px; text-align: center; }
    </style>
</head>
<body>
    <h2>Data User</h2>
    <table>
        <tr>
            <th>Jumlah Pengguna</th>
        </tr>
        <tr>
            <td>{{ $data }}</td> <!-- Menampilkan jumlah pengguna -->
        </tr>
    </table>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Posts</title>
    <style>
        /* Mengatur font secara keseluruhan */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            color: #333;
        }

        /* Styling judul */
        h1 {
            text-align: center;
            color: #2c3e50;
            font-family: 'Helvetica', sans-serif;
        }

        /* Mengatur tampilan tabel */
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            font-family: 'Courier New', Courier, monospace;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }

        /* Styling header tabel */
        th {
            background-color: #2980b9;
            color: white;
            font-size: 18px;
            padding: 12px;
            text-align: center;
        }

        /* Styling baris tabel */
        td {
            text-align: left;
            padding: 10px;
            font-size: 16px;
        }

        /* Warna latar belakang selang-seling */
        tbody tr:nth-child(odd) {
            background-color: #ecf0f1;
        }

        tbody tr:nth-child(even) {
            background-color: #bdc3c7;
        }

        /* Hover efek pada baris tabel */
        tbody tr:hover {
            background-color: #3498db;
            color: white;
        }
    </style>
</head>
<body>
    <h1>Data Posts</h1>

    <table border="1" cellpadding="10" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Body</th>
            </tr>
        </thead>
        <tbody>
        <?php
                // Inisialisasi URL dan pengaturan CURL
                $url = 'https://jsonplaceholder.typicode.com/posts';
                $ch = curl_init();
                curl_setopt($ch,CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $response = curl_exec($ch);
                curl_close($ch);
                
                // Ubah respon JSON menjadi array
                $data = json_decode($response, true);

                // Loop untuk menampilkan data dalam tabel
                foreach ($data as $post) {
                    echo "<tr>";
                    echo "<td>" . $post['id'] . "</td>";
                    echo "<td>" . $post['title'] . "</td>";
                    echo "<td>" . $post['body'] . "</td>";
                    echo "</tr>";
                }
            ?>
        </tbody>
    </table>

</body>
</html>
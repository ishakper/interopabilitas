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
            margin: 0;
            padding: 20px;
        }

        /* Styling judul */
        h1 {
            text-align: center;
            color: #d35400; /* Warna oranye gelap */
            font-family: 'Helvetica', sans-serif;
            margin-bottom: 20px;
        }

        /* Mengatur tampilan tabel */
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            font-family: 'Courier New', Courier, monospace;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            background-color: #fff;
            border-radius: 8px; /* Menambahkan sudut melengkung */
            overflow: hidden; /* Menjaga sudut melengkung */
        }

        /* Styling header tabel */
        th {
            background-color: #f39c12; /* Warna kuning oranye */
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
            border-bottom: 1px solid #ddd; /* Garis bawah sel */
        }

        /* Warna latar belakang selang-seling */
        tbody tr:nth-child(odd) {
            background-color: #ecf0f1; /* Warna abu-abu muda */
        }

        tbody tr:nth-child(even) {
            background-color: #bdc3c7; /* Warna abu-abu lebih gelap */
        }

        /* Hover efek pada baris tabel */
        tbody tr:hover {
            background-color: #f39c12; /* Warna kuning oranye saat hover */
            color: white;
        }
    </style>
</head>
<body>
    <h1>DATA POST</h1>

    <table>
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
            $url = 'http://jsonplaceholder.typicode.com/posts';
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($ch);
            
            // Cek apakah CURL berhasil
            if ($response === false) {
                echo "<tr><td colspan='3'>Error: " . curl_error($ch) . "</td></tr>";
            } else {
                // Ubah respon JSON menjadi array
                $data = json_decode($response, true);

                // Cek apakah data valid
                if (is_array($data)) {
                    // Loop untuk menampilkan data dalam tabel
                    foreach ($data as $post) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($post['id']) . "</td>";
                        echo "<td>" . htmlspecialchars($post['title']) . "</td>";
                        echo "<td>" . htmlspecialchars($post['body']) . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='3'>No data found.</td></tr>";
                }
            }

            curl_close($ch);
        ?>
        </tbody>
    </table>

</body>
</html>

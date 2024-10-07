<?php

// URL API publik
$url = 'http://jsonplaceholder.typicode.com/posts';

// Jika form dikirim (POST request)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['title']) && isset($_POST['body'])) {
    // Data dari form yang akan dikirim ke API
    $new_data = array(
        'title' => $_POST['title'],
        'body' => $_POST['body'],
    );

    // Inisialisasi cURL untuk POST
    $ch_post = curl_init();
    curl_setopt($ch_post, CURLOPT_URL, $url);
    curl_setopt($ch_post, CURLOPT_POST, 1);
    curl_setopt($ch_post, CURLOPT_POSTFIELDS, json_encode($new_data));
    curl_setopt($ch_post, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    curl_setopt($ch_post, CURLOPT_RETURNTRANSFER, true);

    // Eksekusi cURL untuk POST dan dapatkan respon
    $post_response = curl_exec($ch_post);

    // Tutup cURL POST
    curl_close($ch_post);

    // Decode respons dari POST
    $post_response_data = json_decode($post_response, true);
}

// Inisialisasi cURL untuk GET
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Eksekusi cURL dan simpan respons GET dalam variabel
$response = curl_exec($ch);

// Tutup cURL
curl_close($ch);

// Decode respons JSON dari server menjadi array PHP
$responseData = json_decode($response, true);

// Ambil 5 data pertama dari API (GET)
$first_five = array_slice($responseData, 0, 5);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tugas 2 - Menampilkan Data</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 20px;
        }
        h1, h2 {
            text-align: center;
            color: #333;
        }
        table {
            width: 80%; 
            margin: 20px auto; 
            border-collapse: collapse;
            border: 1px solid #ccc;
            background-color: #fff9c4; /* Warna kuning muda untuk tabel */
        }
        th, td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ccc;
        }
        th {
            background-color: #ffeb3b; /* Warna kuning untuk header */
            color: #333; /* Warna teks gelap */
        }
        form {
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 80%; /* Sesuaikan lebar form juga agar seragam */
        }
        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }
        input, textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        button {
            padding: 8px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
            font-size: 14px;
            background-color: #4CAF50;
            color: white;
        }
        button:hover {
            opacity: 0.8;
        }
    </style>
</head>
<body>

    <h1>Tambah Data Baru</h1>

    <!-- Form untuk menambahkan data baru (POST) -->
    <form method="POST" action="">
        <label for="title">Judul</label>
        <input type="text" id="title" name="title" placeholder="Masukkan judul" required>

        <label for="body">Isi</label>
        <textarea id="body" name="body" rows="5" placeholder="Masukkan isi konten" required></textarea>

        <button type="submit">Submit Data</button>
    </form>

    <?php if (!empty($post_response_data)): ?>
        <h2>Data baru yang ditambahkan</h2>
        <table>
            <thead>
                <tr>
                    <th>Judul</th>
                    <th>Isi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?php echo htmlspecialchars($post_response_data['title']); ?></td>
                    <td><?php echo htmlspecialchars($post_response_data['body']); ?></td>
                </tr>
            </tbody>
        </table>
    <?php endif; ?>

    <h2>Data Teratas dari API (5 Post)</h2>
    
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Judul</th>
                <th>Isi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($first_five as $post): ?>
                <tr>
                    <td><?php echo htmlspecialchars($post['id']); ?></td>
                    <td><?php echo htmlspecialchars($post['title']); ?></td>
                    <td><?php echo htmlspecialchars($post['body']); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</body>
</html>
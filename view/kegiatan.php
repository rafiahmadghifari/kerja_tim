<?php
// Array data kegiatan (contoh)
$dataKegiatan = [];

// Fungsi untuk menghapus data berdasarkan ID
function hapusData($id) {
    global $dataKegiatan;
    if (isset($dataKegiatan[$id])) {
        unset($dataKegiatan[$id]);
    }
}

// Fungsi untuk mengambil data berdasarkan ID
function getData($id) {
    global $dataKegiatan;
    if (isset($dataKegiatan[$id])) {
        return $dataKegiatan[$id];
    }
    return null;
}

// Fungsi untuk menyimpan data kegiatan
function tambahData($data) {
    global $dataKegiatan;
    
    // Generate ID unik untuk data baru
    $id = uniqid();
    
    // Simpan data kegiatan dengan ID unik
    $dataKegiatan[$id] = $data;
    
    return $id; // Mengembalikan ID dari data yang baru disimpan
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Tangani penambahan data
    $nama = $_POST["nama"];
    $tanggal = $_POST["tanggal"];
    $jam = $_POST["jam"];
    $kegiatan = $_POST["kegiatan"];

    // Menggunakan fungsi date() untuk mendapatkan hari berdasarkan tanggal
    $hari = date('l', strtotime($tanggal));

    $data = [
        "nama" => $nama,
        "hari" => $hari,
        "tanggal" => $tanggal,
        "jam" => $jam,
        "kegiatan" => $kegiatan
    ];

    // Menyimpan data dan mendapatkan ID data yang baru disimpan
    tambahData($data);
    
    // Redirect kembali ke halaman utama setelah penambahan data
    header("Location: kegiatan.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kegiatan</title>
    <style>
        /* CSS lainnya seperti sebelumnya */

        /* CSS untuk tombol "Tambah Data" */
        /* .button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 10px 5px;
            cursor: pointer;
            border-radius: 5px;
        }

        /* CSS untuk form tambah data 
        #tambahDataForm {
            background-color: #fff;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-top: 20px;
            width: 400px; /* Lebar form 
            display: none; /* Form awalnya disembunyikan */
        }

        /* CSS untuk tabel *
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #007bff;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        /* CSS untuk tombol "Tambahkan Kegiatan" 
        .tambah-kegiatan-button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 10px 5px;
            cursor: pointer;
            border-radius: 5px;
        }

         /* CSS untuk tombol aksi  
        .aksi-button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 5px 10px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
            border-radius: 5px;
            cursor: pointer;
        } */
    </style>
</head>
<body>
    <h3>Kegiatan</h3>

    <!-- Tombol "Tambah Data" yang akan menampilkan form tambah data -->
    <button class="button" id="tambahDataButton">Tambah Kegiatan</button>

    <!-- Form tambah data -->
    <div id="tambahDataForm">
        <h3>Tambah Kegiatan</h3>
        <form action="kegiatan.php" method="post">
            <label for="nama">Nama:</label>
            <input type="text" id="nama" name="nama"><br><br>

            <label for="tanggal">Tanggal:</label>
            <input type="date" id="tanggal" name="tanggal"><br><br>

            <label for="jam">Jam:</label>
            <input type="time" id="jam" name="jam"><br><br>

            <label for="kegiatan">Kegiatan:</label>
            <textarea id="kegiatan" name="kegiatan"></textarea><br><br>

            <input type="submit" value="Simpan">
        </form>
    </div>

    <!-- Tabel untuk menampilkan data kegiatan -->
    <table>
        <thead>
            <tr>
                <th>Nama</th>
                <th>Hari</th>
                <th>Tanggal</th>
                <th>Jam</th>
                <th>Kegiatan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Menampilkan data dari array $dataKegiatan ke dalam tabel
            foreach ($dataKegiatan as $id => $data) {
                echo "<tr>";
                echo "<td>" . $data["nama"] . "</td>";
                echo "<td>" . $data["hari"] . "</td>";
                echo "<td>" . $data["tanggal"] . "</td>";
                echo "<td>" . $data["jam"] . "</td>";
                echo "<td>" . $data["kegiatan"] . "</td>";
                echo "<td><a href='editkegiatan.php?id=$id'><button class='aksi-button'>Edit</button></a> | <a href='kegiatan.php?action=delete&id=$id'><button class='aksi-button'>Hapus</button></a></td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>

    <!-- JavaScript untuk menampilkan dan menyembunyikan form -->
    <script>
        // Ambil elemen-elemen yang dibutuhkan
        const tambahDataButton = document.getElementById("tambahDataButton");
        const tambahDataForm = document.getElementById("tambahDataForm");

        // Tambahkan event listener untuk tombol "Tambah Data"
        tambahDataButton.addEventListener("click", function() {
            if (tambahDataForm.style.display === "none") {
                tambahDataForm.style.display = "block";
            } else {
                tambahDataForm.style.display = "none";
            }
        });
    </script>
</body>
</html>

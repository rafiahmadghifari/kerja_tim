<?php
// Load data dari file CSV (contoh)
$dataKegiatan = [];
if (($handle = fopen("data_kegiatan.csv", "r")) !== false) {
    while (($data = fgetcsv($handle, 1000, ",")) !== false) {
        $dataKegiatan[] = $data;
    }
    fclose($handle);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST["nama"];
    $jurusan = implode(", ", $_POST["jurusan"]);
    $kehadiran = implode(", ", $_POST["kehadiran"]);
    $jamMasuk = $_POST["jamMasuk"];
    $jamPulang = $_POST["jamPulang"];
    $tanggal = $_POST["tanggal"];

    // Menyimpan data ke file CSV
    $data = [$nama, $jurusan, $kehadiran, $jamMasuk, $jamPulang, $tanggal];
    $handle = fopen("data_kegiatan.csv", "a");
    fputcsv($handle, $data);
    fclose($handle);

    // Redirect kembali ke halaman "absen.php"
    header("Location: absen.php");
    exit; // Penting untuk menghentikan eksekusi skrip setelah redirect
}

if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Hapus data berdasarkan $id
    if (isset($dataKegiatan[$id])) {
        unset($dataKegiatan[$id]);
        
        // Simpan data kembali ke file CSV
        $handle = fopen("data_kegiatan.csv", "w");
        foreach ($dataKegiatan as $data) {
            fputcsv($handle, $data);
        }
        fclose($handle);
    }
    
    // Redirect kembali ke halaman "absen.php" setelah penghapusan
    header("Location: absen.php");
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
        /* CSS untuk latar belakang tabel */
        body {
            background-color: #f0f0f0;
            padding: 20px;
            font-family: Arial, sans-serif;
        }

        /* CSS untuk tombol "Tambah Data" */
        .button {
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

        /* CSS untuk tabel */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #ccc;
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

        /* CSS untuk form tambah data yang awalnya disembunyikan */
        #tambahDataForm {
            display: none;
            background-color: #fff;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-top: 20px;
        }

        #tambahDataForm h3 {
            font-size: 20px;
            margin-bottom: 10px;
        }

        #tambahDataForm label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        #tambahDataForm input[type="text"],
        #tambahDataForm input[type="date"],
        #tambahDataForm input[type="time"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        #tambahDataForm label.checkbox-label {
            display: inline-block;
            margin-right: 10px;
        }

        #tambahDataForm input[type="checkbox"] {
            margin-right: 5px;
        }

        #tambahDataForm input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin-top: 10px;
            cursor: pointer;
            border-radius: 5px;
        }

        /* Ganti warna latar belakang tombol "Edit" menjadi biru */
        .edit-button {
            background-color: blue;
            color: white;
            padding: 5px 10px;
            text-decoration: none;
            border-radius: 5px;
        }

        /* Ganti warna latar belakang tombol "Hapus" menjadi merah */
        .delete-button {
            background-color: red;
            color: white;
            padding: 5px 10px;
            text-decoration: none;
            border-radius: 5px;
        }

        /* Responsifitas untuk tampilan layar kecil */
        @media screen and (max-width: 600px) {
            table {
                font-size: 14px;
            }

            #tambahDataForm {
                padding: 10px;
            }

            #tambahDataForm input[type="text"],
            #tambahDataForm input[type="date"],
            #tambahDataForm input[type="time"] {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <h3>Absensi</h3>

    <!-- Tombol "Tambah Data" yang akan menampilkan form tambah data -->
    <button class="button" id="tambahDataButton">Tambah Data</button>

    <!-- Form tambah data -->
    <div id="tambahDataForm">
        <h3>Tambah Data Absen</h3>
        <form action="absen.php" method="post">
            <label for="nama">Nama:</label>
            <input type="text" id="nama" name="nama"><br><br>

            <label>Jurusan:</label>
            <label>
                <input type="checkbox" name="jurusan[]" value="RPL"> RPL
            </label>
            <label>
                <input type="checkbox" name="jurusan[]" value="TBSM"> TBSM
            </label>
            <label>
                <input type="checkbox" name="jurusan[]" value="ATPH"> ATPH
            </label><br><br>

            <label for="kehadiran">Kehadiran:</label>
            <input type="checkbox" id="hadir" name="kehadiran[]" value="Hadir">
            <label for="hadir">Hadir</label>
            <input type="checkbox" id="izin" name="kehadiran[]" value="Izin">
            <label for="izin">Izin</label>
            <input type="checkbox" id="tanpaKeterangan" name="kehadiran[]" value="Tanpa Keterangan">
            <label for="tanpaKeterangan">Alfa</label><br><br>

            <label for="tanggal">Tanggal:</label>
            <input type="date" id="tanggal" name="tanggal"><br><br>

            <label for="jamMasuk">Jam Masuk:</label>
            <input type="time" id="jamMasuk" name="jamMasuk"><br><br>

            <label for="jamPulang">Jam Pulang:</label>
            <input type="time" id="jamPulang" name="jamPulang"><br><br>

            <input type="submit" value="Simpan Data">
        </form>
    </div>

    <!-- Tabel untuk menampilkan data -->
    <table>
        <thead>
            <tr>
                <th>Nama</th>
                <th>Jurusan</th>
                <th>Kehadiran</th>
                <th>Masuk</th>
                <th>Pulang</th>
                <th>Tanggal</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Menampilkan data dari CSV ke dalam tabel
            foreach ($dataKegiatan as $key => $data) {
                echo "<tr>";
                echo "<td>" . $data[0] . "</td>";
                echo "<td>" . $data[1] . "</td>";
                echo "<td>" . $data[2] . "</td>";
                echo "<td>" . $data[3] . "</td>";
                echo "<td>" . $data[4] . "</td>";
                echo "<td>" . $data[5] . "</td>";
                echo "<td><a href='edit.php?id=$key' class='edit-button'>Edit</a> | ";
                echo "<a href='absen.php?action=delete&id=$key' class='delete-button'>Hapus</a></td>";
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

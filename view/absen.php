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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <!-- <style>
        /* CSS untuk latar belakang tabel */
       /* CSS untuk latar belakang tabel */
body {
    background-color: #f0f0f0;
    padding: 20px;
    font-family: Arial, sans-serif;
}

/* CSS untuk tombol */
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
    background-color: #fff;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Tambahkan bayangan untuk tampilan elegan */
    border-radius: 5px;
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
            background-color: #E3E1E1;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-top: 20px;
            position: relative;
        }

        #tambahDataForm h3 {
            font-size: 15px;
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

        /* CSS untuk tombol "Kembali" (X) */
        #kembaliButton {
            position: absolute;
            top: 10px; /* Jarak dari atas */
            right: 10px; /* Jarak dari kanan */
            font-size: 20px;
            cursor: pointer;
            display: none; /* Tombol ini awalnya disembunyikan */
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
                width: 100%;
            }

            /* Mengatur ulang lebar elemen-elemen pada layar kecil */
            th, td {
                width: auto;
                display: block;
                padding: 4px;
            }

            /* Menambahkan garis bawah untuk baris tabel */
            tr {
                border-bottom: 1px solid #ddd;
                margin-bottom: 10px;
                display: flex;
                flex-direction: column;
            }

            /* Menambahkan margin antara baris */
            tr:last-child {
                margin-bottom: 0;
            }

            /* Menyembunyikan header tabel */
            th {
                display: none;
            }

            /* Menyembunyikan label pada form tambah data */
            #tambahDataForm label {
                display: block;
                font-weight: bold;
                margin-bottom: 5px;
            }

            /* Menampilkan tombol "Tambah Data" pada layar kecil */
            .button {
                display: inline-block;
            }

            /* Menyembunyikan checkbox label */
            #tambahDataForm label.checkbox-label {
                display: none;
            }

            /* Menampilkan checkbox dan label pada form tambah data */
            #tambahDataForm input[type="checkbox"] {
                display: inline-block;
                margin-right: 5px;
            }
            /* CSS untuk mode terang */
            .light-mode {
                background-color: #fff;
                color: #333;
            }

            /* CSS untuk tombol mode gelap dan terang */
            .mode-toggle {
                background-color: transparent;
                color: #333;
                border: none;
                cursor: pointer;
            }

        }

        
    </style> -->
</head>
<body>
    <h3>Absensi
<button id="modeToggle" class="mode-toggle">
    <i class="fas fa-moon"></i>
</button>
</h3>

    <!-- Tombol "Tambah Data" yang akan menampilkan form tambah data -->
    <button class="button" id="tambahDataButton" style="background-color: #008000;">Tambah Data</button>

    <!-- Form tambah data -->
<div id="tambahDataForm">
    <h3>Tambah Data Absen</h3>
    <form action="absen.php" method="post">
        <div id="kembaliButton" onclick="toggleTambahDataForm()">&#10006;</div>
        <div class="form-group">
    <label for="nama">Nama:</label>
    <input type="text" id="nama" name="nama" required>
</div>
        <div class="form-group">
    <label for="jurusan">Jurusan:</label>
    <div class="checkbox-group">
        <label for="jurusanRPL">
            <input type="checkbox" id="jurusanRPL" name="jurusan[]" value="RPL" title="Rekayasa Perangkat Lunak"> RPL
        </label>
        <label for="jurusanTBSM">
            <input type="checkbox" id="jurusanTBSM" name="jurusan[]" value="TBSM" title="Teknik Bisnis Sepeda Motor"> TBSM
        </label>
        <label for="jurusanATPH">
            <input type="checkbox" id="jurusanATPH" name="jurusan[]" value="ATPH" title="Agribisnis Tanaman Pangan dan Holtikultura"> ATPH
        </label>
    </div>
</div>

<div class="form-group">
    <label for="kehadiran">Kehadiran:</label>
    <div class="checkbox-group">
        <label for="hadir">
            <input type="checkbox" id="hadir" name="kehadiran[]" value="Hadir" title="Hadir">Hadir
        </label>
        <label for="izin">
            <input type="checkbox" id="izin" name="kehadiran[]" value="Izin" title="Izin">Izin
        </label>
        <label for="tanpaKeterangan">
            <input type="checkbox" id="tanpaKeterangan" name="kehadiran[]" value="Tanpa Keterangan" title="Alfa">Alfa
        </label>
    </div>
</div>

        <div class="form-group">
            <label for="tanggal">Tanggal:</label>
            <input type="date" id="tanggal" name="tanggal">
        </div>
        
        <div class="form-group">
            <label for="jamMasuk">Jam Masuk:</label>
            <input type="time" id="jamMasuk" name="jamMasuk">
        </div>

        <div class="form-group">
            <label for="jamPulang">Jam Pulang:</label>
            <input type="time" id="jamPulang" name="jamPulang">
        </div>

        <div class="form-group">
            <input type="submit" value="Simpan Data">
        </div>
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
        const kembaliButton = document.getElementById("kembaliButton");

        // Tambahkan event listener untuk tombol "Tambah Data"
        tambahDataButton.addEventListener("click", function() {
            if (tambahDataForm.style.display === "none" || getComputedStyle(tambahDataForm).display === "none") {
                tambahDataForm.style.display = "block";
                kembaliButton.style.display = "inline-block"; // Tampilkan tombol "Kembali"
            } else {
                tambahDataForm.style.display = "none";
                kembaliButton.style.display = "none"; // Sembunyikan tombol "Kembali"
            }
        });

        // Tambahkan event listener untuk tombol "Kembali"
        kembaliButton.addEventListener("click", function() {
            tambahDataForm.style.display = "none";
            kembaliButton.style.display = "none"; // Sembunyikan tombol "Kembali"
        });

        const modeToggle = document.getElementById("modeToggle");
        const body = document.body;

    // Event listener untuk tombol mode gelap/terang
    modeToggle.addEventListener("click", function () {
        if (body.classList.contains("dark-mode")) {
            // Saat ini dalam mode gelap, ganti ke mode terang
            body.classList.remove("dark-mode");
            modeToggle.innerHTML = '<i class="fas fa-sun"></i> '; // Ganti ikon dan teks
        } else {
            // Saat ini dalam mode terang, ganti ke mode gelap
            body.classList.add("dark-mode");
            modeToggle.innerHTML = '<i class="fas fa-moon"></i> '; // Ganti ikon dan teks
        }console.log("Tombol mode gelap/terang ditekan");
    });
    </script>
</body>
</html>

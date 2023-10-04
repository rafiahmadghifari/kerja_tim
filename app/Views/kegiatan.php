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
        <form action="kegiatan.php" method="post">
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

            <input type="submit" value="Tambahkan Data">
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
            // Load data dari file CSV (contoh)
            $dataKegiatan = [];
            if (($handle = fopen("data_kegiatan.csv", "r")) !== false) {
                while (($data = fgetcsv($handle, 1000, ",")) !== false) {
                    $dataKegiatan[] = $data;
                }
                fclose($handle);
            }

            // Menampilkan data dari CSV ke dalam tabel
            foreach ($dataKegiatan as $key => $data) {
                echo "<tr>";
                echo "<td>" . $data[0] . "</td>";
                echo "<td>" . $data[1] . "</td>";
                echo "<td>" . $data[2] . "</td>";
                echo "<td>" . $data[3] . "</td>";
                echo "<td>" . $data[4] . "</td>";
                echo "<td>" . $data[5] . "</td>";
                echo "<td><a href='edit.php?id=$key'>Edit</a></td>";
                echo "<td><a href='hapusabsen.php?id=$key'>Hapus</a></td>";
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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Kegiatan</title>
    <style>
        /* CSS untuk latar belakang form */
        body {
            background-color: #f0f0f0;
            padding: 20px;
            font-family: Arial, sans-serif;
        }

        /* CSS untuk form */
        .form {
            max-width: 400px;
            margin: 0 auto;
        }

        .form label {
            display: block;
            margin-bottom: 5px;
        }

        .form input {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        /* CSS untuk tombol "Simpan Perubahan" */
        .button {
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
    </style>
</head>
<body>
    <h3>Edit Kegiatan</h3>

    <?php
    $dataKegiatan = loadKegiatanData();

    $id = $_GET['id'];
    
    // Pastikan ID valid, misalnya, apakah ID tersebut ada dalam array $dataKegiatan (yang akan didefinisikan di "prosesedit.php").
    if (array_key_exists($id, $dataKegiatan)) {
        $dataToEdit = $dataKegiatan[$id];
    } else {
        echo "ID tidak valid.";
        exit;
    }
    ?>

    <!-- Form untuk mengedit data -->
    <div class="form">
        <form action="prosesedit.php" method="post">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <label for="nama">Nama:</label>
            <input type="text" name="nama" value="<?php echo $dataToEdit['nama']; ?>"><br>

            <label for="jurusan">Jurusan:</label>
            <input type="text" name="jurusan" value="<?php echo $dataToEdit['jurusan']; ?>"><br>

            <label for="kehadiran">Kehadiran:</label>
            <input type="text" name="kehadiran" value="<?php echo $dataToEdit['kehadiran']; ?>"><br>

            <label for="jamMasuk">Jam Masuk:</label>
            <input type="text" name="jamMasuk" value="<?php echo $dataToEdit['jamMasuk']; ?>"><br>

            <label for="jamPulang">Jam Pulang:</label>
            <input type="text" name="jamPulang" value="<?php echo $dataToEdit['jamPulang']; ?>"><br>

            <label for="tanggal">Tanggal:</label>
            <input type="text" name="tanggal" value="<?php echo $dataToEdit['tanggal']; ?>"><br>

            <input type="submit" value="Simpan Perubahan" class="button">
        </form>
    </div>
</body>
</html>

<?php
require_once('kegiatan.php');

// Pengecekan apakah 'id' ada dalam query string
$id = isset($_GET["id"]) ? $_GET["id"] : null;

// Mengambil data kegiatan yang akan diedit
$dataToEdit = getData($id);

// Pengecekan apakah data ditemukan
if (!$dataToEdit) {
    echo "Data kegiatan tidak ditemukan.";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Tangani pembaruan data
    $namaBaru = $_POST["nama"];
    $tanggalBaru = $_POST["tanggal"];
    $jamBaru = $_POST["jam"];
    $kegiatanBaru = $_POST["kegiatan"];

    // Update data kegiatan yang sesuai di dalam array
    $dataToEdit["nama"] = $namaBaru;
    $dataToEdit["tanggal"] = $tanggalBaru;
    $dataToEdit["jam"] = $jamBaru;
    $dataToEdit["kegiatan"] = $kegiatanBaru;

    // Redirect kembali ke halaman utama setelah pembaruan
    header("Location: kegiatan.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Kegiatan</title>
    <!-- Masukkan CSS atau styling yang sesuai di sini -->
</head>
<body>
    <h3>Edit Kegiatan</h3>

    <!-- Formulir Edit Data -->
    <form action="editkegiatan.php?id=<?php echo $id; ?>" method="post">
        <label for="nama">Nama:</label>
        <input type="text" id="nama" name="nama" value="<?php echo $dataToEdit["nama"]; ?>"><br><br>

        <label for="tanggal">Tanggal:</label>
        <input type="date" id="tanggal" name="tanggal" value="<?php echo $dataToEdit["tanggal"]; ?>"><br><br>

        <label for="jam">Jam:</label>
        <input type="time" id="jam" name="jam" value="<?php echo $dataToEdit["jam"]; ?>"><br><br>

        <label for="kegiatan">Kegiatan:</label>
        <textarea id="kegiatan" name="kegiatan"><?php echo $dataToEdit["kegiatan"]; ?></textarea><br><br>

        <input type="submit" value="Simpan Perubahan">
    </form>
</body>
</html>

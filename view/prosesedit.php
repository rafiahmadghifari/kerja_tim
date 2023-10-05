<?php
// Pastikan Anda memiliki $dataKegiatan sebelumnya.
// Misalnya, Anda telah mengisi $dataKegiatan dengan data-data sebelumnya.

// Proses edit data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];

    // Pastikan ID valid, misalnya, apakah ID tersebut ada dalam array $dataKegiatan.
    if (array_key_exists($id, $dataKegiatan)) {
        $dataToEdit = $dataKegiatan[$id];

        // Perbarui data sesuai input dari formulir
        $dataToEdit['nama'] = $_POST['nama'];
        $dataToEdit['jurusan'] = $_POST['jurusan'];
        $dataToEdit['kehadiran'] = $_POST['kehadiran'];
        $dataToEdit['jamMasuk'] = $_POST['jamMasuk'];
        $dataToEdit['jamPulang'] = $_POST['jamPulang'];
        $dataToEdit['tanggal'] = $_POST['tanggal'];

        // Simpan kembali data yang sudah diperbarui ke dalam array
        $dataKegiatan[$id] = $dataToEdit;

        // Redirect kembali ke halaman kegiatan.php
        header("Location: absen.php");
        exit;
    } else {
        echo "ID tidak valid.";
        exit;
    }
} else {
    echo "ID tidak ditemukan.";
    exit;
}
?>

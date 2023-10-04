<?php
// Jika Anda memiliki $dataKegiatan sebelumnya, Anda bisa menggunakannya di sini.
// Pastikan data sudah ada sebelum mencoba mengedit.

// Proses edit data
if (isset($_POST['id'])) {
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
        header("Location: kegiatan.php");
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

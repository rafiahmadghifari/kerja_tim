<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    // Hapus data berdasarkan $id
    unset($dataKegiatan[$id]);
}

// Redirect kembali ke halaman kegiatan.php
header("Location: kegiatan.php");
exit;
?>

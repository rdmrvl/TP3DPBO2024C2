<?php
include('config/db.php');
include('classes/DB.php');
include('classes/Penduduk.php');

$penduduk = new Penduduk($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$penduduk->open();

$id = isset($_GET['id']) ? $_GET['id'] : null;
if ($id !== null) {
    $result = $penduduk->deletePenduduk($id);
    if ($result) {
        echo "<script>
            alert('Penduduk dengan ID $id berhasil dihapus!');
            window.location.href = 'index.php';
        </script>";
    } else {
        echo "<script>
            alert('Penduduk dengan ID $id berhasil dihapus!');
            window.location.href = 'index.php';
        </script>";
    }
    exit();
}


$penduduk->close();
?>
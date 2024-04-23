<?php
include('config/db.php');
include('classes/DB.php');
include('classes/Kecamatan.php');
include('classes/Penghasilan.php');
include('classes/Penduduk.php');
include('classes/Template.php');

$penduduk = new Penduduk($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$penduduk->open();

// Mendapatkan data kecamatan
$kecamatan = new Kecamatan($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$kecamatan->open();
$kecamatanOptions = '';
$kecamatan->getKecamatan();
while ($row = $kecamatan->getResult()) {
    $kecamatanOptions .= '<option value="' . $row['id_kecamatan'] . '">' . $row['nama_kecamatan'] . '</option>';
}
$kecamatan->close();

// Mendapatkan data penghasilan
$penghasilan = new Penghasilan($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$penghasilan->open();
$penghasilanOptions = '';
$penghasilan->getPenghasilan();
while ($row = $penghasilan->getResult()) {
    $penghasilanOptions .= '<option value="' . $row['id_penghasilan'] . '">' . $row['jumlah_penghasilan'] . '</option>';
}
$penghasilan->close();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $namaPenduduk = $_POST['nama'];
    $nikPenduduk = $_POST['nik'];
    $kecamatanId = $_POST['kecamatan'];
    $penghasilanId = $_POST['penghasilan'];
    
    // Upload foto
    $foto = $_FILES['foto']['name'];
    $foto_temp = $_FILES['foto']['tmp_name'];
    $foto_path = 'assets/images/' . $foto;
    
    if (move_uploaded_file($foto_temp, $foto_path)) {
        $result = $penduduk->addPenduduk($nikPenduduk,$namaPenduduk, $foto ,$kecamatanId, $penghasilanId);
        echo "<script>
            alert('Data berhasil ditambah!');
            window.location.href = 'index.php';
        </script>";
    } else {
        echo "<script>
            alert('Gagal mengupload foto!');
            document.location.href = 'tambahpenduduk.php';
        </script>";
    }
    
}

$penduduk->close();

$view = new Template('templates/skintambahpenduduk.html');
$view->replace('DATA_KECAMATAN_OPTIONS', $kecamatanOptions);
$view->replace('DATA_PENGHASILAN_OPTIONS', $penghasilanOptions);
$view->write();

?>

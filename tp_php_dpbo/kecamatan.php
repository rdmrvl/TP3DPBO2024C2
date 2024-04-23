<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Kecamatan.php');
include('classes/Template.php');

$kecamatan = new Kecamatan($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$kecamatan->open();

if (!isset($_GET['id'])) {
    if (isset($_POST['submit'])) {
        if ($kecamatan->addKecamatan($_POST) > 0) {
            echo "<script>
                alert('Data berhasil ditambah!');
                document.location.href = 'kecamatan.php';
            </script>";
        } else {
            echo "<script>
                alert('Data gagal ditambah!');
                document.location.href = 'kecamatan.php';
            </script>";
        }
    }

    $btn = 'Tambah';
    $title = 'Tambah';
}

$view = new Template('templates/skintabel.html');

$mainTitle = 'Kecamatan';
$header = '<tr>
<th scope="row">No.</th>
<th scope="row">Nama Kecamatan</th>
</tr>';
$data = null;
$no = 1;
$formLabel = 'Kecamatan';

$kecamatan->getKecamatan();

while ($row = $kecamatan->getResult()) {
    $data .= '<tr>
    <th scope="row">' . $no . '</th>
    <td>' . $row['nama_kecamatan'] . '</td>
    
    </tr>';
    $no++;
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($id > 0) {
        if (isset($_POST['submit'])) {
            if ($kecamatan->updateKecamatan($id, $_POST) > 0) {
                echo "<script>
                alert('Data berhasil diubah!');
                document.location.href = 'kecamatan.php';
            </script>";
            } else {
                echo "<script>
                alert('Data gagal diubah!');
                document.location.href = 'kecamatan.php';
            </script>";
            }
        }

        $kecamatan->getKecamatanById($id);
        $row = $kecamatan->getResult();

        $dataUpdate = $row['nama_kecamatan'];
        $btn = 'Simpan';
        $title = 'Ubah';

        $view->replace('DATA_VAL_UPDATE', $dataUpdate);
    }
}

if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    if ($id > 0) {
        if ($kecamatan->deleteKecamatan($id) > 0) {
            echo "<script>
                alert('Data berhasil dihapus!');
                document.location.href = 'kecamatan.php';
            </script>";
        } else {
            echo "<script>
                alert('Data gagal dihapus!');
                document.location.href = 'kecamatan.php';
            </script>";
        }
    }
}

$kecamatan->close();

$view->replace('DATA_MAIN_TITLE', $mainTitle);
$view->replace('DATA_TABEL_HEADER', $header);
$view->replace('DATA_TITLE', $title);
$view->replace('DATA_BUTTON', $btn);
$view->replace('DATA_FORM_LABEL', $formLabel);
$view->replace('DATA_TABEL', $data);
$view->write();
?>

<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Penghasilan.php');
include('classes/Template.php');

$penghasilan = new Penghasilan($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$penghasilan->open();

// Proses tambah data
if (isset($_POST['submit'])) {
    if ($penghasilan->addPenghasilan($_POST) > 0) {
        echo "<script>
            alert('Data berhasil ditambah!');
            document.location.href = 'Penghasilan.php';
        </script>";
    } else {
        echo "<script>
            alert('Data gagal ditambah!');
            document.location.href = 'Penghasilan.php';
        </script>";
    }
}

$btn = 'Tambah';
$title = 'Tambah';

$view = new Template('templates/skinpenghasilan.html');

$mainTitle = 'Penghasilan';
$header = '<tr>
<th scope="col">No.</th>
<th scope="col">Jumlah Penghasilan</th>
</tr>';
$data = null;
$no = 1;
$formLabel = 'Penghasilan';

$penghasilan->getPenghasilan();

while ($row = $penghasilan->getResult()) {
    $data .= '<tr>
    <td>' . $no . '</td>
    <td>' . $row['jumlah_penghasilan'] . '</td>
    </tr>';
    $no++;
}

// Proses update data
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($id > 0) {
        if (isset($_POST['submit'])) {
            if ($penghasilan->updatePenghasilan($id, $_POST) > 0) {
                echo "<script>
                alert('Data berhasil diubah!');
                document.location.href = 'Penghasilan.php';
            </script>";
            } else {
                echo "<script>
                alert('Data gagal diubah!');
                document.location.href = 'Penghasilan.php';
            </script>";
            }
        }

        $penghasilan->getPenghasilanById($id);
        $row = $penghasilan->getResult();

        $dataUpdate = $row['jumlah_penghasilan'];
        $btn = 'Simpan';
        $title = 'Ubah';

        $view->replace('DATA_VAL_UPDATE', $dataUpdate);
    }
}

// Proses hapus data
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    if ($id > 0) {
        if ($penghasilan->deletePenghasilan($id) > 0) {
            echo "<script>
                alert('Data berhasil dihapus!');
                document.location.href = 'Penghasilan.php';
            </script>";
        } else {
            echo "<script>
                alert('Data gagal dihapus!');
                document.location.href = 'Penghasilan.php';
            </script>";
        }
    }
}

$penghasilan->close();

$view->replace('DATA_MAIN_TITLE', $mainTitle);
$view->replace('DATA_TABEL_HEADER', $header);
$view->replace('DATA_TITLE', $title);
$view->replace('DATA_BUTTON', $btn);
$view->replace('DATA_FORM_LABEL', $formLabel);
$view->replace('DATA_TABEL', $data);
$view->write();
?>

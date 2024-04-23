<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Kecamatan.php');
include('classes/Penghasilan.php');
include('classes/Penduduk.php');
include('classes/Template.php');

// buat instance penduduk
$listPenduduk = new Penduduk($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);

// buka koneksi
$listPenduduk->open();

$listPenduduk->getPendudukJoin();

// cari penduduk
if (isset($_POST['btn-cari'])) {
    $keyword = $_POST['cari'];
    $filter = $_POST['filter'];
    $listPenduduk->getPendudukJoin($keyword, $filter);
} else {
    // method menampilkan data penduduk
    $listPenduduk->getPendudukJoin();
}

$data = null;

// ambil data penduduk
// gabungkan dengan tag html
// untuk dipassing ke skin/template
while ($row = $listPenduduk->getResult()) {
    $data .= '<div class="col gx-2 gy-3 justify-content-center">' .
        '<div class="card pt-4 px-2 penduduk-thumbnail">
        <a href="detail.php?id=' . $row['id_penduduk'] . '">
            <div class="row justify-content-center">
                <img src="assets/images/' . $row['foto_penduduk'] . '" class="card-img-top" alt="' . $row['foto_penduduk'] . '">
            </div>
            <div class="card-body">
                <p class="card-text penduduk-nama my-0">' . $row['nama_penduduk'] . '</p>
                <p class="card-text nik-penduduk">' . $row['nik_penduduk'] . '</p>
                <p class="card-text kecamatan">' . $row['nama_kecamatan'] . '</p>
                <p class="card-text penghasilan">' . $row['jumlah_penghasilan'] . '</p>
            </div>
        </a>
        </div>
    </div>';
}

// tutup koneksi
$listPenduduk->close();

// buat instance template
$home = new Template('templates/skin.html');

// simpan data ke template
$home->replace('DATA_PENDUDUK', $data);
$home->write();


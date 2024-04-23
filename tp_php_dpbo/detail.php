<?php
include('config/db.php');
include('classes/DB.php');
include('classes/Kecamatan.php');
include('classes/Penghasilan.php');
include('classes/Penduduk.php');
include('classes/Template.php');

$penduduk = new Penduduk($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$penduduk->open();

$data = null;

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($id > 0) {
        $penduduk->getPendudukById($id);
        $row = $penduduk->getResult();

        $kecamatan = new Kecamatan($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
        $kecamatan->open();
        $kecamatan->getKecamatanById($row['id_kecamatan']);
        $kecamatanData = $kecamatan->getResult();
        $kecamatan->close();

        $penghasilan = new Penghasilan($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
        $penghasilan->open();
        $penghasilan->getPenghasilanById($row['id_penghasilan']);
        $penghasilanData = $penghasilan->getResult();
        $penghasilan->close();

        $data .= '<div class="card-header text-center">
        <h3 class="my-0">Detail ' . $row['nama_penduduk'] . '</h3>
        </div>
        <div class="card-body text-end">
            <div class="row mb-5">
                <div class="col-3">
                    <div class="row justify-content-center">
                        <img src="assets/images/' . $row['foto_penduduk'] . '" class="img-thumbnail" alt="' . $row['foto_penduduk'] . '" width="60">
                    </div>
                </div>
                <div class="col-9">
                    <div class="card px-3">
                        <table border="0" class="text-start">
                            <tr>
                                <td>Nama</td>
                                <td>:</td>
                                <td>' . $row['nama_penduduk'] . '</td>
                            </tr>
                            <tr>
                                <td>NIK</td>
                                <td>:</td>
                                <td>' . $row['nik_penduduk'] . '</td>
                            </tr>
                            <tr>
                                <td>Kecamatan</td>
                                <td>:</td>
                                <td>' . $kecamatanData['nama_kecamatan'] . '</td> 
                            </tr>
                            <tr>
                                <td>Penghasilan</td>
                                <td>:</td>
                                <td>' . $penghasilanData['jumlah_penghasilan'] . '</td> 
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card-footer text-end">
                <a href="updatePenduduk.php?id=' . $id . '"><button type="button" class="btn btn-success text-white" id="btnUbah">Ubah Data</button></a>
                <a href="deletePenduduk.php?id=' . $id . '" onclick="return confirm(\'Apakah Anda yakin ingin menghapus data ini?\')"><button type="button" class="btn btn-danger">Hapus Data</button></a>
            </div>
            
        </div>';
    }
}


$penduduk->close();
$detail = new Template('templates/skindetail.html');
$detail->replace('DATA_DETAIL_PENDUDUK', $data);
$detail->write();
?>

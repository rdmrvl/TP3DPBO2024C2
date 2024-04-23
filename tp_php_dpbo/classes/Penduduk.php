<?php

class Penduduk extends DB
{
    function getPendudukJoin($keyword = '', $filter = '')
    {
        $query = "SELECT * FROM penduduk 
                JOIN kecamatan ON penduduk.id_kecamatan=kecamatan.id_kecamatan 
                JOIN penghasilan ON penduduk.id_penghasilan=penghasilan.id_penghasilan";

        if (!empty($keyword)) {
            if ($filter == 'nik') {
                $query .= " WHERE nik_penduduk LIKE '%$keyword%'";
            } elseif ($filter == 'nama') {
                $query .= " WHERE nama_penduduk LIKE '%$keyword%'";
            } elseif ($filter == 'kecamatan') {
                $query .= " WHERE nama_kecamatan LIKE '%$keyword%'";
            } else {
                $query .= " WHERE nik_penduduk LIKE '%$keyword%' OR nama_penduduk LIKE '%$keyword%' OR nama_kecamatan LIKE '%$keyword%'";
            }
        }

        $query .= " ORDER BY penduduk.id_penduduk";

        return $this->execute($query);
    }



    function getPenduduk()
    {
        $query = "SELECT * FROM penduduk";
        return $this->execute($query);
    }

    function getPendudukById($id)
    {
        $query = "SELECT * FROM penduduk WHERE id_penduduk=$id";
        return $this->execute($query);
    }

    function addPenduduk($nik, $nama, $foto, $kecamatanId, $penghasilanId)
    {
        $nama = $this->escapeString($nama);
        $foto = $this->escapeString($foto);
        $nik = $this->escapeString($nik);
        $kecamatanId = (int)$kecamatanId;
        $penghasilanId = (int)$penghasilanId;

        $query = "INSERT INTO penduduk (nik_penduduk, nama_penduduk, foto_penduduk, id_kecamatan, id_penghasilan) VALUES ('$nik', '$nama', '$foto', $kecamatanId, $penghasilanId)";

        return $this->execute($query);
    }

    function updatePenduduk($id, $nama, $nik, $foto, $kecamatanId, $penghasilanId) {
        $nama = $this->escapeString($nama);
        $nik = $this->escapeString($nik);
        $foto = $this->escapeString($foto);
        $kecamatanId = (int)$kecamatanId;
        $penghasilanId = (int)$penghasilanId;
    
        $sql = "UPDATE penduduk SET nama_penduduk=?, nik_penduduk=?, foto_penduduk=?, id_kecamatan=?, id_penghasilan=? WHERE id_penduduk=?";
        
        $stmt = $this->prepare($sql);
        $stmt->bind_param('sssiis', $nama, $nik, $foto, $kecamatanId, $penghasilanId, $id);
        $stmt->execute();
        $stmt->close();
    }
    
    

    function deletePenduduk($id)
    {
        $query = "DELETE FROM penduduk WHERE id_penduduk=$id";

        return $this->execute($query);
    }

}
<?php

class Kecamatan extends DB
{
    function getKecamatan()
    {
        $query = "SELECT * FROM kecamatan";
        return $this->execute($query);
    }

    

    function getKecamatanById($id)
    {
        $query = "SELECT * FROM kecamatan WHERE id_kecamatan=$id";
        return $this->execute($query);
    }

    function updateKecamatan($id, $data)
    {
        $nama_kecamatan = $data['nama_kecamatan'];
        $query = "UPDATE kecamatan SET nama_kecamatan='$nama_kecamatan' WHERE id_kecamatan=$id";
        return $this->execute($query);
    }

    function deleteKecamatan($id)
    {
        $query = "DELETE FROM kecamatan WHERE id_kecamatan=$id";
        return $this->execute($query);
    }
}

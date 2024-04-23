<?php

class Penghasilan extends DB
{
    function getPenghasilan()
    {
        $query = "SELECT * FROM penghasilan";
        return $this->execute($query);
    }

    function getPenghasilanById($id)
    {
        $query = "SELECT * FROM penghasilan WHERE id_penghasilan=$id";
        return $this->execute($query);
    }

    function addPenghasilan($data)
    {
        $nama_penghasilan = $this->escapeString($data['nama_penghasilan']);
        $query = "INSERT INTO penghasilan (nama_penghasilan) VALUES ('$nama_penghasilan')";
        return $this->execute($query);
    }

    function updatePenghasilan($id, $data)
    {
        $nama_penghasilan = $this->escapeString($data['nama_penghasilan']);
        $query = "UPDATE penghasilan SET nama_penghasilan='$nama_penghasilan' WHERE id_penghasilan=$id";
        return $this->execute($query);
    }

    function deletePenghasilan($id)
{
    // Check if the penghasilan is used in any other table
    $checkQuery = "SELECT COUNT(*) as total FROM penduduk WHERE id_penghasilan=$id";
    $checkResult = $this->execute($checkQuery);

    if ($checkResult[0]['total'] > 0) {
        return false; // Return false if the penghasilan is used in other table
    }

    $query = "DELETE FROM penghasilan WHERE id_penghasilan=$id";
    return $this->execute($query);
}

    
}

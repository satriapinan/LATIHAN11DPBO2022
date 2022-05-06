<?php

class Peminjaman extends DB
{
    function getPeminjaman()
    {
        $query = "SELECT * FROM peminjaman";
        return $this->execute($query);
    }

    function add($data)
    {
        date_default_timezone_set('Asia/Jakarta');
        $pinjam = date("y/m/d h:i:s");
        $book = $data['tbook'];
        $member = $data['tmember'];

        $query = "INSERT INTO peminjaman VALUES ('', '$pinjam', '', '$book', '$member')";

        // Mengeksekusi query
        return $this->execute($query);
    }

    function delete($id)
    {
        $query = "DELETE FROM peminjaman WHERE id_peminjaman = '$id'";

        // Mengeksekusi query
        return $this->execute($query);
    }

    function setReturned($id)
    {
        date_default_timezone_set('Asia/Jakarta');
        $kembali = date("y/m/d h:i:s");

        $query = "UPDATE peminjaman SET datetime_kembali = '$kembali' WHERE id_peminjaman='$id'";

        // Mengeksekusi query
        return $this->execute($query);
    }
}


?>
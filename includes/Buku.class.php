<?php

class Buku extends DB
{
    function getBuku()
    {
        $query = "SELECT * FROM buku";
        return $this->execute($query);
    }

    function add($data)
    {
        $judul = $data['tjudul'];
        $penerbit = $data['tpenerbit'];
        $deskripsi = $data['tdeskripsi'];
        $status = "-";
        $author = $data['cmbauthor'];

        $query = "insert into buku values ('', '$judul', '$penerbit', '$deskripsi', '$status', '$author')";

        // Mengeksekusi query
        return $this->execute($query);
    }

    function delete($id)
    {

        $query = "delete FROM buku WHERE id_buku = '$id'";

        // Mengeksekusi query
        return $this->execute($query);
    }

    function statusBuku($id)
    {

        $status = "Best Seller";
        $query = "update buku set status = '$status' where id_buku = '$id'";

        // Mengeksekusi query
        return $this->execute($query);
    }

    function getJudul($id) 
    {
        $query = "SELECT judul_buku FROM buku WHERE id_buku='$id'";
        $result = $this->execute($query);
        if(mysqli_num_rows($result) > 0)
        {
            while($row = mysqli_fetch_array($result))
            {
                $judul =  $row['judul_buku'];
            }
        }
        return $judul;
    }
}


?>
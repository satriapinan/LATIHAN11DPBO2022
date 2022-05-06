<?php

class Member extends DB
{
    function getMember()
    {
        $query = "SELECT * FROM member";
        return $this->execute($query);
    }

    function add($data)
    {
        $nim = $data['tnim'];
        $nama = $data['tnama'];
        $jurusan = $data['tjurusan'];

        $query = "INSERT INTO member VALUES ('$nim', '$nama', '$jurusan')";

        // Mengeksekusi query
        return $this->execute($query);
    }

    function update($data)
    {
        $nim = $data['tnim'];
        $nama = $data['tnama'];
        $jurusan = $data['tjurusan'];

        $query = "UPDATE member SET nama = '$nama', jurusan = '$jurusan' WHERE nim='$nim'";

        // Mengeksekusi query
        return $this->execute($query);
    }

    function delete($id)
    {
        $query = "DELETE FROM member WHERE nim = '$id'";

        // Mengeksekusi query
        return $this->execute($query);
    }

    function getNIM($id) 
    {
        $query = "SELECT nim FROM member WHERE nim='$id'";
        $result = $this->execute($query);
        if(mysqli_num_rows($result) > 0)
        {
            while($row = mysqli_fetch_array($result))
            {
                $nim =  $row['nim'];
            }
        }
        return $nim;
    }

    function getNama($id) 
    {
        $query = "SELECT nama FROM member WHERE nim='$id'";
        $result = $this->execute($query);
        if(mysqli_num_rows($result) > 0)
        {
            while($row = mysqli_fetch_array($result))
            {
                $nama =  $row['nama'];
            }
        }
        return $nama;
    }

    function getJurusan($id) 
    {
        $query = "SELECT jurusan FROM member WHERE nim='$id'";
        $result = $this->execute($query);
        if(mysqli_num_rows($result) > 0)
        {
            while($row = mysqli_fetch_array($result))
            {
                $jurusan =  $row['jurusan'];
            }
        }
        return $jurusan;
    }
}


?>
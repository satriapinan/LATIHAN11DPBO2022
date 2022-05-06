<?php

include("conf.php");
include("includes/Template.class.php");
include("includes/DB.class.php");
include("includes/Buku.class.php");
include("includes/Member.class.php");
include("includes/Peminjaman.class.php");

$buku = new Buku($db_host, $db_user, $db_pass, $db_name);
$member = new Member($db_host, $db_user, $db_pass, $db_name);
$peminjaman = new Peminjaman($db_host, $db_user, $db_pass, $db_name);
$buku->open();
$member->open();
$peminjaman->open();
$buku->getBuku();
$member->getMember();
$peminjaman->getPeminjaman();

if (isset($_POST['add'])) {
    //memanggil add
    $peminjaman->add($_POST);
    header("location:peminjaman.php");
}

if (!empty($_GET['id_hapus'])) {
    //memanggil add
    $id = $_GET['id_hapus'];

    $peminjaman->delete($id);
    header("location:peminjaman.php");
}

if (!empty($_GET['id_edit'])) {
    //memanggil add
    $id = $_GET['id_edit'];

    $peminjaman->setReturned($id);
    header("location:peminjaman.php");
}

$data = null;
$no = 1;
$judul_buku = null;
$nim_member = null;
$nama_member = null;

$peminjaman->getPeminjaman();
while (list($id_peminjaman, $datetime_pinjam, $datetime_kembali, $id_buku, $nim) = $peminjaman->getResult()) {
   if ($id_peminjaman != null) {
       $judul_buku = $buku->getJudul($id_buku);
       $nim_member = $member->getNIM($nim);
       $nama_member = $member->getNama($nim);
   }
   if ($datetime_kembali != "0000-00-00 00:00:00") {
        $data .= "<tr>
            <td>" . $no++ . "</td>
            <td>" . $judul_buku . "</td>
            <td>" . $nim_member . " - " . $nama_member . "</td>
            <td>" . $datetime_pinjam . "</td>
            <td>" . $datetime_kembali . "</td>
            <td>
            <a href='peminjaman.php?id_hapus=" . $id_peminjaman . "' class='btn btn-danger' '>Hapus</a>
            </td>
            </tr>";
    }
    else {
        $data .= "<tr>
            <td>" . $no++ . "</td>
            <td>" . $judul_buku . "</td>
            <td>" . $nim_member . " - " . $nama_member . "</td>
            <td>" . $datetime_pinjam . "</td>
            <td>" . $datetime_kembali . "</td>
            <td>
            <a href='peminjaman.php?id_edit=" . $id_peminjaman .  "' class='btn btn-success' '>Dikembalikan</a>
            <a href='peminjaman.php?id_hapus=" . $id_peminjaman . "' class='btn btn-danger' '>Hapus</a>
            </td>
            </tr>";
    }
}

$dataBook = null;
$dataMember = null;

$buku->getBuku();
while (list($id_buku, $judul, $penerbit, $deskripsi, $status, $author) = $buku->getResult()) {
    $dataBook .= "<option value='".$id_buku."'>".$judul."</option>";
}
$member->getMember();
while (list($nim, $nama, $jurusan) = $member->getResult()) {
    $dataMember .= "<option value='".$nim."'>".$nim." - ".$nama."</option>";
}

$member->close();
$buku->close();
$tpl = new Template("templates/peminjaman.html");
$tpl->replace("OPTIONBOOK", $dataBook);
$tpl->replace("OPTIONMEMBER", $dataMember);
$tpl->replace("DATA_TABEL", $data);
$tpl->write();

<?php

include("conf.php");
include("includes/Template.class.php");
include("includes/DB.class.php");
include("includes/Member.class.php");

$member = new Member($db_host, $db_user, $db_pass, $db_name);
$member->open();
$member->getMember();

if (isset($_POST['add'])) {
    //memanggil add
    $member->add($_POST);
    header("location:member.php");
}
if (isset($_POST['update'])) {
    //memanggil add
    $member->update($_POST);
    header("location:member.php");
}

if (!empty($_GET['id_hapus'])) {
    //memanggil delete
    $id = $_GET['id_hapus'];

    $member->delete($id);
    header("location:member.php");
}

$inputTitle = null;
$inputNIM = null;
$inputNama = null;
$inputJurusan = null;
$inputButton = null;

if (!empty($_GET['id_edit'])) {
    //memanggil delete
    $id = $_GET['id_edit'];

    $inputTitle .= "<h2 class='card-title'>Edit Member</h2>";
    $inputNIM .= "<input value='" . $member->getNIM($id) . "' type='text' class='form-control' name='tnim' readonly />";
    $inputNama .= "<input value='" . $member->getNama($id) . "' type='text' class='form-control' name='tnama' required />";
    $inputJurusan .= "<input value='" . $member->getJurusan($id) . "' type='text' class='form-control' name='tjurusan' required></input>";
    $inputButton .= "<button type='submit' name='update' class='btn btn-primary mt-3'>Update</button>";
} else {
    $inputTitle .= "<h2 class='card-title'>Add Member</h2>";
    $inputNIM .= "<input type='text' class='form-control' name='tnim' required />";
    $inputNama .= "<input type='text' class='form-control' name='tnama' required />";
    $inputJurusan .= "<input type='text' class='form-control' name='tjurusan' required></input>";
    $inputButton .= "<button type='submit' name='add' class='btn btn-primary mt-3'>Add</button>";
}

$form = null;
$form .= "INPUTTITLE
        <form action='member.php' method='POST'>
          <div class='form-row'>
            <div class='form-group col'>
              <label for='tnim'>NIM</label>
              INPUTNIM
            </div>
          </div>

          <div class='form-row'>
            <div class='form-group col'>
              <label for='tnama'>Nama</label>
              INPUTNAMA
            </div>
          </div>

          <div class='form-row'>
            <div class='form-group col'>
              <label for='tjurusan'>Jurusan</label>
              INPUTJURUSAN
            </div>
          </div>

          INPUTBUTTON
        </form>";

$data = null;
$no = 1;
$member->getMember();
while (list($nim, $nama, $jurusan) = $member->getResult()) {
    $data .= "<tr>
        <td>" . $no++ . "</td>
        <td>" . $nim . "</td>
        <td>" . $nama . "</td>
        <td>" . $jurusan . "</td>
        <td>
        <a href='member.php?id_edit=" . $nim .  "' class='btn btn-warning' '>Edit</a>
        <a href='member.php?id_hapus=" . $nim . "' class='btn btn-danger' '>Hapus</a>
        </td>
        </tr>";
}

$member->close();
$tpl = new Template("templates/member.html");
$tpl->replace("DATA_TABEL", $data);
$tpl->replace("FORM", $form);
$tpl->replace("INPUTTITLE", $inputTitle);
$tpl->replace("INPUTNIM", $inputNIM);
$tpl->replace("INPUTNAMA", $inputNama);
$tpl->replace("INPUTJURUSAN", $inputJurusan);
$tpl->replace("INPUTBUTTON", $inputButton);
$tpl->write();

?>
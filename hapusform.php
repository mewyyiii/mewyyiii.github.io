<?php
  include("koneksi.php");
  if (isset($_GET['id'])) {
    $id=$_GET['id'];
    // DELETE FROM `tbl_berita` WHERE `tbl_berita`.`id` =$id
    $qdelete="DELETE FROM `tb_form` WHERE `tb_form`.`id` =$id";
    $deleteb=$koneksi->query($qdelete);
    header("location:forms.php");
  }
 ?>
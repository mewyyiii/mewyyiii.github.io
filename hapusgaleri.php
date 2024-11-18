<?php
  include("koneksi.php");
  if (isset($_GET['id'])) {
    $id=$_GET['id'];
    // DELETE FROM `tbl_berita` WHERE `tbl_berita`.`id` =$id
    $qdelete="DELETE FROM `tb_galeri` WHERE `tb_galeri`.`id` =$id";
    $deleteb=$koneksi->query($qdelete);
    header("location:galeritampil.php");
  }
 ?>
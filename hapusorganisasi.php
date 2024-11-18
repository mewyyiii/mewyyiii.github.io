<?php
  include("koneksi.php");
  if (isset($_GET['id'])) {
    $id=$_GET['id'];
    // DELETE FROM `tbl_berita` WHERE `tbl_berita`.`id` =$id
    $qdelete="DELETE FROM `tb_organisasi` WHERE `tb_organisasi`.`id` =$id";
    $deleteb=$koneksi->query($qdelete);
    header("location:organisasitampil.php");
  }
 ?>
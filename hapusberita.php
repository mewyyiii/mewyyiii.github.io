<?php
  include("koneksi.php");
  if (isset($_GET['id'])) {
    $id=$_GET['id'];
    // DELETE FROM `tbl_berita` WHERE `tbl_berita`.`id` =$id
    $qdelete="DELETE FROM `tb_berita` WHERE `tb_berita`.`idberita` =$id";
    $deleteb=$koneksi->query($qdelete);
    header("location:beritatampil.php");
  }
 ?>
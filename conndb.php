<?php 
    include 'koneksi.php';
    $id = $_GET['id'];
    
    $data = "SELECT * FROM users WHERE id = '$id'";
    $update = mysqli_query($koneksi,$data);
?>
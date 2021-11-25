<?php
include 'config.php';

if(isset($_POST['regis'])){
    $namaD = $_POST['namaD'];
    $namaB = $_POST['namaB'];
    $email = $_POST['email-user'];
    $password = $_POST['pw-user'];
    $confpw = $_POST['konf-pw-user'];
    $hashedPass=password_hash($password,PASSWORD_DEFAULT);
    $TanggalLahir = $_POST['tanggal-lahir'];
    $noWA = $_POST['no-wa'];

    
    if(password_verify($confpw, $hashedPass)){
        $regis_query = "INSERT INTO Users(NamaDepan, NamaBelakang, email, password, TanggalLahir, no_WA) VALUES('$namaD', '$namaB', '$email', '$hashedPass', '$TanggalLahir', '$noWA')";
    
        $registrasi = mysqli_query($conn,$regis_query);

        if (!$registrasi ) {
            printf("error: %s\n", mysqli_error($conn));
        }else{
            header("location:index.php?alert=berhasil");
        }
    }else{
        header("location:index.php?alert=gagal");
    }
    
}

if($conn->connect_error){
    die('Connection Failed : '.$conn->connect_error);
}else{
    // $stmt = $conn->prepare
    
    // $stmt->bind_param("ssssss",$namaD, $namaB, $email, $password, $TanggalLahir, $noWA);
    // $stmt->execute();
}
?>
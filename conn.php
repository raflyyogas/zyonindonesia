<?php

$host = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "zyon";

$conn = new mysqli ($host, $dbusername, $dbpassword, $dbname);

if(isset($_POST['regis'])){
    echo 'tes';
    $namaD = $_POST['namaD'];
    $namaB = $_POST['namaB'];
    $email = $_POST['email-user'];
    $password = $_POST['pw-user'];
    $hashedPass=password_hash($password,PASSWORD_DEFAULT);
    $TanggalLahir = $_POST['tanggal-lahir'];
    $noWA = $_POST['no-wa'];

    $regis_query = "
    INSERT INTO 
    Users(NamaDepan, NamaBelakang, email, password, TanggalLahir, no_WA)
    VALUES('$namaD', '$namaB', '$email', '$hashedPass', '$TanggalLahir', '$noWA')
    ";
    
    $registrasi = mysqli_query($conn,$regis_query);
    printf($registrasi);
    if ( false===$registrasi ) {
        printf("error: %s\n", mysqli_error($conn));
        print_r($noWA);
      }

    if ($registrasi){
        header("location:index.php");
    }else{
        echo 'upload gagal';
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
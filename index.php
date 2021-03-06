<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Zyon Indonesia</title>
    <meta content="Dari Zyon, Untuk kamu" name="description" />
    <meta content="psychology, Consultant, Helper, Cares" name="keywords" />

    <!-- SEO TAGS -->
    <meta name="author" content="RYG, Ditra" />
    <meta name="robots" content="noindex,nofollow" />
    <meta name="google" content="nositelinkssearchbox" />

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon" />
    <link href="assets/img/favicon.png" rel="apple-touch-icon" />

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet" />
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet" />
    <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- Template Main CSS File -->
    <link rel="stylesheet" href="assets/css/style.css">

</head>

<body>

<?php 
	require('create.php');
	
    // <div aria-live='polite' aria-atomic='true' class='d-flex justify-content-center align-items-center w-100'>
    // <div class='toast-container position-absolute align-items-center text-white bg-primary border-0 bottom-0 start-0 show' role='alert' aria-live='assertive' aria-atomic='true'>
    //     <div class='d-flex'>
    //         <div class='toast-body'>
    //         Hello, world! This is a toast message.
    //         </div>
    //         <button type='button' class='btn-close btn-close-white me-2 m-auto' data-bs-dismiss='toast' aria-label='Close'></button>
    //     </div>
    // </div>
    // </div>
?>

    <!-- NAVIGATOR -->
    <div class="container-fluid navigator fixed-top">

<?php

    if(isset($_POST['login']))
    {
        if((isset($_POST['email-user']) && $_POST['email-user'] !='') && (isset($_POST['pw-user']) && $_POST['pw-user'] !=''))
        {

            $email_user = trim($_POST['email-user']);
            $password_user = trim($_POST['pw-user']);
            
            $sqlEmail = "select * from Users where email = '".$email_user."'";
            $rs = mysqli_query($conn,$sqlEmail);
            
            $numRows = mysqli_num_rows($rs);
            
            if($numRows  == 1)
            {
                $tampil = mysqli_fetch_array($rs);

                if(password_verify($password_user,$tampil['password']))
                {             
                    $_SESSION['user_id'] = $tampil['Id'];
                    if((!empty($_SESSION['user_id']))){
                        echo "
                        <div class='alert alert-success alert-dismissible fade show' role='alert'>
                            <strong>Berhasil Login!</strong> Halo ".$tampil['NamaDepan']."
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>
                        ";
                    };
                }
                else 
                {
                    echo "
                    <div class='alert alert-danger alert-dismissible fade show' role='alert'>
                        <strong>Gagal Login!</strong> Wrong Email Or Password
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>
                    ";
                }
            }
            else
            {
                echo "
                <div class='alert alert-danger alert-dismissible fade show' role='alert'>
                    <strong>Gagal Login!</strong> User not found
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>
                ";
            }
        }
    }
    
?>

<?php 
        if(isset($_GET['alert'])){
            if($_GET['alert']=="berhasil")
            {
                echo "
                    <div class='alert alert-success alert-dismissible fade show' role='alert'>
                        <strong>Berhasil Daftar!</strong> Silahkan Login
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>
                    ";
            } elseif($_GET['alert']=="gagal"){
                echo "
                    <div class='alert alert-danger alert-dismissible fade show' role='alert'>
                        <strong>Gagal Daftar!</strong> Password tidak sama
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>
                    ";
            }
        }
    ?>

        <div class="navigator-center">

            <nav class="navbar navbar-expand-lg navbar-dark navigator-box" id="navbar">

                <div class="container-fluid">

                    <a class="navbar-brand px-2" href="#">
                        <img src="assets/img/Logo.png" alt="logo" style="max-height: 45px;" id="logo">
                    </a>
                    <button class="navbar-toggler mx-3 toggler-minimize" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation" id="toggler">
                        <span class="navbar-toggler-icon" id="icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarText" style="width: 100vh;">
                        <ul class="navbar-nav nav nav-fill me-auto mb-2 mb-lg-0 w-100 px-2">
                            <li class="nav-item">
                                <a class="nav-link text-light" aria-current="page" href="#">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-light" href="#fitur">Fitur</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-light" href="#about">Tentang</a>
                            </li>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-light" href="#foot">Kontak</a>
                            </li>
                            <li class="nav-item">
                                
                                    <?php
                                    if(!empty($_SESSION['user_id'])){
                                        echo "
                                        <form action='dashboard.php' method='GET'>
                                            <button class='nav-link btn' style='border-style: none; color: white;' type='submit' value='".$tampil['Id']."' name='ID'>
                                                Dashboard
                                            </button>
                                        </form>
                                        ";
                                    }else{
                                        echo "
                                        <button class='btn btn-login' data-bs-toggle='modal' data-bs-target='#login-modal' id='login'>
                                        Login
                                        </button>
                                        ";
                                    }
                                    ?>
                                                          
                            </li>
                        </ul>
                    </div>

                </div>

            </nav>

        </div>
    </div>

    <!-- LOGIN MODAL -->
    <div class='modal content' id='login-modal' data-bs-backdrop='static' data-bs-keyboard='false' tabindex='-1' aria-labelledby='staticBackdropLabel' aria-hidden='true'>
        <div class='modal-dialog modal-dialog-centered'>

            <div class='modal-content'>
                <div class='modal-header p-5 pb-4 border-bottom-0'>
                    <h2 class='fw-bold mb-0'>Masuk</h2>
                    <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                </div>
                <div class='modal-body px-5 pb-5'>
                    <form action="<?php echo $_SERVER['PHP_SELF']?>" method='post'>
                        <div class='form-floating mb-3'>
                            <input type="email" name="email-user" class="form-control rounded-4" id="floatingInput" name="email" placeholder="name@example.com" required>
                            <label for="floatingInput">Email address</label>

                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">Please fill out this field.</div>
                        </div>
                        <div class='form-floating mb-3'>
                            <input type="password" name="pw-user" class="form-control rounded-4" id="floatingPassword" placeholder="Password" required>
                            <label for="floatingPassword">Password</label>

                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">Please fill out this field.</div>
                        </div>
                        <button name='login' type='submit' class='w-100 mb-2 btn btn-lg rounded-4 btn-primary'>
                            Masuk
                        </button>
                        <a class='btn' data-bs-toggle='modal' data-bs-target='#resetpass-modal' data-dismiss='modal' aria-label='Close'><small class='text-muted'>Lupa Password?</small></a>

                        <hr class='my-4'>

                        <h2 class='fs-5 fw-bold mb-3'>Belum memiliki akun?</h2>
                        <button class='w-100 mb-2 btn btn-lg rounded-4 btn-secondary' type='button' data-bs-toggle='modal' data-bs-target='#regis-modal' data-dismiss='modal' aria-label='Close'>
                            Registrasi
                        </button>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Lupa Pass MODAL -->
    <div class="modal content" id="resetpass-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">

            <div class="modal-content">
                <div class="modal-header p-5 pb-4 border-bottom-0">
                    <h2 class="fw-bold mb-0">Lupa Password</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-5 pb-5">
                    <form action="#" method="post">
                        <div class="form-floating mb-3">
                            <input type="email" name="email-user" class="form-control rounded-4" id="floatingInput" name="email" placeholder="name@example.com" required>
                            <label for="floatingInput">Email address</label>

                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">Please fill out this field.</div>
                        </div>
                        <button class="w-100 mb-2 btn btn-lg rounded-4 btn-warning" type="submit">
                            Kirim Email Verifikasi
                        </button>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Lupa Pass telah dikirim MODAL -->
    <div class="modal content" id="resetpass-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">

            <div class="modal-content">
                <div class="modal-body px-5 pb-5">

                </div>
            </div>
        </div>
    </div>

    <!-- REGIS MODAL -->
    <div class="modal content" id="regis-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">

            <div class="modal-content">
                <div class="modal-header p-5 pb-4 border-bottom-0">
                    <h2 class="fw-bold mb-0">Masuk</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-5 pb-5">
                    <form class="row g-3" action="create.php" method="post">
                        <div class="form-floating col-md-6">
                            <input type="text" name="namaD" class="form-control rounded-4" id="floatingInput" placeholder="abc">
                            <label class="px-3" for="#floatingInput">Nama Depan</label>

                            <div class="invalid-feedback">Please fill out this field.</div>
                        </div>
                        <div class="form-floating col-md-6">
                            <input type="text" name="namaB" class="form-control rounded-4" id="floatingInput" placeholder="abc">
                            <label class="px-3" for="#floatingInput">Nama Belakang</label>

                            <div class="invalid-feedback">Please fill out this field.</div>
                        </div>
                        <div class="form-floating col-md-12">
                            <input type="email" name="email-user" class="form-control rounded-4" id="floatingInput" placeholder="name@example.com" required>
                            <label class="px-3" for="floatingInput">Email address</label>

                            <div class="invalid-feedback">Please fill out this field.</div>
                        </div>
                        <div class="form-floating col-md-6">
                            <input type="password" name="pw-user" class="form-control rounded-4" id="floatingPassword" placeholder="Password" required>
                            <label class="px-3" for="floatingPassword">Password</label>

                            <div class="invalid-feedback">Please fill out this field.</div>
                        </div>
                        <div class="form-floating col-md-6">
                            <input type="password" name="konf-pw-user" class="form-control rounded-4" id="floatingInput" placeholder="password" required>
                            <label class="px-3" for="#floatingInput">Konfirmasi Password</label>

                            <div class="invalid-feedback">Please fill out this field.</div>
                        </div>
                        <div class="form-floating col-md-12">
                            <input type="date" name="tanggal-lahir" class="form-control rounded-4" id="floatingInput" placeholder="17/11/2021">
                            <label class="px-3" for="#floatingInput">Tanggal Lahir</label>

                            <div class="invalid-feedback">Please fill out this field.</div>
                        </div>
                        <div class="form-floating col-md-12">
                            <!-- NOMOR TELPON -->
                            <input type="text" name="no-wa" class="form-control rounded-4" id="phoneNumber" placeholder="(081x) xxxx-xxxx" required>
                            <label class="px-3" for="#phoneNumber">Nomor Handphone (Whatsapp)</label>

                            <div class="invalid-feedback">Please fill out this field.</div>
                        </div>
                        <br>

                        <div class="form-check col-mb-2">
                            <input class="form-check-input" type="checkbox" id="myCheck" name="remember" required />
                            <label class="form-check-label" for="myCheck">Saya Menyetujui</label>
                            <div class="invalid-feedback">Check this checkbox to continue.</div>
                        </div>
                        <button type="submit" name="regis" class="w-100 mb-2 btn btn-lg rounded-4 btn-primary">Daftarkan
                            Akun
                        </button>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- UTAMA -->
    <div class="container-fluid bg-image bg-cover" style="height: 100vh;">
        <div class="mask bg-cover-mask" style="height: 100vh;">

            <!-- ISI-UTAMA -->
            <div class="container-fluid konten-utama">
                <h1 class="text-utama">
                    Ayo Mulai Peduli pada Kesehatan Mental !
                </h1>
                <a class="button-utama" href="#fitur">
                    Konsultasi dengan Ekspert
                </a>
            </div>

        </div>
    </div>

    <!-- FITUR -->
    <div class="container-fluid" id="fitur" style="height: 110vh;">

        <!-- HEADER FITUR -->
        <div class="fitur-head">
            <h1 class="head-text">
                FITUR ZYON
            </h1>
        </div>

        <!-- ISI FITUR -->
        <ul class="nav nav-pills nav-justified fitur-navigator" id="pills-tab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active link-light border-rad" id="pills-konsultasi-tab" data-bs-toggle="pill" href="#pills-konsultasi" role="tab" aria-controls="pills-konsultasi" aria-selected="true">Konsultasi</a>
            </li>
            <li class="nav-item">
                <a class="nav-link link-light border-rad" id="pills-self-care-tab" data-bs-toggle="pill" href="#pills-self-care" role="tab" aria-controls="pills-self-care" aria-selected="false">Self
                    Care</a>
            </li>
            <li class="nav-item">
                <a class="nav-link link-light border-rad" id="pills-forum-tab" data-bs-toggle="pill" href="#pills-forum" role="tab" aria-controls="pills-forum" aria-selected="false">Forum</a>
            </li>
            <li class="nav-item">
                <a class="nav-link link-light border-rad" id="pills-podcast-tab" data-bs-toggle="pill" href="#pills-podcast" role="tab" aria-controls="pills-podcast" aria-selected="false">Podcast</a>
            </li>
        </ul>

        <div class="container mt-5">

            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-konsultasi" role="tabpanel" aria-labelledby="pills-home-tab">

                    <!-- ISI KONSULTASI -->

                    <div class="card mb-3 fitur-card">
                        <div class="row g-0" style="max-height: 4000px;">
                            <div class="col-md-4">
                                <div class="card-img-top img-konsultasi" style="background-image: url('assets/img/konsultasi.jpg');">
                                </div>
                            </div>
                            <div class="col-md-8 px-2">
                                <div class="card-body">
                                    <h2 class="konsultasi-head">KONSULTASI DENGAN EKSPERT</h2>

                                    <div class="card-text box-deskripsi-konsultasi">
                                        <p class="card-text">
                                            Zyon bekerja sama dengan biro-biro psikologi di Indonesia untuk mempermudah user menemukan dan melakukan Konsultasi
                                        </p>
                                    </div>

                                    <div class="card-text box-btn-konsultasi">
                                        <a class="btn-fitur-konsultasi" data-bs-toggle="modal" data-bs-target="#pilih-biro">
                                            MULAI KONSULTASI
                                        </a>
                                        <p style="margin: 10px;"><small class="text-muted">atau</small></p>
                                        <a class="btn-fitur-daftar-biro" href="https://api.whatsapp.com/send?phone=6282128863838&text=Saya%20tertarik%20mendaftarkan%20biro%20saya%20di%20Zyon.">
                                            DAFTAR MENJADI BIRO KONSULTAN
                                        </a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="tab-pane fade" id="pills-self-care" role="tabpanel" aria-labelledby="pills-profile-tab">

                    <!-- ISI SELF CARE -->

                    <h2 class="konsultasi-head pos-middle">COMING SOON</h2>

                </div>
                <div class="tab-pane fade" id="pills-forum" role="tabpanel" aria-labelledby="pills-contact-tab">

                    <!-- ISI FORUM -->

                    <h2 class="konsultasi-head pos-middle">COMING SOON</h2>

                </div>
                <div class="tab-pane fade" id="pills-podcast" role="tabpanel" aria-labelledby="pills-contact-tab">

                    <!-- ISI PODCAST -->

                    <h2 class="konsultasi-head pos-middle">COMING SOON</h2>

                </div> 

            </div>
        </div>


        <!-- PILIH BIRO MODAL -->
        <div class="modal content" id="pilih-biro" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">

                <div class="modal-content">
                    <div class="modal-header p-5 pb-4 border-bottom-0">
                        <h2 class="fw-bold mb-0">Pilih Biro</h2>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body mb-0">
                        <!-- Isi Biro -->
                        <div class="accordion isi-biro">
                            <div class="card">
                                <div class="card-header" id="headingOne">
                                    <h2 class="mb-0">
                                        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            ULP Fakultas Psikologi UIN SGD Bandung
                                        </button>
                                    </h2>
                                </div>

                                <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                                    <div class="card-body">
                                        ULP Fakultas Psikologi adalah biro psikologi yang berbasis di UIN SGD Bandung.
                                        <a href="https://api.whatsapp.com/send?phone=6282128863838&text=Saya%20tertarik%20melakukan%20konsultasi%20dengan%20ULP%20Fakultas%20Psikologi.">Lanjutkan</a>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="card">
                                <div class="card-header" id="headingTwo">
                                    <h2 class="mb-0">
                                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                            ULP Fakultas Psikologi UIN SGD Bandung
                                        </button>
                                    </h2>
                                </div>
                                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                    <div class="card-body">
                                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird
                                        on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat
                                        craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="headingThree">
                                    <h2 class="mb-0">
                                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                            ULP Fakultas Psikologi UIN SGD Bandung
                                        </button>
                                    </h2>
                                </div>
                                <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                                    <div class="card-body">
                                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird
                                        on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat
                                        craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                    </div>
                                </div>
                            </div> -->

                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- ABOUT US -->
    <!-- ======= About Section ======= -->
    <section id="about" class="about section-bg pb-5">
        <div class="container-fluid pt-5">
            <div class="head">
                <h3 class="text-center">Tentang Kami</h3>
                <p class="mx-3">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec scelerisque ligula dictum magna elementum, sit amet pretium mauris fermentum. Nam fringilla sem nibh, non rhoncus odio iaculis et. Donec hendrerit tempor quam eu venenatis. Aliquam ac bibendum
                    purus. Nullam id elementum elit. Aenean vel aliquet tortor, ultricies cursus ante.
                </p>
            </div>
            <div class="row">
                <div class="col-lg-5 video-box d-flex justify-content-center align-items-stretch position-relative">
                    <a href="https://www.youtube.com/watch?v=bIKB15NT7uk" class="play-btn mb-4" target="_blank"></a>
                </div>

                <div class="col-lg-7 icon-boxes d-flex flex-column align-items-stretch justify-content-center py-5 px-lg-5">
                    <h3 class="text-center">YANG BISA KAMU DAPATKAN ?</h3>

                    <div class="icon-box">
                        <div class="icon"><i class="fas fa-hands-helping"></i></div>
                        <h4 class="title">KONSULTASI</h4>
                        <p class="description">Voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident</p>
                    </div>

                    <div class="icon-box">
                        <div class="icon"><i class="far fa-comments"></i></i>
                        </div>
                        <h4 class="title">KOMUNIKASI</h4>
                        <p class="description">At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque</p>
                    </div>

                    <div class="icon-box">
                        <div class="icon"><i class="fas fa-hand-holding-heart"></i></div>
                        <h4 class="title">HASIL</h4>
                        <p class="description">Explicabo est voluptatum asperiores consequatur magnam. Et veritatis odit. Sunt aut deserunt minus aut eligendi omnis</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div id="preloader"></div>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- FOOTER -->
    <div class="footer text-center mt-auto py-2 foot" id="foot">
        <footer class="d-flex flex-wrap justify-content-between align-items-center my-2 w-100">
            <div class="col-md-4 d-flex align-items-center">
                <span class="logo"><img src="assets/img/Logo.png" alt="logo" width="200px"></span>
            </div>
            <div class="col-md-4 justify-content-end d-flex">
                <ul class="contact">
                    <li>
                        <a class="text-light row" href="https://wa.me/message/ORU2POH45X6OC1">
                            <span class="col-sm-4">
                                WHATSAPP
                            </span>
                            <span class="col-sm-8">
                                : +62 821-2886-3838
                            </span>
                        </a>
                    </li>
                    <li>
                        <a class="text-light row" href="https://www.instagram.com/zyon.id/">
                            <span class="col-sm-4">
                                INSTAGRAM
                            </span>
                            <span class="col-sm-8">
                                : @ZYON.ID
                            </span>
                        </a>
                    </li>
                    <li>
                        <a class="text-light row" href="tel:+6282128863838">
                            <span class="col-sm-4">
                                TELEPON
                            </span>
                            <span class="col-sm-8">
                                : +62 821-2886-3838
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
        </footer>
    </div>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>

    <!-- JS -->
    <script>
        const isNumericInput = (event) => {
            const key = event.keyCode;
            return ((key >= 48 && key <= 57) || // Allow number line
                (key >= 96 && key <= 105) // Allow number pad
            );
        };

        const isModifierKey = (event) => {
            const key = event.keyCode;
            return (event.shiftKey === true || key === 35 || key === 36) || // Allow Shift, Home, End
                (key === 8 || key === 9 || key === 13 || key === 46) || // Allow Backspace, Tab, Enter, Delete
                (key > 36 && key < 41) || // Allow left, up, right, down
                (
                    // Allow Ctrl/Command + A,C,V,X,Z
                    (event.ctrlKey === true || event.metaKey === true) &&
                    (key === 65 || key === 67 || key === 86 || key === 88 || key === 90)
                )
        };

        const enforceFormat = (event) => {
            // Input must be of a valid number format or a modifier key, and not longer than ten digits
            if (!isNumericInput(event) && !isModifierKey(event)) {
                event.preventDefault();
            }
        };

        const formatToPhone = (event) => {
            if (isModifierKey(event)) {
                return;
            }

            const input = event.target.value.replace(/\D/g, '').substring(0, 13); // First ten digits of input only
            const areaCode = input.substring(0, 4);
            const middle = input.substring(4, 8);
            const last = input.substring(8, 13);

            if (input.length > 7) {
                event.target.value = `(${areaCode}) ${middle}-${last}`;
            } else if (input.length > 4) {
                event.target.value = `(${areaCode}) ${middle}`;
            } else if (input.length > 0) {
                event.target.value = `(${areaCode}`;
            }
        };

        const inputElement = document.getElementById('phoneNumber');
        inputElement.addEventListener('keydown', enforceFormat);
        inputElement.addEventListener('keyup', formatToPhone);
    </script>
</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <style>
        body {
            background-image: url(<?= base_url('assets/img/bg2.png'); ?>);

        }
    </style>

    <title><?= $title; ?></title>

    <!-- Custom fonts for this template-->
    <link href="<?= base_url('assets/vendor/fontawesome-free/css/all.min.css'); ?>" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= base_url('assets/css/sb-admin-2.min.css'); ?>" rel="stylesheet">

</head>

<body style="font-family: 'Times New Roman', Times, serif;">
    <div class="container mt-5">

        <!-- Outer Row -->
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card bg-light o-hidden border-0 shadow-lg my-5 rounded-50">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg">
                                <div class="pl-5 pr-5">
                                    <form action="<?= site_url('admin/auth/check'); ?>" method="POST">
                                        <div class="brand text-center mt-4 mb-4">
                                            <h5 class="text-left"><i class="fa fa-map text-primary"></i> TransBantul</h5>
                                            <h1 class="mt-4"><?= $title; ?></h1>
                                            <?= $this->session->flashdata('info') ?>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user bg-light rounded-pill" name="nm_admin" placeholder="Username" required="" />
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user bg-light rounded-pill" name="password" placeholder="Password" required="" />
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary btn-block rounded-pill">
                                                <strong>Log in</strong>
                                            </button>
                                        </div>
                                        <hr>
                                       <div class="text-center">
                                            <a href="<?= site_url('admin/auth/pendaftaran'); ?>">Daftar</a>
                                            <!-- <a class="small" href="forgot-password.html">Forgot Password?</a> -->
                                        </div> 
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div> <!-- Bootstrap core JavaScript-->
    <script src="<?= base_url('assets/vendor/jquery/jquery.min.js'); ?>"></script>
    <script src="<?= base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?= base_url('assets/vendor/jquery-easing/jquery.easing.min.js'); ?>"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?= base_url('assets/js/sb-admin-2.min.js'); ?>"></script>

</body>

</html>
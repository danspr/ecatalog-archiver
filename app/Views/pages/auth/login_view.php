<!DOCTYPE html>
<html lang="en" dir="ltr" data-nav-layout="vertical" data-vertical-style="overlay" data-theme-mode="light" data-header-styles="light" data-menu-styles="light" data-toggled="close">

<head>
    <!-- Meta Data -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= $pageTitle ?></title>
    <meta name="Description" content="Bootstrap Responsive Admin Web Dashboard HTML5 Template">
    <meta name="Author" content="Spruko Technologies Private Limited">
	<meta name="keywords" content="admin,admin dashboard,admin panel,admin template,bootstrap,clean,dashboard,flat,jquery,modern,responsive,premium admin templates,responsive admin,ui,ui kit.">

    <!-- Favicon -->
    <link rel="icon" href="<?= base_url() ?>assets/images/brand-logos/smarteoq-favicon.png" type="image/x-icon">
    <!-- Main Theme Js -->
    <script src="<?= base_url() ?>assets/js/authentication-main.js"></script>
    <!-- Bootstrap Css -->
    <link id="style" href="<?= base_url() ?>assets/libs/bootstrap/css/bootstrap.min.css" rel="stylesheet" >
    <!-- Style Css -->
    <link href="<?= base_url() ?>assets/css/styles.min.css" rel="stylesheet" >
    <!-- Icons Css -->
    <link href="<?= base_url() ?>assets/css/icons.min.css" rel="stylesheet" >
    <!-- Toastr Css -->
    <link href="<?= base_url() ?>assets/css/libs/toastr.min.css" rel="stylesheet"  type="text/css" />

</head>

<body>
    <div class="container" id="app-wrapper">
        <div class="row justify-content-center align-items-center authentication authentication-basic h-100">
            <div class="col-xxl-4 col-xl-5 col-lg-5 col-md-6 col-sm-8 col-12">
                <div class="card custom-card">
                    <div class="card-body p-5">
                        <p class="h5 fw-semibold mb-2 text-center">Sign In</p>
                        <div class="mb-5 d-flex justify-content-center">
                            <a href="index.html">
                                <img src="<?= base_url() ?>assets/images/brand-logos/smarteoq-light-logo.png" alt="logo" class="desktop-logo">
                                <img src="<?= base_url() ?>assets/images/brand-logos/smarteoq-logo.png" alt="logo" class="desktop-dark">
                            </a>
                        </div>
                        <!-- <p class="mb-4 text-muted op-7 fw-normal text-center">Welcome to SmartEOQ</p> -->
                        <div class="row gy-3">
                            <div class="col-xl-12">
                                <label for="signin-username" class="form-label text-default">Username</label>
                                <input type="text" class="form-control form-control-lg" id="signin-username" placeholder="username" v-model="loginForm.username">
                            </div>
                            <div class="col-xl-12 mb-2">
                                <label for="signin-password" class="form-label text-default d-block">Password</label>
                                <div class="input-group">
                                    <input type="password" class="form-control form-control-lg" id="signin-password" placeholder="password" @keyup.enter="login()" v-model="loginForm.password">
                                    <button class="btn btn-light" type="button" onclick="createpassword('signin-password',this)" id="button-addon2"><i class="ri-eye-off-line align-middle"></i></button>
                                </div>
                            </div>

                            <div class="col-xl-12 d-grid mt-5">
                                <button class="btn btn-lg btn-primary w-100" type="button" @click="login()" id="login-button">                                               
                                    <span class="d-flex align-items-center">
                                        <span class="flex-grow-1 ms-2 btn-text">
                                            Sign In
                                        </span>
                                        <span class="spinner-border flex-shrink-0" role="status" style="display:none;">
                                            <span class="visually-hidden btn-text">Sign In</span>
                                        </span>
                                    </span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="<?= base_url() ?>assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Show Password JS -->
    <script src="<?= base_url() ?>assets/js/show-password.js"></script>
     <!-- Form Validation JS -->
     <script src="<?= base_url() ?>assets/js/validation.js"></script>
    <?= view('templates/script_custom') ?>
    
    <?= isset($vueScript)  ? '<script src="'.base_url($vueScript).'"></script>' : '' ?>

</body>

</html>
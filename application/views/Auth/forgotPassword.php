<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>VIP - Forgot Password</title>
    <link rel="apple-touch-icon" href="<?=base_url()?>app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="<?=base_url()?>assets/images/favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Muli:300,300i,400,400i,600,600i,700,700i%7CComfortaa:300,400,700" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>app-assets/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>app-assets/vendors/css/forms/toggle/switchery.min.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>app-assets/css/plugins/forms/switch.min.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>app-assets/css/core/colors/palette-switch.min.css">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>app-assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>app-assets/css/bootstrap-extended.min.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>app-assets/css/colors.min.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>app-assets/css/components.min.css">
    <!-- END: Theme CSS-->

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>app-assets/css/core/menu/menu-types/vertical-menu.min.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>app-assets/css/core/colors/palette-gradient.min.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>app-assets/css/pages/login-register.min.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/style.css">
    <!-- END: Custom CSS-->
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"
        integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w=="
        crossorigin="anonymous" />
</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu 1-column  bg-full-screen-image blank-page blank-page" data-open="click" data-menu="vertical-menu" data-color="bg-gradient-x-purple-blue" data-col="1-column">
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-wrapper-before"></div>
            <div class="content-header row"></div>
            <div class="content-body">
                <section class="flexbox-container">
                    <div class="col-12 d-flex align-items-center justify-content-center">
                        <div class="col-lg-4 col-md-6 col-10 box-shadow-2 p-0">
                            <div class="card border-grey border-lighten-3 px-1 pt-1 pb-4 m-0">
                                <div class="card-header border-0">
                                    <div class="text-center mb-1">
                                        <img src="<?=base_url()?>assets/images/VIP_Icon.png" alt="branding logo">
                                    </div>
                                    <div class="font-large-1  text-center">Forgot Password</div>
                                </div>
                                <p class="px-2 mb-0">Please enter your email address and we'll send you instructions on how to reset your password.</p>
                                <div class="card-content">
                                    <div class="card-body">
                                        <?= form_open('/forgot-password') ?>
                                            <fieldset class="form-group position-relative has-icon-left">
                                                <input type="email" class="form-control round" id="email" name="email" placeholder="Email" required>
                                                <div class="form-control-position">
                                                    <i class="fa fa-envelope"></i>
                                                </div>
                                            </fieldset>
                                            <div class="form-group row">
                                                <div class="col-12">
                                                    <span class="message text-danger"><?php echo $this->session->flashdata('message'); ?></span>
                                                </div>
                                            </div>
                                            <a href="<?= base_url('login') ?>" class="btn btn-outline-primary float-left btn-inline">Back To Login</a>
                                            <button type="submit" class="btn btn-primary float-right btn-inline">Send Verification Code</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

            </div>
        </div>
    </div>
    <!-- END: Content-->

    <!-- BEGIN: Vendor JS-->
    <script src="<?=base_url()?>app-assets/vendors/js/vendors.min.js" type="text/javascript"></script>
    <script src="<?=base_url()?>app-assets/vendors/js/forms/toggle/switchery.min.js" type="text/javascript"></script>
    <script src="<?=base_url()?>app-assets/js/scripts/forms/switch.min.js" type="text/javascript"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="<?=base_url()?>app-assets/vendors/js/forms/validation/jqBootstrapValidation.js" type="text/javascript"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="<?=base_url()?>app-assets/js/core/app-menu.min.js" type="text/javascript"></script>
    <script src="<?=base_url()?>app-assets/js/core/app.min.js" type="text/javascript"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="<?=base_url()?>app-assets/js/scripts/forms/form-login-register.min.js" type="text/javascript"></script>
    <!-- END: Page JS-->

</body>
<!-- END: Body-->

</html>
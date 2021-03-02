<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Chameleon Admin is a modern Bootstrap 4 webapp &amp; admin dashboard html template with a large number of components, elegant design, clean and organized code.">
    <meta name="keywords" content="admin template, Chameleon admin template, dashboard template, gradient admin template, responsive admin template, webapp, eCommerce dashboard, analytic dashboard">
    <meta name="author" content="ThemeSelect">
    <title>VIP - Answer ST and TT</title>
    <link rel="apple-touch-icon" href="<?= base_url() ?>app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="<?= base_url() ?>assets/images/favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Muli:300,300i,400,400i,600,600i,700,700i%7CComfortaa:300,400,700" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>app-assets/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>app-assets/vendors/css/forms/toggle/switchery.min.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>app-assets/css/plugins/forms/switch.min.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>app-assets/css/core/colors/palette-switch.min.css">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>app-assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>app-assets/css/bootstrap-extended.min.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>app-assets/css/colors.min.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>app-assets/css/components.min.css">
    <!-- END: Theme CSS-->

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>app-assets/css/core/menu/menu-types/vertical-menu.min.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>app-assets/css/core/colors/palette-gradient.min.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/style.css">
    <link rel="stylesheet" href="<?= base_url() ?>app-assets/css/feather.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />


</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu 2-columns   fixed-navbar" data-open="click" data-menu="vertical-menu" data-color="bg-gradient-x-purple-blue" data-col="2-columns">

    <!-- BEGIN: Header-->
    <nav class="header-navbar navbar-expand-md navbar navbar-with-menu navbar-without-dd-arrow fixed-top navbar-semi-light">
        <div class="navbar-wrapper">
            <div class="navbar-container content" style="background-image: -webkit-gradient(linear,left top,right top,from(#a5e29c),to(#32cafe)) !important">
                <div class="collapse navbar-collapse show" id="navbar-mobile">
                    <ul class="nav navbar-nav mr-auto float-left">
                        <li class="nav-item mobile-menu d-md-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="fa fa-bars font-large-1"></i></a></li>
                        <li class="nav-item d-none d-md-block"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="fa fa-bars "></i></a></li>
                    </ul>
                    <ul class="nav navbar-nav float-right">
                        <li class="dropdown dropdown-user nav-item"><a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                                <?php if (empty($this->session->userdata('photo'))) { ?>
                                    <span class="avatar avatar-online"><img src="<?= base_url() ?>assets/images/ProfileIcon.jpg" alt="avatar"></span>
                                <?php } else { ?>
                                    <span class="avatar avatar-online"><img src="<?= base_url() . $this->session->userdata('photo') ?>" alt="avatar"></span>
                                <?php } ?>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <div class="arrow_box_right">
                                    <a class="dropdown-item" href="#">
                                        <?php if (empty($this->session->userdata('photo'))) { ?>
                                            <span class="avatar avatar-online"><img src="<?= base_url() ?>assets/images/ProfileIcon.jpg" alt="avatar">
                                            <?php } else { ?>
                                                <span class="avatar avatar-online"><img src="<?= base_url() . $this->session->userdata('photo') ?>" alt="avatar">
                                                <?php } ?>
                                                <span class="user-name text-bold-700 ml-1"><?= $this->session->userdata('username') ?></span>
                                                </span>
                                    </a>
                                    <div class="dropdown-divider"></div><a class="dropdown-item" href="<?= base_url() ?>logout"><i class="fa fa-sign-out"></i> Logout</a>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <!-- END: Header-->


    <!-- BEGIN: Main Menu-->
    <div class="main-menu menu-fixed menu-light menu-accordion    menu-shadow " data-scroll-to-active="true" data-img="<?= base_url() ?>app-assets/images/backgrounds/02.jpg">
        <div class="navbar-header">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item mr-auto"><a class="navbar-brand" href="<?= base_url() ?>unit"><img class="brand-logo" alt="Chameleon admin logo" src="<?= base_url() ?>assets/images/VIP_Icon.png" style="width: 52px;" />
                        <h3 class="brand-text">VIP</h3>
                    </a></li>
                <li class="nav-item d-md-none"><a class="nav-link close-navbar"><i class="ft-x"></i></a></li>
            </ul>
        </div>
        <div class="navigation-background"></div>
        <div class="main-menu-content">
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
                <?php if ($this->session->userdata('role') == 3) { ?>
                    <li class=" nav-item"><a href="<?= base_url() ?>user"><i class="fa fa-user"></i><span class="menu-title" data-i18n="">Users</span></a>
                    </li>
                <?php } ?>
                <li class=" nav-item"><a href="<?= base_url() ?>unit"><i class="fa fa-folder"></i><span class="menu-title" data-i18n="">Units</span></a>
                </li>
                <li class=" nav-item"><a href="<?= base_url() ?>learning-content"><i class="fa fa-book-open"></i><span class="menu-title" data-i18n="">Learning Contents</span></a>
                </li>
                <li class=" nav-item"><a href="<?= base_url() ?>lecture"><i class="fa fa-microphone"></i><span class="menu-title" data-i18n="">Lectures</span></a>
                </li>
                <li class=" nav-item"><a href="<?= base_url() ?>practice"><i class="fa fa-file"></i><span class="menu-title small" data-i18n="">Interpreting <br>Practice & Exercise</span></a>
                </li>
                <li class=" nav-item active"><a href="<?= base_url() ?>sttt"><i class="fa fa-book"></i><span class="menu-title" data-i18n="">Answer ST & TT</span></a>
                </li>
                <li class=" nav-item"><a href="<?= base_url() ?>glossary"><i class="fa fa-language"></i><span class="menu-title" data-i18n="">Glossaries</span></a>
                </li>
                <li class=" nav-item"><a href="<?= base_url() ?>forum"><i class="fa fa-comments"></i><span class="menu-title" data-i18n="">Forum</span></a>
                </li>
<li class=" nav-item"><a href="<?= base_url() ?>setting"><i class="fa fa-cog"></i><span class="menu-title" data-i18n="">Settings</span></a>
                </li>
            </ul>
        </div>
    </div>
    <!-- END: Main Menu-->

    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-wrapper-before" style="background-image: -webkit-gradient(linear,left top,right top,from(#a5e29c),to(#32cafe)) !important">
            </div>
            <div class="content-header row">
                <div class="content-header-left col-md-4 col-12 mb-2">
                    <h3 class="content-header-title">Answer ST and TT Management</h3>
                </div>
            </div>


            <div class="content-body">
                <!-- Basic form layout section start -->
                <section id="basic-form-layouts">
                    <div class="row match-height">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-content collapse show">
                                    <div class="card-body">
                                        <?= form_open_multipart(base_url() . 'sttt/add') ?>
                                        <div class="form-body">
                                            <h4 class="form-section">
                                                <i class="fa fa-folder"></i>Answer ST and TT Create
                                            </h4>
                                            <div class="form-group">
                                                <label for="practice_number">Practice Number</label>
                                                <select id="practice_number" name="practice_number" class="form-control">
                                                    <option value="" selected disabled>Select Interpreting Practice and Exercise</option>
                                                    <?php
                                                    foreach ($data_practice as $practice) {
                                                        echo '<option value="' . $practice->number . '">' . $practice->number . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="title">Answer ST and TT Title</label>
                                                        <input type="text" id="title" class="form-control" placeholder="Enter Answer ST and TT Title" name="title">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="ex1_answer_original">Ex1. Original Answer</label>
                                                <textarea id="ex1_answer_original" rows="5" class="form-control" name="ex1_answer_original" placeholder="Enter Exercise 1 Original Answer"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="ex1_answer_translated">Ex1. Translated Answer</label>
                                                <textarea id="ex1_answer_translated" rows="5" class="form-control" name="ex1_answer_translated" placeholder="Enter Exercise 1 Translated Answer"></textarea>
                                            </div>

                                            <div class="form-group">
                                                <label for="ex2_answer_original">Ex2. Original Answer</label>
                                                <textarea id="ex2_answer_original" rows="5" class="form-control" name="ex2_answer_original" placeholder="Enter Exercise 2 Original Answer"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="ex2_answer_translated">Ex2. Translated Answer</label>
                                                <textarea id="ex2_answer_translated" rows="5" class="form-control" name="ex2_answer_translated" placeholder="Enter Exercise 2 Translated Answer"></textarea>
                                            </div>

                                            <div class="form-actions">
                                                <a type="button" class="btn btn-danger mr-1 text-white" href='javascript:history.back(1);'>
                                                    <i class="fa fa-close"></i> Cancel
                                                </a>
                                                <button type="submit" class="btn btn-success">
                                                    <i class="fa fa-save"></i> Save
                                                </button>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                </section>
                <!-- // Basic form layout section end -->
            </div>
        </div>
    </div>
    <!-- END: Content-->


    <!-- BEGIN: Customizer-->

    <!-- END: Footer-->


    <!-- BEGIN: Vendor JS-->
    <script src="<?= base_url() ?>app-assets/vendors/js/vendors.min.js" type="text/javascript"></script>
    <script src="<?= base_url() ?>app-assets/vendors/js/forms/toggle/switchery.min.js" type="text/javascript"></script>
    <script src="<?= base_url() ?>app-assets/js/scripts/forms/switch.min.js" type="text/javascript"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="<?= base_url() ?>app-assets/js/core/app-menu.min.js" type="text/javascript"></script>
    <script src="<?= base_url() ?>app-assets/js/core/app.min.js" type="text/javascript"></script>
    <script src="<?= base_url() ?>app-assets/js/scripts/customizer.min.js" type="text/javascript"></script>
    <script src="<?= base_url() ?>app-assets/vendors/js/jquery.sharrre.js" type="text/javascript"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <!-- END: Page JS-->

</body>
<!-- END: Body-->

<!-- Mirrored from themeselection.com/demo/chameleon-admin-template/html/ltr/vertical-menu-template/form-layout-basic.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 28 Jan 2021 19:01:13 GMT -->

</html>
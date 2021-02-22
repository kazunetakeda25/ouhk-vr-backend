<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description"
        content="Chameleon Admin is a modern Bootstrap 4 webapp &amp; admin dashboard html template with a large number of components, elegant design, clean and organized code.">
    <meta name="keywords"
        content="admin template, Chameleon admin template, dashboard template, gradient admin template, responsive admin template, webapp, eCommerce dashboard, analytic dashboard">
    <meta name="author" content="ThemeSelect">
    <title>VIP - Units</title>
    <link rel="apple-touch-icon" href="<?=base_url()?>app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="<?=base_url()?>assets/images/favicon.ico">
    <link
        href="https://fonts.googleapis.com/css?family=Muli:300,300i,400,400i,600,600i,700,700i%7CComfortaa:300,400,700"
        rel="stylesheet">

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
    <link rel="stylesheet" type="text/css"
        href="<?=base_url()?>app-assets/css/core/menu/menu-types/vertical-menu.min.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>app-assets/css/core/colors/palette-gradient.min.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/style.css">

    <link rel="stylesheet" href="<?=base_url()?>app-assets/css/feather.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"
        integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w=="
        crossorigin="anonymous" />


</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu 2-columns   fixed-navbar" data-open="click" data-menu="vertical-menu"
    data-color="bg-gradient-x-purple-blue" data-col="2-columns">

    <!-- BEGIN: Header-->
    <nav
        class="header-navbar navbar-expand-md navbar navbar-with-menu navbar-without-dd-arrow fixed-top navbar-semi-light">
        <div class="navbar-wrapper">
            <div class="navbar-container content"
                style="background-image: -webkit-gradient(linear,left top,right top,from(#a5e29c),to(#32cafe)) !important">
                <div class="collapse navbar-collapse show" id="navbar-mobile">
                    <ul class="nav navbar-nav mr-auto float-left">
                        <li class="nav-item mobile-menu d-md-none mr-auto"><a
                                class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i
                                    class="fa fa-bars font-large-1"></i></a></li>
                        <li class="nav-item d-none d-md-block"><a class="nav-link nav-menu-main menu-toggle hidden-xs"
                                href="#"><i class="fa fa-bars "></i></a></li>
                    </ul>
                    <ul class="nav navbar-nav float-right">
                        <li class="dropdown dropdown-user nav-item"><a
                                class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                                <span class="avatar avatar-online"><img
                                        src="<?=base_url()?>assets/images/ProfileIcon.jpg" alt="avatar"></span></a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <div class="arrow_box_right"><a class="dropdown-item" href="#"><span
                                            class="avatar avatar-online"><img
                                                src="<?=base_url()?>assets/images/ProfileIcon.jpg" alt="avatar"><span
                                                class="user-name text-bold-700 ml-1">Admin</span></span></a>
                                    <div class="dropdown-divider"></div><a class="dropdown-item" href="login.html"><i
                                            class="fa fa-sign-out"></i> Logout</a>
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
    <div class="main-menu menu-fixed menu-light menu-accordion    menu-shadow " data-scroll-to-active="true"
        data-img="<?=base_url()?>app-assets/images/backgrounds/02.jpg">
        <div class="navbar-header">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item mr-auto"><a class="navbar-brand" href="index.html"><img class="brand-logo"
                            alt="Chameleon admin logo" src="<?=base_url()?>assets/images/VIP_Icon.png"
                            style="width: 52px;" />
                        <h3 class="brand-text">VIP</h3>
                    </a></li>
                <li class="nav-item d-md-none"><a class="nav-link close-navbar"><i class="ft-x"></i></a></li>
            </ul>
        </div>
        <div class="navigation-background"></div>
        <div class="main-menu-content">
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
                <li class=" nav-item"><a href="user"><i class="fa fa-user"></i><span class="menu-title"
                            data-i18n="">Users</span></a>
                </li>
                <li class=" nav-item active"><a href="unit"><i class="fa fa-folder"></i><span class="menu-title"
                            data-i18n="">Units</span></a>
                </li>
                <li class=" nav-item"><a href="learning-content"><i class="fa fa-book-open"></i><span class="menu-title"
                            data-i18n="">Learning Contents</span></a>
                </li>
                <li class=" nav-item"><a href="lecture"><i class="fa fa-microphone"></i><span class="menu-title"
                            data-i18n="">Lectures</span></a>
                </li>
                <li class=" nav-item"><a href="practice"><i class="fa fa-file"></i><span class="menu-title"
                            data-i18n="">Practices</span></a>
                </li>
                <li class=" nav-item"><a href="sttt"><i class="fa fa-book"></i><span class="menu-title"
                            data-i18n="">Answer ST & TT</span></a>
                </li>
                <li class=" nav-item"><a href="glossary"><i class="fa fa-language"></i><span class="menu-title"
                            data-i18n="">Glossaries</span></a>
                </li>
            </ul>
        </div>
    </div>
    <!-- END: Main Menu-->

    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-wrapper-before"
                style="background-image: -webkit-gradient(linear,left top,right top,from(#a5e29c),to(#32cafe)) !important">
            </div>
            <div class="content-header row">
                <div class="content-header-left col-md-4 col-12 mb-2">
                    <h3 class="content-header-title">Unit Management</h3>
                </div>
                <div class="content-header-right col-md-8 col-12">
                    <div class="breadcrumbs-top float-md-right">
                        <div class="breadcrumb-wrapper mr-1">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a>Admin</a>
                                </li>
                                <li class="breadcrumb-item"><a>Unit Managment</a>
                                </li>
                                <li class="breadcrumb-item active"><a>Unit List</a>
                                </li>
                            </ol>
                        </div>
                    </div>
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
                                        <a type="button" class="btn btn-success" style="color: white" href="unit/add">
                                            <i class="fa fa-folder"></i> Create New Unit
                                        </a>
                                        <p>&nbsp;</p>
                                        <div class="table-responsive">
                                            <table class="table table-hover mb-0">

                                                <thead class="text-white"
                                                    style="background-color: rgba(97, 227, 181,100)">
                                                    <tr>
                                                        <th scope="col">Unit Number</th>
                                                        <th scope="col">Unit Title</th>
                                                        <th scope="col">Unit Description</th>
                                                        <th scope="col">Unit System</th>
                                                        <th scope="col">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    foreach ($data_unit as $unit) {
                                                        echo '<tr>';
                                                        echo '<th scope="row">' . $unit->number . '</th>';
                                                        echo '<td>' . $unit->title . '</td>';
                                                        echo '<td>' . $unit->description . '</td>';
                                                        echo '<td style="white-space: nowrap">
                                                                <a type="button" class="btn btn-secondary text-white" href="learning-content/' . $unit->number . '"
                                                                    title="Learning Content">
                                                                    <img class="rounded-bottom"
                                                                        src="' . base_url() . 'assets/images/LC.png" alt="LC"
                                                                        height="20" width="20">
                                                                </a>
                                                                <a type="button" class="btn btn-secondary text-white" href="lecture/' . $unit->number . '"
                                                                    title="Lecture">
                                                                    <img class="rounded-bottom"
                                                                        src="' . base_url() . 'assets/images/LE.png" alt="LE"
                                                                        height="20" width="15">
                                                                </a>
                                                                <a type="button" class="btn btn-secondary text-white" href="practice/' . $unit->number . '"
                                                                    title="Interpreting Practice and Exercise">
                                                                    <img class="rounded-bottom"
                                                                        src="' . base_url() . 'assets/images/IPE.png" alt="IPE"
                                                                        height="20" width="17">
                                                                </a>
                                                                <a type="button" class="btn btn-secondary text-white" href="sttt/' . $unit->number . '"
                                                                    title="Answer ST & TT">
                                                                    <img class="rounded-bottom"
                                                                        src="' . base_url() . 'assets/images/STTT.png"
                                                                        alt="STTT" height="20" width="17">
                                                                </a>
                                                            </td>';
                                                        echo '<td style="white-space: nowrap">
                                                                <a type="button" class="btn btn-info text-white" href="unit/edit/' . $unit->id . '"
                                                                    title="Edit">
                                                                    <span class="fa fa-edit"></span>
                                                                </a>
                                                                <a type="button" class="btn btn-danger text-white" href="javascript:deleteUnit(' . $unit->id . ');"
                                                                    title="Delete">
                                                                    <span class="fa fa-trash"></span>
                                                                </a>
                                                            </td>';
                                                        echo '</tr>';
                                                    }
                                                    ?>
                                                </tbody>

                                            </table>
                                        </div>

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
    <!-- End: Customizer-->


    <!-- END: Footer-->


    <!-- BEGIN: Vendor JS-->
    <script src="<?=base_url()?>app-assets/vendors/js/vendors.min.js" type="text/javascript"></script>
    <script src="<?=base_url()?>app-assets/vendors/js/forms/toggle/switchery.min.js" type="text/javascript"></script>
    <script src="<?=base_url()?>app-assets/js/scripts/forms/switch.min.js" type="text/javascript"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="<?=base_url()?>app-assets/js/core/app-menu.min.js" type="text/javascript"></script>
    <script src="<?=base_url()?>app-assets/js/core/app.min.js" type="text/javascript"></script>
    <script src="<?=base_url()?>app-assets/js/scripts/customizer.min.js" type="text/javascript"></script>
    <script src="<?=base_url()?>app-assets/vendors/js/jquery.sharrre.js" type="text/javascript"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <!-- END: Page JS-->
    <script>
    function deleteUnit(id) {
        if (confirm('Are you sure you want to delete this unit?')) {
            window.location.replace("unit/delete/" + id);
        }
    }
    </script>

</body>
<!-- END: Body-->

<!-- Mirrored from themeselection.com/demo/chameleon-admin-template/html/ltr/vertical-menu-template/form-layout-basic.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 28 Jan 2021 19:01:13 GMT -->

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ERP</title>


    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url() ?>public/admin/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
        href="<?php echo base_url() ?>public/admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet"
        href="<?php echo base_url() ?>public/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="<?php echo base_url() ?>public/admin/plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url() ?>public/admin/dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet"
        href="<?php echo base_url() ?>public/admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="<?php echo base_url() ?>public/admin/plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="<?php echo base_url() ?>public/admin/plugins/summernote/summernote-bs4.min.css">


    <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css'); ?>">

    <!-- Data Table -->
    <link rel="stylesheet"
        href="<?php echo base_url() ?>public/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet"
        href="<?php echo base_url() ?>public/admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet"
        href="<?php echo base_url() ?>public/admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- /Data Table -->

</head>
<style>
.sticky-nav{
    position: sticky;
    width: 100%;
    /* margin-bottom: 15rem;  */
    top: 0; 
    background-color: rgb(202, 204, 206);
    z-index: 200;
    padding: 5px;

}
</style>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Preloader
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div> -->
            
                     <?php 
                    // $user_type = $this->session->userdata('user_data')->user_type; 
                    // $user_id = $this->session->userdata('user_data')->user_id;
                    // if($user_type == '1')
                    // {
                    //     $menuGroup = side_menu_for_admin();
                    // echo'<pre>';print_r($menuGroup);exit;

                    // }else{

                    //     $menuGroup = get_sidebar_menu($user_id);
                    // }
                    ?> 

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <!-- <img src="<?php echo base_url() ?>public/admin/dist/img/logo.png"
                            class="img-circle elevation-2" alt="User Image"> -->
                    </div>
                    <div class="info">
                    <?php $role_name = (get_role_of_user($this->session->userdata('user_data')->user_type)); ?>
                        <a href="#" class="d-block">EPRt</a>
                        <span class="text-light"><?php echo $role_name; ?></span>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <?php 
                    $user_type = $this->session->userdata('user_data')->user_type; 
                    $user_id = $this->session->userdata('user_data')->user_id;

                    if($user_type == '1')
                    {
                        $menuGroup = side_menu_for_admin();
                    // echo'<pre>';print_r($menuGroup);exit;

                    }else{

                        $menuGroup = get_sidebar_menu($user_id);
                    }
                    // echo'<pre>';print_r($menuGroup);exit;
                    ?>
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                        <li class="nav-item menu-open">
                            <a href="<?php echo base_url().'index.php/dashboard'?>" class="nav-link active">
                                <i class="fa fa-home" aria-hidden="true"></i>
                                <p>
                                    Dashboard
                                    <!-- <i class="right fas fa-angle-left"></i> -->
                                </p>
                            </a>
                        </li>

                        <?php 
                        foreach($menuGroup as $menu)
                        { ?>
                            <li class="nav-item">
                                <?php if(!empty($menu['module']->slug)){ ?>
                                    <a href="<?php echo base_url().'index.php/'.$menu['module']->slug?>" class="nav-link">
                                <?php } else{ ?>
                                    <a href="#" class="nav-link">

                                <?php } ?>
                                <i class="<?php echo $menu['module']->icon ?>" aria-hidden="true"></i>
                                    <p>
                                        <?php echo $menu['module']->module_name ?>
                                        
                                        <?php if(empty($menu['module']->slug)) { ?>
                                        <i class="fas fa-angle-left right"></i>
                                        <?php } ?>
                                    </p>
                                </a>

                                <?php 
                                    if(!empty($menu['submodules'])){
                                        foreach($menu['submodules'] as $submodule){
                                ?>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="<?php echo base_url().'index.php/'.$submodule->slug ?>" class="nav-link">
                                                <i class="<?php echo $submodule->icon ?>"></i>
                                                <p><?php echo $submodule->submodule_name?></p>
                                            </a>
                                        </li>
                                    </ul>
                                <?php } } ?>
                            </li>
                            
                        <?php } ?>

                        <li class="nav-item">
                            <a href="<?php echo base_url().'index.php/checklist-group-master'?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                    <p>CheckList group master</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo base_url().'index.php/logout'?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                    <p>Log Out</p>
                            </a>
                        </li>
                       
                    </ul>
                </nav>
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header sticky-nav">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6 breadcrumb">
                            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                            <h1 class="mx-2">ERP</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Dashboard</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <div class="main-container m-3">

                <?php

                if($this->session->has_userdata('user_data')){
                    $this->load->view($_view);

                }else{

                    redirect('welcome/index');
                }


                ?>
            </div>


            <!-- Control Sidebar -->
            <aside class="control-sidebar control-sidebar-dark">
                <!-- Control sidebar content goes here -->
            </aside>
            <!-- /.control-sidebar -->
        </div>
        <!-- ./wrapper -->

        <!-- jQuery -->
        <script src="<?php echo base_url() ?>public/admin/plugins/jquery/jquery.min.js"></script>
        <!-- jQuery UI 1.11.4 -->
        <script src="<?php echo base_url() ?>public/admin/plugins/jquery-ui/jquery-ui.min.js"></script>
        <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
        <script>
            //   $.widget.bridge('uibutton', $.ui.button)
        </script>
        <!-- Bootstrap 4 -->
        <script src="<?php echo base_url() ?>public/admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- ChartJS -->
        <script src="<?php echo base_url() ?>public/admin/plugins/chart.js/Chart.min.js"></script>
        <!-- Sparkline -->
        <script src="<?php echo base_url() ?>public/admin/plugins/sparklines/sparkline.js"></script>
        <!-- JQVMap -->
        <script src="<?php echo base_url() ?>public/admin/plugins/jqvmap/jquery.vmap.min.js"></script>
        <script src="<?php echo base_url() ?>public/admin/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
        <!-- jQuery Knob Chart -->
        <script src="<?php echo base_url() ?>public/admin/plugins/jquery-knob/jquery.knob.min.js"></script>
        <!-- daterangepicker -->
        <script src="<?php echo base_url() ?>public/admin/plugins/moment/moment.min.js"></script>
        <script src="<?php echo base_url() ?>public/admin/plugins/daterangepicker/daterangepicker.js"></script>
        <!-- Tempusdominus Bootstrap 4 -->
        <script
            src="<?php echo base_url() ?>public/admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
        <!-- Summernote -->
        <script src="<?php echo base_url() ?>public/admin/plugins/summernote/summernote-bs4.min.js"></script>
        <!-- overlayScrollbars -->
        <script
            src="<?php echo base_url() ?>public/admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
        <!-- AdminLTE App -->
        <script src="<?php echo base_url() ?>public/admin/dist/js/adminlte.js"></script>
        <script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"
            integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V"
            crossorigin="anonymous"></script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
            crossorigin="anonymous"></script>

        <!-- AdminLTE for demo purposes -->
        <!-- <script src="<?php echo base_url() ?>public/admin/dist/js/demo.js"></script> -->
        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <!-- <script src="<?php echo base_url() ?>public/admin/dist/js/pages/dashboard.js"></script> -->
        <script src="<?php echo base_url() ?>public/admin/plugins/datatables/jquery.dataTables.min.js"></script>
        <script
            src="<?php echo base_url() ?>public/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
        <script
            src="<?php echo base_url() ?>public/admin/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
        <script
            src="<?php echo base_url() ?>public/admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
        <script
            src="<?php echo base_url() ?>public/admin/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
        <script
            src="<?php echo base_url() ?>public/admin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
        <script src="<?php echo base_url() ?>public/admin/plugins/jszip/jszip.min.js"></script>
        <script src="<?php echo base_url() ?>public/admin/plugins/pdfmake/pdfmake.min.js"></script>
        <script src="<?php echo base_url() ?>public/admin/plugins/pdfmake/vfs_fonts.js"></script>
        <script src="<?php echo base_url() ?>public/admin/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
        <script src="<?php echo base_url() ?>public/admin/plugins/datatables-buttons/js/buttons.print.min.js"></script>
        <script src="<?php echo base_url() ?>public/admin/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
</body>

</html>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Clinic App | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="icon" href="<?=base_url()?>asset/dist/img/cleanlogo.png" type="image">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?= base_url() ?>asset/bootstrap/css/bootstrap.min.css">
  <!-- <link href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.css" rel="stylesheet"/>
  <link href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.css" rel="stylesheet"/> -->
  <link rel="stylesheet" href="<?= base_url() ?>asset/plugins/datatables/datatables.min.css" >
  <!-- cUSTOM css -->
  <link rel="stylesheet" href="<?= base_url() ?>asset/css/custom.css">

  <link rel="stylesheet" href="<?= base_url() ?>asset/css/buttons.dataTables.min.css">

  <link rel="stylesheet" href="<?= base_url() ?>asset/css/jquery.dataTables.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url() ?>asset/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?= base_url() ?>asset/dist/css/skins/_all-skins.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?= base_url() ?>asset/plugins/iCheck/flat/blue.css">
  <!-- Morris chart -->
  <!-- <link rel="stylesheet" href="<?= base_url() ?>asset/plugins/morris/morris.css"> -->
  <!-- jvectormap -->
  <link rel="stylesheet" href="<?= base_url() ?>asset/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="<?= base_url() ?>asset/plugins/datepicker/datepicker3.css">
  <!-- Daterange picker -->
  <!-- <link rel="stylesheet" href="<?= base_url() ?>asset/plugins/daterangepicker/daterangepicker.css"> -->
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="<?= base_url() ?>asset/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

  <!-- select -->
  <link rel="stylesheet" href="<?= base_url() ?>asset/plugins/iCheck/all.css">
  <link rel="stylesheet" href="<?= base_url() ?>asset/plugins/select2/select2.min.css">
  
  <script src="<?= base_url() ?>asset/plugins/jQuery/jquery-2.2.3.min.js"></script>
  
  <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Raleway" />

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
  <?php   
            $user_id = ($this->session->userdata['logged_in']['user_id']); 
            $fname = $profile->user_fname;
            $lname = $profile->user_lname;
            $fullname = $fname ." ". $lname;
            $position = $profile->position;
  ?>
  <header class="main-header">
    <nav class="navbar navbar-static-top" id="tooglemobile">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
          <!-- User Account: style can be found in dropdown.less -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <span class="hidden-xs"><p class="custom-color"><img class="topheaderlogo" src="<?php echo base_url('asset/dist/img/cleanlogo.png'); ?>" />Clinic Manager</p></span>
            </a>
      </div>
    </nav>
    <!-- Logo -->    
    <div class="mydrop-online">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" ><i class="fa fa-circle text-success"></i> Online</a><span class="caret"></span>
          <ul class="dropdown-menu custom-drop">
            <li class="frontview"><a href="<?= base_url('Sec_profile') ?>">Profile</a></li>
            <li class="frontview"><a href="<?= base_url('Authentication/logout') ?>">Sign-out</a></li>
          </ul>
    </div>
    <div class="user-panel" id="sec-color">
        <div class="pull-left image">
          <img src="<?php echo $profile->user_photo ?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p class="userFullname"><?php echo $fullname ?></p>
        </div>
        <div class="pull-right">
          <p class="userPosition"><?php echo $position ?></p>          
        </div>
    </div>    
    <!-- Header Navbar: style can be found in header.less -->

    <nav class="navbar navbar-static-top" id="navtoggle">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
          <!-- User Account: style can be found in dropdown.less -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <span class="hidden-xs"><p class="custom-color"><img class="topheaderlogo" src="<?php echo base_url('asset/dist/img/cleanlogo.png'); ?>" />Clinic Manager</p></span>
            </a>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      
      <ul class="sidebar-menu">
        
        <li class="treeview lioverview">
          <a href="<?= base_url('Dashboard_sec') ?>">
            <i class="fa fa-eye custom-font-color"></i> <span class="custom-font-color">Overview</span>
          </a>
        </li>
        <li class="treeview liclinics">
          <a href="#">
            <i class="fa fa-hospital-o custom-font-color"></i>
            <span class="custom-font-color">Clinics</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?= base_url('Sec_myclinic') ?>"><i class="fa fa-user-md custom-font-color"></i>My Clinics</a></li>
            <li><a href="<?= base_url('Sec_billing') ?>"><i class="fa fa-money custom-font-color"></i> Billing Section</a></li>
            <!-- <li><a href="pages/layout/collapsed-sidebar.html"><i class="fa fa-circle-o"></i> Collapsed Sidebar</a></li> -->
          </ul>
        </li>


        <li class="lichat"><a href="<?= base_url('Sec_searchrecords') ?> "><i class="fa fa-files-o custom-font-color"></i> <span class="custom-font-color">Patient's History</span></a></li>
        <li class="lireports"><a href="<?= base_url('Sec_clinicchat') ?> "><i class="fa fa-comments-o custom-font-color"></i> <span class="custom-font-color">Clinic Chat</span></a></li>
        
        <!-- <li class="header">LABELS</li>
        <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Important</span></a></li>
        <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Information</span></a></li> -->
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="description" content="Property Datastore ">
    <!-- Twitter meta-->
    <meta property="twitter:card" content="">
    <meta property="twitter:site" content="">
    <meta property="twitter:creator" content="">
    <!-- Open Graph Meta-->
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Property Datastore">
    <meta property="og:title" content="Property Datastore ">
    <meta property="og:url" content="https://www.propertydatastore.com">
    <meta property="og:image" content="">
    <title>DotCom Values -<?=isset($pageTitle)? $pageTitle:'New page'; ?></title>
    <meta property="og:description" content="<?=isset($pageTitle)? $pageDescription:'Description'; ?> ">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
        <!-- Toastr style -->
    <link href="<?= base_url() ?>public/assets/css/plugins/toastr/toastr.min.css" rel="stylesheet">
    <!-- Sweet Alert -->
    <link href="<?= base_url() ?>public/assets/css/plugins/sweetalert/sweetalert.css" rel="stylesheet">
    <!-- Datatables style -->
    <link href="<?= base_url() ?>public/assets/css/plugins/dataTables/datatables.min.css" rel="stylesheet">
    <!-- Datepicker style -->
    <link href="<?= base_url() ?>public/assets/css/plugins/datepicker/datepicker3.css" rel="stylesheet">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>public/assets/css/main.css">
    <!-- CUSTOM CSS -->
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>public/assets/css/custom.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>public/assets/js/plugins/select2/select2.min.css">
    <!-- LOAD JQUERY FROM HERE -->
    <script src="<?= base_url() ?>public/assets/js/jquery-3.2.1.min.js"></script>
    <script src="<?php echo base_url(); ?>public/assets/js/plugins/select2/select2.full.js"></script>

    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>public/assets/font-awesome/css/font-awesome.css">
    <script src="<?= base_url() ?>public/assets/js/proj4.js"></script>

    <?= $this->renderSection("styles"); ?>
</head>

<body class="app sidebar-mini rtl">
  <!--  Loads contents and navbars -->
  <?php
   echo $this->include('includes/admin_nav');
   echo  $this->include('locate_modal');

  ?>

  <!-- Essential javascripts for application to work-->
  <script src="<?= base_url() ?>public/assets/js/popper.min.js"></script>
  <script src="<?= base_url() ?>public/assets/js/bootstrap.min.js"></script>
  <script src="<?= base_url() ?>public/assets/js/main.js"></script>
  <!-- The javascript plugin to display page loading on top-->
  <script src="<?= base_url() ?>public/assets/js/plugins/pace.min.js"></script>
  <!-- Data tables -->
  <script src="<?= base_url() ?>public/assets/js/plugins/dataTables/datatables.min.js"></script>
  <script src="<?= base_url() ?>public/assets/js/plugins/dataTables/dataTables.bootstrap4.min.js"></script>
  <script src="<?= base_url() ?>public/assets/js/plugins/dataTables/dataTables.fixedColumns.min.js"></script>
  <!-- Sweet alert -->
  <script src="<?= base_url() ?>public/assets/js/plugins/sweetalert/sweetalert.min.js"></script>
  <!-- Toastr script -->
  <script src="<?= base_url() ?>public/assets/js/plugins/toastr/toastr.min.js"></script>
  <!-- Bootstrap validator script -->
  <script src="<?= base_url() ?>public/assets/js/plugins/validate/validator.min.js"></script>
  <!-- Moment JScript -->
  <script src="<?= base_url() ?>public/assets/js/plugins/moment/moment.min.js"></script>
  <!-- Moment JScript -->
  <script src="<?= base_url() ?>public/assets/js/plugins/datepicker/bootstrap-datepicker.js"></script>
  <!-- Knockout Jscript -->
  <script src="<?= base_url() ?>public/assets/js/plugins/knockout/knockout-3.4.2.js"></script>

  <!-- Page specific javascripts-->
  <?= $this->renderSection("scripts"); ?>

  <script>
    $(document).ready(function() {
      $('.select2').select2({
        dropdownParent: $("#add_property-modal")
      });
    });
  </script>
  <!-- <script async defer
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDTURido_kO6MfC6GG26PhI-_JufYwxcjw&callback=initMap">
</script> -->
  <!-- Google analytics script-->
<?= $this->include('includes/helpers'); ?>
</body>

</html>
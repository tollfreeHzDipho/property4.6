<?= $this->extend("includes/template") ?> 
<?= $this->section("styles") ?>
    <!-- Toastr style -->
    <link href="<?=base_url()?>public/assets/css/plugins/cropping/croppie.css" rel="stylesheet">
<?=$this->endSection();?>
<?= $this->section("content") ?>
<!-- Page title bar --> 
<div class="app-title">
  <div>
    <h1><i class="fa fa-users"></i> Users</h1>
    <p>View, Add, Update and Manage Users</p>
  </div>
  <button type="button" class="btn btn-sm btn-warning pull-right" data-toggle="modal" data-target="#locate_me"><i class="fa fa-map-marker"></i> Search the Map</button>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="tile">
      <div class="bs-component">

<div class="row">
    <div class="col-xs-12 col-sm-6 col-md-5 col-lg-3">
    <!-- ========LOAD  MEMBER NAV BAR HERE =============== -->
           <?php echo view('users/user_nav'); ?>
    <!-- ========MEMBER NAV BAR =============== -->
    </div>
    <div class="col-xs-12 col-sm-6 col-md-7 col-lg-9" >
        <div class="ibox ">
            <div class="ibox-content">
                <div class="tabs-container">
                <div class="tab-content" style="min-height:500px;">
                        <?php echo view('users/staff/profile'); ?>
                        <?php  //echo view('users/staff/role/role_view_tab'); ?>
                    <?php echo view('users/staff/contact/contact_view_tab'); ?>
                    <?php echo view('users/staff/password/password_view_tab'); ?>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

        </div>

    </div>
  </div>
</div>
<?=$this->endSection()?>
<?=$this->section('scripts')?>
<script src="<?php echo base_url('public/assets/js/plugins/cropping/croppie.js') ?>"></script>
<script src="<?php echo base_url('public/assets/js/plugins/validate/jquery.validate.min.js') ?>"></script>
<script>
    var dTable = {};
    var TableManageButtons = {};

    $(document).ready(function () {
        
        <?php echo view('users/staff/profile_pic_js.php'); ?>
        // $("#village_id").select2({allowClear: true, dropdownParent: $("#add_address-modal") });

        //.......................end of address.................
        $('#formContact').validator().on('submit', saveData);
       // $('#formUser_role').validator().on('submit', saveData);
        $('#formPassword').validator().on('submit', saveData);
      
        //contact javascript 
        var handleDataTableButtons = function (tabClicked) {
        <?php echo view('users/staff/contact/contact_js'); ?>
        <?php //$this->view('users/staff/role/user_role_js'); ?>
        };
        TableManageButtons = function () {
            "use strict";
            return {
                init: function (tabClicked) {
                    handleDataTableButtons(tabClicked);
                }
            };
        }();
        TableManageButtons.init("tab-active");
        TableManageButtons.init("tab-contact");

        
    });
    function reload_data(form_id, response) {
        switch (form_id) {
            case "formContact; ?>":
                break;            
            default:
                //nothing really to do here
                break;
        }
    }
   
</script>
<?=$this->endSection()?>

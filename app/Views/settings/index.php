<?= $this->extend("includes/template") ?> 
<?= $this->section("styles") ?>
    <!-- Toastr style -->
    <link href="<?=base_url()?>public/assets/js/plugins/select2/select2.min.css" rel="stylesheet">
<?=$this->endSection();?>
<?= $this->section("content") ?>
<!-- Page title bar --> 
<div class="app-title">
  <div>
    <h1><i class="fa fa-cogs"></i> Settings</h1>
    <p>View, Add, Update and Manage the System</p>
  </div>
  <button type="button" class="btn btn-sm btn-warning pull-right" data-toggle="modal" data-target="#locate_me"><i class="fa fa-map-marker"></i> Search the Map</button>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="tile">
      <div class="bs-component">
              <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item"><a class="nav-link active" data-toggle="tab" data-bind="click: display_table" href="#tab-branch">Branch</a></li>
                <li class="nav-item"><a class="nav-link " data-toggle="tab" data-bind="click: display_table" href="#tab-role">Roles</a></li>   
                <li class="nav-district"><a class="nav-link " data-toggle="tab" data-bind="click: display_table" href="#tab-district">Districts</a></li>
                <li class="nav-item"><a class="nav-link " data-toggle="tab" data-bind="click: display_table" href="#tab-bank">Banks</a></li>       
              </ul>
          <div class="tab-content" id="myTabContent">
          <?php echo view('settings/branches/tab_view');?>
          <?php echo view('settings/roles/tab_view');?>
          <?php echo view('settings/districts/tab_view');?>
          <?php echo view('settings/banks/tab_view');?>
          </div>

         <?php echo view('settings/branches/add_branch_modal');?>
         <?php echo view('settings/roles/add_role_modal');?>
         <?php echo view('settings/districts/add_district_modal');?>
         <?php echo view('settings/banks/add_bank_modal');?>

        </div>
   
    </div>
  </div>
</div>
<?= $this->endSection() ?> 
<?= $this->section("scripts") ?>
<script src="<?php echo base_url('public/assets/js/plugins/select2/select2.full.min.js') ?>"></script>
<script src="<?php echo base_url('public/assets/js/plugins/validate/jquery.validate.min.js') ?>"></script>
<script type="text/javascript">
var dTable = {};
  var settingsModel = {};
  var TableManageButtons = {};
  var counter=1;
$(document).ready( function () {
      var SettingsModel = function () {
        var self = this;
        self.display_table = function (data, click_event) {
            TableManageButtons.init($(click_event.target).prop("hash").toString().replace("#", ""));
        };
        
        self.initialize_edit = function () {
            edit_data(self.formatOptions(), "form");
        };

    };
    settingsModel = new SettingsModel();
      ko.applyBindings(settingsModel);

var handleDataTableButtons = function(tabClicked) {
  <?php echo view('settings/branches/table_js'); ?>
  <?php echo view('settings/roles/table_js'); ?>
  <?php echo view('settings/districts/table_js'); ?>
  <?php echo view('settings/banks/table_js'); ?>

};
TableManageButtons = function () {
    "use strict";
    return {
        init: function (tabClicked) {
            handleDataTableButtons(tabClicked);
        }
    };
}();
TableManageButtons.init("tab-branch");

$('#formBranch').validate({submitHandler: saveData2});
$('#formRole').validate({submitHandler: saveData2});
$('#formBank').validate({submitHandler: saveData2});
$('#formDistrict').validate({submitHandler: saveData2});
} );


function reload_data(formId, reponse_data)
    {
     switch (formId) {
            case "formBranch":
            counter=1;
                break;
            case "formRole":
            counter=1;
                break;
            case "formBank":
            counter=1;
                break;
            case "formDistrict":
            counter=1;
                break;
            default:
                break;
         }
      
 }
 </script>
<?= $this->endSection() ?>
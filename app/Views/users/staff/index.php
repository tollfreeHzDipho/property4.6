<?= $this->extend("includes/template") ?> 
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
      <?php if(($_SESSION['role_id']==1) ||($_SESSION['role_id']==5)) { ?>
             <button type="button" class="btn btn-sm btn-primary pull-right" data-toggle="modal" data-target="#add_staff-modal"><i class="fa fa-plus-circle"></i> Add User</button>
      <?php } ?>

          <ul class="nav nav-tabs">
            <li class="nav-item"><a class="nav-link active" data-toggle="tab" data-bind="click: display_table" href="#active">Active</a></li>
            <li class="nav-item"><a class="nav-link" data-toggle="tab" data-bind="click: display_table" href="#inactive">Inactive</a></li>
          </ul>

          <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade active show" id="active">
            <br>
            <div class="table-responsive">
              <table class="table table-hover table-sm table-bordered table-stripped" id="tblStaff"  width="100%">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Initials</th>
                    <th>Phone Number</th>
                    <th>Email</th>
                    <th>Branch</th>
                    <th>Status</th>
                    <?php if(($_SESSION['role_id']==1) ||($_SESSION['role_id']==5)) { ?>
                    <th>Action</th>
                    <?php } ?>
                  </tr>
                </thead>
                <tbody>

                </tbody>
               </table>
            </div>
            </div>
            <div class="tab-pane fade" id="inactive">
            <br>
            <div class="table-responsive">
              <table class="table table-hover table-sm table-bordered table-stripped" id="tblStaff_inactive" width="100%"> 
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Initials</th>
                    <th>Phone Number</th>
                    <th>Email</th>
                    <th>Branch</th>
                    <th>Status</th>
                    <?php if(($_SESSION['role_id']==1) ||($_SESSION['role_id']==5)) { ?>
                    <th>Action</th>
                    <?php } ?>
                  </tr>
                </thead>
                <tbody>

                </tbody>
               </table>
            </div>
           </div>
          </div>
         <?php echo view('users/staff/signup_modal.php');?>
        </div>

    </div>
  </div>
</div>
<?= $this->endSection() ?> 
<?= $this->section("scripts") ?>
<script src="<?php echo base_url('public/assets/js/plugins/validate/jquery.validate.min.js') ?>"></script>
<script type="text/javascript">
var dTable = {};
var staffModel = {};
var TableManageButtons = {};
var counter=1;
$(document).ready( function () {
  var StaffModel = function () {
        var self = this;
        self.display_table = function (data, click_event) {
            TableManageButtons.init($(click_event.target).prop("hash").toString().replace("#", ""));
        };
        
        self.initialize_edit = function () {
            edit_data(self.formatOptions(), "form");
        };

    };
    staffModel = new StaffModel();
    ko.applyBindings(staffModel);

var handleDataTableButtons = function(tabClicked) {
<?php echo view('users/staff/table_js_active'); ?>
<?php echo view('users/staff/table_js_inactive'); ?>

};
TableManageButtons = function () {
    "use strict";
    return {
        init: function (tabClicked) {
            handleDataTableButtons(tabClicked);
        }
    };
}();
TableManageButtons.init("active");

$('#formStaff').validate({submitHandler: saveData2});
} );


function reload_data(formId, reponse_data)
    {
     switch (formId) {
            case "formStaff":
              counter=1;
                break;
           
            default:
                //nothing really to do here
                break;
         }
      
 }
 </script>
 <?= $this->endSection() ?> 
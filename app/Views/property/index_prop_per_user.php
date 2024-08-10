<!-- Page title bar --> 
<div class="app-title">
  <div>
    <h1><i class="fa fa-bars"></i> Properties valued by: <?php echo ucwords(strtolower($valuer_name['first_name']." ".$valuer_name['last_name']." ".$valuer_name['other_names'])); ?></h1>
    <p class="text-secondary">All the properties are categorised under 'Active' and 'Inactive' tabs below</p>
  </div>
  <ul class="app-breadcrumb breadcrumb">
    <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
    <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard'); ?>">Dashboard</a></li>
  </ul>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="tile">
      <div class="bs-component">
             <!-- <button type="button" class="btn btn-sm btn-primary pull-right" data-toggle="modal" data-target="#add_property-modal"><i class="fa fa-plus-circle"></i> Add Property</button> -->

          <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item"><a class="nav-link active" data-toggle="tab" data-bind="click: display_table" href="#tab-active">Active</a></li>
            <li class="nav-item"><a class="nav-link " data-toggle="tab" data-bind="click: display_table" href="#tab-inactive">Inactive</a></li>            
          </ul>

          <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade active show" id="tab-active">
            <br>	
            <div class="table-responsive">
              <table class="table table-hover table-sm table-bordered table-stripped" id="tblProperty_pa_valuer" >
                <thead>
                  <tr >
                     <th>#Serial Number</th>
                    <th class="ptenure">Tenure</th>
                    <th class="paddress">Property Address</th>
                    <th>District</th>
                    <th>Town</th>
                    <th>Village</th>
                    <th class="pbank">Bank</th>
                    <th>Nothings</th>
                    <th>Eastings</th>
                    <th>Acreage</th>
                    <th>Rate Per Acre</th>
                    <th>Land Value</th>
                    <th>User Status</th>
                    <th>Date of Valuation</th>
                    <th>Valued By (initials)</th>
                    <th>Status</th>
               <?php if(($_SESSION['role_id']==1) ||($_SESSION['role_id']==5)||($_SESSION['role_id']==3)) { ?>
                    <th class="paction">Created By</th>
                    <th class="paction">Date Created</th>
                    <th class="paction">Action</th>
                <?php }  ?>             
                  </tr>
                </thead>
                <tbody>

                </tbody>
               </table>
               <div class="table-responsive">
            </div>
            
          </div>
         <?php //echo view('property/add_property_modal');?>

        </div>
        <div class="tab-pane fade " id="tab-inactive">
            <br>
            <div class="table-responsive">
              <table class="table table-hover table-sm table-bordered table-stripped" id="tblProperty_pa_valuer_inactive" >
                <thead>
                  <tr >
                     <th>#Serial Number</th>
                    <th class="ptenure">Tenure</th>
                    <th class="paddress">Property Address</th>
                    <th>District</th>
                    <th>Town</th>
                    <th>Village</th>
                    <th class="pbank">Bank</th>
                    <th>Nothings</th>
                    <th>Eastings</th>
                    <th>Acreage</th>
                    <th>Rate Per Acre</th>
                    <th>Land Value</th>
                    <th>User Status</th>
                    <th>Date of Valuation</th>
                    <th>Valued By (initials)</th>
                    <th>Status</th>
               <?php if(($_SESSION['role_id']==1) ||($_SESSION['role_id']==5)||($_SESSION['role_id']==3)) { ?>
                    <th class="paction">Created By</th>
                    <th class="paction">Date Created</th>
                    <th class="paction">Action</th>
                <?php }  ?>  
                  </tr>
                </thead>
                <tbody>

                </tbody>
               </table>
               <div class="table-responsive">
            </div>
            
          </div>
         <?php //echo view('property/add_property_modal');?>

        </div>


    </div>
  </div>
</div>
<script type="text/javascript">
var dTable = {};
  var propertyModel = {};
  var TableManageButtons = {};
  var counter=1;
$(document).ready( function () {
      var PropertyModel = function () {
        var self = this;
        self.display_table = function (data, click_event) {
            TableManageButtons.init($(click_event.target).prop("hash").toString().replace("#", ""));
        };
        
        self.initialize_edit = function () {
            edit_data(self.formatOptions(), "form");
        };

    };
    propertyModel = new PropertyModel();
      ko.applyBindings(propertyModel);

var handleDataTableButtons = function(tabClicked) {
  <?php $this->view('property/table_js_active_per_user'); ?>
  <?php $this->view('property/table_js_inactive_per_user'); ?>

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

$('#formProperty').validate({submitHandler: saveData2});
} );


function reload_data(formId, reponse_data)
    {
     switch (formId) {
        case "formProperty":
        counter=1;
        break;
       
        default:
            //nothing really to do here
        break;
    }
 }
 </script>

<div class="tab-pane fade show settings" id="tab-district">
    <br>
<?php if(($_SESSION['role_id']==1) ||($_SESSION['role_id']==5)) { ?>
    <button type="button" class="btn btn-sm btn-primary pull-right" data-toggle="modal" data-target="#add_district"><i class="fa fa-plus-circle"></i> Add District </button>
<?php } ?>
    <div class="table-responsive">
    <br>
        <table class="table table-hover table-sm table-bordered table-stripped" id="tblDistrict"  width="100%" >
        <thead>
            <tr >
            <th>#</th>
            <th>District</th>
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
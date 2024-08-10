<div class="tab-pane fade active show settings" id="tab-branch">
    <br>
<?php if(($_SESSION['role_id']==1) ||($_SESSION['role_id']==5)) { ?>
    <button type="button" class="btn btn-sm btn-primary pull-right" data-toggle="modal" data-target="#add_branch"><i class="fa fa-plus-circle"></i> Add Branch </button>
<?php } ?>
    <div class="table-responsive">
    <br>
        <table class="table table-hover table-sm table-bordered table-stripped" id="tblBranch" width="100%">
        <thead>
            <tr >
            <th>#</th>
            <th>Branch Name</th>
            <th>Branch Address</th>
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
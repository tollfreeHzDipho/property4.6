<div id="tab-contact" class="tab-pane">
    <div class="pull-right add-record-btn">
    <?php if(($_SESSION['role_id']==1) ||($_SESSION['role_id']==5)||($_SESSION['id']==$user['id'])) { ?>
        <button class="btn btn-primary btn-sm" type="button" data-toggle="modal" data-target="#add_contact-modal"><i class="fa fa-edit"></i> Add Contact </button>
    <?php } ?>
        <?php echo view('users/staff/contact/contact_modal'); ?>
    </div>
    <div class="table-responsive">
        <table id="tblContact" class="table table-striped  table-hover"  width="100%">
            <thead>
                <tr>
                    <th>Phone Number</th>
                    <th>Type</th>
    <?php if(($_SESSION['role_id']==1) ||($_SESSION['role_id']==5)||($_SESSION['id']==$user['id'])) { ?>
                    <th>Action</th>   
      <?php } ?>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div><!-- ==END TAB-CONTACT =====-->
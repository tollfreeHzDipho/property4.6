<div id="profile" class="tab-pane active" >
    <!-- ================== START YOUR CONTENT HERE =============== -->
    <div class="col-md-12">
        <?php echo view('users/staff/profile_pic_modal.php'); ?>
        <div class="profile-info">
            <div class="row">
                <div class="col-lg-12">
                    <div class="modal-body">

                        <table class="table table-user-information  table-stripped  m-t-md">
                            <tbody >
                                <tr>
                                    <td><strong>Mobile Number</strong></td>
                                    <td colspan="3" ><?php echo isset($user['mobile_number'])?$user['mobile_number']:''; ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Email</strong></td>
                                    <td colspan="3"><?php echo isset($user['email'])?$user['email']:''; ?></td>
                                </tr>
                                 <tr>
                                    <td><strong>Branch</strong></td>
                                    <td colspan="3"><?php echo isset($user['branch_name'])?$user['branch_name']:''; ?></td>
                                </tr>
                               <tr>
                                    <td><strong>Firm/Organisation</strong></td>
                                    <td colspan="3"><?php echo isset($user['firm_name'])?$user['firm_name']:''; ?></td>
                                </tr>
                               
                                <tr>
                                    <td><strong>Role</strong></td>
                                    <td ><?php echo isset($user['role_name'])?$user['role_name']:''; ?></td>
                                    <td><strong>Status</strong></td>
                                    <td ><span class="badge badge-primary"><?php echo isset($user['status_name'])?$user['status_name']:''; ?></span></td> 
                                </tr>
                                
                                <tr>
                                    <td><strong>Comment</strong></td>
                                    <td ><?php echo isset($user['comment'])?$user['comment']:''; ?></td>
                                </tr>
                            </tbody>
                        </table>
                      <?php
                        echo view('users/staff/signup_modal');
                        ?>
                    </div>  
                </div>
            </div>
        </div>

        <hr>
        <div  class="row"  style="font-size:12px;">
           <div class="col-md-6">
                <div class="row">
                    <div class="col-md-4">
                        <span><strong>Created By :</strong></span>
                    </div>

                    <div class="col-md-8">
                        <span ><?php echo (isset($user['createdby_firstname'])?$user['createdby_firstname']:"")." ".(isset($user['createdby_lastname'])?$user['createdby_lastname']:""); ?></span>
                    </div>

                    <div class="col-md-4">
                        <span><strong>Date :</strong></span>
                    </div>

                    <div class="col-md-8">
                        <span ><?php echo isset($user['date_created'])?date("d-M-Y",strtotime($user['date_created'])):""; ?></span>
                    </div>  
                </div>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-4">
                        <span><strong>Modified By:</strong></span>
                    </div>

                    <div class="col-md-8">
                        <span ><?php echo (isset($user['modifiedby_firstname'])?$user['modifiedby_firstname']:"")." ".(isset($user['modifiedby_lastname'])?$user['modifiedby_lastname']:""); ?></span>
                    </div>

                    <div class="col-md-4">
                        <span><strong>Date:</strong></span>
                    </div>

                    <div class="col-md-8">
                        <span ><?php echo isset($user['date_modified'])?date("d-M-Y",strtotime($user['date_modified'])):''; ?></span>
                    </div>  
                </div>
            </div>
        </div>
    </div> 

</div>

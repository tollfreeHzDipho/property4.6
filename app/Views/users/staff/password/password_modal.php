<!-- bootstrap modal -->
<div class="modal inmodal fade" id="password-modal" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
         <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h3 class="modal-title">Password</h3>
            </div>
            <div class="modal-body">
            <form action="<?=base_url()?>/password/create" id="formPassword" class="formValidate" name="formPassword" method="post" role="form" enctype="multipart/form-data" accept-charset="utf-8" novalidate="true">
           
            <input type="hidden" name="user_id" value="<?php echo isset($user['id'])?$user['id']:""; ?>">
            
            <div class="form-group row">
            <label class="col-lg-4 col-form-label">New Password<span class="text-danger">*</span></label>
            <div class="col-lg-8">
                <div class="input-group ">
                <input type="password" name="password"  placeholder="*********" id="password" class="form-control m-b" required="required">
                </div>
            </div>
            </div>
            <div class="form-group row">
            <label class="col-lg-4 col-form-label">Confirm password<span class="text-danger">*</span></label>
            <div class="col-lg-8">
                <div class="input-group ">
                <input type="password" name="confirmpassword" placeholder="*********" id="confirmpassword" class="form-control m-b" required="required">
                </div>
            </div>					
            </div>
            <div class="form-group row">
            <div class="col-lg-12">
            <div class="pull-right">
            <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
            <?php if((isset($user['id'])?$user['id']:""==$_SESSION['id']) || ($_SESSION['role_id']==1)){ ?>
                <button id="btn-submit" type="submit" class="btn btn-success btn-sm save_data">
                        <i class="fa fa-check"></i> Set Password</button>
            <?php } ?>
          
                </div>
            </div>					
            </div>					
          </form>
          </div>
        </div>
    </div>
</div>
<!-- bootstrap modal ends -->

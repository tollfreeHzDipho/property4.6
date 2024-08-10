<style>
.allcaps{text-transform: uppercase;}
.firstcap{text-transform: capitalize;}
.lowercase{text-transform: lowercase;}
</style> 
<div class="modal fade" id="add_staff-modal" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg"  role="document">
        <div class="modal-content">
            <form method="post" class="formValidate" action="<?php echo base_url(); ?>create_staff" id="formStaff">
                <div class="modal-header">
                      <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">X</span></button>
                      <h4 ><center>User Details </center>
                      </h4>
                      <center><small class="font-bold">Note: Required fields are marked with <span class="text-danger">*</span></small></center>
                </div>
                <div class="modal-body">
                        <input type="hidden" name="id">
                        <input type="hidden" name="firm_id"  value="1">
                        <div class="form-group row">

                            <label class="col-lg-2 col-form-label">Salutation<span class="text-danger">*</span></label>
                            <div class="col-lg-4 form-group">
                                <select class="form-control" required name="salutation">
                                    <option value="" selected>-select-</option>
                                    <option value="Mr." >Mr</option>
                                    <option value="Mrs.">Mrs</option>
                                    <option value="Miss.">Miss</option>
                                    <option value="Dr.">Dr</option>
                                </select>
                            </div>
                            <span  class="help-block with-errors" aria-hidden="true"></span>
                            <label class="col-lg-2 col-form-label">First Name<span class="text-danger">*</span></label>
                            <div class="col-lg-4 form-group">
                                <input placeholder="" required class="form-control firstcap" name="first_name" type="text">
                            </div>
                            <span  class="help-block with-errors" aria-hidden="true"></span>
                        </div>
                        <div class="form-group row">
                        <label class="col-lg-2 col-form-label">Last Name<span class="text-danger">*</span></label>
                            <div class="col-lg-4 form-group">
                                <input placeholder="" required class="form-control firstcap" name="last_name" type="text">
                            </div>
                            <span  class="help-block with-errors" aria-hidden="true"></span>

                            <label class="col-lg-2 col-form-label">Other Name(s)</label>
                            <div class="col-lg-4 form-group">
                                <input placeholder="" class="form-control firstcap" name="other_names" type="text"> 
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-2 col-form-label">Gender<span class="text-danger">*</span></label>
                            <div class="col-lg-4 form-group">
                               <select class="form-control" required name="gender">
                                    <option value="" selected>-select-</option>
                                    <option value="Male" >Male</option>
                                    <option value="Female">Female</option>
                                </select> 
                            </div>
                           <label class="col-lg-2 col-form-label">Initials</label>

                          <div class="col-lg-4 form-group">
                              <input placeholder="" required class="form-control allcaps" name="initials" type="text">
                          </div>                         
                        </div>                    
                        <div class="form-group row">
                          <label class="col-lg-2 col-form-label">Email<span class="text-danger">*</span></label>

                            <div class="col-lg-4 form-group">
                                <input placeholder="" required class="form-control lowercase" name="email" type="email" autosave="off" autocomplete="off">
                            </div>
                           
                            <label class="col-lg-2 col-form-label">Branch<span class="text-danger">*</span></label>
                            <div class="col-lg-4 form-group">
                                <select id='branch_id' class="form-control" name="branch_id" required>
                                    <option selected value="" >Please select Branch</option>
                                    <?php
                                    foreach ($branches as $branch) {
                                        echo "<option value='" . $branch['id'] . "'>" . $branch['branch_name'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-2 col-form-label">Comment</label>
                            <div class="col-lg-10 form-group">
                                <textarea class="form-control" rows="2" name="comment" id="comment"></textarea>
                            </div>
                        </div>
                        <?php if(($_SESSION['role_id']==1) ||($_SESSION['role_id']==5)){ ?>
                        <div class="form-group row">
                            <label class="col-lg-6 col-form-label">System Role <small> (Leave it empty if your not sure ) </small> </label>
                            <div class="col-lg-6 form-group">
                                <select id='branch_id' class="form-control" name="role_id">
                                    <?php
                                    foreach ($roles as $role) {
                                        echo "<option value='" . $role['id'] . "'>" . $role['role_name'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <?php } ?>
                </div>
                 <div class="modal-footer">
                      <button id="btn-cancel" class="btn btn-secondary" name="btn_cancel" type="button" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>

                      <button  id="btn-submit" type="submit" class="btn btn-primary save_data" type="button"> <i class="fa fa-check"></i>  Save </button>
                  </div>                
            </form>
        </div>
    </div>
</div>


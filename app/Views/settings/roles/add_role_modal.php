    
<div class="modal fade" id="add_role" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-md"  role="document">
        <div class="modal-content">
            <form method="post" class="formValidate" action="<?php echo base_url(); ?>create_role" id="formRole" name="formRole">
                <div class="modal-header">
                      <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">X</span></button>

                      <h4 ><center> Roles </center>
                      </h4>
             <center><small class="font-bold">Note: Required fields are marked with <span class="text-danger">*</span></small></center>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id">
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label">Role<span class="text-danger">*</span></label>
                            <div class="col-lg-8 form-group">
                                <input placeholder="" required class="form-control" name="role_name" type="text">
                            </div>
                            <span  class="help-block with-errors" aria-hidden="true"></span>
                        </div>
                       
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label">Description</label>
                            <div class="col-lg-8 form-group">
                                <textarea class="form-control" rows="2" required name="description" id="description"></textarea>
                            </div>
                        </div>

                </div>
                 <div class="modal-footer">
                      <button id="btn-cancel" class="btn btn-secondary" name="btn_cancel" type="button" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>

                      <button  id="btn-submit" type="submit" class="btn btn-primary save_data" type="button"> <i class="fa fa-check"></i>  Save </button>
                  </div>
                
            </form>
        </div>
    </div>
</div>


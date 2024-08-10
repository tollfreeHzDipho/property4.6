<!-- bootstrap modal -->
<div class="modal inmodal fade" id="add_contact-modal" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <form method="post" class="formValidate" action="<?php echo base_url(); ?>create_contact" id="formContact">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h3 class="modal-title">Contacts</h3>
                    <small class="font-bold">Please Make sure you enter all the required fields correctly</small>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="id">                
                    <input type="hidden"  name="user_id" id="user_id" value="<?php echo isset($user['id'])?$user['id']:''; ?>">
                    <div class="row">
                    <label class="col-lg-12 col-form-label">Mobile number *</label> 
                        <div class="form-group col-lg-12">
                            <input name="mobile_number" id="mobile_number" type="tel" class="form-control" placeholder="070--" pattern="^(0|\+256)[2347]([0-9]{8})" data-pattern-error="Wrong number format, start with + 0" required />
                        </div>
                    </div>
                    <div class="row">
                     <label for="contact_type_id" class="form-control-label  col-lg-12"> Contact type *</label>
                        <div class="form-group  col-lg-12">
                            <select id='contact_type_id' class="form-control required" name="contact_type_id" >
                                <option value="">--Select--</option>
                                <?php
                                    foreach ($contact_types as $contact_type) {
                                        echo "<option value='" . $contact_type['id'] . "'>" . $contact_type['contact_type'] . "</option>";
                                    }
                                ?>
                            </select>
                            </div>
                        </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="add_property-modal"  role="dialog"   style="display: none;">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
        <form method="post" class="formValidate" action="<?php echo base_url(); ?>create_property" id="formProperty">
                <div class="modal-header">
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">X</span></button>

                    <h4>
                        <center>Property Data </center>
                    </h4>
                    <center><small class="font-bold">Note: Required fields are marked with <span class="text-danger">*</span></small></center>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id">
                    <input class="form-control" type="text" hidden value="1" name="firm_id">

                    <div class="row ">
                        <div class="form-group col-md-12">
                            <label class="control-label">Tenure</label>
                            <input class="form-control" required type="text" placeholder="Tenure" name="tenure">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-7 form-group border-right">

                            <label class="control-label">Property Address</label>
                            <textarea class="form-control" required rows="5" placeholder="Plot No. & Street No. or Road name" name="property_address"></textarea>

                        </div>
                        <div class="row col-md-5  pr-0">
                            <div class="form-group col-md-12 pr-0">
                                <label class="control-label">North (latitude)</label>
                                <input class="form-control" type="text" placeholder="" name="north" id="north">
                            </div>
                            <div class="form-group col-md-12 pr-0 hemisphere" hidden>
                                <label class="control-label">Hemisphere</label>
                                <select class="myzone form-control" name="zone">
                                    <option value="">Select Hemisphere</option>
                                    <option value="36 N">36 N</option>
                                    <option value="36 S">36 S</option>
                                    <option value="35 S">35 S (Extreme SW Uganda)</option>
                               </select>
                            </div>
                            <div class="form-group col-md-12 pr-0">
                                <label class="control-label">East (longitude)</label>
                                <input class="form-control" type="text" placeholder="" name="east" id="east" >
                            </div>
                            
                        </div>
                    </div><!--
                    <input class="form-control" type="hidden"  id="c_north" name="c_north" readonly>
                    <input class="form-control" type="hidden" id="c_east" name="c_east" readonly>
                     <div class="row bg-light border-top border-bottom" id="conversion-result" >
                        <div class="col-md-7 form-group border-right">

                            <label class="control-label">Map preview</label>
                            <div id="mymap">

                            </div>

                        </div>
                        <div class="row col-md-5  pr-0">
                            <div class="form-group col-md-12 pr-0">
                                <label class="control-label">Converted North (latitude)</label>
                                <input class="form-control" type="hidden"  id="convnorth" name="convnorth" readonly>
                            </div>
                            <div class="form-group col-md-12 pr-0">
                                <label class="control-label">Converted East (longitude)</label>
                                <input class="form-control" type="hidden" id="conveast" name="conveast" readonly>
                            </div>
                            
                        </div>
                    </div>
                    -->
                    <div class="row ">
                        <div class="form-group col-md-4 ">
                            <label class="control-label">District</label><br>
                            <select name="district_id" required id="district" class="form-control">
                                <option selected value="">--Please select district--</option>

                                <?php if ($districts)  {
                                    foreach ($districts as $district) {
                                        echo "<option value='" . $district['id'] . "'>" . $district['district_name'] . "</option>";
                                    }
                                } else {
                                    echo "<option>--No results--</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label">Town</label>
                            <input class="form-control" type="text" placeholder="Town/County" name="town_id">
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label">Village</label>
                            <input class="form-control" type="text" placeholder="Village/Parish" name="village_id">
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label">Acreage</label>
                            <input class="form-control" required type="text" placeholder="Enter Acreage" name="acreage">
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label">Rate Per Acre</label>
                            <div class="input-group">
                                <div class="input-group-prepend"><span class="input-group-text">Shs.</span></div>
                                <input class="form-control" id="exampleInputAmount" type="number" placeholder="Amount" name="rate_per_acre">
                            </div>
                        </div>
                    <div class="form-group col-md-4">
                        <label class="control-label">Land Value</label>
                        <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text">Shs.</span></div>
                        <input class="form-control"  data-a-sign="" data-a-dec="," data-a-sep="." id="property_value" type="number" placeholder="Amount" name="property_value">
                       </div>
                      <span  class="help-block with-errors" aria-hidden="true"></span>

                    </div>
                  <!--   <div class="form-group col-md-4">
                        <label class="control-label">Development Status</label>
                        <select name="DEV_STATUS" id="Select" class="form-control">
                          <option value="N/A">--select-- </option>
                          <option value="Developed">Developed</option>
                          <option value="Undeveloped">Undeveloped</option>
                        </select>
                    </div> -->

                        <div class="form-group col-md-4">
                            <label class="control-label">User Status</label>
                            <select name="user_status" id="p_user" class="form-control">
                                <option value="N/A">--select--</option>
                                <option value="Residential">Residential</option>
                                <option value="Commercial">Commercial</option>
                                <option value="Industrial">Industrial</option>
                                 <option value="Factory">Factory</option>
                                <option value="School">School</option>
                                <option value="Farm">Farm</option>
                                <option value="Land">Land</option>
                                <option value="Hostel">Hostel</option>
                                <option value="Other">Other</option>
                            </select>
                            <input type="text" id="other" name="user_option" class="form-control" style="display: none;" placeholder="Please Specify here.....">
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label">Bank </label>
                            <select name="bank_id" required id="p_bank" class="form-control">
                                <option selected value="">--Select Bank--</option>
                                <?php if ($banks) {
                                    foreach ($banks as $bank) {
                                        echo "<option value='" . $bank['id'] . "'>" . $bank['bank_name'] . "</option>";
                                    }
                                } else {
                                    echo "<option>--No Banks Available--</option>";
                                }
                                  ?>
                                <option value="9999">Other</option>

                          </select>
                            <input type="text" id="other_bank" name="bank_option" class="form-control" style="display: none;" placeholder="Please Specify here.....">
                    </div>
                    <div class="form-group col-md-4">
                        <label class="control-label">Date of Valuation</label>
                            <div class="input-group date">
                                <input class="form-control"  name="date_of_val" type="text"/> <div class="input-group-prepend input-group-addon"> <span class="input-group-text"><i class="fa fa-calendar "></i></span></div>
                               
                            </div>
                         <span  class="help-block with-errors" aria-hidden="true"></span>

                    </div>
                    <div class="form-group col-md-4">
                        <label class="control-label">Valued By</label>
                        <select name="valuer_id" required id="valuer" class="form-control ">
                          <option selected value="" >Please select user</option>
                          <?php if($valuers){
                                  foreach ($valuers as $valuer) {
                                      echo "<option value='" . $valuer['id'] . "'>" . $valuer['first_name']." ".$valuer['last_name']." ".$valuer['other_names']."( ".$valuer['initials']." )</option>";
                                  }
                                }else{
                                   echo "<option>--No results--</option>";
                                }
                                ?>
                            </select>
                        </div>


                        <div class="form-group col-md-8">
                            <label class="control-label">Notes</label>
                            <textarea class="form-control" type="text" placeholder="Special notes go here..." name="notes"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="btn-cancel" class="btn btn-secondary" name="btn_cancel" type="button" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>

                    <button id="btn-submit" type="submit" class="btn btn-primary save_data" type="button"> <i class="fa fa-check"></i> Save </button>
                </div>

            </form>
        </div>
    </div>
</div>
<script>
$('.select2').css({"width": ''}).css({'width':'100%','height':'36px','font-size': '0.875rem','line-height':' 1.5','color': '#495057','background-color': '#FFF','background-clip': 'padding-box','border': '2px solid #ced4da','border-radius': '4px','-webkit-transition': 'border-color 0.15s ease-in-out'});
$('#mymap').css({"height":"120px","width":"100%"});
                        $(document).ready(function() {   
                        $('#p_user').change(function(){   
                        if($('#p_user').val() === 'Other')   
                           {   
                           $('#other').show();    
                           }   
                        else 
                           {   
                           $('#other').hide();      
                           }   
                        }); 
                         $('#p_bank').change(function(){   
                        if($('#p_bank').val() === '9999')   
                           {   
                           $('#other_bank').show();    
                           }   
                        else 
                           {   
                           $('#other_bank').hide();      
                           }   
                        });   
                        });   
        
</script>

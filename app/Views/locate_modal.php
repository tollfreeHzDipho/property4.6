    
<div class="modal fade" id="locate_me" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-sm"  role="document">
        <div class="modal-content">
            <form method="post" action="<?php echo base_url(); ?>map_view">
                <div class="modal-header">
                      <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">X</span></button>

                      <h4 ><center> Search the Map </center>
                      </h4>
             <center><small class="font-bold">Search with coordinates<span class="text-secondary">*</span></small></center>
                </div>
                <div class="modal-body">
                   <div class="row">
                            <div class="form-group col-md-12">
                                <label class="control-label">North (latitude) (Y)</label>
                                <input class="form-control" required type="text" placeholder="" name="north" id="north">
                            </div>
                            <div class="form-group col-md-12  hemisphere" hidden>
                                <label class="control-label">Hemisphere</label>
                                <select class="myzone form-control" name="ZONE">
                                    <option value="">Select Hemisphere</option>
                                    <option value="36 N">36 N</option>
                                    <option value="36 S">36 S</option>
                                    <option value="35 S">35 S (Extreme SW Uganda)</option>
                                    
                               </select>
                            </div>
                            <div class="form-group col-md-12 ">
                                <label class="control-label">East (Longitude) (X)</label>
                                <input class="form-control" required type="text" placeholder="" name="east" id="east" >
                            </div>
                             <input class="form-control" type="hidden"  id="CONVNORTH" name="CONVN" readonly>
           <input class="form-control" type="hidden" id="CONVEAST" name="CONVE" readonly>
                        </div>
                </div>
                 <div class="modal-footer">
                      <button id="btn-cancel" class="btn btn-secondary" name="btn_cancel" type="button" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>

                      <button  id="btn-submit" type="submit" class="btn btn-primary" type="button"> <i class="fa fa-map-marker"></i>  Search </button>
                  </div>
                
            </form>
        </div>
    </div>
</div>


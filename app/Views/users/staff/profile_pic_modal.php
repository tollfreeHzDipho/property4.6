<style>
    .cabinet{
        display: block;
        cursor: pointer;
        position:relative;	
    }
    #upload-sh{
        width: auto;
        height: 250px;
        padding-bottom:25px;
    }

    figure figcaption {
        position: absolute;
        top: 74px;
        color: #fff;
        right:18px;
        padding-right:9px;
        padding-bottom: 5px;
        text-shadow: 0 0 5px #000;
        opacity:0.4;
    }
</style>
<div class="row">
<div class="col-md-3">
    <label class="profile-image cabinet" >
    <figure>
            <img class="app-sidebar__user-avatar gambar img-responsive img-thumbnail img-circle " src="<?php 
           if (empty($user['photo'])) { echo base_url('public/uploads/images/avatar.png'); } else { echo base_url("public/uploads/profile_pics/".$user['photo']); } ?>" alt="User Image" id="item-img-output" style="min-height:110px !important; min-width:110px !important;">
        <figcaption ><i class="fa fa-2x fa-camera" style="right:80px"></i></figcaption>
    </figure>
    <input type="file" class="item-img file center-block " style="display:none;" name="file_photo"/>
</label>
</div>
<div class="col-md-9">
<div  class="row">
    <div class="col-md-7">
        <span><strong>Name</strong></span>
      <?php if(isset($user['first_name'])||isset($user['last_name'])){?>  <h3> <?php echo $user['first_name']." ".$user['last_name']." ".$user['other_names']; ?></h3>
        <?php } ?>
    </div>
    <div class="col-md-2">
        <span><strong>Initials</strong></span>
        <p > <b><?php echo isset($user['initials'])?$user['initials']:''; ?> </b></p>
    </div>     
    <div class="col-md-3">
        <span><strong>Gender</strong></span>
        <p > <?php echo isset($user['gender'])?$user['gender']:''; ?></p>
    </div>
</div>
</div>
</div>

<div class="modal fade" id="cropImagePop" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
               
                <center>
                    <small>Zoom in and out to fit your photo in the square, click crop & save.</small>
                </center>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="pull-right">&times;</span></button>
            </div>
            <div class="modal-body">
                <div id="upload-sh" class="center-block"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" id="cropImageBtn" class="btn btn-primary">Crop & save</button>
            </div>
        </div>
    </div>
</div>
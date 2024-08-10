<!-- Page title bar -->
<div class="app-title">
  <div>
    <h4><i class="fa fa-eye"></i> Data Entry Review Center</h4>
  </div>
  <button type="button" class="btn btn-sm btn-warning pull-right" data-toggle="modal" data-target="#locate_me"><i class="fa fa-map-marker"></i> Search the Map</button>
</div>
<div class="row ">
    <div class="col-md-8">
<div class="row ">
    <div class="col-md-6">
      <div class="tile">
        <div class="tile-title">
          <h6>Entered <span class="text-danger">Today</span> ( <?php echo date('D d-M-Y'); ?> )</h6>
        </div>
        <table class="table table-sm">
          <?php
          if(count($today)==0){ echo "<tr><td><i>No Records Found </i></td></tr>";}
          $counter=1;
          foreach ($today as $key => $value){ 
            ?>
          <tr>
           <td><?php echo $counter; ?></td><td> <a href="<?php echo base_url();?>Prop_pa_entrant/view/<?php echo $value['id'];?>/<?php echo date('Y-m-d');?>/<?php echo date('Y-m-d',strtotime('tomorrow'));?>"><?php echo $value['first_name']." ".$value['last_name']." ". $value['other_names']; ?></a></td><td><h5><span class="badge badge-success"><?php echo $value['count'];?></span></h5></td>
          </tr>
         <?php $counter++; } ?>
        </table>
      </div>
  </div>
  <div class="col-md-6">
      <div class="tile">
        <div class="tile-title">
          <h6>Entered <span class="text-danger">Yesterday</span> ( <?php echo date('D d-M-Y',strtotime('yesterday')); ?> )</h6>
        </div>
        <table class="table table-sm">
          <?php 
          $counter=1;
          if(count($yesterday)==0){ echo "<tr><td><i>No Records Found </i></td></tr>";}

          foreach ($yesterday as $key => $value){ 
            ?>
          <tr>
            <td><?php echo $counter; ?></td><td><a href="<?php echo base_url();?>Prop_pa_entrant/view/<?php echo $value['id'];?>/<?php echo date('Y-m-d',strtotime('yesterday')); ?>/<?php echo date('Y-m-d');?>"><?php echo $value['first_name']." ".$value['last_name']." ". $value['other_names']; ?></a></td><td><h5><span class="badge badge-success"><?php echo $value['count'];?></span></h5></td>
          </tr>
         <?php $counter++; } ?>
        </table>
      </div>
  </div>
  <div class="col-md-6">
      <div class="tile">
        <div class="tile-title">
          <h6>Entered <span class="text-danger">This Week </span> ( <?php echo date('D d/M/Y',strtotime('this week monday')) ." - ".date('D d/M/Y',strtotime('this week sunday')) ?> )</h6>
        </div>
        <table class="table table-sm">
          <?php 
          $counter=1;
          if(count($this_week)==0){ echo "<tr><td><i>No Records Found </i></td></tr>";}
          foreach ($this_week as $key => $value){ 
            ?>
          <tr>
            <td><?php echo $counter; ?></td><td><a href="<?php echo base_url();?>Prop_pa_entrant/view/<?php echo $value['id'];?>/<?php echo date('Y-m-d',strtotime('this week monday'));?>/<?php echo date('Y-m-d',strtotime('this week sunday'));?>"><?php echo $value['first_name']." ".$value['last_name']." ". $value['other_names']; ?></a></td><td><h5><span class="badge badge-success"><?php echo $value['count'];?></span></h5></td>
          </tr>
         <?php $counter++; } ?>
        </table>
      </div>
  </div>
  <div class="col-md-6">
      <div class="tile">
        <div class="tile-title">
        <h6>Entered <span class="text-danger">Last Week </span> ( <?php echo date('D d/M/Y',strtotime('last week monday')) ." - ".date('D d/M/Y',strtotime('last week sunday')) ?> )</h6>
        </div>
        <table class="table table-sm">

          <?php 
          $counter=1;
          if(count($last_week)==0){ echo "<tr><td><i>No Records Found </i></td></tr>";}

          foreach ($last_week as $key => $value){ 
            ?>
          <tr>
            <td><?php echo $counter; ?></td><td><a href="<?php echo base_url();?>Prop_pa_entrant/view/<?php echo $value['id'];?>/<?php echo date('Y-m-d',strtotime('last week monday'));?>/<?php echo date('Y-m-d',strtotime('last week sunday'));?>"><?php echo $value['first_name']." ".$value['last_name']." ". $value['other_names']; ?></a></td><td><h5><span class="badge badge-success"><?php echo $value['count'];?></span></h5></td>
          </tr>
         <?php $counter++; } ?>
        </table>
      </div>
  </div>
  <div class="col-md-6">
      <div class="tile">
        <div class="tile-title">
          <h6>Entered <span class="text-danger">This Month </span> ( <?php echo date('M-Y'); ?> )</h6>
        </div>
        <table class="table table-sm">
          <?php 
          $counter=1;
          if(count($month)==0){ echo "<tr><td><i>No Records Found </i></td></tr>";}
          foreach ($month as $key => $value){ 
            ?>
          <tr>
            <td><?php echo $counter; ?></td><td><a href="<?php echo base_url();?>Prop_pa_entrant/view/<?php echo $value['id'];?>/<?php echo date('m');?>/<?php echo date('y');?>"><?php echo $value['first_name']." ".$value['last_name']." ". $value['other_names']; ?></a></td><td><h5><span class="badge badge-success"><?php echo $value['count'];?></span></h5></td>
          </tr>
         <?php $counter++; } ?>
        </table>
      </div>
  </div>
  <div class="col-md-6">
      <div class="tile">
        <div class="tile-title">
          <h6>Entered <span class="text-danger">Last Month </span> ( <?php echo date('M-Y',strtotime('last month')); ?> )</h6>
        </div>
        <table class="table table-sm">
          <?php 
          $counter=1;
          if(count($last_month)==0){ echo "<tr><td><i>No Records Found </i></td></tr>";}
          foreach ($last_month as $key => $value){ 
            ?>
          <tr>
            <td><?php echo $counter; ?></td><td><a href="<?php echo base_url();?>Prop_pa_entrant/view/<?php echo $value['id'];?>/<?php echo date('m',strtotime('last month'));?>/<?php echo date('y');?>"><?php echo $value['first_name']." ".$value['last_name']." ". $value['other_names']; ?></a></td><td><h5><span class="badge badge-success"><?php echo $value['count'];?></span></h5></td>
          </tr>
         <?php $counter++; } ?>
        </table>
      </div>
  </div>
  <div class="col-md-6">
      <div class="tile">
        <div class="tile-title">
          <h6>Entered <span class="text-danger">This Year </span> ( <?php echo date('Y'); ?> )</h6>
        </div>
        <table class="table table-sm">
          <?php 
           $counter=1;
          foreach ($year as $key => $value){ 
            ?>
          <tr>
            <td><?php echo $counter; ?></td><td><a href="<?php echo base_url();?>Prop_pa_entrant/view/<?php echo $value['id'];?>/<?php echo date('Y');?>"><?php echo $value['first_name']." ".$value['last_name']." ". $value['other_names']; ?></a></td><td><h5><span class="badge badge-success"><?php echo $value['count'];?></span></h5></td>
          </tr>
         <?php $counter++; } ?>
        </table>
      </div>
  </div>
  <div class="col-md-6">
      <div class="tile">
        <div class="tile-title">
          <h6>Entered <span class="text-danger">Last Year </span> ( <?php echo date('Y',strtotime('last year')); ?> )</h6>
        </div>
        <table class="table table-sm">
          <?php 
           $counter=1;
          foreach ($last_year as $key => $value){ 
            ?>
          <tr>
            <td><?php echo $counter; ?></td><td><a href="<?php echo base_url();?>Prop_pa_entrant/view/<?php echo $value['id'];?>/<?php echo date('Y',strtotime('last year')); ?>"><?php echo $value['first_name']." ".$value['last_name']." ". $value['other_names']; ?></a></td><td><h5><span class="badge badge-success"><?php echo $value['count'];?></span></h5></td>
          </tr>
         <?php $counter++; } ?>
        </table>
      </div>
  </div>
    
  
</div>
</div>
<div class="col-md-4">
      <div class="tile">
        <div class="tile-title">
          <h6>Entered <span class="text-danger">Beyond last year </span> ( Below  <?php echo date('Y',strtotime('last year')); ?> ) </h6>
        </div>
        <table class="table table-sm">
          <?php 
           $counter=1;
          foreach ($beyond_last_year as $key => $value){ 
            ?>
          <tr>
            <td><?php echo $counter; ?></td><td><a href="<?php echo base_url();?>Prop_pa_entrant/view/<?php echo $value['id'];?>/<?php echo date('Y',strtotime('last year')); ?>/old"><?php echo $value['first_name']." ".$value['last_name']." ". $value['other_names']; ?></a></td><td><h5><span class="badge badge-success"><?php echo $value['count'];?></span></h5></td>
          </tr>
         <?php $counter++; } ?>
        </table>
      </div>
  </div>
</div>
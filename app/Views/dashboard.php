<?= $this->extend("includes/template") ?>
<?= $this->section("styles") ?>
    <!--no custom css-->
<?= $this->endSection() ?>
<?= $this->section("content") ?>
<!-- Page title bar -->
<div class="app-title">
  <div>
    <h2><i class="fa fa-eye"></i> Dashboard</h2>
    <p class="pull-right">Property Database</p>
  </div>
  <button type="button" class="btn btn-sm btn-warning pull-right" data-toggle="modal" data-target="#locate_me"><i class="fa fa-map-marker"></i> Search the Map</button>
</div>
<!-- page main content here -->
<div class="row pt-3">
  <div class=" col-md-6">
    <div class="row mr-0">
      <div class="col-md-6 col-lg-6">
        <a href="<?php echo base_url("staff") ?>">
          <div class="widget-small primary coloured-icon"><i class="icon fa fa-users fa-3x"></i>
            <div class="info">
              <h4>Users</h4>
              <p><b><?php echo count($user); ?></b></p>
            </div>
          </div>
        </a>
      </div>
      <div class="col-md-6 col-lg-6">
        <a href="<?php echo base_url("property") ?>">
          <div class="widget-small info coloured-icon"><i class="icon fa fa-map-marker fa-3x"></i>
            <div class="info">
              <h4>Properties</h4>
              <p><b><?php echo count($properties); ?></b></p>
            </div>
          </div>
        </a>
      </div>
    </div>
    <div class="col-md-12 pl-0">
      <div class="tile">
        <div class="tile-title">
          <h6>Properties per month (<?php echo date('Y'); ?>)</h6>
        </div>
        <div class="embed-responsive embed-responsive-16by9">
          <canvas class="embed-responsive-item" id="barChartDemo" style="width: 475px; height: 267px;"></canvas>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-6 row mr-0 pr-0">
    <div class="col-md-6 ">
      <div class="tile">
        <div class="tile-title">
          <h6>Properties per Month (<?php echo date('Y'); ?>)</h6>
        </div>
        <table class="table table-sm">
          <?php foreach ($monthly as $key => $value){ 
            $dateObj   = DateTime::createFromFormat('!m', $value['month']);
            ?>
          <tr>
            <td><?php echo $dateObj->format('F'); ?></td><td><b><?php echo $value['count'];?></b></td>
          </tr>
         <?php } ?>
        </table>
       <!--  <div class="embed-responsive embed-responsive-16by9" style="height: 200px;">
          <canvas class="embed-responsive-item" id="polarChartDemo" width="100%" style="width: 100%; height: 200px;"></canvas>
        </div> -->
      </div>
    </div>
    <div class="col-md-6 mr-0 pr-0">
      <div class="widget-small info coloured-icon"><i class="icon fa fa-map fa-3x"></i>
            <div class="info">
              <b>Properties with Coordinates</b>
              <p><b><?php echo $properties_cord; ?></b></p>
            </div>
      </div>
      <div class="tile">
        <div class="tile-title">
          <h6>Per district (Top 15)</h6>
        </div>
        <div class="embed-responsive embed-responsive-16by9" style="height: 250px;">
          <canvas class="embed-responsive-item" id="pieChartDemo" width="100%" style="width: 100%; height: 200px;"></canvas>
        </div>
      </div>
       
    </div>

  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="row tile mx-0">
      <div class="col-md-7 pl-0 border-right">
        <div class="tile-title">
          <h6>Total Properties per Valuer</h6>
        </div>
        <div class="table-responsive">
          <table class="table table-hover table-sm table-bordered table-stripped" id="tblPropPerUser">
            <thead>
              <tr>
                <th>#</th>
                <th>Valuer</th>
                <th>Properties</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>

            </tbody>
          </table>
        </div>
      </div>
      <?php if($_SESSION['role_id']==1 || $_SESSION['role_id']==5) { ?>
      <div class="col-md-5">
        <div class="tile-title">
          <h6>Current User Status</h6>
        </div>

        <div class="messanger">
          <div class="messages">
             
          </div>
        </div>
      </div>
      <?php } ?>
    </div>
  </div>
<?= $this->endSection() ?>  
<?= $this->section("scripts") ?>
  <script src="<?php echo base_url('public/assets/js/plugins/chart.js') ?>"></script>
  <script type="text/javascript">
    var data = {
      labels: ["January", "February", "March", "April", "May", "june", "july", "August", "sept.", "October", "November", "December"],
      datasets: [{
          label: "My First dataset",
          fillColor: "#4aa14a",
          strokeColor: "rgba(220,220,220,1)",
          pointColor: "rgba(220,220,220,1)",
          pointStrokeColor: "#fff",
          pointHighlightFill: "#fff",
          pointHighlightStroke: "rgba(220,220,220,1)",
          data: [<?php foreach ($month as $key => $value) {
                    echo $value . ",";
                  } ?>]
        }

      ]
    };
    var pdata = [{
        value: <?php echo $properties_nocord ?>,
        color: "#F7464A",
        highlight: "#FF5A5E",
        label: "No cordinates"
      },
      {
        value: <?php echo $properties_cord ?>,
        color: "#46BFBD",
        highlight: "#5AD3D1",
        label: "with cordinates"
      },

    ]
    var pdatadistrict = [
      <?php foreach ($per_dist as $key => $value) {
        $rand = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f');
        $color = '#' . $rand[rand(0, 15)] . $rand[rand(0, 15)] . $rand[rand(0, 15)] . $rand[rand(0, 15)] . $rand[rand(0, 15)] . $rand[rand(0, 15)];
        ?> {
          value: <?php echo $value['count']; ?>,
          color: "<?php echo $color; ?>",
          highlight: "#FF5A5E",
          label: " <?php echo $value['district_name'];?>"
        },
      <?php } ?>
    ]

    var ctxb = $("#barChartDemo").get(0).getContext("2d");
    var barChart = new Chart(ctxb).Bar(data);

    // var ctxpo = $("#polarChartDemo").get(0).getContext("2d");
    // var polarChart = new Chart(ctxpo).PolarArea(pdata);

    var ctxp = $("#pieChartDemo").get(0).getContext("2d");
    var pieChart = new Chart(ctxp).Pie(pdatadistrict);
    <?php if($_SESSION['role_id']==1 || $_SESSION['role_id']==5) { ?>
      $(".messages").html('Loading  status...');
    //check logged in users
    setInterval(function() {
      $.ajax({
        url: "<?php echo base_url("online.users"); ?>",
        type: "POST",
        data: {
          nothing: null
        },
        dataType: 'json',
        success: function(data) {
          $(".messages").html('');
          moment.fn.minutesFromNow = function() {
            var r = Math.floor((+new Date() - (+this)) / 60000);
            return r;
          }

          for (var a = 0; a < data.length; a++) {

            var photo = (data[a]['photo'] != "") ? 'public/uploads/profile_pics/' + data[a]['photo'] : 'images/avatar.png';
            var name = data[a]['first_name'] + ' ' + data[a]['last_name'] + ' ' + data[a]['other_name'];
            var time = moment.unix(data[a]['TIME']).format("DD/MM h:m");
            var lastseenconverted = (!isNaN(data[a]['last_seen'].valueOf())&& data[a]['last_seen']!='' )? moment.unix(data[a]['last_seen']).minutesFromNow():moment.unix(data[a]['TIME']).minutesFromNow();
            var lastseen=(lastseenconverted>43200)?(round(lastseenconverted/43200,0)+' month' + ((lastseenconverted === 1) ? '' : 's') +' ago.'):((lastseenconverted>1440)?(round(lastseenconverted/1440,0)+' day' + ((lastseenconverted === 1) ? '' : 's') +' ago.'):((lastseenconverted>120)?(round(lastseenconverted/60,2) +'hrs ago'):(round(lastseenconverted,0)+ ' min' + ((lastseenconverted === 1) ? '' : 's') + ' ago')));
            var online="";
            if(data[a]['status']==0){
             online =  '<small class="col-md-5  pr-0 float-right"><span class="float-right text-secondary">Last Seen: <b>'+lastseen+'</b></span></small>';
            }else if(lastseenconverted<=30){
              online =  '<span class="col-md-5  pr-0 float-right"><span class="float-right badge badge-primary ">online <i class="fa fa-dot-circle-o "></i></span></span>';} else if(lastseenconverted>30 && lastseenconverted<=90){
              online =  '<span class="col-md-5  pr-0 float-right"><span class="float-right badge badge-warning "> Idle <i class="fa fa-dot-circle-o "></i></span></span>';
                } else { 
              online =  '<small class="col-md-5  pr-0 float-right"><span class="float-right text-secondary">Last Seen: <b>'+lastseen+'</b></span></small>';
            }

            var html = '<div ><img class="rounded-circle" style="height:34px; width:34px;" src="<?php echo base_url(); ?>' + photo + '"><span class=""> ' + text_truncate(name,22) + '</span>' + online + '</div><hr>';

            $(".messages").append(html);
          }
          //do something with response data
        }
      });
    }, 5000); //time in milliseconds 
  <?php } ?>
  </script>
  <?= view('table_prop_per_user_js'); ?>
  <!--load the counter for the prop per valuer -->
  <?= $this->endSection() ?>

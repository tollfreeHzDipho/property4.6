<?= $this->extend("includes/template") ?>
<?= $this->section("styles") ?>
<style>
   /*      //////////map SEARCH  ///////////////*/

    .controls {
        border: 1px solid transparent;
        border-radius: 2px 0 0 2px;
        box-sizing: border-box;
        -moz-box-sizing: border-box;
        outline: none;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
    }

    #pac-input {
        margin-top: 10px;
        background-color: #fff;
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
        margin-left: 12px;
        padding: 0 11px 0 13px;
        text-overflow: ellipsis;
        width: 50%;
        height:38px;
    }

    #pac-input:focus {
        border-color: #4d90fe;
    }

    .pac-container {
        font-family: Roboto;
    }

    #type-selector {
        color: #fff;
        background-color: #4d90fe;
        padding: 5px 11px 0px 11px;
    }

    #type-selector label {
        font-family: Roboto;
        font-size: 13px;
        font-weight: 300;
    }

    #target {
        width: 300px;
    }

    fieldset.scheduler-border {
        border: solid 1px #DDD !important;
        padding: 0 10px 10px 10px;
        border-bottom: none;
    }

    legend.scheduler-border {
        width: auto !important;
        border: none;
        font-size: 14px;
    }
</style>
<link href="<?= base_url() ?>public/assets/css/plugins/datepicker/datepicker3.css" rel="stylesheet">
<link href="<?= base_url() ?>public/assets/css/plugins/jquery-ui.css" rel="stylesheet">

<?= $this->endSection() ?> 

<?= $this->section("content") ?>
<!-- Page title bar -->
<div class="app-title">
    <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item"><a href="#">Property Details and Map</a></li>
    </ul>
    <button type="button" class="btn btn-sm btn-warning pull-right" data-toggle="modal" data-target="#locate_me"><i class="fa fa-map-marker"></i> Search the Map</button>
</div>
<!-- page main content here -->
<div class="row ">
    <div class="col-md-12 ">
        <div class="tile py-0 px-3">

            <div class="tile-body">
                <?php
               // print_r($property);
                $tenure = $property['tenure'];
                $property_address = $property['property_address'];
                $bank = $property['bank_name'];
                $north = $property['north'];
                $east = $property['east'];
                $convnorth = $north;
                $conveast = $east;
                $zone = $property['zone'];
                $date_of_val = $property['date_of_val'];
                $acreage = $property['acreage'];
                $money = $property['rate_per_acre'];
                $divide = $money / 1000000;
                $print = $divide . "m";
                if ($divide >= 1000000) {
                    $div = $divide / 1000000;
                    $rate = $div . "t";
                } else if ($divide >= 1000) {
                    $div = $divide / 1000;
                    $rate = $div . "b";
                } else {
                    $rate = $print;
                }
                $moneyP = $property['property_value'];
                $divideP = $moneyP / 1000000;
                $printP = $divideP . "m";
                if ($divideP >= 1000000) {
                    $divP = $divideP / 1000000;
                    $property_val = $divP . "t";
                } else if ($divideP >= 1000) {
                    $divP = $divideP / 1000;
                    $property_val = $divP . "b";
                } else {
                    $property_val = $printP;
                }
                if ($property['user_status']=="Other") {
                $user_status = $property['user_option'];
                }else{
                $user_status = $property['user_status'];
                }
                $notes = $property['notes'];
                $valuer = $property['valuer_initials'];
                $firm = $property['firm_name'];
                $district = $property['district_name'];
                $village = $property['village_id'];
                $town = $property['town_id'];
               
                ?>
                <div class="row shadow pb-3 mb-5 rounded">
                    <div class="col-md-7">
                        <div class="row" style="height:500px; background-color:beige;">
                        <input id="pac-input" class="form-control controls" type="text" placeholder="Search places" style="display:none;">
                            <div id="bigmap" style="width:100%; height:500px;">
                                
                            </div>
                        </div>
                        <div class="row col-md-12 p-2">
                            <br>
                            <label>
                                <h6> Special Note: </h6>

                                <p> <?php echo  $notes; ?>
                                </p>
                        </div>
                    </div>
                    <div class="col-md-5 p-0 border">
                        <div class="title p-2 mx-0" style="background-color:beige;">
                            <a href="#" class="fa fa-edit fa-lg float-right text-primary" data-toggle="modal" data-target="#add_property-modal">
                                <i class=""></i>
                            </a>
                            <h4><?php echo $property_address; ?></h4>
                        </div>
                        <div class="px-2">
                            <div class="table-responsive">
                                <table class="table table-sm ">
                                    <tr>
                                        <td><b>Tenure</b>:</td>
                                        <td><?php echo $tenure; ?></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <span><b>North (latitude)</b>:&nbsp;&nbsp; <?php echo $north; ?></span>
                                            <?php if($zone=='36 N' || $zone=="36 S"|| $zone=="35 S"){
                                                echo "<span class='badge badge-primary'>" .$zone. "</span>";
                                            }else{
                                             echo '&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp'; 
                                            }  ?>
                                            <span class=""><b>East (longitude)</b>:&nbsp;&nbsp; <?php echo $east; ?></span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td><b>District</b>:</td>
                                        <td><?php echo $district; ?></td>
                                    </tr>
                                    <tr>
                                        <td><b>Town</b>:</td>
                                        <td><?php echo $town; ?></td>
                                    </tr>
                                    <tr>
                                        <td><b>Village</b>:</td>
                                        <td><?php echo $village; ?></td>
                                    </tr>
                                    <tr>
                                        <td><b>Acreage</b>:</td>
                                        <td><?php echo $acreage; ?></td>
                                    </tr>
                                    <tr>
                                        <td><b>Rate Per Acre</b>:</td>
                                        <td><?php echo $rate; ?></td>
                                    </tr>
                                    <tr>
                                        <td><b>Land Value</b>:</td>
                                        <td><?php echo $property_val; ?></td>
                                    </tr>
                                 
                                    <tr>
                                        <td><b>User Status</b>:</td>
                                        <td><?php echo $user_status; ?></td>
                                    </tr>
                                    <tr>
                                        <td><b>Bank </b>:</td>
                                        <td><?php echo $bank; ?></td>
                                    </tr>
                                    <tr>
                                        <td><b>Date of Valuation</b>:</td>
                                        <td><?php echo date("d-M-Y",strtotime($date_of_val)); ?></td>
                                    </tr>
                                    <tr>
                                        <td><b>Valued By </b>:</td>
                                        <td><?php echo $valuer; ?></td>
                                    </tr>
                                    <tr>
                                        <td><b>Firm</b>:</td>
                                        <td><?php echo $firm; ?></td>
                                    </tr>
                                </table>
                                
                                    <hr>
        <div  class="row"  style="font-size:12px;">
           <div class="col-md-12">
                <div class="row">
                    <div class="col-md-4">
                        <span><strong>Created By :</strong></span>
                    </div>

                    <div class="col-md-8">
                        <span ><?php echo $property['created_first_name']." ".$property['created_last_name']; ?></span>
                    </div>

                    <div class="col-md-4">
                        <span><strong>Date :</strong></span>
                    </div>

                    <div class="col-md-8">
                        <span ><?php echo date("d-M-Y",strtotime($property['date_created'])); ?></span>
                    </div>  
                </div>
            </div>
        
        </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
               <!--  <div class="row px-0 " style="background-color:beige">
                    <div class="col-lg-12 ">
                        <fieldset class="border p-2">
                            <legend class="w-auto">Comment Section</legend>
                            <ul class="media-list">
                                <li class="media">
                                    <a href="#" class="pull-left">
                                        <span class="img-circle" style="background-color:grey;">
                                        </span>
                                    </a>
                                    <div class="media-body" hidden="">
                                    </div>
                                </li>
                            </ul>
                            <textarea class="form-control" placeholder=" Feel free to comment on the data above..." rows="3" id="commentarea"></textarea>
                            <br><span id="notice" class="alert alert-danger" hidden=""></span>
                            <button id="comment" class="btn btn-primary btn-sm pull-right">Comment</button>
                        </fieldset>

                        <div class="clearfix"></div>


                    </div>
                </div> -->
            </div>

        </div>
    </div>
</div>
<?=$this->section('scripts');?>
<?= $this->endSection();?>
<script>
var map;

function initMap2() {
      var center_lat = '<?php echo $convnorth;?>';
	  var center_long = '<?php echo $conveast;?>';
	  
	  
			<?php 
                            $counter=1;
                            foreach ($properties as $key => $property) {
                              //  print_r($property['dev_status']) ;
                                $id1 = $property['id'];
                                $tenure1 = $property['tenure'];
                                $property_address1 = $property['property_address'];
                                $bank1 = $property['bank_name'];
                                $north1 = $property['north'];
                                $east1 = $property['east'];
                                $convnorth1 = $north1;
                                $conveast1 = $east1;
                                $date_of_val1 = $property['date_of_val'];
                                $acreage1 = $property['acreage'];
                                $money1 = $property['rate_per_acre'];
                                $divide1 = $money1 / 1000000;
                                $print1 = $divide1 . "m";
                                if ($divide1 >= 1000000) {
                                    $div1 = $divide1 / 1000000;
                                    $rate1 = $div1 . "t";
                                } else if ($divide1 >= 1000) {
                                    $div1 = $divide1 / 1000;
                                    $rate1 = $div1 . "b";
                                } else {
                                    $rate1 = $print1;
                                }
                                $money2 = $property['property_value'];
                                $divide2 = $money2/ 1000000;
                                $print2 = $divide2 . "m";
                                if ($divide2 >= 1000000) {
                                    $div2 = $divide2 / 1000000;
                                    $property_val2 = $div2 . "t";
                                } else if ($divide2 >= 1000) {
                                    $div2 = $divide2 / 1000;
                                    $property_val2 = $div2 . "b";
                                } else {
                                    $property_val2 = $print2;
                                }
                                if ($property['user_status']=="Other") {
                                $user_status1 = $property['user_option'];
                                }else{
                                $user_status1 = $property['user_status'];
                                }
                                $notes1 = $property['notes'];
                                $valuer1 = $property['valuer_initials'];
                                $firm1 = $property['firm_name'];
                                $district1 = $property['district_name'];
                                $village1 = $property['village_id'];
                                $town1 = $property['town_id'];
                                $category_id1 = $property['category_id'];
                           
			?>
   ////////////////////////arrays for the data points on the map/////////////////////////////////
	var belmont<?php echo $counter;?> = {info: '<b>Property Address:</b> <?php echo $property_address1;?><br><b>Tenure: </b><?php echo $tenure1;?><br><b>Cordinates: N: </b><?php echo $north1;?> , &nbsp;<b>E: </b><?php echo $east1;?> <br> <b>Rate/acre:</b> Shs: <?php echo $rate1; ?> </br> <b>District: </b><?php echo $district1; ?><br><b>  Valued on: </b> <?php echo date("d-M, Y",strtotime($date_of_val1)); ?>  <?php $pr_id =$id1;?></br> <span style="font-size:14px; font-weight:bold;"><a href="<?php echo base_url('property/view/').$pr_id;?>">View details</a></span>',
				lat:<?php echo $convnorth1;?>,
				long:<?php echo $conveast1;?>,
				check:<?php echo $category_id1;?>		
				};
				<?php
				$counter++; }
				?>
	  ////////////////////////JavaScript ojects for the data points on the map//////////////////////
	var locations = [
	     <?php 
	      $count =1;
		  for($count=1;$count<$counter;$count++){?>
		  [belmont<?php echo $count;?>.info, belmont<?php echo $count;?>.lat,belmont<?php echo $count;?>.long,belmont<?php echo $count;?>.check],
         <?php } ?>
         ];
     
	    map = new google.maps.Map(document.getElementById('bigmap'), {
		zoom: 15,
		center: new google.maps.LatLng(center_lat, center_long),
		mapTypeId: google.maps.MapTypeId.HYBRID,
		streetViewControl:true,
		zoomControl: true,
		  mapTypeControl: true,
		  scaleControl: true,
		  streetViewControl: true,
		  rotateControl: true,
          fullscreenControl: true,
            zoomControlOptions: {
             style: google.maps.ZoomControlStyle.SMALL},
		heading: 90,
        tilt: 45

	});
	
		
	var infowindow = new google.maps.InfoWindow({});

	var marker, i,marker1;
         // Create the search box and link it to the UI element.
        if (typeof google === 'object' && typeof google.maps === 'object') {
            $('#pac-input').delay(5000).fadeIn(); //show the search input after 5s
        }
        var input = document.getElementById('pac-input');
       
        var searchBox = new google.maps.places.SearchBox(input);
       map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

        // Bias the SearchBox results towards current map's viewport.
        map.addListener('bounds_changed', function() {
         searchBox.setBounds(map.getBounds());
        }); 
        
    var markers = [];
    
	for (i = 0; i < locations.length; i++) {
		//checking the marker for color variation//////////////////////////////////
		
		  if (locations[i][1] != center_lat && locations[i][2] != center_long ){
		   marker = new google.maps.Marker({
				position: new google.maps.LatLng(locations[i][1], locations[i][2]),
				map: map,
				icon: 'https://maps.google.com/mapfiles/ms/icons/green.png'
				
				});
			}
			if(locations[i][1] == center_lat && locations[i][2] == center_long){
					   marker = new google.maps.Marker({
				position: new google.maps.LatLng(locations[i][1], locations[i][2]),
				map: map,
				icon: 'https://maps.google.com/mapfiles/ms/icons/green-dot.png',

				animation: google.maps.Animation.BOUNCE
				});
		
			}
			
		google.maps.event.addListener(marker, 'click', (function (marker, i) {
			return function () {
				infowindow.setContent(locations[i][0]);
				infowindow.open(map, marker);
				
			}
		})(marker, i));
	
	}
	
        // Listen for the event fired when the user selects a prediction and retrieve
        // more details for that place.
         searchBox.addListener('places_changed', function() {
          var places = searchBox.getPlaces();

          if (places.length == 0) {
            return;
          }

          // Clear out the old markers.
          markers.forEach(function(marker) {
            marker.setMap(null);
          });
          markers = [];

          // For each place, get the icon, name and location.
          var bounds = new google.maps.LatLngBounds();
          places.forEach(function(place) {
            if (!place.geometry) {
              console.log("Returned place contains no geometry");
              return;
            }
            var icon = {
              url: place.icon,
              size: new google.maps.Size(71, 71),
              origin: new google.maps.Point(0, 0),
              anchor: new google.maps.Point(17, 34),
              scaledSize: new google.maps.Size(25, 25)
            };

            // Create a marker for each place.
            markers.push(new google.maps.Marker({
              map: map,
              icon: icon,
              title: place.name,
              position: place.geometry.location
            }));

            if (place.geometry.viewport) {
              // Only geocodes have viewport.
              bounds.union(place.geometry.viewport);
            } else {
              bounds.extend(place.geometry.location);
            }
          });
          map.fitBounds(bounds);
        }); 

	
}
function rotate90() {
  var heading = map.getHeading() || 0;
  map.setHeading(heading + 90);
}

function autoRotate() {
  // Determine if we're showing aerial imagery.
  if (map.getTilt() !== 0) {
    window.setInterval(rotate90, 3000);
  }
}
</script>
<script async defer
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDw0tqVz5k9ryQq-gsp-nb55_HEv8u5YRE&callback=initMap2&libraries=places">
</script>

<?php //echo view('property/add_property_modal'); ?>
<?= $this->endSection();?>
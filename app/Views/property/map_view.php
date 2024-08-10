<style>

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
  <form  method="POST" action="<?php echo base_url(); ?>map_view">
  <div class="row" style="margin-top: -20px !important;">
            <div class="form-group col-md-4">
                <label class="control-label">North (latitude)</label>
                <input class="form-control" value="<?php echo $cordinates['north'];?>" type="text" placeholder="" required="required" name="north" id="north">
            </div>
            <?php 
             $selected1="";
             $selected2="";
            $selected3="";
            if($cordinates['ZONE']!=NUll){
              ?>
              <script type="text/javascript">
                $( document ).ready(function() {
                $('.hemisphere').removeAttr("hidden");
                $('.app').toggleClass('sidenav-toggled');
              });
              </script>
            <?php
            if($cordinates['ZONE']=="36 N"){
              $selected1="selected";
              $selected2="";
              $selected3="";
            } else if($cordinates['ZONE']=="36 S"){
              $selected1="";
              $selected2="selected";
              $selected3="";
            }else{
              $selected1="";
              $selected2="";
              $selected3="selected";
            }
           }
           ?>
            <div class="form-group col-md-2  hemisphere" hidden>
                <label class="control-label">Hemisphere</label>
                <select class="myzone form-control" name="ZONE">
                    <option value="">Select Hemisphere</option>
                    <option <?php echo $selected1;?> value="36 N">36 N</option>
                    <option <?php echo $selected2;?> value="36 S">36 S</option>
                    <option <?php echo $selected3;?> value="35 S">35 S (Extreme SW Uganda)</option>
               </select>
            </div>
            <div class="form-group col-md-4">
                <label class="control-label">East (longitude)</label>
                <input class="form-control" value="<?php echo $cordinates['east'];?>" type="text" required="required" placeholder="" name="east" id="east" >
            </div>
            <input class="form-control" type="hidden" value="<?php echo $cordinates['CONVN'];?>" id="CONVNORTH" name="CONVN" readonly>
           <input class="form-control" type="hidden" value="<?php echo $cordinates['CONVE'];?>" id="CONVEAST" name="CONVE" readonly>
                
            <div class="form-group col-md-2">
               <button style="margin-top: 30px !important;" id="btn-submit" type="submit" class="btn btn-primary"> <i class="fa fa-check"></i> Search </button>
            </div>
                
        </div>
    </form>
<div class="row" style="height:100%; background-color:beige;">
  <input id="pac-input" class="form-control controls" type="text" placeholder="Search places" style="display:none;">
        <div id="bigmap" style="width:100%; height:550px;">
            
        </div>
    </div>


<script>
var map;

function initMap() {
      var center_lat = '<?php echo $cordinates["CONVN"]; ?>';
	  var center_long = '<?php echo $cordinates["CONVE"]; ?>';
	  
			<?php 
                            $counter=1;
                            foreach ($properties as $key => $property) {
                              //  print_r($property['DEV_STATUS']) ;
                                $id1 = $property['id'];
                                $tenure1 = $property['tenure'];
                                $serial = $property['serial_no'];
                                $property_address1 = $property['property_address'];
                                $bank1 = $property['bank_name'];
                                $north1 = $property['north'];
                                $east1 = $property['east'];
                                $convnorth1 = $property['CONVNORTH'];
                                $conveast1 = $property['CONVEAST'];
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
                                $user_status1 = $property['USER_OPTION'];
                                }else{
                                $user_status1 = $property['user_status'];
                                }
                                $notes1 = $property['NOTES'];
                                $valuer1 = $property['valuer_initials'];
                                $firm1 = $property['firm_name'];
                                $district1 = $property['district_name'];
                                $village1 = $property['village_id'];
                                $town1 = $property['town_id'];
                                $category_id1 = $property['category_id'];
                           
			?>
	var belmont<?php echo $counter;?> = {info: '<b>Property Address:</b> <?php echo $property_address1;?><br><b>Tenure: </b><?php echo $tenure1;?><br><b>Cordinates: N: </b><?php echo $north1;?> , &nbsp;<b>E: </b><?php echo $east1;?> <br><b>Acreage: </b><?php echo $acreage1;?><br> <b>Rate/acre:</b> Shs: <?php echo $rate1; ?> </br><b>Land Value: </b>Shs: <?php echo $property_val2; ?> <br><b>User Status: </b> <?php echo $user_status1; ?> <br> <b>District: </b><?php echo $district1; ?><br><b>Town/Village </b><?php echo $town1; ?> ,<?php echo $village1; ?><br><b>  Valued on: </b> <?php echo date("d-M, Y",strtotime($date_of_val1)); ?>  <?php $pr_id =$id1;?></br> <span style="font-size:14px; font-weight:bold;"><a target="_blank" href="<?php echo base_url('property/view/').$pr_id;?>">View more details</a></span><br><b>#Serial: </b><?php echo $serial; ?>',
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
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDw0tqVz5k9ryQq-gsp-nb55_HEv8u5YRE&callback=initMap&libraries=places">
</script>

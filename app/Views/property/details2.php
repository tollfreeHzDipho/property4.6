<?= $this->extend("includes/template") ?>
<?= $this->section("styles") ?>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
<link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
<link href="<?= base_url() ?>public/assets/css/plugins/datepicker/datepicker3.css" rel="stylesheet">
<link href="<?= base_url() ?>public/assets/css/plugins/jquery-ui.css" rel="stylesheet">
<style>
    /*      //////////map SEARCH  ///////////////*/


    .marker-pin {
        width: 30px;
        height: 30px;
        border-radius: 50% 50% 50% 0;
        background: #c30b82;
        position: absolute;
        transform: rotate(-45deg);
        left: 50%;
        top: 50%;
        margin: -15px 0 0 -15px;
    }

    /*  to draw white circle */
    .marker-pin::after {
        content: '';
        width: 24px;
        height: 24px;
        margin: 3px 0 0 3px;
        background: #fff;
        position: absolute;
        border-radius: 50%;
    }

    /* to align icon */
    .custom-div-icon i {
        position: absolute;
        width: 22px;
        font-size: 22px;
        left: 0;
        right: 0;
        margin: 10px auto;
        text-align: center;
    }

    .custom-div-icon i.awesome {
        margin: 12px auto;
        font-size: 17px;
    }

    .outer {
        position: relative
    }

    @media screen and (min-width: 480px) {

        .inner {
            position: absolute;
            top: 0;
            z-index: 1020;
            padding: 20px;
            width: 30%;
            height: 100%;
            left: 70%;
            margin-left: 0;
            /* half of the width */
            background-color: white;
            display: none;
        }
    }
   
   
}
</style>

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
                $id = $property['id'];
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
                if ($property['user_status'] == "Other") {
                    $user_status = $property['user_option'];
                } else {
                    $user_status = $property['user_status'];
                }
                $notes = $property['notes'];
                $valuer = $property['valuer_initials'];
                $firm = $property['firm_name'];
                $district = $property['district_name'];
                $village = $property['village_id'];
                $town = $property['town_id'];
                $status_id = $property['status_id'];

                ?>
                <div class="row shadow pb-3 mb-5 rounded">
                    <div class="col-md-12 outer">
                        <div class="row" style="height:500px; background-color:beige;">
                            <input id="pac-input" class="form-control controls" type="text" placeholder="Search places" style="display:none;">
                            <div id="bigmap" style="width:100%; height:500px;">
                            </div>
                        </div>
                        <div class="inner"></div>

                    </div>


                </div>
            </div>
        </div>
    </div>
</div>

</div>

</div>
</div>
</div>
<?= $this->endSection(); ?>
<?= $this->section('scripts'); ?>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
<script type="text/javascript" src="<?php echo base_url('public/assets/js/markerSmoothBouncer.js'); ?>" crossorigin="anonymous"></script>
<script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
<script>
    $(document).ready(function() {
        //defining our layers
        const openStreetLayer = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        });
        var Esri_WorldImagery = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
            attribution: 'Tiles &copy; Esri &mdash; Source: Esri, i-cubed, USDA, USGS, AEX, GeoEye, Getmapping, Aerogrid, IGN, IGP, UPR-EGP, and the GIS User Community'
        })
        var cyclOSM = L.tileLayer('https://{s}.tile-cyclosm.openstreetmap.fr/cyclosm/{z}/{x}/{y}.png', {
            maxZoom: 20,
            attribution: '<a href="https://github.com/cyclosm/cyclosm-cartocss-style/releases" title="CyclOSM - Open Bicycle render">CyclOSM</a> | Map data: &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }); // the CyclOSM tile layer available from Leaflet servers
        // Set object for the basemaps
        var basemaps = {
            "openStreetLayer": openStreetLayer,
            'cycleOsm': cyclOSM,
            'Esri_WorldImagery': Esri_WorldImagery,
        }
        //define our custom icon for the marker
        const icon = L.divIcon({
            className: 'custom-div-icon',
            html: "<div style='background-color:#4838cc;' class='marker-pin'></div><i class='fa fa-home awesome'>",
            iconSize: [30, 42],
            iconAnchor: [15, 42]
        });
        //initialize the map witha center point
        const map = L.map('bigmap', {
            layers: [Esri_WorldImagery]
        }).setView([<?= $north; ?>, <?= $east; ?>], 14);
        //add map control for our layers
        L.control.layers(basemaps).addTo(map); 
        //search button      
        L.Control.geocoder().addTo(map);
        // fetch our marker data from server
        $.ajax({
            url: '<?php echo base_url("detail.properties.json"); ?>',
            type: 'POST',
            data: {
                id: <?= $id ?>,
                lat: <?= $north ?>,
                long: <?= $east ?>,
                status_id: <?= $status_id ?>
            },
            dataType: 'json',
            success: function(data) {
                for (item in data) {
                    for (key in data[item]) {
                        const prop = data[item][key];
                        const popUpContent = `<b>Property Address:</b> ${prop.property_address}<br><b>Tenure: </b> ${prop.tenure}<br><b>Cordinates: N: </b>${prop.north}, &nbsp;<b>E: </b>${prop.east}<br> <b>Rate/acre:</b> Shs: ${prop.rate_per_acre} </br> <b>District: </b>${prop.district_name}<br><b>  Valued on: </b> ${prop.date_of_val} </br> <span style="font-size:14px; font-weight:bold;"><a href="<?php echo base_url('property/view/'); ?>${prop.id}">View details</a></span>`;

                        //adding marker
                        if (prop.id == <?= $id ?>) {
                            const centerMarker = L.marker([prop.north, prop.east], {
                                    title: 'Click for details',
                                    icon: icon,
                                })
                                .bindPopup(popUpContent)
                                .addTo(map)
                                .bounce();
                            centerMarker.on('popupopen', function() {
                                $('.inner').html("<div class='innerClose pull-right font-weight-bolder'>x</div>" + popUpContent).show();
                            });
                            //load the right side bar on page load
                            $('.inner').html("<div class='innerClose pull-right lead'>X</div>" + popUpContent).show();
                        } else {
                            let fromLatLng = L.latLng([<?= $north ?>, <?= $east ?>]);
                            let to = L.latLng(prop.north, prop.east);
                            let distance = fromLatLng.distanceTo(to) / 1000;
                            const otherMarker = L.marker([prop.north, prop.east], {
                                    title: `${distance.toFixed(2)}km away`,
                                    icon: icon,
                                })
                                .bindPopup(popUpContent + `<span class="badge badge-pill badge-light pull-right">${distance.toFixed(2)}km away</span>`)
                                .addTo(map);
                        }
                        $(document).on("click", ".innerClose", function() {
                            $('.inner').hide();
                        });
                    };

                }
            }
        });
    });
</script>
<?= $this->endSection(); ?>
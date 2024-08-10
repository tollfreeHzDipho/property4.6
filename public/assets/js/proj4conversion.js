$( document ).ready(function() {
var source =  new proj4.Proj('EPSG:4326');   //source coordinates will be in Longitude/Latitude, WGS84

proj4.defs([
  [
    'EPSG:21096',
    '+proj=utm +zone=36 +ellps=clrk80 +towgs84=-160,-6,-302,0,0,0,0 +units=m +no_defs'],
    [
      'EPSG:21036',
      '+proj=utm +zone=36 +south +ellps=clrk80 +towgs84=-160,-6,-302,0,0,0,0 +units=m +no_defs'],
    [
      "EPSG:4063",
      "+proj=utm +zone=35 +south +ellps=GRS80 +towgs84=0,0,0,0,0,0,0 +units=m +no_defs"]
]);

var dest36N= proj4('EPSG:21096');
var dest36S= proj4('EPSG:21036');
var dest35N= proj4('');
var dest35S= proj4('EPSG:4063');

function dms2deg(s) {

    // Determine if south latitude or west longitude
    var sw = /[sw]/i.test(s);
  
    // Determine sign based on sw (south or west is -ve) 
    var f = sw? -1 : 1;
  
    // Get into numeric parts
    var bits = s.match(/[\d.]+/g);
  
    var result = 0;
  
    // Convert to decimal degrees
    for (var i=0, iLen=bits.length; i<iLen; i++) {
  
      // String conversion to number is done by division
      // To be explicit (not necessary), use 
      //   result += Number(bits[i])/f
      result += bits[i]/f;
  
      // Divide degrees by +/- 1, min by +/- 60, sec by +/-3600
      f *= 60;
    }
  
    return result;
  }


  

// transforming point coordinates

function selectMtd(mystringlat,mystringlong,hemisphere, coordinate) {
  
  if ((mystringlat.indexOf("'") > 0 && mystringlat.indexOf('"') > 0 )&& (mystringlong.indexOf("'") > 0 && mystringlong.indexOf('"') > 0)) {
    //DMS
        $('.hemisphere').attr("hidden","hidden");
        var xx = mystringlat.replace(/��/g, "");    //remove degree
        var myStrx = xx.replace(/''/g, `"`); 
       
                var yy = mystringlong.replace(/��/g, "");     //remove degree
                var myStry = yy.replace(/''/g, `"`);         //Remove "
                  $("#north").val(dms2deg(myStrx));
                  $("#east").val(dms2deg(myStry));
                  $("#CONVNORTH").val(dms2deg(myStrx));
                  $("#CONVEAST").val(dms2deg(myStry));
                 // $('#conversion-result').show("slow");
         
          
  } else if ((mystringlat > 180 && !isNaN(mystringlat))&&(mystringlong > 180 && !isNaN(mystringlong)) && hemisphere!=="") {
    //UTM 
              var convlalong = doConvert(Number(mystringlat),Number(mystringlong),hemisphere);  //conver utm
               $("#CONVNORTH").val(FormatNumberLength(round(convlalong[1],8),12));
               $("#CONVEAST").val(FormatNumberLength(round(convlalong[0],8),12));
              // $('#conversion-result').show("slow");
           
    
  } else if ((!isNaN(mystringlat) && mystringlat <= 90 && mystringlat >= -90)&&(!isNaN(mystringlong) && mystringlong <= 180 && mystringlong >= -180)) {
      //latlong need No converting...
            $("#CONVNORTH").val(mystringlat);
            $("#CONVEAST").val(mystringlong);
           // $('#conversion-result').show("slow");
            $('.hemisphere').attr("hidden","hidden");
                    
  } else {
         // alert("Be sure of the following \n 1. The cordinates belong to the same cordinate system. \n 2. Zone is set.");      
         // $('#conversion-result').show();
          $("#CONVNORTH").val('');
          $("#CONVEAST").val('');
          // anything out of the cordinates range  set
  }
}
// return converted proj4 cordinates
function doConvert(x,y,h){
  var dest="",toLatLong="";
  if(h==="36 N"){
    //alert(x+" "+y);
      dest=dest36N;
       toLatLong = proj4(source, dest).inverse([y,x]); 
  }else if(h==="36 S"){
      dest=dest36S;
       toLatLong = proj4(source, dest).inverse([y,x]); 
  }else if(h==="35 N"){
      dest=dest35N;
       toLatLong = proj4(source, dest).inverse([y,x]); 
  }else if(h==="35 S"){
      dest=dest35S;
       toLatLong = proj4(source, dest).inverse([y,x]); 
  }
  return toLatLong;
}

$('#north').on("change",checkBeforeCoversion);
$("#east").on('change',checkBeforeCoversion);
$(".myzone").on('change',checkBeforeCoversion);

function checkBeforeCoversion(){
  
  var strlat = $("#north").val().trim(); //north
  var strLong = $("#east").val().trim();  //south
  var strhem = $(".myzone").val();         //hemisphre

          if(strlat > 90 && !isNaN(strlat)){
              $('.hemisphere').removeAttr("hidden");
            }else{
              $('.hemisphere').attr("hidden","hidden");
            }
    if((strlat=="" || typeof strlat === 'undefined')||(strLong==="" || typeof strLong === 'undefined')){ 
            $("#CONVNORTH").val('');
            $("#CONVEAST").val('');
           
    }else{
               selectMtd(strlat,strLong,strhem,"East");          
    }
}
/* 
function initMap() {
  var strlat = $("#north").val().trim(); //north
  var strLong = $("#east").val().trim();  //south
  var myLatLng = {lat:parseInt(strlat) , lng: parseInt(strLong)};

  var map = new google.maps.Map(document.getElementById('mymap'), {
    zoom: 8,
    center: myLatLng
  });

  var marker = new google.maps.Marker({
    position: myLatLng,
    map: map,
    title: 'Hello World!'
  });
} */
function remove_selected(){
  $(".myzone option").removeAttr('selected');
}

function round(value, decimals) {  //round off the number
  return Number(Math.round(value + 'e' + decimals) + 'e-' + decimals);
}

function FormatNumberLength(num, length) {   //add zeros to a string
  var r = num+"";
  if(r.indexOf('.')>=1){
  while (r.length < length) {
            r=r+"0";
  }
  }
  return r;
}



});
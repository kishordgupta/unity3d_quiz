<?
	if($lat!='' and $lng!='')
		$def_latlong=$lat.",".$lng;	
	else
		$def_latlong="-33.9671109, 151.1028549";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml">
  <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <title>Google Maps V3 API Sample</title>
    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
    <script type="text/javascript">
	  var geocoder;
  	  var map;
	  var marker;
	  var markersArray = [];
	  var infoWindow;
	  function initialize() {		
    	geocoder = new google.maps.Geocoder();
		var mapDiv=document.getElementById('map-canvas');	
	    map = new google.maps.Map(mapDiv, {
			 center: new google.maps.LatLng(<?=$def_latlong?>),
			 zoom: 13,
			 mapTypeId: google.maps.MapTypeId.ROADMAP
			});
		  
			  marker = new google.maps.Marker({
			  map: map,
			  draggable: true,
			  icon:"images/red-pin.png",
			  position: new google.maps.LatLng(<?=$def_latlong?>),			 
			});					

			google.maps.event.addListener(marker, 'dragend', function(event)
				{						
					$("#lat").val(event.latLng.lat());
					$("#lng").val(event.latLng.lng());	
					$("#lat").html(event.latLng.lat());
					$("#lng").html(event.latLng.lng());					
				});	 	   
			markersArray.push(marker);					  			
  	}

  function codeAddress() {
	clearOverlays();	
    var address=$("#address").val()+",australia";
	
    geocoder.geocode( { 'address': address}, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
        map.setCenter(results[0].geometry.location);
        marker = new google.maps.Marker({
            map: map, 
			zoom: 18,
			draggable: true,
			icon:"images/red-pin.png",
            position: results[0].geometry.location			
        });
		markersArray.push(marker);
		google.maps.event.addDomListener(window, 'load', initialize); 
	    google.maps.event.addListener(marker, 'dragend', function(event)
				{	
					$("#lat").val(event.latLng.lat());
					$("#long").val(event.latLng.lng());					
				});	    
      } else 
	  		{
	        //alert("Geocode was not successful for the following reason: " + status);
			alert('Can\'t locate on map', '');
      		}
    });
  }
  function codeAddress_edit() {
	clearOverlays();	
    var address=$("#address").val()+","+$("#city_id1").find("option:selected").attr('title')+","+$("#state_id1").find("option:selected").attr('title')+",canada";
	
    geocoder.geocode( { 'address': address}, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
        map.setCenter(results[0].geometry.location);
        marker = new google.maps.Marker({
            map: map, 
			zoom: 18,
			draggable: true,
			icon:"images/red-pin.png",
            position: results[0].geometry.location			
        });
		markersArray.push(marker);
		google.maps.event.addDomListener(window, 'load', initialize); 
		google.maps.event.addListener(marker, 'dragend', function(event)
				{	
					$("#lat").val(event.latLng.lat());
					$("#lng").val(event.latLng.lng());					
				});	    
      } else 
	  		{
	        //alert("Geocode was not successful for the following reason: " + status);			
			alert('Can\'t locate on map', '');      		
      		}
    });
  }
  function locateonmap() {
	clearOverlays();
	if($("#location").val()=='')
	{
		alert('Please enter address', '');
		$("#address").focus();
		return false;
	}
	var address=$("#location").val();
	
    geocoder.geocode( { 'address': address}, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
        map.setCenter(results[0].geometry.location);
        marker = new google.maps.Marker({
            map: map, 
			zoom: 18,
			draggable: true,
			icon:"images/red-pin.png",
            position: results[0].geometry.location			
        });
		markersArray.push(marker);
		google.maps.event.addDomListener(window, 'load', initialize); 
	    google.maps.event.addListener(marker, 'dragend', function(event)
				{	
					$("#lat").val(event.latLng.lat());
					$("#lng").val(event.latLng.lng());	
				});	    
      } else 
	  		{
	        //alert("Geocode was not successful for the following reason: " + status);			
			alert('Can\'t locate on map', '');      		
      		}
    });
  }  	   	     
  function clearOverlays() 
  {
  	if (markersArray) 
	    {
			for (i in markersArray) {
		  		markersArray[i].setMap(null);
			}
  		}
	}
   </script>
  </head>
  <body style="font-family: Arial; border: 0 none;" onload="initialize()">
    <div id="map-canvas" style="width: 600px; height: 400px"></div>    
  </body>
</html>
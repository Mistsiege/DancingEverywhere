var geocoder;
var map;
function initialize() {
  geocoder = new google.maps.Geocoder();
  var latlng = new google.maps.LatLng(-34.397, 150.644);
  var mapOptions = {
    zoom: 8,
    center: latlng,
	disableDefaultUI: true
  }
  map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
}

function codeAddress() {
  var spacer1 = ", ";
  var address = document.getElementById('address').value;
  var city = document.getElementById('city').value;
  var state = document.getElementById('state').value;
  var country = document.getElementById('country').value;
  var total_address = address.concat(spacer1);
  var total_address = total_address.concat(city);
  var total_address = total_address.concat(spacer1);
  var total_address = total_address.concat(state);  
  var total_address = total_address.concat(spacer1);
  var total_address = total_address.concat(country);
  geocoder.geocode( { 'address': total_address}, function(results, status) {
    if (status == google.maps.GeocoderStatus.OK) {
      map.setCenter(results[0].geometry.location);
	  document.getElementById('lat').value=results[0].geometry.location.lat();
	  document.getElementById('lng').value=results[0].geometry.location.lng();
      var marker = new google.maps.Marker({
          map: map,
          position: results[0].geometry.location
      });
    } else {
      alert('Geocode was not successful for the following reason: ' + status);
    }
  });
}

google.maps.event.addDomListener(window, 'load', initialize);

//Functionality for Create/Edit Form
$(function(){
	$('input[type=radio][name=submission]').change(function() {    
		if($(this).val() == "community"){   
			$('#organizer-email').addClass('hidden-organizer');
			$("#organizer-email").removeClass('visible-organizer');
		}
		else if($(this).val() == "organizer"){   
			$('#organizer-email').removeClass('hidden-organizer');
			$("#organizer-email").addClass('visible-organizer');
		}
	});
});
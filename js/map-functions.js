var customIcons = {
            Balboa: {
                icon: 'http://www.dancingeverywhere.com/images/mappin_balboa_18x22.png'
            },
            Lindyhop: {
                icon: 'http://www.dancingeverywhere.com/images/mappin_lindyhop_18x22.png'
            },
            Swing: {
                icon: 'http://www.dancingeverywhere.com/images/mappin_lindyhop_18x22.png'
            },
            Charleston: {
                icon: 'http://www.dancingeverywhere.com/images/mappin_lindyhop_18x22.png'
            },
            EastCoastSwing: {
                icon: 'http://www.dancingeverywhere.com/images/mappin_lindyhop_18x22.png'
            },
            ArgentineTango: {
                icon: 'http://www.dancingeverywhere.com/images/mappin_ballroom_18x22.png'
            },
            Ballroom: {
                icon: 'http://www.dancingeverywhere.com/images/mappin_ballroom_18x22.png'
            },
            Waltz: {
                icon: 'http://www.dancingeverywhere.com/images/mappin_ballroom_18x22.png'
            },
            Foxtrot: {
                icon: 'http://www.dancingeverywhere.com/images/mappin_ballroom_18x22.png'
            },
            Salsa: {
                icon: 'http://www.dancingeverywhere.com/images/mappin_salsa_18x22.png'
            },
            Bachata: {
                icon: 'http://www.dancingeverywhere.com/images/mappin_salsa_18x22.png'
            },
            WestCoastSwing: {
                icon: 'http://www.dancingeverywhere.com/images/mappin_westcoast_18x22.png'
            },
            ContraDance: {
                icon: 'http://www.dancingeverywhere.com/images/mappin_contra_18x22.png'
            },
            Blues: {
                icon: 'http://www.dancingeverywhere.com/images/mappin_blues_18x22.png'
            },
			Zouk: {
                icon: 'http://www.dancingeverywhere.com/images/mappin_zouk_18x22.png'				
			},
            Default: {
                icon: 'http://www.dancingeverywhere.com/images/mappin_default_18x22.png'
            }
        };
    
        function load() { 
            var map = new google.maps.Map(document.getElementById("map"), {
                center: new google.maps.LatLng(39.8282, -98.5795),
                zoom: 4,
                mapTypeId: 'roadmap',
				mapTypeControl: true,
				mapTypeControlOptions: {
					position: google.maps.ControlPosition.RIGHT_CENTER
				},
				zoomControl: true,
				zoomControlOptions: {
					position: google.maps.ControlPosition.RIGHT_CENTER
				},
				scaleControl: true,
				streetViewControl: true,
				streetViewControlOptions: {
					position: google.maps.ControlPosition.RIGHT_CENTER
				}
            });
            var infoWindow = new google.maps.InfoWindow;
    
            // Change this depending on the name of XML Generation PHP file
            downloadUrl("../includes/phpsqlajax_genxml2.php", function(data) {
                var xml = data.responseXML;
                var markers = xml.documentElement.getElementsByTagName("marker");
                for (var i = 0; i < markers.length; i++) {
                    var name = markers[i].getAttribute("name");
					var address = markers[i].getAttribute("address");
					var type = markers[i].getAttribute("type");
					var style = markers[i].getAttribute("style");
					var www = markers[i].getAttribute("www");
					var timing = markers[i].getAttribute("timing");
					var lesson = markers[i].getAttribute("lesson");
					if(lesson==1) {
						lesson = 'Lessons Available';
					} else {
						lesson = 'No Lesson';  
					}
					var point = new google.maps.LatLng(
						parseFloat(markers[i].getAttribute("lat")),
						parseFloat(markers[i].getAttribute("lng")));
					var html = "<a href='" + www + "' target='_blank'>" + name + "</a><br />" + address + "<br /><br />" + style + "<br />" + type + " / " + timing + "<br />" + lesson;
					var icon = customIcons[style] || {};
					var image = 'http://www.dancingeverywhere.com/images/dancingeverywhere_mappin18x22.png';
					var marker = new google.maps.Marker({
						map: map,
						position: point,
						icon: icon.icon,
						shadow: icon.shadow
					});
                    bindInfoWindow(marker, map, infoWindow, html);
                }
            });
        }
    
        function bindInfoWindow(marker, map, infoWindow, html) {
            google.maps.event.addListener(marker, 'click', function() {
                infoWindow.setContent(html);
                infoWindow.open(map, marker);
            });
        }
    
        function downloadUrl(url, callback) {
            var request = window.ActiveXObject ?
            new ActiveXObject('Microsoft.XMLHTTP') :
            new XMLHttpRequest;
            request.onreadystatechange = function() {
                if (request.readyState == 4) {
                    request.onreadystatechange = doNothing;
                    callback(request, request.status);
                }
            };
            request.open('GET', url, true);
            request.send(null);
        }
        
        function doNothing() {}
		
		
		google.maps.event.addDomListener(window, 'load', load);
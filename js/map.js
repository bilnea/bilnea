function initMap() {
	var pattern = /^map_+/;
	for (var varName in window) {
		if (pattern.test(varName)) {
			var a = varName.replace('map_', '');
			var c = eval('center_'+a);
			var myStyles;
			if (eval('poi_'+a) == 'false') {
				myStyles =[{
					featureType: "poi",
					elementType: "labels",
					stylers: [{
						visibility: "off"
					}]
				}];
			};
			if (eval('drag_'+a) == 'false') {
				var controles = true;
			} else {
				var controles = false;
			}
			window['map_'+a] = new google.maps.Map(document.getElementById('map-'+a), {
				zoom: eval('zoom_'+a),
				center: c,
				styles: myStyles,
				disableDefaultUI: controles,
				zoomControl: eval('z_control_'+a),
				mapTypeControl: eval('m_control_'+a),
				scrollwheel: eval('scroll_'+a),
				navigationControl: true,
				streetViewControl: false,
				draggable: eval('drag_'+a)
			});
			var mark = window['markers_'+a];
			for (var i = 0; i < mark.length; i++) {
				var marker = mark[i];
				if (typeof marker['icon'] === 'undefined') {
					window['marker_'+a] = new google.maps.Marker({
						position: {lat: marker['position']['lat'], lng: marker['position']['lng']},
						map: window[marker['map']]
					});
				} else {
					var size = parseInt(marker['icon']['size']);
					window['marker_'+a] = new google.maps.Marker({
						position: {lat: marker['position']['lat'], lng: marker['position']['lng']},
						map: window[marker['map']],
						icon: {
							url: marker['icon']['url'],
							scaledSize: new google.maps.Size(size, size),
							origin: new google.maps.Point(0,0),
							anchor: new google.maps.Point((size/2), size)
						}
					});
					if (marker['info'] != undefined) {
						window['marker_'+a].infowindow = new google.maps.InfoWindow({
							content: marker['info']
						});
						google.maps.event.addListener(window['marker_'+a], 'click', function() {
							this.infowindow.open(window['map_'+a], this);
						});
					};
				}
			};
		}
	}
}

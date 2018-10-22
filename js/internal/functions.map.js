jQuery(function($) {
	jQuery('.map-wrapper').each(function() {
		var t = $(this),
			i = t.attr('id').split('-')[1],
			o = window['options_'+i],
			m = o['markers'],
			b = false;
		if (o.hasOwnProperty('bounds')) {
			b = o.bounds;
			delete o['bounds'];
		}
		delete o['markers'];
		console.log(m);
		o.container = t.attr('id');
		mapboxgl.accessToken = mapbox.token;
		window['map_'+i] = new mapboxgl.Map(o);
		var y = 1;
		m.forEach(function(marker) {
			var e = document.createElement('div'),
				s = marker.icon.size[0];
			e.style.width = s+'px';
			e.style.height = s+'px';
			e.style.marginLeft = (-s/2)*marker.icon.anchor[0]+'px';
			e.style.marginTop = (-s/2)*marker.icon.anchor[1]+'px';
			e.className = 'marker marker_'+i+'_'+y;
			e.style.backgroundImage = 'url('+marker.icon.url+')';
			if (marker.info.open == 'yes') {
				e.innerHTML = '<div class="bubble">'+marker.info.text+'</div>';
			}
			new mapboxgl.Marker(e).setLngLat(marker.position).addTo(window['map_'+i]);
			y++;
		});
		if (b != false) {
			window['map_'+i].fitBounds(b, {
				animate: false,
				padding: o.padding[0]
			});
		}
		window['map_'+i].addControl(new mapboxgl.NavigationControl({
			zoomControl: o.zoomControl
		}), 'top-left');
	});
});

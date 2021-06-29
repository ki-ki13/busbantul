<!-- Make sure you put this AFTER Leaflet's CSS -->
<!-- Make sure you put this AFTER Leaflet's CSS -->
<script src="https://unpkg.com/leaflet@1.3.4/dist/leaflet.js" integrity="sha512-nMMmRyTVoLYqjP9hrbed9S+FzjZHW5gY1TWCHA5ckwXZBadntCNs8kEqAWdrb9O7rxbCaA4lKTIWjDXZxflOcA==" crossorigin=""></script>
<script src="<?= base_url('assets/js/leaflet-panel-layers-master/src/leaflet-panel-layers.js') ?>"></script>
<script src="<?= base_url('assets/js/leaflet.ajax.js') ?>"></script>
<script>
	var latInput = document.querySelector("[name=latitude]");
	var lngInput = document.querySelector("[name=longitude]");
	var marker;
	var map = L.map('map').setView([-7.83702297266836, 110.3650265331058], 11);

	var Layer = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
		attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
		maxZoom: 18,
		id: 'mapbox/streets-v11',
		tileSize: 512,
		zoomOffset: -1,
		accessToken: 'pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw'
	});

	map.addLayer(Layer);

	map.on("click", function(e) {
		var lat = e.latlng.lat;
		var lng = e.latlng.lng;
		if (!marker) {
			marker = L.marker(e.latlng).addTo(map)
		} else {
			marker.setLatLng(e.latlng);
		}
		latInput.value = lat;
		lngInput.value = lng;
	});

	var myStyle = {
		"color": "#ff7800",
		"weight": 3,
		"opacity": 1
	};

	var myStyle2 = {
		"color": "#ff1000",
		"weight": 3,
		"opacity": 1
	};


	function popUp(f, l) {
		var out = [];
		if (f.properties) {
			// for (key in f.properties) {
			// 	
			// }
			out.push("Jalur :" + f.properties['JALUR']);
			l.bindPopup(out.join("<br />"));
		}
	}

	// legend

	function iconByName(name) {
		return '<i class="icon" style="background-color:' + name + ';border-radius:50%"></i>';
	}

	function featureToMarker(feature, latlng) {
		return L.marker(latlng, {
			icon: L.divIcon({
				className: 'marker-' + feature.properties.amenity,
				html: iconByName(feature.properties.amenity),
				iconUrl: '../images/markers/' + feature.properties.amenity + '.png',
				iconSize: [25, 41],
				iconAnchor: [12, 41],
				popupAnchor: [1, -34],
				shadowSize: [41, 41]
			})
		});
	}

	var baseLayers = [{
		name: "StreetMap",
		layer: Layer
	}]

	<?php
	$getjalur = $this->Rute_model->get_jalur();
	foreach ($getjalur->result() as $row) {
	?>

		var myStyle<?= $row->id_jalur ?> = {
			"color": "<?= $row->warna ?>",
			"weight": 1,
			"opacity": 1
		};

	<?php
		$arrayjalur[] = '{
			name: "' . $row->jalur . '",
			icon: iconByName("' . $row->warna . '"),
			layer: new L.GeoJSON.AJAX(["assets/unggah/geojson/' . $row->geojson . '"],{onEachFeature:popUp,style: myStyle' . $row->id_jalur . ',pointToLayer: featureToMarker }).addTo(map)
			}';
	}
	?>

	var overLayers = [{
		group: "Daftar Jalur",
		layers: [
			<?= implode(',', $arrayjalur); ?>
		]
	}];

	var panelLayers = new L.Control.PanelLayers(baseLayers, overLayers, {
		collapsibleGroups: true
	});

	map.addControl(panelLayers);
</script>
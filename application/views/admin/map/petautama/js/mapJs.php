
<!-- Make sure you put this AFTER Leaflet's CSS -->
<!-- Make sure you put this AFTER Leaflet's CSS -->
<script src="https://unpkg.com/leaflet@1.3.4/dist/leaflet.js" integrity="sha512-nMMmRyTVoLYqjP9hrbed9S+FzjZHW5gY1TWCHA5ckwXZBadntCNs8kEqAWdrb9O7rxbCaA4lKTIWjDXZxflOcA==" crossorigin=""></script>
<script src="<?= base_url('assets/js/leaflet-panel-layers-master/src/leaflet-panel-layers.js') ?>"></script>
<script src="<?= base_url('assets/js/leaflet.ajax.js') ?>"></script>
<script src="<?= site_url('admin/api/data/jalur') ?>"></script>
<script src="<?= site_url('admin/api/data/kategoritikor') ?>"></script>
<script>
	var latInput = document.querySelector("[name=latitude]");
	var lngInput = document.querySelector("[name=longitude]");
	var marker;
	var map = L.map('map').setView([-7.83702297266836, 110.3650265331058], 11);
	var layersJalur = [];
	var layerskategoritikor = [];
	var Layer = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
		attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
		maxZoom: 18,
		id: 'mapbox/streets-v11',
		tileSize: 512,
		zoomOffset: -1,
		accessToken: 'pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw'
	});

	map.addLayer(Layer);
	// console.log(dataJalur);
	function getColorJalur(KODE) {
		for (i = 0; i < dataJalur.length; i++) {
			var data = dataJalur[i];
			if (data.kd_jalur == KODE) {
				return data.warna;
			}
		}
	}

	function popUp(f, l) {
		var out = [];
		if (f.properties) {
			// for (key in f.properties) {
			// 	
			// }
			// out.push("Kode Jalur :" + f.properties['KODE']);
			out.push("Jalur :" + f.properties['JALUR']);
			l.bindPopup(out.join("<br />"));
		}
	}

	// legend

	function iconByName(name) {
		return '<i class="icon" style="background-color:' + name + ';border-radius:50%"></i>';
	}

	function iconByImage(image) {
		return '<img src="' + image + '" style="width:16px">';
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

	for (i = 0; i < dataJalur.length; i++) {
		var data = dataJalur[i];
		var layer = {
			name: data.jalur,
			icon: iconByName(data.warna),
			layer: new L.GeoJSON.AJAX([data.linkgeojson.replace("dl=0","raw=1")], {
				onEachFeature: popUp,
				style: function(feature) {
					// console.log(feature);
					var KODE = feature.properties.KODE;
					return {
						"color": getColorJalur(KODE),
						"weight": 3,
						"opacity": 1
					}

				},

			}).addTo(map) 
		}
		layersJalur.push(layer);
	}

	//kategoritikor
	for (i = 0; i < datakategoritikor.length; i++) {
		var data = datakategoritikor[i];
		var layer = {
			name: (data.jalur),
			icon: iconByImage(data.marker),
			layer: new L.GeoJSON.AJAX(["<?= site_url('api/data/tikor/point') ?>/" + data.id_jalur], {

				pointToLayer: function(feature, latlng) {
					// console.log(feature)
					return L.marker(latlng, {
						icon: new L.icon({
							iconUrl: feature.properties.marker,
							iconSize: [15, 20]
						})
					});
				},
				onEachFeature: function(feature, layer) {
					if (feature.properties && feature.properties.jalur) {
						layer.bindPopup(feature.properties.popUp);
					}
				}
			}).addTo(map)
		}
		layerskategoritikor.push(layer);
	}



	var overLayers = [{
		group: "Jalur",
		layers: layersJalur
	}, {
		group: "Halte",
		layers: layerskategoritikor
	}];

	var panelLayers = new L.Control.PanelLayers(baseLayers, overLayers, {
		collapsibleGroups: true
	});

	map.addControl(panelLayers);
</script>
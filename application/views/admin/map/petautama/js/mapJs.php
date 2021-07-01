
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
	function iconMarker(name) {
		return '<i class="fa fa-map-marker-alt" style="color:' + name + '"></i>';
	}

	// function featureToMarker(feature, latlng) {
	// 	return L.marker(latlng, {
	// 		icon: L.divIcon({
	// 			className: 'marker-' + feature.properties.amenity,
	// 			html: '<i class="fa fa-map-marker-alt" style="color:' + feature + ';border-radius:50%"></i>',
	// 			//iconUrl: '../images/markers/' + feature.properties.amenity + '.png',
	// 			iconSize: [25, 41],
	// 			iconAnchor: [12, 41],
	// 			popupAnchor: [1, -34],
	// 			shadowSize: [41, 41]
	// 		})
	// 	});
	//}

	var baseLayers = [{
		name: "StreetMap",
		layer: Layer
	}]

	for (i = 0; i < dataJalur.length; i++) {
		var data = dataJalur[i];
		var layer = {
			name: data.jalur,
			icon: iconByName(data.warna),
			layer: new L.GeoJSON.AJAX([data.linkgeojson.replace("www.dropbox.com","dl.dropboxusercontent.com").replace("?dl=0","")], {
				onEachFeature: popUp,
				style:{
				"color": data.warna, 
				"weight": 3,
				"opacity": 1}
				// function(feature) {
				// 	// console.log(feature);
				// 	//var KODE = feature.properties.KODE;
				// 	return 
				// 		"weight": 3,
				// 		"opacity": 1
					

				}).addTo(map) 
		}
		layersJalur.push(layer);
	}

	//kategoritikor
	for (i = 0; i < datakategoritikor.length; i++) {
		var data = datakategoritikor[i];
		var warnaMarker = data.warna;
		const markermap ={

		}
		var layer = {
			name: (data.jalur),
			icon: iconMarker(data.warna),
			layer: new L.GeoJSON.AJAX(["<?= site_url('admin/api/data/tikor/point') ?>/" + data.id_jalur], {

				pointToLayer: function(feature, latlng) {
					// console.log(feature)
					return L.marker(latlng, {
						icon: L.divIcon({
							className : 'yoyo',
							html :'<i class="fa fa-map-marker-alt" style="color: '+ feature.properties.warna + '; background-color: none"></i>',
							//iconUrl: iconMarker(feature.properties.warna),
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
		collapsibleGroups: true,
		collapsed : true
	});

	map.addControl(panelLayers);
</script>
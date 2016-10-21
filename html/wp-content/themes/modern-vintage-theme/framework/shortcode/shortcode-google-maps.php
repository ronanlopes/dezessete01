<?php
	function indiegroundshortcode_create_google_maps() {
		global $indieground_options;

		$numrnd = rand();

		$output = "";

		$output .= "<div id='map_canvas_".$numrnd."' class='map_canvas'></div>\n";

		$output .= "<scri"."pt type='text/javascr"."ipt'>\n";
		$output .= "jQuery(document).ready(function() {\n";
		$output .= "	var map_".$numrnd.";\n";
		$output .= "	var options_".$numrnd." = {\n";
		$output .= "		zoom: ".$indieground_options['indieground-maps-zoom'].",\n";
		$output .= "		zoomControl: true, // controllo manuale zoom\n";
		$output .= "		scaleControl: true,// controllo manuale zoom\n";
		$output .= "		scrollwheel: false,// controllo mouse zoom\n";
		$output .= "		disableDoubleClickZoom: true,\n";
		$output .= "		center: new google.maps.LatLng(".$indieground_options['indieground-maps-latitude'].", ".$indieground_options['indieground-maps-longitude']."),\n";
		if ($indieground_options['indieground-maps-type']=='1') {
			$output .= "		mapTypeId: google.maps.MapTypeId.SATELLITE\n";
		} else {
			$output .= "		mapTypeId: google.maps.MapTypeId.ROADMAP\n";
		}
		$output .= "	};\n";
		$output .= "	var map_".$numrnd." = new google.maps.Map(document.getElementById('map_canvas_".$numrnd."'), options_".$numrnd.");\n";
		$output .= "	var marker_".$numrnd." = new google.maps.Marker({\n";
		$output .= "		position: new google.maps.LatLng(".$indieground_options['indieground-maps-latitude'].", ".$indieground_options['indieground-maps-longitude']."),\n";
		$output .= "				map: map_".$numrnd;

		if ($indieground_options['indieground-maps-marker']['url']!="") {
			$output .= ",\n";
			$output .= "				icon: '".$indieground_options['indieground-maps-marker']['url']."'\n";
		}
		$output .= "\n";
		$output .= "		});\n";


		if ($indieground_options['indieground-maps-text']!="") {
			$output .= "	google.maps.event.addListener(marker_".$numrnd.", 'click', function() {\n";
			$output .= "		infowindow.open(map_".$numrnd.",marker_".$numrnd.");\n";
			$output .= "	});\n";
			$output .= "	var infowindow = new google.maps.InfoWindow({\n";
			$output .= "		content: '".$indieground_options['indieground-maps-text']."'\n";
			$output .= "	});\n";
		}

		if ($indieground_options['indieground-maps-type']!='1') {
			$output .= "	var styles_".$numrnd." = [{\n";
			$output .= "			stylers: [\n";
			$output .= "				{ hue: '#E96045' },\n";
			$output .= "				{ saturation: -30 },\n";
			$output .= "				{ lightness: 30 }\n";
			$output .= "			]},{\n";
			$output .= "			featureType: 'road',\n";
			$output .= "			elementType: 'geometry',\n";
			$output .= "			stylers: [\n";
			$output .= "				{ lightness: 50 },\n";
			$output .= "				{ saturation: 0 },\n";
			$output .= "				{ visibility: 'simplified' }\n";
			$output .= "			]},{\n";
			$output .= "			featureType: 'road',\n";
			$output .= "			elementType: 'labels',\n";
			$output .= "			stylers: [\n";
			$output .= "			{ visibility: 'on' }\n";
			$output .= "			]\n";
			$output .= "	}];\n";

			$output .= "	var styledMap_".$numrnd." = new google.maps.StyledMapType(styles_".$numrnd.",{name: 'Styled Map'});\n";
			$output .= "	map_".$numrnd.".mapTypes.set('map_style', styledMap_".$numrnd.");\n";
			$output .= "	map_".$numrnd.".setMapTypeId('map_style');\n";
		}

		//$output .= "	};\n";

		$output .= "	});\n";
		$output .= "</script>\n";

		return $output;
	}
?>
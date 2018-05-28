<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>Highcharts Example</title>
		<!-- 1. Add these JavaScript inclusions in the head of your page -->
		<script type="text/javascript" src="https://code.jquery.com/jquery-1.10.1.js"></script>
		<script type="text/javascript" src="https://code.highcharts.com/highcharts.js"></script>
		<script type="text/javascript" src="https://code.highcharts.com/modules/exporting.js"></script>
		<script type="text/javascript" src="https://code.highcharts.com/modules/offline-exporting.js"></script>
		
		
		<!-- 2. Add the JavaScript to initialize the chart on document ready -->
		<script>
		var chart; // global
		
		/**
		 * Request data from the server, add it to the graph and set a timeout to request again
		 */
		function requestData() {
			$.ajax({
				url: 'live-server-data.php', 
				success: function(point) {
					var series = chart.series[0],
						shift = series.data.length > 20; // shift if the series is longer than 20
		
					var values = eval(point);
		
		
					// add the point
					chart.series[0].addPoint([values[0], values[1]], true, shift);
					chart.series[1].addPoint([values[0], values[2]], true, shift);
					// call it again after one second
					setTimeout(requestData, 5000);	
				},
				cache: false
			});
		}
			
		$(document).ready(function() {
			chart = new Highcharts.Chart({
				chart: {
					renderTo: 'container',
					defaultSeriesType: 'spline',
					events: {
						load: requestData
					}
				},
				title: {
					text: 'LSD - Live Sensor Data'
				},
				subtitle: {
					text: 'Source: Particle Photon ID #0001'
				},
				xAxis: {
					type: 'datetime',
					tickPixelInterval: 150,
					maxZoom: 20 * 1000
				},
				yAxis: {
					title: {
						text: 'Value',
						margin: 80
					}
				},
				series: [{
					name: 'Temperature',
					data: []
				},
				{
					name: 'Humidity',
					data: []
				}
				]
			});		
		});
		</script>
		
		<style id="style-1-cropbar-clipper">/* Copyright 2014 Evernote Corporation. All rights reserved. */
			.en-markup-crop-options {
				top: 18px !important;
				left: 50% !important;
				margin-left: -100px !important;
				width: 200px !important;
				border: 2px rgba(255,255,255,.38) solid !important;
				border-radius: 4px !important;
			}

			.en-markup-crop-options div div:first-of-type {
				margin-left: 0px !important;
			}
		</style>
	</head>
<body>
		<div id="text1">
			<h1 style="text-align:center;">Test site</h1>
		</div>
		
		<!-- 3. Add the container -->
		<div id="container" style="width: 800px; height: 400px; margin: 0 auto" data-highcharts-chart="0">
	
</div>
	

</body>
</html>
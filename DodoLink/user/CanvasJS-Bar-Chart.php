<!DOCTYPE HTML>
<html>
<head>

	<script type="text/javascript" src="../js/jquery.min.js"></script>
	<script type="text/javascript" src="../js/jquery.canvasjs.min.js"></script>
<script>
window.onload = function () {
	jQuery.ajax({
 	 type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
 	 url         : "../includes/bar.php", // the url where we want to POST
 	 dataType    : 'json',
 	 encode      : true// what type of data do we expect back from the server
 	 })
 	 .done(function(result) {
				 var options = {
					 animationEnabled: true,
					 title: {
						 text: "Mobile Phones Used For",
						 fontColor: "Peru"
					 },
					 axisY: {
						 tickThickness: 0,
						 lineThickness: 0,
						 valueFormatString: " ",
						 gridThickness: 0
					 },
					 axisX: {
						 tickThickness: 0,
						 lineThickness: 0,
						 labelFontSize: 18,
						 labelFontColor: "Peru"
					 },
					 data: [{
						 indexLabelFontSize: 26,
						 toolTipContent: "<span style=\"color:#62C9C3\">{indexLabel}:</span> <span style=\"color:#CD853F\"><strong>{y}</strong></span>",
						 indexLabelPlacement: "inside",
						 indexLabelFontColor: "white",
						 indexLabelFontWeight: 600,
						 indexLabelFontFamily: "Verdana",
						 color: "#62C9C3",
						 type: "bar",
						 dataPoints: result
					 }]
				 };

				 $("#chartContainer").CanvasJSChart(options);
		 	});


}
</script>
</head>
<body>
<div id="chartContainer" style="height: 370px; max-width: 920px; margin: 0px auto;"></div>
</body>
</html>

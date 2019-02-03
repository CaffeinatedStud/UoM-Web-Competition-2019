<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<script type="text/javascript" src="../js/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="../js/jquery.canvasjs.min.js"></script>
<script type="text/javascript">
window.onload = function() {

	                    jQuery.ajax({
	                      type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
	                      url         : "../includes/pie.php", // the url where we want to POST
	                      dataType    : 'json',
	                      encode      : true// what type of data do we expect back from the server
	                      })
												.done(function(result) {

													//	alert(result);
														var options = {
															title: {
																text: "Website Traffic Source"
															},
															data: [{
																	type: "pie",
																	startAngle: 45,
																	showInLegend: "true",
																	legendText: "{label}",
																	indexLabel: "{label} ({y})",
																	yValueFormatString:"#,##0.#"%"",
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

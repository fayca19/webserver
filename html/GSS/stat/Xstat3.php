<?php 
include "../../GSS/stat/load3.php";
?>
	
	<script src="Chart.min.js"></script>
    <script src="utils.js"></script>
	<style>
	canvas {
		-moz-user-select: none;
		-webkit-user-select: none;
		-ms-user-select: none;
	}
	.chart-container {
		width: 100%;
		margin-left: 40px;
		margin-right: 40px;
		margin-bottom: 40px;
	}
	.container {
		display: flex;
		flex-direction: row;
		flex-wrap: wrap;
		justify-content: center;
	}
	</style>



	<div id="container" style="width: 90%;">
		<canvas id="canvas"></canvas>
	</div>
		<script>
		
		var color = Chart.helpers.color;
		var barChartData= {
			labels: ['BINOME-1', 'BINOME-2', 'BINOME-3', 'BINOME-4', 'BINOME-5', 'BINOME-6'],
			datasets: [{
				label: 'BINOME-1',
				backgroundColor: color(window.chartColors.yellowe).alpha(0.5).rgbString(),
				borderColor: window.chartColors.yellowe,
				borderWidth: 4,
				data: [
					<?php echo $jaune;?>,
					0,
					0,
					0,
					0,
					0,
					0,
					0,
					0,
					0,
					0,
					0
				]
			}, {
				label: 'BINOME-2',
				backgroundColor: color(window.chartColors.purplee).alpha(0.5).rgbString(),
				borderColor: window.chartColors.purplee,
				borderWidth: 4,
				data: [
					0,
					<?php echo $violet;?>,
					0,
					0,
					0,
					0,
					0,
					0,
					0,
					0,
					0
				]
			},{
				label: 'BINOME-2',
				backgroundColor: color(window.chartColors.blue).alpha(0.5).rgbString(),
				borderColor: window.chartColors.blue,
				borderWidth: 4,
				data: [
					0,
					0,
					<?php echo $bleu;?>,
					0,
					0,
					0,
					0,
					0,
					0,
					0
				]
			},{
				label: 'BINOME-4',
				backgroundColor: color(window.chartColors.greene).alpha(0.5).rgbString(),
				borderColor: window.chartColors.greene,
				borderWidth: 4,
				data: [
					0,
					0,
					0,
					<?php echo $vert;?>,
					0,
					0,
					0
				]
			}, {
				label: 'BINOME-5',
				backgroundColor: color(window.chartColors.orange).alpha(0.5).rgbString(),
				borderColor: window.chartColors.orange,
				borderWidth: 4,
				data: [
					0,
					0,
					0,
					0,
					<?php echo $orange;?>,
					0
				]
			}, {
				label: 'BINOME-6',
				backgroundColor: color(window.chartColors.red).alpha(0.5).rgbString(),
				borderColor: window.chartColors.red,
				borderWidth: 4,
				data: [
					0,
					0,
					0,
					0,
					0,
					<?php echo $rouge;?>
				]
			}]

		};

		window.onload = function() {
			var ctx = document.getElementById('canvas').getContext('2d');
			window.myBar = new Chart(ctx, {
				type: 'bar',
				data: barChartData,
				options: {
					responsive: true,
					legend: {
						position: 'top',
					},
					title: {
						display: true,
						text: '<?php echo $titre;?>' 
					}
				}
			});

		};

setInterval("location.reload()", 300000);		
	</script>
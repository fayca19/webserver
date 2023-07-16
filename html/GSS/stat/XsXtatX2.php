<?php 
include "../../GSS/stat/load2.php";
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
			labels: ['LATOUI', 'AMOUR', 'ARAB', 'ZEFOUNI', 'ZEMRANI', 'BOUCHAMA', 'MANSOURI','BOUTER','BOUAZIZ','MESLI','HADDAR','BACHIR','KETIR','DJADOURI','Raouf'],
			datasets: [{
				label: 'LATOUI',
				backgroundColor: color(window.chartColors.orange).alpha(0.5).rgbString(),
				borderColor: window.chartColors.orange,
				borderWidth: 4,
				data: [
					<?php echo $latoui;?>,
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
					0,
                                        0,
                                        0,
                                        0
				]
			}, {
				label: 'AMOUR',
				backgroundColor: color(window.chartColors.yellow).alpha(0.5).rgbString(),
				borderColor: window.chartColors.yellow,
				borderWidth: 4,
				data: [
					0,
					<?php echo $amour;?>,
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
                                        0,
                                        0,
                                        0

				]
			}, {
				label: 'ARAB',
				backgroundColor: color(window.chartColors.blue).alpha(0.5).rgbString(),
				borderColor: window.chartColors.blue,
				borderWidth: 4,
				data: [
					0,
					0,
					<?php echo $arab;?>,
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
                                        0,
                                        0

				]
			}, {
				label: 'ZEFOUNI',
				backgroundColor: color(window.chartColors.green).alpha(0.5).rgbString(),
				borderColor: window.chartColors.green,
				borderWidth: 4,
				data: [
					0,
					0,
					0,
					<?php echo $zefouni;?>,
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
				label: 'ZEMRANI',
				backgroundColor: color(window.chartColors.red).alpha(0.5).rgbString(),
				borderColor: window.chartColors.red,
				borderWidth: 4,
				data: [
					0,
					0,
					0,
					0,
					<?php echo $zemrani;?>,
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
				label: 'BOUCHAMA',
				backgroundColor: color(window.chartColors.grey).alpha(0.5).rgbString(),
				borderColor: window.chartColors.grey,
				borderWidth: 4,
				data: [
					0,
					0,
					0,
					0,
					0,
					<?php echo $bouchama;?>,
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
				label: 'MANSOURI',
				backgroundColor: color(window.chartColors.purple).alpha(0.5).rgbString(),
				borderColor: window.chartColors.purple,
				borderWidth: 4,
				data: [
					0,
					0,
					0,
					0,
					0,
					0,
					<?php echo $mansouri;?>,
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
				label: 'BOUTER',
				backgroundColor: color(window.chartColors.black).alpha(0.5).rgbString(),
				borderColor: window.chartColors.black,
				borderWidth: 4,
				data: [
					0,
					0,
					0,
					0,
					0,
					0,
					0,
					<?php echo $bouter;?>,
					0,
					0,
					0,
					0,
                                        0,
                                        0,
                                        0

				]
			}, {
				label: 'BOUAZIZ',
				backgroundColor: color(window.chartColors.greene).alpha(0.5).rgbString(),//greene
				borderColor: window.chartColors.greene,
				borderWidth: 4,
				data: [
					0,
					0,
					0,
					0,
					0,
					0,
					0,
					0,
					<?php echo $bouaziz;?>,
					0,
					0,
					0,
                                        0,
                                        0,
                                        0

				]
			}, {
				label: 'MESLI',
				backgroundColor: color(window.chartColors.bluee).alpha(0.5).rgbString(),
				borderColor: window.chartColors.bluee,
				borderWidth: 4,
				data: [
					0,
					0,
					0,
					0,
					0,
					0,
					0,
					0,
					0,
					<?php echo $mesli;?>,
					0,
					0,
                                        0,
                                        0,
                                        0

				]
			}, {
				label: 'HADDAR',
				backgroundColor: color(window.chartColors.yellowe).alpha(0.5).rgbString(),
				borderColor: window.chartColors.yellowe,
				borderWidth: 4,
				data: [
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
					<?php echo $haddar;?>,
					0,
                                        0,
                                        0,
                                        0

				]
			}, {
				label: 'BACHIR',
				backgroundColor: color(window.chartColors.purplee).alpha(0.5).rgbString(),
				borderColor: window.chartColors.purplee,
				borderWidth: 4,
				data: [
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
					0,
					<?php echo $bachir;?>,
                                        0,
                                        0,
                                        0

				]
			}, {
				label: 'KETIR',
				backgroundColor: color(window.chartColors.orange).alpha(0.5).rgbString(),
				borderColor: window.chartColors.orange,
				borderWidth: 4,
				data: [
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
					0,
                                        0,
					<?php echo $ketir;?>,
,
                                        0,
                                        0

				]
			},{

				label: 'DJADOURI',
				backgroundColor: color(window.chartColors.orange).alpha(0.5).rgbString(),
				borderColor: window.chartColors.green,
				borderWidth: 4,
				data: [
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
					0,
                                        0,
					0,<?php echo $djadouri;?>,0

				]
			}, {
				label: 'Raouf',
				backgroundColor: color(window.chartColors.orange).alpha(0.5).rgbString(),
				borderColor: window.chartColors.bleu,
				borderWidth: 4,
				data: [
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
					0,
                                        0,
					0,0,
                                        <?php echo $Raouf;?>

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
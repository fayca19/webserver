<?php 
include "../../GSS/stat/load.php";
$latoui=json_encode($latoui); 
$amour=json_encode($amour);
$arab=json_encode($arab);
$zefouni=json_encode($zefouni);
$zemrani=json_encode($zemrani);
$bouchama=json_encode($bouchama);
$mansouri=json_encode($mansouri);
$bouter=json_encode($bouter);
$rebaine=json_encode($rebaine);
$bouaziz=json_encode($bouaziz);
$mesli=json_encode($mesli);
$haddar=json_encode($haddar);
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



	<div class="container">
	</div>
		<script>
		function createConfig(gridlines, title,latoui,amour,arab,zefouni,zemrani,bouchama,mansouri,bouter,rebaine,bouaziz,mesli,haddar,maxi,step) {
			return {
				type: 'line',
				data: {
					labels: ['Janvier', 'Fevrier', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet','Aout','Septembre','Octobre','Novombre','Decembre'],
					datasets: [{
						label: 'LATOUI',
						backgroundColor: window.chartColors.orange,
						borderColor: window.chartColors.orange,
						data:latoui,
						fill: false,
					}, {
						label: 'AMOUR',
						fill: false,
						backgroundColor: window.chartColors.yellow,
						borderColor: window.chartColors.yellow,
						data:amour,
					}, {
						label: 'ARAB',
						fill: false,
						backgroundColor: window.chartColors.blue,
						borderColor: window.chartColors.blue,
						data:arab,
					}, {
						label: 'ZEFOUNI',
						fill: false,
						backgroundColor: window.chartColors.green,
						borderColor: window.chartColors.green,
						data:zefouni,
					}, {
						label: 'ZEMRANI',
						fill: false,
						backgroundColor: window.chartColors.red,
						borderColor: window.chartColors.red,
						data:zemrani,
					}, {
						label: 'BOUCHAMA',
						fill: false,
						backgroundColor: window.chartColors.grey,
						borderColor: window.chartColors.grey,
						data:bouchama,
					}, {
						label: 'MANSOURI',
						fill: false,
						backgroundColor: window.chartColors.purple,
						borderColor: window.chartColors.purple,
						data:mansouri,
					}, {
						label: 'BOUTER',
						fill: false,
						backgroundColor: window.chartColors.black,
						borderColor: window.chartColors.black,
						data:bouter,
					}, {
						label: 'REBAINE',
						fill: false,
						backgroundColor: window.chartColors.greene,
						borderColor: window.chartColors.greene,
						data:rebaine,
					}, {
						label: 'BOUAZIZ',
						fill: false,
						backgroundColor: window.chartColors.bluee,
						borderColor: window.chartColors.bluee,
						data:bouaziz,
					}, {
						label: 'MESLI',
						fill: false,
						backgroundColor: window.chartColors.yellowe,
						borderColor: window.chartColors.yellowe,
						data:mesli,
					}, {
						label: 'HADDAR',
						fill: false,
						backgroundColor: window.chartColors.purplee,
						borderColor: window.chartColors.purplee,
						data:haddar,
					}]
				},
				options: {
					responsive: true,
					title: {
						display: true,
						text: title
					},
					scales: {
						xAxes: [{
							gridLines: gridlines
						}],
						yAxes: [{
							gridLines: gridlines,
							ticks: {
								min: 0,
								max: maxi,
								stepSize: step
							}
						}]
					}
				}
			};
		}

		window.onload = function() {
			var container = document.querySelector('.container');

			[{
				title: 'STATISTIQUE-ACTIVITE-SINISTRE',
				gridLines: {
					display: true
				}
			}].forEach(function(details) {
				var div = document.createElement('div');
				div.classList.add('chart-container');

				var canvas = document.createElement('canvas');
				div.appendChild(canvas);
				container.appendChild(div);

				var ctx = canvas.getContext('2d');
				var config = createConfig(details.gridLines, details.title,<?php echo $latoui; ?>,<?php echo $amour; ?>,<?php echo $arab; ?>,<?php echo $zefouni; ?>,<?php echo $zemrani; ?>,<?php echo $bouchama; ?>,<?php echo $mansouri; ?>,<?php echo $bouter; ?>,<?php echo $rebaine; ?>,<?php echo $bouaziz; ?>,<?php echo $mesli; ?>,<?php echo $haddar; ?>,<?php echo $max; ?>,<?php echo $step; ?>);
				new Chart(ctx, config);
			});
		};
setInterval("location.reload()", 300000);	
	</script>
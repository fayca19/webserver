<?php 
include "load4.php";

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

<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-blue-grey.css">
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	<div id="container" class=" w3-padding"   >

    <canvas id="canvas"></canvas>
     
	</div>
    <div id="container2" class=" w3-hide  w3-padding" >
           <canvas id="canvas2"></canvas>  
	</div>
    
<!--   $data valeur par gestionnaire $datano                 -->
    
		<script>
	  // let datayazid=JSON.parse(<?php echo var_dump($datanom);?>)
		alert(<?php echo var_dump($datanom);?>)
		//console.log("azul");
		var barChartDatayazid= {
			labels: datayazid.map(row => row.nom),
			datasets: [{ 
				label: "datayazid.map(row=>row.nom)",
                data: datayazid.map(row => row.freq)}]
         };	
		 
		 

		window.onload = function() {
			var ctx = document.getElementById('canvas').getContext('2d');
			window.myBar = new Chart(ctx, {
				type: 'bar',
				data: barChartDatayazid,
				options: {
					responsive: true,
					legend: {
						position: 'top',
					},
					title: {
						display: true,
						text: '<?php /* echo $titre;*/ ?>' 
					}
				}
			});
	

		};  


        setInterval("location.reload()", 300000);		
	</script>
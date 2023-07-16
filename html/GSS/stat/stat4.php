<?php 


?>
	
	<script src="Chart.min.js"></script>
    <script src="utils.js"></script>
	<script src="vue.global.js"></script>
	<script src="axios.min.js"></script>
	<script src="vuetify.min.js"></script>



<link rel="stylesheet" href="vuetify.min.css">


<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	<div id="app" >

	   <div id='wrapper'>
			<v-sheet
				class="d-flex align-center justify-center flex-wrap text-center mx-auto pa-2"
				elevation="4"
				height="50"
				width="100%"
				color="#023E8A"

			>
				<div>
					<h6 style="font-family: monospace" class="text-h6  text-white">AUJOURD'HUI {{ time }}</h6>

				</div>
			</v-sheet>
			<div style="display:flex; align-items:center;">
				<div style="padding: 20px; width: 75vw; height:40vh;">
							<canvas id="acquisitions"></canvas>
				</div>
				<v-card
					width="20vw"
					
				>
					<v-card-item>
					<div>
						<div class="text-h6 mb-1 text-center" style="padding:10px; background-color:#00B4D8; border-radius:10px">
							TOTAL
							<div class="text-h5 text-center">{{parseFloat(data.t_op_classic) + parseFloat(data.t_op_tp)}}</div>
						</div>
						
						<div class="text-overline mb-1 text-center" style="padding:10px; background-color:#ADE8F4; border-radius:10px">
							CLASSIC
							<div class="text-h5 text-center">{{ data.t_op_classic }}</div>
						</div>
						
						<div class="text-overline mb-1 text-center " style="padding:10px; background-color:#CAF0F8; border-radius:10px">
							TP
							<div class="text-h5 text-center">{{ data.t_op_tp }}</div>
						</div>

					</div>
					</v-card-item>
				</v-card>

			</div>


		
			<v-sheet
				class="d-flex align-center justify-center flex-wrap text-center mx-auto pa-2"
				elevation="4"
				height="50"
				width="100%"
				color="#023E8A"
			>
				<div>
					<h6 style="font-family: monospace" class="text-h6  text-white">CE MOIS-CI</h6>
				</div>
			</v-sheet>
			    <div  style="display:flex; align-items:center;">
					<div style="padding: 20px; width: 80vw; height:40vh; display:flex; justify-content:center;">
								<canvas id="acquisitions2"></canvas>
					</div>
					<v-card
					width="20vw"
					
				>
					<v-card-item>
					<div>
						<div class="text-h6 mb-1 text-center" style="padding:10px; background-color:#00B4D8; border-radius:10px">
							TOTAL
							<div class="text-h5 text-center">{{parseFloat(dataMonth.t_op_classic) + parseFloat(dataMonth.t_op_tp)}}</div>
						</div>
						
						<div class="text-overline mb-1 text-center" style="padding:10px; background-color:#ADE8F4; border-radius:10px">
							CLASSIC
							<div class="text-h5 text-center">{{ dataMonth.t_op_classic }}</div>
						</div>
						
						<div class="text-overline mb-1 text-center " style="padding:10px; background-color:#CAF0F8; border-radius:10px">
							TP
							<div class="text-h5 text-center">{{ dataMonth.t_op_tp }}</div>
						</div>

					</div>
					</v-card-item>
				</v-card>
				</div>


	   </div>


     
	</div>

    
<!--   $data valeur par gestionnaire $datano                 -->
    

<script>
  const { createApp } = Vue
  const { createVuetify } = Vuetify
  const vuetify = createVuetify()
  setInterval("location.reload()", 60000);


  createApp({
    data() {
      return {
        data:[],
		dataMonth:[]
      }
    },
	computed:{
        date(){
			const date = new Date();
            let day = String(date.getDate());
            let month = String(date.getMonth() + 1);
            let year = String(date.getFullYear());
			if(month.length < 2) month = '0'+month
            let currentDate = `${day}/${month}/${year}`;
			return currentDate;
        },
		time(){
			const date = new Date();
			let heur = String(date.getHours())
			let minute = String(date.getMinutes())
			if(heur.length < 2) heur = '0'+heur
			if(minute.length < 2) minute = '0'+minute
			let time = heur + ":" + minute;
            return time;
		}
	},
	methods:{
		sortData (data){
				let sortedData;
                sortedData = data.sort(function(a,b){
					return b.nom.toLowerCase() - a.nom.toLowerCase();
				})
				return sortedData;
         },
		async getData(){
			const response = await axios.get(`load4.php`);
			const response2 = await axios.get(`load4month.php`);
			this.data = response.data;
			this.dataMonth = response2.data
			this.addChart();
			this.addChartMonth();

		},
		async addChart(){
			const data = this.data.production
			new Chart(
					document.getElementById('acquisitions').getContext("2d"),
					{
						type: 'bar',
						data: {
							labels: data.map(row => row.nom),
							datasets: [
							{
								label:'TRAITEMENT',
								data: data.map(row => row.freq),
								backgroundColor: ['#03045e','#023E8A','#0077B6','#0096C7','#00B4D8','#48CAE4','#90E0EF','#ADE8F4','#CAF0F8'],
							},
							]
						},
						options: {
							responsive: true,
                            maintainAspectRatio: false,
							indexAxis: 'y',
							scales: {
								x: {
									ticks: {
									font: {
										size: 12,
										weight: "bold"
									},
									color: 'black',
									},
								},

								y: {
									ticks: {
									beginAtZero: true,
									font: {
										size: 12,
										weight: "bold"
									},
									color: 'black'
									}
								}
							},
							legend: {
								display: false,
							}

						}

					}
				);
		},

		async addChartMonth(){
			const data = this.dataMonth.production
			new Chart(
					document.getElementById('acquisitions2').getContext("2d"),
					{
						type: 'bar',
						data: {
							labels: data.map(row => row.nom),
							datasets: [
							{
								label:'TRAITEMENT',
								data: data.map(row => row.freq),
								backgroundColor: ['#03045e','#023E8A','#0077B6','#0096C7','#00B4D8','#48CAE4','#90E0EF','#ADE8F4','#CAF0F8'],
							},
							]
						},
						options: {
							responsive: true,
                            maintainAspectRatio: false,
							indexAxis: 'y',
							responsive:true,
							scales: {
								x: {
									ticks: {
									font: {
										size: 12,
										weight: "bold"
									},
									color: 'black',
									},
								},

								y: {
									ticks: {
									beginAtZero: true,
									font: {
										size: 12,
										weight: "bold"
									},
									color: 'black'
									}
								}
							}
						}

					}
				);
		},
	},
	created(){
		this.getData()
	}
  }).use(vuetify).mount('#app')
</script>

<style>
#wrapper {
	display : flex;
	flex-direction : column;
	align-items : center;
}

</style>
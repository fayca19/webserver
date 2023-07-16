<?php 


?>
	
	<script src="Chart.min.js"></script>
    <script src="utils.js"></script>
	<script src="../js/vue.global.js"></script>
	<script src="../js/axios.min.js"></script>
	<script src="../js/vuetify.min.js"></script>



<link rel="stylesheet" href="../css/vuetify.min.css">
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	<div id="app" >

	   <div id='wrapper'>
			<v-sheet
				class="d-flex align-center justify-center flex-wrap text-center mx-auto pa-4"
				elevation="4"
				height="120"
				width="100%"
				color="#23307d"
			>
				<div>
					<h4 style="font-family: monospace" class="text-h4  text-white">PRODUCTION</h4>
					<h6 style="font-family: monospace" class="text-h6  text-white">{{ date }}</h6>
					<h6 style="font-family: monospace" class="text-h6  text-white">{{ time }}</h6>

				</div>
			</v-sheet>
			<div >
						<canvas style="padding: 20px; width: 75vw;" id="acquisitions"></canvas>
			</div>


	   </div>


     
	</div>

    
<!--   $data valeur par gestionnaire $datano                 -->
    

<script>
  const { createApp } = Vue
  const { createVuetify } = Vuetify
  const vuetify = createVuetify()


  createApp({
    data() {
      return {
        data:[],
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
		sortData (data, byKey){
				let sortedData;
                sortedData = data.sort(function(a,b){
					return b.freq - a.freq;
				})
				return sortedData;
         },
		async getData(){
			const response = await axios.get(`load4.php`);
			this.data = response.data;
			this.addChart();

		},
		async addChart(){
			const data = this.data
			new Chart(
					document.getElementById('acquisitions').getContext("2d"),
					{
						type: 'bar',
						data: {
							labels: data.map(row => row.nom),
							datasets: [
							{
								label: 'OPERATION',
								data: data.map(row => row.freq),
								backgroundColor: '#c49e68',
							},
							]
						},
						options: {
							scales: {
							x: {
								title: {
								font: {
									size: 14,
									weight: "bold"
								},
								color: 'black'
								},

								ticks: {
								font: {
									size: 20,
									weight: "bold"
								},
								color: 'black',
								},
							},

							y: {
								title: {
								font: {
									size: 14,
									weight: "bold"
								},
								color: 'black'
								},

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
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Jadwal Shalat dan Imsakiyah</title>
	<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
	<style>
		body {
			font-family: 'Open Sans', sans-serif;
			margin: 0;
			padding: 0;
			background-color: #f4f4f9;
		}
		.container {
			width: 90%;
			max-width: 1200px;
			margin: 0 auto;
			padding: 20px;
		}
		h2, h3 {
			text-align: center;
			color: #333;
		}
		.kotak {
			background: #fff;
			padding: 20px;
			box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
			border-radius: 8px;
			margin-bottom: 20px;
			position: relative;
		 }
		.clock {
			position: absolute;
			top: 10px;
			left: 10px;
			font-size: 18px;
			color: #333;
		}
		.imsakiyah {
			overflow-x: auto;
		}
		.imsakiyah table {
			width: 100%;
			border-collapse: collapse;
			margin-top: 20px;
		}
		.imsakiyah table th, .imsakiyah table td {
			padding: 10px;
			border: 1px solid #ddd;
			text-align: center;
		}
		.imsakiyah table th {
			background-color: #4548ff;
			color: #fff;
		}
		.imsakiyah table tr:nth-child(even) {
			background-color: #f9f9f9;
		}
		select {
			padding: 10px;
			border: 1px solid #ddd;
			border-radius: 4px;
			margin-top: 10px;
		}
		@media (max-width: 768px) {
			.kotak {
				padding: 10px;
			}
			.imsakiyah table th, .imsakiyah table td {
				padding: 5px;
			 }
			 .clock {
				position: static;
				display: block;
				margin-bottom: 10px;
			}
		}
		.table-container {
			overflow-x: auto;
		}
		.search-container {
			display: flex;
			justify-content: center;
			align-items: center;
			margin-top: 20px;
			flex-direction: column;
		}
		.search-container input {
			padding: 10px;
			border: 1px solid #ddd;
			border-radius: 4px;
			width: 200px;
			margin-bottom: 10px;
		}
		.option-container {
			display: flex;
			justify-content: center;
			align-items: center;
		}
	</style>
	<script>
		function updateClock() {
			var now = new Date();
			var hours = now.getHours();
			var minutes = now.getMinutes();
			var seconds = now.getSeconds();
			hours = hours < 10 ? '0' + hours : hours;
			minutes = minutes < 10 ? '0' + minutes : minutes;
			seconds = seconds < 10 ? '0' + seconds : seconds;
			var timeString = hours + ':' + minutes + ':' + seconds;
			document.getElementById('clock').innerHTML = timeString;
		}
		setInterval(updateClock, 1000);

		function filterCities() {
			var input, filter, select, options, i;
			input = document.getElementById("citySearch");
			filter = input.value.toLowerCase();
			select = document.getElementById("citySelect");
			options = select.getElementsByTagName("option");
			for (i = 0; i < options.length; i++) {
				txtValue = options[i].textContent || options[i].innerText;
				if (txtValue.toLowerCase().indexOf(filter) > -1) {
					options[i].style.display = "";
				} else {
					options[i].style.display = "none";
				 }
			 }
			if (filter.length > 0) {
				select.selectedIndex = 0;
				document.getElementById("citySelectOption").innerHTML = select.innerHTML;
				document.getElementById("selectedCityTitle").innerHTML = options[select.selectedIndex].textContent;
			}
		}
		function searchCity() {
			var select = document.getElementById("citySelect");
			select.selectedIndex = 0;
			filterCities();
			select.form.submit();
		}
	</script>
</head>
<body onload="updateClock()">
	<div class="container">
		<h2>Jadwal Shalat dan Imsakiyah</h2>
		<h3><a href="https://www.malasngoding.com">www.malasngoding.com</a></h3>

		<?php
		// Mendapatkan tahun dan bulan saat ini
		$year = date('Y');
		$month = date('m');

		$api_url = 'https://api.myquran.com/v2/sholat/kota/semua';

		// membaca JSON dari url
		$kota = file_get_contents($api_url);

		// Decode data JSON data menjadi array PHP
		$response_kota = json_decode($kota);

		// Mengakses data yang ada dalam object 'data'
		$list_kota = $response_kota->data;

		if(isset($_GET['kota'])){
			$kota_terpilih = $_GET['kota'];
		}else{
			$kota_terpilih = '0119';
		}

		$selected_city = '';
		foreach($list_kota as $k){
			if($k->id == $kota_terpilih){
				$selected_city = $k->lokasi;
				break;
			}
		}
		?>

		<div class="search-container">
			<input type="text" id="citySearch" onkeyup="filterCities()" placeholder="Cari kota atau daerah...">
			<form method="get" action="" style="display:none;">
				<select name="kota" id="citySelect">
					<?php 
					foreach($list_kota as $k){
						?>
						<option <?php if($kota_terpilih == $k->id){ echo "selected";} ?> value="<?php echo $k->id ?>"><?php echo $k->lokasi ?></option>
						<?php
					}
					?>
				</select>
			</form>
		 </div>

		<div class="option-container">
			<form method="get" action="">
				<select name="kota" id="citySelectOption" onchange="this.form.submit()">
					<?php 
					foreach($list_kota as $k){
						?>
						<option <?php if($kota_terpilih == $k->id){ echo "selected";} ?> value="<?php echo $k->id ?>"><?php echo $k->lokasi ?></option>
						<?php
					}
					?>
				</select>
			</form>
		</div>

		<h3 id="selectedCityTitle"><?php echo $selected_city; ?></h3>

		<div class="kotak">
			<div id="clock" class="clock"></div>
			 <div class="imsakiyah table-container">
				<table>
					<tr>
						<th width="200px">Tanggal</th>
						<th>Imsak</th>
						<th>Subuh</th>
						<th>Dzuhur</th>
						<th>Ashar</th>
						<th>Maghrib</th>
						<th>Isya</th>
					</tr>
					<?php 
					// tentukan bulan puasa
					$api_url = "https://api.myquran.com/v2/sholat/jadwal/$kota_terpilih/$year/$month";

					// membaca JSON dari url
					$json_data = file_get_contents($api_url);

					// Decode data JSON data menjadi array PHP
					$response_data = json_decode($json_data);

					// Mengakses data yang ada dalam object 'data'
					$jadwal_shalat = $response_data->data;

					foreach($jadwal_shalat->jadwal as $jadwal){ 
						?>
						<tr>
							<th><?php echo $jadwal->tanggal; ?></th>			
							<td><?php echo $jadwal->imsak; ?></td>
							<td><?php echo $jadwal->subuh; ?></td>	
							<td><?php echo $jadwal->dzuhur; ?></td>	
							<td><?php echo $jadwal->ashar; ?></td>	
							<td><?php echo $jadwal->maghrib; ?></td>	
							<td><?php echo $jadwal->isya; ?></td>	
						</tr>
						<?php 
					}
					?>			
				</table>
			</div>
		</div>
	</div>
</body>
</html>
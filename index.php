<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Jadwal Shalat dan Imsakiyah</title>
    <link href="https://fonts.googleapis.com/css2?family=Ramadhan&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: 'Ramadhan', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
            color: #333;
            transition: background-color 0.5s ease;
        }

        .container {
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.5s ease, transform 0.5s ease;
        }

        .container.loaded {
            opacity: 1;
            transform: translateY(0);
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
            animation: fadeIn 1s ease;
        }

        h2 a {
            color: black;
            text-decoration: none;
            cursor: default;
        }

        .kotak {
            background: #fff;
            padding: 20px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            margin-bottom: 20px;
            position: relative;
            animation: fadeInUp 1s ease;
        }

        .imsakiyah {
            overflow-x: auto;
        }

        .imsakiyah table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            display: none;
            /* Hide table initially */
            animation: fadeIn 1s ease;
        }

        .imsakiyah table th,
        .imsakiyah table td {
            padding: 12px;
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

        .imsakiyah table tr.today {
            background-color: #ffeb3b;
        }

        select {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            margin-top: 10px;
            width: 100%;
            max-width: 300px;
            animation: fadeIn 1s ease;
            transition: all 0.3s ease;
        }

        select:focus {
            outline: none;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        select option {
            padding: 10px;
            transition: all 0.3s ease;
        }

        select option:hover {
            background-color: #f4f4f9;
        }

        @media (max-width: 768px) {
            .kotak {
                padding: 10px;
            }

            .imsakiyah table th,
            .imsakiyah table td {
                padding: 8px;
            }
        }

        .table-container {
            overflow-x: auto;
            max-width: 100%;
        }

        .search-container {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 20px;
            flex-direction: column;
            animation: fadeIn 1s ease;
        }

        .search-container input {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            width: 100%;
            max-width: 300px;
            margin-bottom: 10px;
        }

        .option-container {
            display: flex;
            justify-content: center;
            align-items: center;
            animation: fadeIn 1s ease;
        }

        .loading {
            display: none;
            text-align: center;
            font-size: 18px;
            color: #333;
            margin-top: 20px;
            animation: fadeIn 1s ease;
        }

        .print-button {
            position: absolute;
            top: 10px;
            right: 10px;
            padding: 8px 12px;
            background-color: #4548ff;
            color: #fff;
            border: none;
            border-radius: 50%;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.3s ease;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .print-button:hover {
            background-color: #333;
            transform: scale(1.1);
        }

        .print-button i {
            font-size: 14px;
        }

        footer {
            text-align: center;
            padding: 20px;
            background-color: #f4f4f9;
            border-top: 1px solid #ddd;
            margin-top: 20px;
            animation: fadeIn 1s ease;
        }

        footer p {
            margin: 5px 0;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media print {
            body * {
                visibility: hidden;
            }

            .imsakiyah table,
            .imsakiyah table * {
                visibility: visible;
            }

            .imsakiyah table {
                position: absolute;
                left: 0;
                top: 0;
            }

            .imsakiyah table th {
                background-color: #4548ff !important;
                -webkit-print-color-adjust: exact;
            }

            .imsakiyah table tr:nth-child(even) {
                background-color: #f9f9f9 !important;
                -webkit-print-color-adjust: exact;
            }

            .imsakiyah table tr.today {
                background-color: #ffeb3b !important;
                -webkit-print-color-adjust: exact;
            }
        }
    </style>
    <script>
        function showLoading() {
            document.getElementById('loading').style.display = 'block';
            document.querySelector('.imsakiyah table').style.display = 'none'; // Hide table during loading
        }

        function hideLoading() {
            setTimeout(() => {
                document.getElementById('loading').style.display = 'none';
                document.querySelector('.imsakiyah table').style.display = 'table'; // Show table after loading
            }, 1500);
        }

        function filterCities() {
            showLoading();
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
            hideLoading();
        }

        function searchCity() {
            showLoading();
            var select = document.getElementById("citySelect");
            select.selectedIndex = 0;
            filterCities();
            select.form.submit();
        }

        function printPDF() {
            window.print();
        }

        document.addEventListener('DOMContentLoaded', function () {
            showLoading();
            const apiUrl = 'https://api.myquran.com/v2/sholat/kota/semua';
            fetch(apiUrl)
                .then(response => response.json())
                .then(data => {
                    const listKota = data.data;
                    const select = document.getElementById('citySelect');
                    const selectOption = document.getElementById('citySelectOption');
                    listKota.forEach(kota => {
                        const option = document.createElement('option');
                        option.value = kota.id;
                        option.textContent = kota.lokasi;
                        select.appendChild(option);
                        selectOption.appendChild(option.cloneNode(true));
                    });

                    const kotaTerpilih = new URLSearchParams(window.location.search).get('kota') || '0119';
                    select.value = kotaTerpilih;
                    selectOption.value = kotaTerpilih;
                    document.getElementById('selectedCityTitle').textContent = select.options[select.selectedIndex].textContent;

                    fetchPrayerSchedule(kotaTerpilih);
                })
                .catch(error => console.error('Error fetching data:', error))
                .finally(() => {
                    hideLoading();
                    document.querySelector('.container').classList.add('loaded');
                });
        });

        function fetchPrayerSchedule(kotaTerpilih) {
            showLoading();
            const year = new Date().getFullYear();
            const month = new Date().getMonth() + 1;
            const day = new Date().getDate();
            const apiUrl = `https://api.myquran.com/v2/sholat/jadwal/${kotaTerpilih}/${year}/${month}`;

            fetch(apiUrl)
                .then(response => response.json())
                .then(data => {
                    const jadwalShalat = data.data;
                    const container = document.querySelector('.imsakiyah table tbody');
                    container.innerHTML = jadwalShalat.jadwal.map(jadwal => `
            <tr class="${jadwal.tanggal === `${year}-${month < 10 ? '0' + month : month}-${day < 10 ? '0' + day : day}` ? 'today' : ''}">
              <th>${jadwal.tanggal}</th>
              <td>${jadwal.imsak}</td>
              <td>${jadwal.subuh}</td>
              <td>${jadwal.dzuhur}</td>
              <td>${jadwal.ashar}</td>
              <td>${jadwal.maghrib}</td>
              <td>${jadwal.isya}</td>
            </tr>
          `).join('');
                })
                .catch(error => console.error('Error fetching data:', error))
                .finally(() => hideLoading());
        }
    </script>
</head>

<body>
    <div class="container">
        <h2><a href="/index.php">Jadwal Shalat dan Imsakiyah</a></h2>
        <div class="search-container">
            <input type="text" id="citySearch" onkeyup="filterCities()" placeholder="Cari kota atau daerah...">
            <form method="get" action="" style="display:none;">
                <select name="kota" id="citySelect"></select>
            </form>
        </div>
        <div class="option-container">
            <form method="get" action="">
                <select name="kota" id="citySelectOption" onchange="this.form.submit()"></select>
            </form>
        </div>
        <h3 id="selectedCityTitle"></h3>
        <div class="kotak">
            <button class="print-button" onclick="printPDF()">
                <i class="fas fa-print"></i>
            </button>
            <div class="imsakiyah table-container">
                <table>
                    <thead>
                        <tr>
                            <th width="200px">Tanggal</th>
                            <th>Imsak</th>
                            <th>Subuh</th>
                            <th>Dzuhur</th>
                            <th>Ashar</th>
                            <th>Maghrib</th>
                            <th>Isya</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Jadwal shalat will be inserted here -->
                    </tbody>
                </table>
            </div>
        </div>
        <div id="loading" class="loading">Loading...</div>
    </div>
    <footer>
        <h3><a href="https://www.malasngoding.com">www.malasngoding.com</a></h3>
        <p>© Design by Kall</p>
    </footer>
</body>

</html>
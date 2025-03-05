<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Jadwal Shalat Bulanan</title>
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
    }
    .jadwal {
      width: 100%;
      background: #fff;
      border: 1px solid #ddd;
      margin-bottom: 10px;
      padding: 10px;
      box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
      border-radius: 8px;
    }
    .table-container {
      overflow-x: auto;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }
    table th, table td {
      padding: 10px;
      border: 1px solid #ddd;
      text-align: center;
    }
    table th {
      background-color: #4548ff;
      color: #fff;
    }
    table tr:nth-child(even) {
      background-color: #f9f9f9;
    }
    @media (max-width: 768px) {
      .kotak {
        padding: 10px;
      }
      table th, table td {
        padding: 5px;
      }
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>Jadwal Shalat Bulanan</h2>
    <h3><a href="https://www.malasngoding.com">www.malasngoding.com</a></h3>
    <div class="kotak" id="jadwal-container">
      <!-- Jadwal shalat will be inserted here -->
    </div>
  </div>
  <script>
    const apiUrl = `https://api.myquran.com/v2/sholat/jadwal/1104/${new Date().getFullYear()}/${new Date().getMonth() + 1}`;

    fetch(apiUrl)
      .then(response => response.json())
      .then(data => {
        const jadwalShalat = data.data;
        const container = document.getElementById('jadwal-container');
        container.innerHTML = `
          <center>
            <p>Lokasi: ${jadwalShalat.lokasi}</p>
            <p>Daerah: ${jadwalShalat.daerah}</p>
          </center>
          ${jadwalShalat.jadwal.map(jadwal => `
            <div class="jadwal">
              <div class="table-container">
                <table>
                  <tr><th>Tanggal</th><td>${jadwal.tanggal}</td></tr>
                  <tr><th>Imsak</th><td>${jadwal.imsak}</td></tr>
                  <tr><th>Subuh</th><td>${jadwal.subuh}</td></tr>
                  <tr><th>Dzuhur</th><td>${jadwal.dzuhur}</td></tr>
                  <tr><th>Ashar</th><td>${jadwal.ashar}</td></tr>
                  <tr><th>Maghrib</th><td>${jadwal.maghrib}</td></tr>
                  <tr><th>Isya</th><td>${jadwal.isya}</td></tr>
                </table>
              </div>
            </div>
          `).join('')}
        `;
      })
      .catch(error => console.error('Error fetching data:', error));
  </script>
</body>
</html>

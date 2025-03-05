const apiUrl = 'https://api.myquran.com/v2/sholat/jadwal/1104/2025/3/4';

fetch(apiUrl)
  .then(response => response.json())
  .then(data => {
    const jadwalShalat = data.data;
    console.log(jadwalShalat);
  })
  .catch(error => console.error('Error fetching data:', error));

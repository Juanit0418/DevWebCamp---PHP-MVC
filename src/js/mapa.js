(function(){
  if(document.querySelector("#mapa")){
    const lat = -4.3754030504188;
    const long = -79.94165043364269;
    const zoom = 16;

    const map = L.map('mapa').setView([lat, long], zoom);

    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    L.marker([lat, long]).addTo(map)
      .bindPopup(`
        <h2 class="mapa__heading">DevWebCamp</h2>
        <p class="mapa__texto">Coliseo de eventos</p>
        `)
      .openPopup();
    }
})();
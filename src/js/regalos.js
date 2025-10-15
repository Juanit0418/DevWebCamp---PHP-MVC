(function(){
  const grafica = document.querySelector("#reglos_grafica");
  if(grafica){

    const ctx = document.getElementById('reglos_grafica');

    obtener_datos();
    async function obtener_datos(){
      const url = "/api/regalos";
      const respuesta = await fetch(url);
      const resultado = await respuesta.json();

      new Chart(ctx, {
        type: 'bar',
        data: {
          labels: resultado.map( regalo => regalo.nombre ),
          datasets: [{
            label: 'Número de regalos',
            data: resultado.map( regalo => regalo.total ),
            backgroundColor: [
              '#ea580c',
              '#84cc16',
              '#22d3ee',
              '#a855f7',
              '#ef4444',
              '#14b8a6',
              '#db2777',
              '#e11d48',
              '#7e22ce',
              '#b284f4'
            ],
            borderWidth: 1
          }]
        },
        options: {
          scales: {
            y: {
              beginAtZero: true
            }
          }
        }
      });
    }
  
  };
})();
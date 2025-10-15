(function(){
  const input_ponentes = document.querySelector('#ponentes');

  if(input_ponentes){
    let ponentes = [];
    let ponentes_filtrados = [];

    const listado_ponentes = document.querySelector('#listado_ponentes');
    const ponente_hidden = document.querySelector('[name="ponente_id"]');

    obtener_ponentes();
    input_ponentes.addEventListener('input', buscar_ponentes);

    async function obtener_ponentes(){
      const url = `http://localhost:3000/api/ponentes`;
      const respuesta = await fetch(url);
      const resultado = await respuesta.json();

      formatear_ponentes(resultado);
    };

    function formatear_ponentes(arreglo_ponentes = []){
      ponentes = arreglo_ponentes.map( ponente => {
        return {
          nombre: `${ponente.nombre.trim()} ${ponente.apellido.trim()}`,
          id: ponente.id.trim()
        }
      });
    };

    function buscar_ponentes(e){
      const busqueda = e.target.value;
      if(busqueda.length > 3){
        const expresion = new RegExp(busqueda, "i");
        ponentes_filtrados = ponentes.filter(ponente => {
          if(ponente.nombre.toLowerCase().search(expresion) !== -1){
            return ponente;
          };
        });
      } else {
        ponentes_filtrados = [];
      };

      mostrar_ponentes();
    };

    function mostrar_ponentes(){
      //Limpiar el html previo
      while(listado_ponentes.firstChild){
        listado_ponentes.removeChild(listado_ponentes.firstChild);
      };

      if(ponentes_filtrados.length > 0){
        ponentes_filtrados.forEach(ponente => {
          const ponente_html = document.createElement('LI');
          ponente_html.classList.add('listado_ponentes__ponente');
          ponente_html.textContent = ponente.nombre;
          ponente_html.dataset.ponenteId = ponente.id;
          ponente_html.onclick = seleccionar_ponente;
  
          //Añadir al dom
          listado_ponentes.appendChild(ponente_html);
        });
      } else {
        const no_resultados = document.createElement('LI');
        no_resultados.classList.add('listado_ponentes__no_resultado');
        no_resultados.textContent = 'No hay resultados para tu busqueda';
        listado_ponentes.appendChild(no_resultados);
      };
    };

    function seleccionar_ponente(e){
      const ponente_id = e.target.dataset.ponenteId;
      const ponente_nombre = e.target.textContent;

      input_ponentes.value = ponente_nombre;
      input_ponentes.dataset.ponenteId = ponente_id;
      ponente_hidden.value = ponente_id;

      //Limpiar los resultados
      while(listado_ponentes.firstChild){
        listado_ponentes.removeChild(listado_ponentes.firstChild);
      };
    };
  }

})();
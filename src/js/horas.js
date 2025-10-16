(function(){
  const horas = document.querySelector("#horas");

  if(horas){

    const categoria = document.querySelector("[name='categoria_id']");
    const dias = document.querySelectorAll("[name='dia']");
    const input_hidden_dia = document.querySelector("[name='dia_id']");
    const input_hidden_hora = document.querySelector("[name='hora_id']");

    categoria.addEventListener("change", termino_busqueda);
    dias.forEach(dia => {
      dia.addEventListener("change", termino_busqueda);
    });

    let busqueda = {
      categoria_id : +categoria.value || "",
      dia : +input_hidden_dia.value || ""
    };

    if(!Object.values(busqueda).includes("")){

      async function reiniciar_horas(){
        await buscar_eventos();
  
        //Resaltar la hora tomada
        const hora_tomada = document.querySelector(`[data-hora-id="${input_hidden_hora.value}"]`);
        hora_tomada.classList.remove("horas__hora--deshabilitada");
        hora_tomada.classList.add("horas__hora--seleccionada");
      };
      reiniciar_horas();
    };

    function termino_busqueda(e){
      busqueda[e.target.name] = e.target.value;

      //Reiniciar el campo oculto y el selector de horas
      input_hidden_hora.value = "";
      input_hidden_dia.value = "";

      const hora_seleccionada = document.querySelector(".horas__hora--seleccionada");
      if(hora_seleccionada){
        hora_seleccionada.classList.remove("horas__hora--seleccionada");
      };

      if(Object.values(busqueda).includes("")){
        return;
      };
      buscar_eventos();
    };
    
    async function buscar_eventos(){
      const {categoria_id, dia} = busqueda;

      const url = `${window.location.origin}/api/eventos-horario?categoria_id=${categoria_id}&dia_id=${dia}`;
      const resultado = await fetch(url);
      const eventos = await resultado.json();

      obtener_horas_disponibles(eventos);
    };

    function obtener_horas_disponibles(eventos){
      //Reiniciar las horas
      const listado_horas = document.querySelectorAll("#horas li");
      listado_horas.forEach( li => li.classList.add("horas__hora--deshabilitada"));

      //comprobar eventos ya tomados para inhabilitar esas horas
      const horas_tomadas = eventos.map( evento => evento.hora_id );
      const listado_horas_array = Array.from(listado_horas);

      const resultado = listado_horas_array.filter(li => !horas_tomadas.includes(li.dataset.horaId));
      resultado.forEach(li => li.classList.remove("horas__hora--deshabilitada"));


      // 🎯 delegación: un solo listener en el UL/OL (#horas)
      horas.addEventListener("click", e => {
        if(e.target.tagName === "LI" && !e.target.classList.contains("horas__hora--deshabilitada")) {
        seleccionar_hora(e);
        }
      });
    };

    function seleccionar_hora(e){
      //Desmarcar la hora seleccionada previamente
      const hora_previamente_seleccionada = document.querySelector(".horas__hora--seleccionada");
      if(hora_previamente_seleccionada){
        hora_previamente_seleccionada.classList.remove("horas__hora--seleccionada");
      };

      e.target.classList.add("horas__hora--seleccionada");
      input_hidden_hora.value = e.target.dataset.horaId;

      //LLenar el input hidden de dia
      input_hidden_dia.value = document.querySelector("[name='dia']:checked").value;
    };
  }
})();
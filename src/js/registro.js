import Swal  from "sweetalert2";

(function(){
  let eventos = [];
  
  const resumen = document.querySelector(".registro__resumen");
  const paquete_id = window.PAQUETE_ID;

  if(resumen){
    const eventos_boton = document.querySelectorAll(".evento__agregar");
    eventos_boton.forEach(boton => boton.addEventListener("click", seleccionar_evento));

    const formulario_registro = document.querySelector("#registro");
    formulario_registro.addEventListener("submit", submit_formulario);

    mostrar_eventos();
  
    function seleccionar_evento(e){
      if(eventos.length < 5){
        let evento_nombre = e.target.parentElement.querySelector(".evento__nombre").textContent.trim();
        let evento_id = e.target.dataset.id;
    
        eventos = [...eventos, {
          id: evento_id,
          titulo: evento_nombre
        }]
        
        //Deshabilitar el evento si
        e.target.disabled = true;
        mostrar_eventos();
      } else {
        Swal.fire({
          title: "Error",
          text: "Máximo 5 reservaciones permitidas",
          icon: "error",
          confirmButtonText: "OK"
        });
      };
    }
  
    function mostrar_eventos(){
      //Limpiar el html
      limpiar_eventos();
  
      if(eventos.length > 0){
        eventos.forEach(evento => {
          const evento_dom = document.createElement("DIV");
          evento_dom.classList.add("registro__evento");
  
          const titulo = document.createElement("H3");
          titulo.classList.add("registro__nombre");
          titulo.textContent = evento.titulo
  
          const boton_eliminar = document.createElement("BUTTON");
          boton_eliminar.classList.add("registro__eliminar");
          boton_eliminar.innerHTML = `<i class="fa-solid fa-trash"></i>`;
          boton_eliminar.onclick = function(){
            eliminar_evento(evento.id);
          }
  
          //Renderizar en el html
          evento_dom.appendChild(titulo);
          evento_dom.appendChild(boton_eliminar);
          resumen.appendChild(evento_dom);
        });
      } else {
        const no_registros = document.createElement("P");
        no_registros.classList.add("registro__texto");
        no_registros.textContent = "No hay eventos, puedes añadir hasta 5 máximo";
        resumen.appendChild(no_registros);
      }
    }
  
    function eliminar_evento(id){
      eventos = eventos.filter(evento => evento.id !== id);
      const boton_agregar = document.querySelector(`[data-id="${id}"]`);
      boton_agregar.disabled = false;
      mostrar_eventos();
    }
  
    function limpiar_eventos(){
      while(resumen.firstChild){
        resumen.removeChild(resumen.firstChild);
      };
    }

    async function submit_formulario(e){
      e.preventDefault();

      //Obtenet el regalo
      const regalo = document.querySelector("#regalo");
      const regalo_id = regalo ? regalo.value : "";
      const eventos_id = eventos.map(evento => evento.id);

      if(paquete_id == 2){
        if(eventos_id.length == 0){
          Swal.fire({
          title: "Error",
          text: "Elige tus eventos",
          icon: "error",
          confirmButtonText: "OK"
        });
        return;
        }
      }
      
      if(paquete_id == 1){
        if(eventos_id.length == 0 || regalo_id == ""){
          Swal.fire({
          title: "Error",
          text: "Elige tus eventos y regalo",
          icon: "error",
          confirmButtonText: "OK"
        });
        return;
        }
      }

      //Objeto de formData 
      const datos = new FormData();
      datos.append("eventos", eventos_id);
      datos.append("paquete_id", paquete_id);

      if(paquete_id == 1){
        datos.append("regalo_id", regalo_id);
      }

      const url = "/finalizar-registro/conferencias"

      const respuesta = await fetch(url, {
        method: "POST",
        body: datos
      });
      const resultado = await respuesta.json();

      if(resultado.resultado){
        Swal.fire(
          "Registro exitoso",
          "Conferencias almacenadas, te esperamos en DevWebCamp",
          "success"
        ).then(() => location.href = `/boleto?id=${resultado.token}`);
      } else {
        Swal.fire({
          title: "Error",
          text: "Ha ocurrido un error, intenta nuevamente",
          icon: "error",
          confirmButtonText: "OK"
        }).then(() => location.reload());
      };
    }
  }
})();
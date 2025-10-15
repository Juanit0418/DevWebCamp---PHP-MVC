(function() {
  const tags_input = document.querySelector("#tags_input");

  if(tags_input){
    const tags_div = document.querySelector("#tags");
    const tags_input_hidden = document.querySelector("[name='tags']");
    let tags = [];

    //recuperar del input oculto
    if(tags_input_hidden.value !== ""){
      tags = tags_input_hidden.value.split(",");
      mostrar_tags();
    }

    //Escuchar los cambios en el input
    tags_input.addEventListener("keypress", guardar_tag);

    function guardar_tag(e){
      if(e.keyCode === 44){
        e.preventDefault();
        if(e.target.value.trim() === "" || e.target.value.trim().length < 2){
          return;
        }

        tags = [...tags, e.target.value.trim()];
        tags_input.value = "";

        mostrar_tags();
      };
    };  //guardar_tag

    function mostrar_tags(){
      tags_div.textContent = "";

      tags.forEach(tag => {
        const etiqueta = document.createElement("LI");
        etiqueta.classList.add("formulario__tag");
        etiqueta.textContent = tag;
        etiqueta.ondblclick = eliminar_tag;
        tags_div.appendChild(etiqueta);
      });
      actualizar_input_hidden();
    }; //mostrar_tags

    function eliminar_tag(e){
      e.target.remove();
      tags = tags.filter(tag => tag !== e.target.textContent);
      actualizar_input_hidden();
      console.log(tags);
    }; //eliminar_tag

    function actualizar_input_hidden(){
      tags_input_hidden.value = tags.toString();
    }; //actualizar_input_hidden
  };
})()
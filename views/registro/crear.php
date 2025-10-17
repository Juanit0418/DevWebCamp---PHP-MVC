<script src="https://www.paypal.com/sdk/js?client-id=AQL1KA3znvMorhV-QVMWLMYlwa2Q7KJs9UUCYtnYQGdIZf495-Wt1FudH37ZzerPuwQKjXlKLL_zlEmD&currency=USD">
</script>


<main class="registro">
  <h2 class="registro__heading"><?php echo $titulo; ?></h2>
  <p class="registro__descripcion">Elige tu plan</p>

  <div class="paquetes__grid">
    <div class="paquete">
      <h3 class="paquete__nombre">Pase Gratis</h3>
      <ul class="paquete__lista">
        <li class="paquete__elemento">Acceso virtual a DevWebCamp</li>
      </ul>

      <p class="paquete__precio">$ 0</p>
      <form method="POST" action="/finalizar-registro/gratis">
        <input class="paquetes__submit" type="submit" value="Inscripción Gratis">
      </form>
    </div> <!--Paquete -->

    <div class="paquete">
      <h3 class="paquete__nombre">Pase Presencial</h3>
      <ul class="paquete__lista">
        <li class="paquete__elemento">Pase por 2 días</li>
        <li class="paquete__elemento">Acceso presencial a DevWebCamp</li>
        <li class="paquete__elemento">Acceso a talleres y conferencias</li>
        <li class="paquete__elemento">Acceso a las grabaciones</li>
        <li class="paquete__elemento">Camisa del evento</li>
        <li class="paquete__elemento">Comida y bebida</li>
      </ul>

      <p class="paquete__precio">$ <?php echo $presencial->precio; ?></p>
      <div id="paypal-button-container-presencial"></div>

      <script>
        paypal.Buttons({
  // --- Apariencia del botón ---
          style: {
            layout: 'vertical',  // vertical u horizontal
            color: 'blue',    // gold, blue, silver, black
            shape: 'rect',    // rect o pill
            label: 'paypal',   // muestra solo el logo
            tagline: false   // oculta texto secundario
          },

  // --- Crear la orden ---
          createOrder: function(data, actions) {
            return actions.order.create({
              purchase_units: [{
                description: "1",
                amount: {
                  value: '<?php echo $presencial->precio; ?>', //cambiar este valor según el producto
                  currency_code: 'USD'
                }
              }]
            });
          },

  // --- Cuando el pago es aprobado ---
          onApprove: function(data, actions) {
            return actions.order.capture().then(function(details) {
              const datos = new FormData();
              datos.append("paquete_id", details.purchase_units[0].description);
              datos.append("pago_id", details.purchase_units[0].payments.captures[0].id);

              fetch("/finalizar-registro/pagar", {
                method : "POST",
                body : datos
              }).then(respuesta => respuesta.json()).then(resultado => {
                if(resultado.resultado){
                  actions.redirect(`${window.location.origin}/finalizar-registro/conferencias`);
                };
              });
            });
          },

  // --- Si el usuario cancela el pago ---
          onCancel: function(data) {
            alert('Pago cancelado.');
          },

  // --- Si ocurre un error ---
          onError: function(err) {
            console.error(err);
            alert('Ocurrió un error al procesar el pago.');
          }

        }).render('#paypal-button-container-presencial');
      </script>
    </div> <!--Paquete -->

    <div class="paquete">
      <h3 class="paquete__nombre">Pase Virtual</h3>
      <ul class="paquete__lista">
        <li class="paquete__elemento">Pase por 2 días</li>
        <li class="paquete__elemento">Acceso virtual a DevWebCamp</li>
        <li class="paquete__elemento">Enlace a talleres y conferencias</li>
        <li class="paquete__elemento">Acceso a las grabaciones</li>
        
      </ul>

      <p class="paquete__precio">$ <?php echo $virtual->precio; ?></p>

      <div id="paypal-button-container-virtual"></div>

      <script>
        paypal.Buttons({
  // --- Apariencia del botón ---
          style: {
            layout: 'vertical',  // vertical u horizontal
            color: 'blue',    // gold, blue, silver, black
            shape: 'rect',    // rect o pill
            label: 'paypal',   // muestra solo el logo
            tagline: false   // oculta texto secundario
          },

  // --- Crear la orden ---
          createOrder: function(data, actions) {
            return actions.order.create({
              purchase_units: [{
                description: "2",
                amount: {
                  value: '<?php echo $virtual->precio; ?>', //cambiar este valor según el producto
                  currency_code: 'USD'
                }
              }]
            });
          },

  // --- Cuando el pago es aprobado ---
          onApprove: function(data, actions) {
            return actions.order.capture().then(function(details) {
              const datos = new FormData();
              datos.append("paquete_id", details.purchase_units[0].description);
              datos.append("pago_id", details.purchase_units[0].payments.captures[0].id);

              fetch("/finalizar-registro/pagar", {
                method : "POST",
                body : datos
              }).then(respuesta => respuesta.json()).then(resultado => {
                if(resultado.resultado){
                  actions.redirect(`${window.location.origin}/finalizar-registro/conferencias`);
                };
              });
            });
          },

  // --- Si el usuario cancela el pago ---
          onCancel: function(data) {
            alert('Pago cancelado.');
          },

  // --- Si ocurre un error ---
          onError: function(err) {
            console.error(err);
            alert('Ocurrió un error al procesar el pago.');
          }

        }).render('#paypal-button-container-virtual');
      </script>
    </div> <!--Paquete -->
  </div> <!--Paquetes grid -->
</main>
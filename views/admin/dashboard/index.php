<h2 class="dashboard__heading"><?php echo $titulo; ?></h2>

<main class="bloques">
  <div class="bloques__grid">
    <div class="bloque">
      <h3 class="bloque__heading">Ultimos registros</h3>

      <?php foreach($registros as $registro){ ?>
        <div class="bloque__contenido">
          <p class="bloque__texto"><?php echo $registro->usuario->nombre . " " . $registro->usuario->apellido; ?></p>
        </div>
      <?php } ?>
    </div> <!-- .bloque -->

    <div class="bloque">
      <h3 class="bloque__heading">Ingresos</h3>
      <p class="bloque__texto--cantidad">$<?php echo $ingresos; ?></p>
    </div> <!-- .bloque -->

    <div class="bloque">
      <h3 class="bloque__heading">Eventos con menos lugares diponibles</h3>
      <?php foreach($menos_disponibles as $evento){ ?>
        <div class="bloque__contenido">
          <p class="bloque__texto"><?php echo $evento->nombre . " - " . $evento->disponibles . " lugares"; ?></p>
        </div>
      <?php } ?>
    </div> <!-- .bloque -->

    <div class="bloque">
      <h3 class="bloque__heading">Eventos con más lugares diponibles</h3>
      <?php foreach($mas_disponibles as $evento){ ?>
        <div class="bloque__contenido">
          <p class="bloque__texto"><?php echo $evento->nombre . " - " . $evento->disponibles . " lugares"; ?></p>
        </div>
      <?php } ?>
    </div> <!-- .bloque -->
  </div> <!-- .bloques__grid -->
</main>
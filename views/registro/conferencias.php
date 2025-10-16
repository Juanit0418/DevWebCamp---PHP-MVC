<script>
  window.PAQUETE_ID = <?= (int)$paquete_id ?>;
</script>


<h2 class="pagina__heading"><?php echo $titulo; ?></h2>
<?php if(isset($eventos) && !empty($eventos)){ ?>
<p class="pagina__descripcion">Elige los eventos a los cuales deseas tener acceso, maximo 5</p>

<div class="eventos-registro">
  <main class="eventos-registro__listado">
    <?php if(isset($eventos["conferencias_v"]) || isset($eventos["conferencias_s"])){ ?>
    <h3 class="eventos-registro__heading--conferencias">&lt;Conferencias/></h3>

    <?php if(!empty($eventos["conferencias_v"])){ ?>
    <p class="eventos-registro__fecha">Viernes, 9 de Enero</p>

    <div class="eventos-registro__grid">
      <?php foreach($eventos["conferencias_v"] as $evento){ ?>
        <?php include __DIR__ . "/evento.php" ?>
      <?php } ?>
    </div> <!-- evento dia -->
    <?php } ?>

    <?php if(!empty($eventos["conferencias_s"])){ ?>
    <p class="eventos-registro__fecha">Sábado, 10 de Enero</p>

    <div class="eventos-registro__grid">
      <?php foreach($eventos["conferencias_s"] as $evento){ ?>
        <?php include __DIR__ . "/evento.php" ?>
      <?php } ?>
    </div> <!-- evento dia -->
    <?php } ?>
    <?php } ?>

    <?php if(isset($eventos["workshops_v"]) || isset($eventos["workshops_s"])){ ?>
    <h3 class="eventos-registro__heading--workshops">&lt;Workshops/></h3>
    <?php if(!empty($eventos["workshops_v"])){ ?>
    <p class="eventos-registro__fecha">Viernes, 9 de Enero</p>

    <div class="eventos-registro__grid eventos--workshop">
      <?php foreach($eventos["workshops_v"] as $evento){ ?>
        <?php include __DIR__ . "/evento.php" ?>
      <?php } ?>
    </div> <!-- evento dia -->
    <?php } ?>

    <?php if(!empty($eventos["workshops_s"])){ ?>
    <p class="eventos-registro__fecha">Sábado, 10 de Enero</p>

    <div class="eventos-registro__grid eventos--workshop">
      <?php foreach($eventos["workshops_s"] as $evento){ ?>
        <?php include __DIR__ . "/evento.php" ?>
      <?php } ?>
    </div> <!-- evento dia -->
    <?php } ?>
    <?php } ?>
    <?php } ?>
  </main>

  <aside class="registro">
    <h2 class="registro__heading">Tu registro</h2>

    <div class="registro__resumen" id="registro__resumen"></div>

    <!--Solo mostrar regalos si compró el pase presencial -->
    <?php if($registro->paquete_id == 1){ ?>
    <div class="registro__regalo">
      <label for="regalo" class="registro__label">Elige tu regalo</label>
      <select id="regalo" class="registro__select">
        <option value="" selected disabled>-- Selecciona tu regalo --</option>
        <?php foreach($regalos as $regalo){ ?>
          <option value="<?php echo $regalo->id; ?>"><?php echo $regalo->nombre; ?></option>
        <?php } ?>
      </select>
    </div>
    <?php }; ?>

    <form class="formulario" id="registro">
      <div class="formulario__campo">
        <input type="submit" class="formulario__submit formulario__submit--full" value="Registrarme">
      </div>
    </form>
  </aside>
</div> <!--.eventos-registro-->
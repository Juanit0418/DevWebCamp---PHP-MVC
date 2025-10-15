<main class="agenda">
  <h2 class="agenda__heading">Conferencias y workshops</h2>
  <p class="agenda__descripcion">Talleres y conferencias dictados por expertos en desarrollo web</p>

  <div class="eventos">
    <h3 class="eventos__heading">&lt;Conferencias/></h3>

    <p class="eventos__fecha">Viernes, 9 de Enero</p>
    <div class="eventos__listado slider swiper">
      <div class="swiper-wrapper">
        <?php foreach($eventos["conferencias_v"] as $evento){ ?>
          <?php include __DIR__ . "../../templates/evento.php" ?>
        <?php } ?>
      </div> <!--swiper wrapper -->
      <div class="swiper-button-next"></div>
      <div class="swiper-button-prev"></div>
    </div> <!--eventos listado -->

    <p class="eventos__fecha">Sábado, 10 de Enero</p>
    <div class="eventos__listado slider swiper">
      <div class="swiper-wrapper">
        <?php foreach($eventos["conferencias_s"] as $evento){ ?>
          <?php include __DIR__ . "../../templates/evento.php" ?>
        <?php } ?>
      </div> <!--swiper wrapper -->
      <div class="swiper-button-next"></div>
      <div class="swiper-button-prev"></div>
    </div> <!--eventos listado -->
  </div> <!--Eventos -->

  <div class="eventos  eventos--workshop">
    <h3 class="eventos__heading">&lt;Workshops/></h3>
    
    <p class="eventos__fecha">Viernes, 9 de Enero</p>
    <div class="eventos__listado slider swiper">
      <div class="swiper-wrapper">
        <?php foreach($eventos["workshops_v"] as $evento){ ?>
          <?php include __DIR__ . "../../templates/evento.php" ?>
        <?php } ?>
      </div> <!--swiper wrapper -->
      <div class="swiper-button-next"></div>
      <div class="swiper-button-prev"></div>
    </div> <!--eventos listado -->

    <p class="eventos__fecha">Sábado, 10 de Enero</p>
    <div class="eventos__listado slider swiper">
      <div class="swiper-wrapper">
        <?php foreach($eventos["workshops_s"] as $evento){ ?>
          <?php include __DIR__ . "../../templates/evento.php" ?>
        <?php } ?>
      </div> <!--swiper wrapper -->
      <div class="swiper-button-next"></div>
      <div class="swiper-button-prev"></div>
    </div> <!--eventos listado -->
  </div> <!--Eventos -->
</main>
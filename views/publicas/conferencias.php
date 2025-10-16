<?php if(isset($eventos) && !empty($eventos)){ ?>
  <main class="agenda">
    <h2 class="agenda__heading">Conferencias y workshops</h2>
    <p class="agenda__descripcion">Talleres y conferencias dictados por expertos en desarrollo web</p>
  
  

  <?php if(isset($eventos["conferencias_v"]) || isset($eventos["conferencias_s"])){ ?>
    <div class="eventos">
      <h3 class="eventos__heading">&lt;Conferencias/></h3>
  

  <?php if(isset($eventos["conferencias_v"])){ ?>
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
  <?php } ?>


  <?php if(isset($eventos["conferencias_s"])){ ?>
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

    <?php } ?>
  </div> <!--Eventos -->
  <?php } ?>

  <?php if(isset($eventos["workshops_v"]) || isset($eventos["workshops_s"])){ ?>
    <div class="eventos  eventos--workshop">
      <h3 class="eventos__heading">&lt;Workshops/></h3>

  <?php if(isset($eventos["workshops_v"])){ ?>
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
  <?php } ?>
    

  <?php if(isset($eventos["workshops_s"])){ ?>
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

    <?php } ?>
  </div> <!--Eventos -->
  <?php } ?>
</main>
<?php } else {?>
<main class="agenda">
  <h2 class="agenda__heading">Conferencias y workshops</h2>
  <p class="agenda__descripcion">Próximamente más información sobre conferencias y workshops</p>
</main>
<?php } ?>
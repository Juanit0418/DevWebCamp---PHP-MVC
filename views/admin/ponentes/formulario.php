<fieldset class="formulario__fieldset">
  <legend class="formulario__legend">Información personal</legend>

  <div class="formulario__campo">
    <label for="nombre" class="formulario__label">Nombre</label>
    <input class="formulario__input" type="text" id="nombre" name="nombre" placeholder="Nombre del ponente" value="<?php echo $ponente->nombre ?? ''; ?>">
  </div> <!--campo -->

  <div class="formulario__campo">
    <label for="apellido" class="formulario__label">Apellido</label>
    <input class="formulario__input" type="text" id="apellido" name="apellido" placeholder="Apellido del ponente" value="<?php echo $ponente->apellido ?? ''; ?>">
  </div> <!--campo -->

  <div class="formulario__campo">
    <label for="ciudad" class="formulario__label">Ciudad</label>
    <input class="formulario__input" type="text" id="ciudad" name="ciudad" placeholder="Ciudad del ponente" value="<?php echo $ponente->ciudad ?? ''; ?>">
  </div> <!--campo -->

  <div class="formulario__campo">
    <label for="pais" class="formulario__label">Pais</label>
    <input class="formulario__input" type="text" id="pais" name="pais" placeholder="Pais del ponente" value="<?php echo $ponente->pais ?? ''; ?>">
  </div> <!--campo -->

  <div class="formulario__campo">
    <label for="imagen" class="formulario__label">Imagen</label>
    <input class="formulario__input formulario__input--file" type="file" id="imagen" name="imagen">
  </div> <!--campo -->

  <?php if(isset($ponente->imagen_actual)){ ?>
    <p class="formulario__texto">Imagen actual:</p>
    <div class="formulario__imagen">
      <picture>
        <source srcset="<?php echo $_ENV["HOST"] . "/img/speakers/" . $ponente->imagen; ?>.webp" type="image/webp">
        <source srcset="<?php echo $_ENV["HOST"] . "/img/speakers/" . $ponente->imagen; ?>.png" type="image/png">
        <img src="<?php echo $_ENV["HOST"] . "/img/speakers/" . $ponente->imagen; ?>.png" alt="imagen__ponente">
      </picture>
    </div>
  <?php }; ?>
</fieldset>

<fieldset class="formulario__fieldset">
  <legend class="formulario__legend">Información extra</legend>

  <div class="formulario__campo">
    <label for="tags_input" class="formulario__label">Areas de experiencia (separar con una coma)</label>
    <input class="formulario__input" type="text" id="tags_input" placeholder="Ej. Node.js, PHP, JavaScript">
    <div id="tags" class="formulario__listado"></div>
    <input type="hidden" name="tags" value="<?php echo $ponente->tags ?? ''; ?>">
  </div> <!--campo -->
</fieldset>

<fieldset class="formulario__fieldset">
  <legend class="formulario__legend">Redes sociales</legend>

  <div class="formulario__campo">
    <div class="formulario__contenedor-icono">
      <div class="formulario__icono">
        <i class="fa-brands fa-facebook"></i>
      </div>
      <input class="formulario__input--sociales" type="text" name="redes[facebook]" value="<?php echo $redes->facebook ?? ''; ?>" placeholder="Facebook del Ponente">
    </div>
  </div> <!--campo -->

  <div class="formulario__campo">
    <div class="formulario__contenedor-icono">
      <div class="formulario__icono">
        <i class="fa-brands fa-x"></i>
      </div>
      <input class="formulario__input--sociales" type="text" name="redes[x]" value="<?php echo $redes->x ?? ''; ?>" placeholder="X del Ponente">
    </div>
  </div> <!--campo -->

  <div class="formulario__campo">
    <div class="formulario__contenedor-icono">
      <div class="formulario__icono">
        <i class="fa-brands fa-youtube"></i>
      </div>
      <input class="formulario__input--sociales" type="text" name="redes[youtube]" value="<?php echo $redes->youtube ?? ''; ?>" placeholder="Youtube del Ponente">
    </div>
  </div> <!--campo -->

  <div class="formulario__campo">
    <div class="formulario__contenedor-icono">
      <div class="formulario__icono">
        <i class="fa-brands fa-instagram"></i>
      </div>
      <input class="formulario__input--sociales" type="text" name="redes[instagram]" value="<?php echo $redes->instagram ?? ''; ?>" placeholder="Instagram del Ponente">
    </div>
  </div> <!--campo -->

  <div class="formulario__campo">
    <div class="formulario__contenedor-icono">
      <div class="formulario__icono">
        <i class="fa-brands fa-tiktok"></i>
      </div>
      <input class="formulario__input--sociales" type="text" name="redes[tiktok]" value="<?php echo $redes->tiktok ?? ''; ?>" placeholder="Tiktok del Ponente">
    </div>
  </div> <!--campo -->

  <div class="formulario__campo">
    <div class="formulario__contenedor-icono">
      <div class="formulario__icono">
        <i class="fa-brands fa-github"></i>
      </div>
      <input class="formulario__input--sociales" type="text" name="redes[github]" value="<?php echo $redes->github ?? ''; ?>" placeholder="Github del Ponente">
    </div>
  </div> <!--campo -->
</fieldset>
<fieldset class="formulario__fieldset">
  <legend class="formulario__legend">Información del Evento</legend>

  <div class="formulario__campo">
    <label for="nombre" class="formulario__label">Nombre</label>
    <input class="formulario__input" type="text" id="nombre" name="nombre" placeholder="Nombre del evento" value="<?php echo $evento->nombre ?? ''; ?>">
  </div> <!--campo -->

  <div class="formulario__campo">
    <label for="descripcion" class="formulario__label">Descripción</label>
    <textarea class="formulario__input" id="descripcion" name="descripcion" rows="8" placeholder="descripción del evento"><?php echo $evento->descripcion ?? ''; ?></textarea>
  </div> <!--campo -->

  <div class="formulario__campo">
    <label for="categoria" class="formulario__label">Categoria</label>
    <select class="formulario__select" id="categoria" name="categoria_id">
      <option value="" disabled <?php echo empty($evento->categoria_id) ? 'selected' : ''; ?>>--Elegir Categoria--</option>

      <?php foreach($categorias as $categoria){ ?>
        <option <?php echo ($evento->categoria_id == $categoria->id) ? "selected" : ""; ?> value="<?php echo $categoria->id; ?>"><?php echo $categoria->nombre; ?></option>
      <?php } ?>
    </select>
  </div> <!--campo -->

  <div class="formulario__campo">
    <label for="dia" class="formulario__label">Selecciona el día</label>
    
    <div class="formulario__radio">
      <?php foreach($dias as $dia){ ?>
        <div>
          <label for="<?php echo strtolower($dia->nombre); ?>"><?php echo $dia->nombre; ?></label>
          <input type="radio" name="dia" id="<?php echo strtolower($dia->nombre); ?>" value="<?php echo $dia->id; ?>" <?php echo ($evento->dia_id == $dia->id) ? "checked" : ""; ?>>
        </div>
      <?php } ?>
    </div>

    <input type="hidden" name="dia_id" value="<?php echo $evento->dia_id ?? ''; ?>">
  </div> <!--campo -->

  <div class="formulario__campo" id="horas">
    <label class="formulario__label">Selecciona la hora</label>

    <ul id="horas" class="horas">
      <?php foreach($horas as $hora){ ?>
        <li class="horas__hora horas__hora--deshabilitada" data-hora-id="<?php echo $hora->id; ?>"><?php echo $hora->hora; ?></li>
      <?php } ?>
    </ul>

    <input type="hidden" name="hora_id" value="<?php echo $evento->hora_id ?? ''; ?>">
  </div>
</fieldset>

<fieldset class="formulario__fieldset">
  <legend class="formulario__legend">Información extra</legend>

  <div class="formulario__campo">
    <label for="ponentes" class="formulario__label">Ponente</label>
    <input class="formulario__input" type="text" id="ponentes" name="ponente" placeholder="Buscar ponente" value="<?php echo $evento->ponente ?? ''; ?>">
    <ul id="listado_ponentes" class="listado_ponentes">
      <!-- Los ponentes se van a cargar aquí -->
    </ul>

    <input type="hidden" name="ponente_id" value="<?php echo $evento->ponente_id ?? ''; ?>">
  </div> <!--campo -->

  <div class="formulario__campo">
    <label for="disponibles" class="formulario__label">Lugares disponibles</label>
    <input class="formulario__input" type="number" min="1" step="1" id="disponibles" name="disponibles" placeholder="Ej: 20" value="<?php echo $evento->disponibles ?? ''; ?>">
  </div> <!--campo -->
</fieldset>
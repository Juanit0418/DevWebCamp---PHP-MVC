<h2 class="dashboard__heading"><?php echo $titulo; ?></h2>

<div class="dashboard__contenedor">
  <?php if(!empty($registrados)){ ?>
    <table class="table">
      <thead class="table__thead">
        <tr>
          <th scope="col" class="table__th">Nombre</th>
          <th scope="col" class="table__th">E-mail</th>
          <th scope="col" class="table__th">Pase</th>
        </tr>
      </thead>

      <tbody class="table__tbody">
        <?php foreach($registrados as $registrado){ ?>
          <tr class="table__tr">
            <td class="table__td"><?php echo $registrado->usuario->nombre . " " . $registrado->usuario->apellido . "."; ?></td>
            <td class="table__td"><?php echo $registrado->usuario->email; ?></td>
            <td class="table__td"><?php echo $registrado->paquete->nombre; ?></td>
          </tr>
        <?php }; ?>
      </tbody>
    </table>
  <?php } else { ?>
    <p class="text-center">No hay usuarios registrados</p>
  <?php }; ?>
</div>

<?php echo $paginacion; ?>
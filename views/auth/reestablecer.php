<main class="auth">
  <h2 class="auth__heading"><?php echo $titulo; ?></h2>
  <p class="auth__texto">Reestablece tu contraseña de DevWebCamp</p>

  <?php require_once __DIR__ . "/../templates/alertas.php"; ?>

  <?php if($token_valido){ ?>

  <form method="POST" action="" class="formulario">
    <div class="formulario__campo">
      <label for="password" class="formulario__campo--label">Nueva Contraseña</label>
      <input type="password" id="password" class="formulario__campo--input" placeholder="Tu Nueva Contraseña" name="password">
    </div>

    <input type="submit" class="formulario__submit" value="Reestablecer">
  </form>

  <div class="acciones">
    <a href="/login" class="acciones__enlace">¿Ya tienes una cuenta? Iniciar Sesión</a>
    <a href="/registro" class="acciones__enlace">¿Aún no tienes cuenta? Crear una</a>
  </div>

  <?php } ?>
</main>
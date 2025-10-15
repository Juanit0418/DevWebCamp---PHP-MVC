<header class="header">
  <div class="header__contenedor">
    <nav class="header__navegacion">
      <?php if(is_auth()){ ?>
        <a class="header__enlace" href="<?php echo is_admin() ? '/admin/dashboard' : '/finalizar-registro'; ?>">Administrar</a>
        <form class="header__form" method="POST" action="/logout">
          <input type="submit" value="cerrar sesion" class="header__submit">
        </form>
      <?php } else { ?>
        <a class="header__enlace" href="/registro">Registro</a>
        <a class="header__enlace" href="/login">Iniciar Sesión</a>
      <?php }; ?>
    </nav>

    <div class="header__contenido">
      <a href="/">
        <h1 class="header__logo">&#60;DevWebCamp/></h1>
      </a>

      <p class="header__texto">Enero 9 & 10 del 2026</p>
      <p class="header__texto header__texto--modalidad">Presencial & En Linea</p>

      <a class="header__boton" href="/registro">Comprar Pase</a>
    </div>
  </div>
</header>

<div class="barra">
  <div class="barra__contenido">
    <a href="/"><h2 class="barra__logo">&#60;DevWebCamp/></h2></a>
    <nav class="navegacion">
      <a href="/devwebcamp" class="navegacion__enlace <?php echo pagina_actual("/devwebcamp") ? "navegacion__enlace--activo" : ""; ?>">Eventos</a>
      <a href="/paquetes" class="navegacion__enlace <?php echo pagina_actual("/paquetes") ? "navegacion__enlace--activo" : ""; ?>">Paquetes</a>
      <a href="/workshops-conferencias" class="navegacion__enlace <?php echo pagina_actual("/workshops-conferencias") ? "navegacion__enlace--activo" : ""; ?>">Workshops / Conferencias</a>
      <a href="/registro" class="navegacion__enlace <?php echo pagina_actual("/registro") ? "navegacion__enlace--activo" : ""; ?>">Comprar Pase</a>
    </nav>
  </div>
</div>
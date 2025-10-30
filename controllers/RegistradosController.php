<?php
namespace Controllers;

use Classes\Paginacion;
use Model\Paquete;
use Model\Regalo;
use Model\Registro;
use Model\Usuario;
use MVC\Router;

class RegistradosController {
  public static function index(Router $router){
    admin();
    $hay_paginas = false;

    $pagina_actual = $_GET["page"];
    $pagina_actual = filter_var($pagina_actual, FILTER_VALIDATE_INT);
    if(!$pagina_actual || $pagina_actual < 1){
      header("Location: /admin/registrados?page=1");
    };

    $registros_por_pagina = 10;
    $total_registros = Registro::total();
    $paginacion = new Paginacion($pagina_actual, $registros_por_pagina, $total_registros);

    $registrados = Registro::paginar($registros_por_pagina, $paginacion->offset());

    if($paginacion->total_paginas() > 0){
      $hay_paginas = true;
    };

    if($hay_paginas){
      if($paginacion->total_paginas() < $pagina_actual){
        header("Location: /admin/registrados?page=1");
      };
    };

    //Obtener registrados
    foreach($registrados as $registrado){
      $registrado->usuario = Usuario::find($registrado->usuario_id);
      $registrado->paquete = Paquete::find($registrado->paquete_id);
      if($registrado->regalo_id){
        $registrado->regalo = Regalo::find($registrado->regalo_id);
      }
    }

    $router->render("admin/registrados/index", [
      "titulo" => "Usuarios registrados",
      "registrados" => $registrados,
      "paginacion" => $paginacion->paginacion(),
      "hay_paginas" => $hay_paginas
    ]);
  }
};
?>
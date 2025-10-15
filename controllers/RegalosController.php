<?php
namespace Controllers;

use MVC\Router;

class RegalosController {
  public static function index(Router $router){
    admin();

    $router->render("admin/regalos/index", [
      "titulo" => "Regalos"
    ]);
  }
};
?>
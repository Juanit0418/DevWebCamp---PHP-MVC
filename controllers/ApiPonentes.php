<?php
namespace Controllers;

use Model\Ponente;

class ApiPonentes {
  public static function ponentes(){

    $ponentes = Ponente::all();
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($ponentes);
  }
}
?>
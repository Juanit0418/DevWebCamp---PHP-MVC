<?php
namespace Controllers;

use Model\Regalo;
use Model\Registro;

class ApiRegalos {
  public static function index(){

    $regalos = Regalo::all();
    foreach($regalos as $regalo) {
      $regalo->total = Registro::total_array(["regalo_id" => $regalo->id, "paquete_id" => "1"]);
    }
    echo json_encode($regalos);
  }
}
?>
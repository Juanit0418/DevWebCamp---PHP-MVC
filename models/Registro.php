<?php
namespace Model;

class Registro extends ActiveRecord {
  protected static $tabla = "registros";
  protected static $columnasDB = ["id", "paquete_id", "pago_id", "token", "usuario_id", "regalo_id"];

  public $id;
  public $paquete_id;
  public $pago_id;
  public $token;
  public $usuario_id;
  public $regalo_id;
  public $paquete;
  public $usuario;
  public $regalo;

  public function __construct($arreglo = []){
    $this->id = $arreglo["id"] ?? null;
    $this->paquete_id = $arreglo["paquete_id"] ?? "";
    $this->pago_id = $arreglo["pago_id"] ?? "";
    $this->token = $arreglo["token"] ?? "";
    $this->usuario_id = $arreglo["usuario_id"] ?? "";
    $this->regalo_id = $arreglo["regalo_id"] ?? "";
    $this->paquete = $arreglo["paquete"] ?? "";
    $this->usuario = $arreglo["usuario"] ?? "";
    $this->regalo = $arreglo["regalo"] ?? "";
  }
}
?>
<?php
namespace Model;

class EventosRegistros extends ActiveRecord {
  protected static $tabla = "eventos_registros";
  protected static $columnasDB = ["id", "evento_id", "registro_id"];

  public $id;
  public $evento_id;
  public $registro_id;

  public function __construct($arreglo = []) {
    $this->id = $arreglo["id"] ?? null;
    $this->evento_id = $arreglo["evento_id"] ?? "";
    $this->registro_id = $arreglo["registro_id"] ?? "";
  }
}
?>
<?php
namespace Model;

class Hora extends ActiveRecord {
  protected static $tabla = "horas";
  protected static $columnasDB = ["id", "hora"];

  public $id;
  public $hora;

  public function __construct($arreglo = []) {
    $this->id = $arreglo["id"] ?? null;
    $this->hora = $arreglo["hora"] ?? "";
  }
}
?>
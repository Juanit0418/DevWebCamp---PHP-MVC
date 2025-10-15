<?php
namespace Model;

class Paquete extends ActiveRecord {
  protected static $tabla = 'paquetes';
  protected static $columnasDB = ['id', 'nombre'];

  public $id;
  public $nombre;

  public function __construct($arreglo = []){
    $this->id = $arreglo["id"] ?? null;
    $this->nombre = $arreglo["nombre"] ?? "";
  }
}
?>
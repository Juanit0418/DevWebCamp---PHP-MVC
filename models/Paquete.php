<?php
namespace Model;

class Paquete extends ActiveRecord {
  protected static $tabla = 'paquetes';
  protected static $columnasDB = ['id', 'nombre', 'precio'];

  public $id;
  public $nombre;
  public $precio;

  public function __construct($arreglo = []){
    $this->id = $arreglo["id"] ?? null;
    $this->nombre = $arreglo["nombre"] ?? "";
    $this->precio = $arreglo["precio"] ?? "";
  }
}
?>
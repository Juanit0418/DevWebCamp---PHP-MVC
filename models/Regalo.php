<?php
namespace Model;

class Regalo extends ActiveRecord {
  protected static $tabla = 'regalos';
  protected static $columnasDB = ['id', 'nombre'];

  public $id;
  public $nombre;
  public $total;

  public function __construct($arreglo = []){
    $this->id = $arreglo["id"] ?? null;
    $this->nombre = $arreglo["nombre"] ?? "";
    $this->total = $arreglo["total"] ?? "";
  }
}
?>
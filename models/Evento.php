<?php
namespace Model;

class Evento extends ActiveRecord {
  protected static $tabla = "eventos";
  protected static $columnasDB = ["id", "nombre", "descripcion", "disponibles", "categoria_id", "dia_id", "hora_id", "ponente_id"];

  public $id;
  public $nombre;
  public $descripcion;
  public $disponibles;
  public $categoria_id;
  public $dia_id;
  public $hora_id;
  public $ponente_id;
  public $categoria = null;
  public $dia = null;
  public $hora = null;
  public $ponente = null;

  public function __construct($arreglo = []) {
    $this->id = $arreglo["id"] ?? null;
    $this->nombre = $arreglo["nombre"] ?? "";
    $this->descripcion = $arreglo["descripcion"] ?? "";
    $this->disponibles = $arreglo["disponibles"] ?? "";
    $this->categoria_id = $arreglo["categoria_id"] ?? "";
    $this->dia_id = $arreglo["dia_id"] ?? "";
    $this->hora_id = $arreglo["hora_id"] ?? "";
    $this->ponente_id = $arreglo["ponente_id"] ?? "";
    $this->categoria = $arreglo["categoria"] ?? "";
    $this->dia = $arreglo["dia"] ?? "";
    $this->hora = $arreglo["hora"] ?? "";
    $this->ponente = $arreglo["ponente"] ?? "";
  }

  // Mensajes de validación para la creación de un evento
public function validar() {
    if(!$this->nombre) {
        self::$alertas['error'][] = 'El nombre es obligatorio';
    }
    if(!$this->descripcion) {
        self::$alertas['error'][] = 'La descripción es Obligatoria';
    }
    if(!$this->categoria_id  || !filter_var($this->categoria_id, FILTER_VALIDATE_INT)) {
        self::$alertas['error'][] = 'Elige una Categoría';
    }
    if(!$this->dia_id  || !filter_var($this->dia_id, FILTER_VALIDATE_INT)) {
        self::$alertas['error'][] = 'Elige el día del evento';
    }
    if(!$this->hora_id  || !filter_var($this->hora_id, FILTER_VALIDATE_INT)) {
        self::$alertas['error'][] = 'Elige la hora del evento';
    }
    if(!$this->disponibles  || !filter_var($this->disponibles, FILTER_VALIDATE_INT)) {
        self::$alertas['error'][] = 'Añade una cantidad de lugares disponibles';
    }
    if(!$this->ponente_id || !filter_var($this->ponente_id, FILTER_VALIDATE_INT) ) {
        self::$alertas['error'][] = 'Selecciona la persona encargada del evento';
    }

    return self::$alertas;
}
}
?>
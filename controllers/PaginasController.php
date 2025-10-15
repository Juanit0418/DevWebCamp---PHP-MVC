<?php
namespace Controllers;

use Model\Categoria;
use Model\Dia;
use Model\Evento;
use Model\Hora;
use Model\Ponente;
use MVC\Router;

class PaginasController {
  public static function inicio(Router $router){
    $eventos_formateados = [];

    $eventos = Evento::all();

    foreach($eventos as $evento){
      $evento->categoria = Categoria::find($evento->categoria_id);
      $evento->dia = Dia::find($evento->dia_id);
      $evento->hora = Hora::find($evento->hora_id);
      $evento->ponente = Ponente::find($evento->ponente_id);

      if($evento->dia_id == 1 && $evento->categoria_id == 1){
        $eventos_formateados["conferencias_v"][] = $evento;
      };

      if($evento->dia_id == 2 && $evento->categoria_id == 1){
        $eventos_formateados["conferencias_s"][] = $evento;
      };

      if($evento->dia_id == 1 && $evento->categoria_id == 2){
        $eventos_formateados["workshops_v"][] = $evento;
      };

      if($evento->dia_id == 2 && $evento->categoria_id == 2){
        $eventos_formateados["workshops_s"][] = $evento;
      };
    };

    //Obtener el total de cada bloque
    $ponentes_total = Ponente::total();
    $conferencias_totales = Evento::total("categoria_id", "1");
    $workshops_totales = Evento::total("categoria_id", "2");

    //Obtener todos los ponentes
    $ponentes = Ponente::all();

    $router->render("publicas/index", [
      'titulo' => 'Inicio',
      "eventos" => $eventos_formateados,
      "ponentes_total" => $ponentes_total,
      "conferencias_totales" => $conferencias_totales,
      "workshops_totales" => $workshops_totales,
      "ponentes" => $ponentes
    ]);
  }

  public static function evento(Router $router){
    
    $router->render("publicas/devwebcamp", [
      'titulo' => 'Sobre DevWebCamp'
    ]);
  }

  public static function paquetes(Router $router){
    
    $router->render("publicas/paquetes", [
      'titulo' => 'Paquetes DevWebCamp'
    ]);
  }

  public static function conferencias(Router $router){
    $eventos = Evento::ordenar("hora_id", "ASC");
    $eventos_formateados = [];

    foreach($eventos as $evento){
      $evento->categoria = Categoria::find($evento->categoria_id);
      $evento->dia = Dia::find($evento->dia_id);
      $evento->hora = Hora::find($evento->hora_id);
      $evento->ponente = Ponente::find($evento->ponente_id);

      if($evento->dia_id == 1 && $evento->categoria_id == 1){
        $eventos_formateados["conferencias_v"][] = $evento;
      };

      if($evento->dia_id == 2 && $evento->categoria_id == 1){
        $eventos_formateados["conferencias_s"][] = $evento;
      };

      if($evento->dia_id == 1 && $evento->categoria_id == 2){
        $eventos_formateados["workshops_v"][] = $evento;
      };

      if($evento->dia_id == 2 && $evento->categoria_id == 2){
        $eventos_formateados["workshops_s"][] = $evento;
      };
    };

    $router->render("publicas/conferencias", [
      'titulo' => 'Conferencias & Workshops',
      "eventos" => $eventos_formateados
    ]);
  }

  public static function error(Router $router){

    $router->render("publicas/error", [
      "titulo"  => "Página no encontrada"
    ]);
  }
}
?>
<?php
namespace Controllers;

use Model\Categoria;
use Model\Dia;
use Model\Evento;
use Model\EventosRegistros;
use Model\Hora;
use Model\Paquete;
use Model\Ponente;
use Model\Regalo;
use Model\Registro;
use Model\Usuario;
use MVC\Router;

class RegistroController {
  public static function crear(Router $router){
    autenticado();

    //Verificar si el usuario ya está registrado
    $registro = Registro::where("usuario_id", $_SESSION["id"]);
    if(isset($registro) && $registro->paquete_id == 3){
      header("Location: /boleto?id=" . urlencode($registro->token));
      exit;
    };

    if(isset($registro->paquete_id) && ($registro->paquete_id == 1 || $registro->paquete_id == 2)){
      header("Location: /finalizar-registro/conferencias");
    };

    $router->render("registro/crear", [
      "titulo" => "Finalizar Registro"
    ]);
  }

  public static function gratis(){
    autenticado();

    if($_SERVER["REQUEST_METHOD"] === "POST"){
      $registro = Registro::where("usuario_id", $_SESSION["id"]);

      if(isset($registro) && $registro->usuario_id == 3){
        header("Location: /boleto?id=" . urlencode($registro->token));
        exit;
      };

      $token = substr(md5(uniqid(rand(), true)), 0,  8);

      $datos = array(
        "paquete_id"  => 3,
        "pago_id" => "",
        "token" => $token,
        "usuario_id" => $_SESSION["id"],
        "regalo_id" => 10
      );

      $registro = new Registro($datos);
      $resultado = $registro->guardar();

      if($resultado){
        header("Location: /boleto?id=" . urlencode($registro->token));
        exit;
      };
    };
  }

  public static function pagar(){
    autenticado();

    if($_SERVER["REQUEST_METHOD"] === "POST"){
      //Validar que POST no venga vacío
      if(empty($_POST)){
        json_encode([]);
        return;
      };

      //Crear el registro
      $datos = $_POST;
      $datos["token"] = substr(md5(uniqid(rand(), true)), 0,  8);
      $datos["usuario_id"] = $_SESSION["id"];
      $datos["regalo_id"] = 10;
      try {
        $registro = new Registro($datos);

        $resultado = $registro->guardar();
        echo json_encode($resultado);
      } catch(\Throwable $th) {
        echo json_encode([
          "resultado" => "error"
        ]);
      }
    };
  }

  public static function conferencias(Router $router){
    autenticado();

    //Validar que el usuario tenga algun plan pagp
    $usuario_id = $_SESSION["id"];
    $registro = Registro::where("usuario_id", $usuario_id);
    if(!$registro){
      header("Location: /");
      exit;
    };

    if($registro->paquete_id !== "1" && $registro->paquete_id !== "2") {
    header("Location: /");
    exit;
    }

    if(isset($registro->regalo_id) && $registro->regalo_id !== "10"){
      header("Location: /boleto?id=" . urlencode($registro->token));
      exit;
    };

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

    $regalos = Regalo::all("ASC");

    //Manejar el registro mediante POST
    if($_SERVER["REQUEST_METHOD"] === "POST"){
      $eventos = explode(",", $_POST["eventos"]);
      if(empty($eventos)){
        echo json_encode(["resultado" => false]);
        return;
      };

      if(!isset($registro) || ($registro->paquete_id !== "1" && $registro->paquete_id !== "2")){
        echo json_encode(["resultado" => false]);
        return;
      };

      //Validar la disponibilidad de los eventos seleccionados
      $eventos_arreglo = [];

      foreach($eventos as $evento_id){
        $evento = Evento::find($evento_id);
        
        //Comprobar si no existe el evento osi el paquete es presencial y hay 0 disponoibilidad
        if(!isset($evento) || ($registro->paquete_id == 1 && $evento->disponibles == 0)){
          echo json_encode(["resultado" => false]);
          return;
        };

        $eventos_arreglo[] = $evento;
      } //foreach

      foreach($eventos_arreglo as $evento){

        if($registro->paquete_id == 1){

          $evento->disponibles -=1;
        }
        $evento->guardar();

        //Almacenar el registro
        $datos = [
          "evento_id" => (int) $evento->id,
          "registro_id" => (int) $registro->id
        ];

        $registro_usuario = new EventosRegistros($datos);
        $registro_usuario->guardar();
      }

      //Almacenar el regalo
      $registro->sincronizar(["regalo_id" => $_POST["regalo_id"] ?? 10]);
      $resultado = $registro->guardar();
      if($resultado){
        echo json_encode(["resultado"  => $resultado, "token" => $registro->token]);
      } else {
        echo json_encode(["resultado" => false]);
      };
      return;
    };

    $router->render("registro/conferencias", [
      "titulo" => "Elige tus eventos",
      "eventos" => $eventos_formateados,
      "regalos" => $regalos,
      "registro" => $registro,
      "paquete_id" => $registro->paquete_id
    ]);
  }

  public static function boleto(Router $router){
    
    //Validar la URL
    $id = $_GET["id"];
    if(!$id || strlen($id) !== 8){
      header("Location: /");
      exit;
    };

    $registro = Registro::where("token", $id);
    if(!$registro){
      header("Location: /");
      exit;
    };

    $registro->usuario = Usuario::find($registro->usuario_id);
    $registro->paquete = Paquete::find($registro->paquete_id);

    $router->render("registro/boleto", [
      "titulo" => "Boleto DevWebCamp",
      "registro" => $registro
    ]);
  }
}
?>
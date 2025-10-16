<?php
namespace Controllers;

use Classes\Paginacion;
use Model\Ponente;
use MVC\Router;
use Intervention\Image\ImageManagerStatic as Image;

class PonentesController {
  public static function index(Router $router){
    admin();

    $pagina_actual = $_GET["page"];
    $pagina_actual = filter_var($pagina_actual, FILTER_VALIDATE_INT);
    if(!$pagina_actual || $pagina_actual < 1){
      header("Location: /admin/ponentes?page=1");
    };

    $registros_por_pagina = 10;
    $total_registros = Ponente::total();

    if(!$total_registros){
      header("Location: /admin/ponentes/crear");
    } else {
      $paginacion = new Paginacion($pagina_actual, $registros_por_pagina, $total_registros);
      if($paginacion->total_paginas() < $pagina_actual){
        header("Location: /admin/ponentes?page=1");
      };
    };


    //Obtener ponentes
    $ponentes = Ponente::paginar($registros_por_pagina, $paginacion->offset());

    $router->render("admin/ponentes/index", [
      "titulo" => "Ponentes / Conferencistas",
      "ponentes" => $ponentes,
      "paginacion" => $paginacion->paginacion()
    ]);
  }

  public static function crear(Router $router){
    admin();
    $alertas = [];
    $ponente = new Ponente;

    if($_SERVER["REQUEST_METHOD"] === "POST"){
      //Leer imagen
      if(!empty($_FILES["imagen"]["tmp_name"])){
        $carpeta_imagenes = __DIR__ . "/../public/img/speakers";
        //Crear carpeta si no existe

        if(!is_dir($carpeta_imagenes)){
          mkdir($carpeta_imagenes, 0755, true);
        };

        $imagen_png = image::make($_FILES["imagen"]["tmp_name"])->fit(800, 800)->encode("png", 80);
        $imagen_webp = image::make($_FILES["imagen"]["tmp_name"])->fit(800, 800)->encode("webp", 80);
        $nombre_imagen = md5(uniqid(rand(), true));
        $_POST["imagen"] = $nombre_imagen;
      };

      $_POST["redes"] = json_encode($_POST["redes"], JSON_UNESCAPED_SLASHES);
      $ponente->sincronizar($_POST);
      $alertas = $ponente->validar();

      if(empty($alertas)){
        //Guardar imagen
        $imagen_png->save($carpeta_imagenes . "/" . $nombre_imagen . ".png");
        $imagen_webp->save($carpeta_imagenes . "/" . $nombre_imagen . ".webp");

        $resultado = $ponente->guardar();
        if($resultado){
          header("Location: /admin/ponentes");
        };
      };
    };

    $redes = json_decode($ponente->redes);

    $router->render("admin/ponentes/crear", [
      "titulo" => "Registrar ponentes",
      "alertas" => $alertas,
      "ponente" => $ponente,
      "redes" => $redes
    ]);
  }

  public static function editar(Router $router){
    admin();

    $alertas = [];
    $id = $_GET["nmoaueyromoiebaywuebdfjgprlsus"];
    $id = filter_var($id, FILTER_VALIDATE_INT);
    if(!$id){
      header("Location: /admin/ponentes");
    };

    //Obtener ponente a editar
    $ponente = Ponente::find($id);
    if(!$ponente){
      header("Location: /admin/ponentes");
    };

    $ponente->imagen_actual = $ponente->imagen;
    $redes = json_decode($ponente->redes);

    if($_SERVER["REQUEST_METHOD"] === "POST"){
      //Leer imagen
      if(!empty($_FILES["imagen"]["tmp_name"])){
        $carpeta_imagenes = __DIR__ . "/../public/img/speakers";
        //Crear carpeta si no existe

        if(!is_dir($carpeta_imagenes)){
          mkdir($carpeta_imagenes, 0755, true);
        };

        $imagen_png = image::make($_FILES["imagen"]["tmp_name"])->fit(800, 800)->encode("png", 80);
        $imagen_webp = image::make($_FILES["imagen"]["tmp_name"])->fit(800, 800)->encode("webp", 80);
        $nombre_imagen = md5(uniqid(rand(), true));
        $_POST["imagen"] = $nombre_imagen;
      } else {
        $_POST["imagen"] = $ponente->imagen_actual;
      };
      $_POST["redes"] = json_encode($_POST["redes"], JSON_UNESCAPED_SLASHES);
      $ponente->sincronizar($_POST);
      $alertas = $ponente->validar();

      if(empty($alertas)){
        if(isset($nombre_imagen)){
          $carpeta_imagenes = __DIR__ . "/../public/img/speakers";

          //Eliminar imagenes anteriores
          $png_anterior  = $carpeta_imagenes . "/" . $ponente->imagen_actual . ".png";
          $webp_anterior = $carpeta_imagenes . "/" . $ponente->imagen_actual . ".webp";

          if(file_exists($png_anterior)){
            unlink($png_anterior);
          }

          if(file_exists($webp_anterior)){
            unlink($webp_anterior);
          }

          //Guardar imagen
          $imagen_png->save($carpeta_imagenes . "/" . $nombre_imagen . ".png");
          $imagen_webp->save($carpeta_imagenes . "/" . $nombre_imagen . ".webp");
        };

        $resultado = $ponente->guardar();
        if($resultado){
          header("Location: /admin/ponentes");
        };
      };
    };

    $router->render("admin/ponentes/editar", [
      "titulo" => "Editar ponentes",
      "alertas" => $alertas,
      "ponente" => $ponente,
      "redes" => $redes
    ]);
  }

  public static function eliminar(){
    admin();

    if($_SERVER["REQUEST_METHOD"] === "POST"){
      $id = $_POST["id"];
      $id = filter_var($id, FILTER_VALIDATE_INT);
      if(!$id){
        header("Location: /admin/ponentes");
      };

      $ponente = Ponente::find($id);
      if(!$ponente){
        header("Location: /admin/ponentes");
      };
      $resultado = $ponente->eliminar();
      if($resultado){
        header("Location: /admin/ponentes");
        exit;
      };
    };
  }
};
?>
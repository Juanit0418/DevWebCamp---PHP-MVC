<?php

function debuguear($variable) : string {
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
};

function s($html) : string {
    $s = htmlspecialchars($html);
    return $s;
};

function pagina_actual($path) : bool {
    return str_contains($_SERVER["PATH_INFO"] ?? "/", $path) ? true : false;
};

function is_auth() : bool {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    return isset($_SESSION["login"]) && $_SESSION["login"] === true;
}

function is_admin() : bool {
    if(!is_auth()){
        return false;
    };

    return isset($_SESSION["admin"]) && $_SESSION["admin"] >= 1;
}

function is_dev() : bool {
    if(!is_auth()){
        return false;
    };

    return isset($_SESSION["admin"]) && $_SESSION["admin"] == 2;
}

function autenticado() : void {
    if(!is_auth()){
        header("Location: /");
        exit;
    };
};

function no_autenticado() : void {
    if(is_auth()){
        header("Location: /");
        exit;
    };
};

function admin() : void {
    if(!is_admin()){
        header("Location: /");
        exit;
    };
};

function programador() : void {
    if(!is_dev()){
        header("Location: /");
        exit;
    };
};

function aos_animacion() : void {
    $efectos = ["fade-up", "fade-down", "fade-left",  "fade-right", "flip-left", "flip-right", "zoom-in", "zoom-in-up", "zoom-in-down", "zoom-out"];

    $efecto = array_rand($efectos, 1);
    echo $efectos[$efecto];
}
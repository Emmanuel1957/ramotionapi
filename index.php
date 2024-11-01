<?php
// Habilitar CORS para permitir solicitudes desde otros orígenes
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// Obtener la ruta de la URL (por ejemplo, /inicio o /series)
$request = $_SERVER['REQUEST_URI'];
$base_url = '/api.php'; // Cambia esto si el archivo está en una carpeta distinta

// Quitar el nombre de archivo para obtener solo la ruta
$route = str_replace($base_url, '', $request);
$route = trim($route, '/');

// Definir la ruta de los archivos JSON
$jsonPath = __DIR__ . "/json/";

// Verificar qué JSON retornar en función de la ruta
switch ($route) {
    case 'inicio':
        $jsonFile = $jsonPath . "inicio.json";
        break;
    case 'series':
        $jsonFile = $jsonPath . "series.json";
        break;
    case 'peliculas':
        $jsonFile = $jsonPath . "peliculas.json";
        break;
    case 'colecciones':
        $jsonFile = $jsonPath . "colecciones.json";
        break;
    default:
        http_response_code(404);
        echo json_encode(["error" => "Ruta no encontrada"]);
        exit();
}

// Verificar si el archivo JSON existe y devolver el contenido
if (file_exists($jsonFile)) {
    echo file_get_contents($jsonFile);
} else {
    http_response_code(404);
    echo json_encode(["error" => "Archivo JSON no encontrado"]);
}

<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once 'config/database.php';
    include_once 'class/marcas.php';

    $database = new Database();
    $db = $database->getConnection();

    $item = new Marca($db);

    $item->idmarca = isset($_GET['idmarca']) ? $_GET['idmarca'] : die();

    $item->getMarca();

    if ($item->nombre != null) {
        // create array
        $emp_arr = array(
            "idmarca" =>  $item->idmarca,
            "nombre" => $item->nombre
        );

        http_response_code(200);
        echo json_encode($emp_arr);
    } else {
        http_response_code(404);
        echo json_encode("Marca no encontrada.");
    }
?>
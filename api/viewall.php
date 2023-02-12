<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once 'config/database.php';
    include_once 'class/marcas.php';

    $database = new Database();
    $db = $database->getConnection();

    $items = new Marca($db);

    $stmt = $items->getMarcas();
    $itemCount = $stmt->rowCount();

    echo json_encode($itemCount);

    if($itemCount > 0){
        
        $marcaArray = array();
        $marcaArray["body"] = array();
        $marcaArray["itemCount"] = $itemCount;

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "idmarca" => $idmarca,
                "nombre" => $nombre,
            );

            array_push($marcaArray["body"], $e);
        }
        echo json_encode($marcaArray);
    }

    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "Datos no encontrados.")
        );
    }
?>
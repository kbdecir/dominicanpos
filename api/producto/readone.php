<?php

    include_once "../config/Database.php";
    include_once "../models/producto.php";
    include_once "../utils/response.php";

    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Method: GET");
    header("Content-Type: application/json");

    $resp = new response();

    if ($_SERVER['REQUEST_METHOD'] == 'GET'){

        $database = new dbclass();
        $conn = $database->getConnection();
        $producto = new Producto($conn);
        // obtener el id de la producto
        $producto->codigo = $_GET['codigo'];

        $producto->readone();

        $lstError = $producto->getLastErrorTxt();

        if(empty($lstError)){
            if (empty($producto->codigo))
            {
                http_response_code(404);
                echo json_encode($resp->getResponse('warning',null, 404, 'producto no encontrado'));
            }else{

                 $aProducto = array(
                    "itemUno" => (int)$producto->itemUno,
                    "codigo" => (int)$producto->codigo,
                    "nombre" => html_entity_decode($producto->nombre)
                );

                http_response_code(200);
                echo json_encode($resp->getResponse('success',$aProducto, 200, 'datos del producto'));
            }
        }else{
            http_response_code(500);
            echo json_encode($resp->getResponse('error',null, 500, $lstError));

        }
    }else{
        http_response_code(405);
        echo json_encode($resp->getResponse('error',null, 405, 'method not allowed'));
    }

?>
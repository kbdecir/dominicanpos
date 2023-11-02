<?php

    include_once "../config/Database.php";
    include_once "../models/almacen.php";
    include_once "../utils/response.php";

    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Method: GET");
    header("Content-Type: application/json");

    $resp = new response();

    if ($_SERVER['REQUEST_METHOD'] == 'GET'){

        $database = new dbclass();
        $conn = $database->getConnection();
        $almacen = new Almacen($conn);
        // obtener el id de la almacen
        $almacen->almacenId = $_GET['almacenId'];

        $almacen->readone();

        $lstError = $almacen->getLastErrorTxt();

        if(empty($lstError)){
            if (empty($almacen->almacenId))
            {
                http_response_code(404);
                echo json_encode($resp->getResponse('warning',null, 404, 'almacen no encontrada'));
            }else{

                 $aAlmacen = array(
                    "almacenId" => (int)$almacen->almacenId,
                    "nombre" => html_entity_decode($almacen->nombre),
                    "status" => (int)$almacen->status,
                    "deleted" => (int)$almacen->deleted,
                    "lastUpdatedDate" => (int)$almacen->lastUpdatedDate,
                );

                http_response_code(200);
                echo json_encode($resp->getResponse('success',$aAlmacen, 200, 'datos de la almacen'));
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
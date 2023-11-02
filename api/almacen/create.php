<?php

    include_once "../config/Database.php";
    include_once "../models/almacen.php";
    include_once "../utils/response.php";

    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Method: POST");
    header("Content-Type: application/json");

    $database = new dbclass();
    $conn = $database->getConnection();
    $almacen = new Almacen($conn);
    $resp = new response();

    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $data = json_decode(file_get_contents('php://input'));
        if (!empty($data->almacenId) && !empty($data->nombre)){
            $almacen->almacenId = $data->almacenId;
            $almacen->nombre = $data->nombre;
            $almacen->status = $data->status;
            $almacen->deleted = $data->deleted;
            $almacen->lastUpdatedDate = $data->lastUpdatedDate;
            $almacen->create();
            $lstError = $almacen->getLastErrorTxt();
            if (empty($lstError)){
                http_response_code(201);
                echo json_encode($resp->getResponse('success',$almacen,201,'almacen creado'));
            }else{
                http_response_code(500);
                echo json_encode($resp->getResponse('error',null,500,$lstError));
            }

        }else{
            http_response_code(400);
            echo json_encode($resp->getResponse('warning',null,400,'datos incompletos'));
        }       

    }else{
        http_response_code(405);
        echo json_encode($resp->getResponse('error',null, 405, 'method not allowed'));
    }

?>
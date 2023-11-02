<?php

    include_once "../config/Database.php";
    include_once "../models/categoria.php";
    include_once "../utils/response.php";

    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Method: POST");
    header("Content-Type: application/json");

    $database = new dbclass();
    $conn = $database->getConnection();
    $categoria = new Categoria($conn);
    $resp = new response();

    if ($_SERVER['REQUEST_METHOD'] == 'DELETE'){
        $data = json_decode(file_get_contents('php://input'));
        if (!empty($data->grupo)){
            $categoria->grupo = $data->grupo;
            $categoria->delete();
            $lstError = $categoria->getLastErrorTxt();
            if (empty($lstError)){
                http_response_code(200);
                echo json_encode($resp->getResponse('success',$categoria,200,'categoria eliminada'));
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
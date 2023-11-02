<?php

    include_once "../config/Database.php";
    include_once "../models/categoria.php";
    include_once "../utils/response.php";

    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Method: GET");
    header("Content-Type: application/json");

    $resp = new response();

    if ($_SERVER['REQUEST_METHOD'] == 'GET'){

        $database = new dbclass();
        $conn = $database->getConnection();
        $categoria = new Categoria($conn);
        // obtener el id de la categoria
        $categoria->grupo = $_GET['grupo'];

        $categoria->readone();

        $lstError = $categoria->getLastErrorTxt();

        if(empty($lstError)){
            if (empty($categoria->grupo))
            {
                http_response_code(404);
                echo json_encode($resp->getResponse('warning',null, 404, 'categoria no encontrada'));
            }else{

                 $aCategoria = array(
                    "inv13uno" => (int)$categoria->inv13uno,
                    "grupo" => (int)$categoria->grupo,
                    "nombre" => html_entity_decode($categoria->nombre)
                );

                http_response_code(200);
                echo json_encode($resp->getResponse('success',$aCategoria, 200, 'datos de la categoria'));
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
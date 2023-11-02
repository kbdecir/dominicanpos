<?php

    include_once "../config/Database.php";
    include_once "../models/almacen.php";
    include_once "../utils/response.php";

    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Method: GET");
    header("Content-Type: application/json");

    $database = new dbclass();
    $conn = $database->getConnection();
    $almacen = new Almacen($conn);
    $resp = new response();

    if ($_SERVER['REQUEST_METHOD'] == 'GET'){
        $stmt = $almacen->read();
        $lstError = $almacen->getLastErrorTxt();
        if (empty($lstError)){
            $num =  $stmt->rowCount();
            if ($num < 0)
            {
                http_response_code(404);
                echo json_encode($resp->getResponse('warning',null, 404, 'no almacens consultadas'));
            }else{
                $aData = array();
                
                $aTempData = array();
        
                while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                    extract($row);
        
                    $aTempData = array(
                        "almacenId" => (int)$AlmacenId,
                        "nombre" => html_entity_decode($Nombre),
                        "status" => html_entity_decode($Status),
                        "deleted" => html_entity_decode($Deleted),
                        "lastUpdatedDate" => html_entity_decode($LastUpdatedDate)

                    );
        
                    array_push($aData,$aTempData);
                }
        
                http_response_code(200);
                echo json_encode($resp->getResponse('success',$aData, 200, 'almacenes consultados'));
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
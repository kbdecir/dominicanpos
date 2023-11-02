<?php

    include_once "../config/Database.php";
    include_once "../models/producto.php";
    include_once "../utils/response.php";

    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Method: POST");
    header("Content-Type: application/json");

    $database = new dbclass();
    $conn = $database->getConnection();
    $producto = new Producto($conn);
    $resp = new response();

    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $data = json_decode(file_get_contents('php://input'));
        if (!empty($data->codigo) && !empty($data->nombre)){
            $producto->codigo = $data->codigo;
            $producto->nombre = $data->nombre;
            $producto->codigobarra = $data->codigobarra;
            $producto->almacenId = $data->almacenId;
            $producto->empaqueId = $data->empaqueId;
            $producto->categoriaId = $data->categoriaId;
            $producto->costo = $data->costo;
            $producto->beneficio = $data->beneficio;
            $producto->precio = $data->precio;
            $producto->tipoPrecio = $data->tipoPrecio;
            $producto->suplidorId = $data->suplidorId;
            $producto->existencia = $data->existencia;
            $producto->reorden = $data->reorden;
            $producto->statusCode = $data->statusCode;
            $producto->referencia = $data->referencia;
            $producto->itbis = $data->itbis;
            $producto->descuento = $data->descuento;
            $producto->menor = $data->menor;
            $producto->mayor = $data->mayor;
            $producto->verificae = $data->verificae;
            $producto->precio1 = $data->precio1;
            $producto->precio2 = $data->precio2;
            $producto->materiap = $data->materiap;
            $producto->productot = $data->productot;
            $producto->uso = $data->uso;
            $producto->modiprecio = $data->modiprecio;
            $producto->preciom = $data->preciom;
            $producto->disponible = $data->disponible;
            $producto->oferta = $data->oferta;
            $producto->madera = $data->madera;
            $producto->pies = $data->pies;
            $producto->costoAnt = $data->costoAnt;
            $producto->precioUS = $data->precioUS;
            $producto->photo = $data->photo;
            $producto->auditTime = $data->auditTime; 

            $producto->create();
            $lstError = $producto->getLastErrorTxt();
            if (empty($lstError)){
                http_response_code(201);
                echo json_encode($resp->getResponse('success',$producto,201,'producto creado'));
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
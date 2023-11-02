<?php

    class Producto{
        //Conexion a la db
        private $conn;

        private $_lastErrorTxt;

       

        // Nombre de la tabla
        private $table_name = "items";

        // Lista de propiedades
        public $itemUno;
        public $codigo;
        public $codigoBarra;
        public $nombre;
        public $almacenId;
        public $empaqueId;
        public $categoriaId;
        public $costo;
        public $beneficio;
        public $precio;
        public $tipoPrecio;
        public $suplidorId;
        public $existencia;
        public $reorden;
        public $statusCode;
        public $referencia;
        public $itbis;
        public $descuento;
        public $menor;
        public $mayor;
        public $verificae;
        public $precio1;
        public $precio2;
        public $materiap;
        public $productot;
        public $uso;
        public $modiprecio;
        public $preciom;
        public $disponible;
        public $oferta;
        public $madera;
        public $pies;
        public $costoAnt;
        public $precioUS;
        public $photo;
        public $servicio;
        public $fecha;
        public $itemType;
        public $unidadDeMedida;
        public $auditTime; 

                // public $lastErrorTxt;

        // Constructor con el objeto de la conexion
        public function __construct($db){
            $this->conn = $db;
        }
        
        public function getLastErrorTxt(){
            return $this->_lastErrorTxt;
        }

        protected function setLastErrorTxt($errMsg){
            $this->_lastErrorTxt = $errMsg;
        }

        public function read(){

            if(@$_GET["page"] && @$_GET["row_per_page"]){
                
                $page = $_GET["page"];
                $row_per_page = $_GET["row_per_page"];
                $begin = ($page * $row_per_page) - $row_per_page;

                $query = "
                    SELECT 
                        ItemUno,
                        Codigo,
                        CodigoBarra,
                        Nombre,
                        AlmacenId,
                        EmpaqueId,
                        CategoriaId,
                        Costo,
                        Beneficio,
                        Precio,
                        TipoPrecio,
                        SuplidorId,
                        Existencia,
                        Reorden,
                        StatusCode,
                        Referencia,
                        Itbis,
                        Descuento,
                        Menor,
                        Mayor,
                        Verificae,
                        Precio1,
                        Precio2,
                        Materiap,
                        Productot,
                        Uso,
                        Modiprecio,
                        Preciom,
                        Disponible,
                        Oferta,
                        Madera,
                        Pies,
                        CostoAnt,
                        PrecioUS,
                        Photo,
                        Servicio,
                        Fecha,
                        ItemType,
                        UnidadDeMedida,
                        AuditTime
                    from " . $this->table_name . " order by Codigo limit {$begin},{$row_per_page}; ";
                
                $stmt = $this->conn->prepare($query);

                $stmt->execute();

                return $stmt;

            }
            else{
                echo "invalid request";
            }
        }

        public function readone(){
            $query = "
                select 
                    ItemUno,
                    Codigo,
                    CodigoBarra,
                    Nombre,
                    AlmacenId,
                    EmpaqueId,
                    CategoriaId,
                    Costo,
                    Beneficio,
                    Precio,
                    TipoPrecio,
                    SuplidorId,
                    Existencia,
                    Reorden,
                    StatusCode,
                    Referencia,
                    Itbis,
                    Descuento,
                    Menor,
                    Mayor,
                    Verificae,
                    Precio1,
                    Precio2,
                    Materiap,
                    Productot,
                    Uso,
                    Modiprecio,
                    Preciom,
                    Disponible,
                    Oferta,
                    Madera,
                    Pies,
                    CostoAnt,
                    PrecioUS,
                    Photo,
                    Servicio,
                    Fecha,
                    ItemType,
                    UnidadDeMedida,
                    AuditTime
                from " . $this->table_name . " WHERE codigo = :codigo";
            
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":codigo", $this->codigo);
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->codigo = $row['Codigo'];
            $this->codigoBarra = $row['CodigoBarra'];
            $this->nombre = $row['Nombre'];
            $this->almacenId = $row['AlmacenId'];
            $this->empaqueId = $row['EmpaqueId'];
            $this->categoriaId = $row['CategoriaId'];
            $this->costo = $row['Costo'];
            $this->beneficio = $row['Beneficio'];
            $this->precio = $row['Precio'];
            $this->tipoPrecio = $row['TipoPrecio'];
            $this->suplidorId = $row['SuplidorId'];
            $this->existencia = $row['Existencia'];
            $this->reorden = $row['Reorden'];
            $this->statusCode = $row['StatusCode'];
            $this->referencia = $row['Referencia'];
            $this->itbis = $row['Itbis'];
            $this->descuento = $row['Descuento'];
            $this->menor = $row['Menor'];
            $this->mayor = $row['Mayor'];
            $this->verificae = $row['Verificae'];
            $this->precio1 = $row['Precio1'];
            $this->precio2 = $row['Precio2'];
            $this->materiap = $row['Materiap'];
            $this->productot = $row['Productot'];
            $this->uso = $row['Uso'];
            $this->modiprecio = $row['Modiprecio'];
            $this->preciom = $row['Preciom'];
            $this->disponible = $row['Disponible'];
            $this->oferta = $row['Oferta'];
            $this->madera = $row['Madera'];
            $this->pies = $row['Pies'];
            $this->costoAnt = $row['CostoAnt'];
            $this->precioUS = $row['PrecioUS'];
            $this->photo = $row['Photo'];
            $this->itemUno = $row['ItemUno'];
            $this->auditTime = $row['AuditTime']; 
        }
    }
?>
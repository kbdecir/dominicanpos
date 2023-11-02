<?php
    class Almacen{
        //Conexion a la db
        private $conn;

        // Nombre de la tabla
        private $table_name = "almacen";

        private $_lastErrorTxt;

        // Lista de propiedades
        public $almacenId;
        public $nombre;
        public $status;
        public $deleted;
        public $lastUpdatedDate;

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

        function read(){
            $query = "
                select 
                    AlmacenId,
                    Nombre,
                    Status,
                    Deleted,
                    LastUpdatedDate
                from " . $this->table_name . " order by AlmacenId";
            try{
                $stmt = $this->conn->prepare($query);

                $stmt->execute();

                return $stmt;
            }
            catch(PDOException $ex){
                $this->setLastErrorTxt($ex->getMessage());
            }
        }

        function readone(){
            $query = "
                select 
                AlmacenId,
                Nombre,
                Status,
                Deleted,
                LastUpdatedDate
                from " . $this->table_name . " WHERE AlmacenId = :almacenId limit 1";
            
                try{
                    $stmt = $this->conn->prepare($query);
                    $stmt->bindParam(':almacenId', $this->almacenId);
                    $stmt->execute();
        
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    
                    //if(isset($register['grupo'])){
                        $this->almacenId = $row['AlmacenId'];
                        $this->nombre = $row['nombre'];
                        $this->status = $row['Status'];
                        $this->deleted = $row['Deleted'];
                        $this->lastUpdatedDate = $row['LastUpdatedDate'];
                    //}
                }
                catch(PDOException $ex){
                    $this->setLastErrorTxt($ex->getMessage());
                }

        }

        function Create(){
            $sql = "
                INSERT INTO " . $this->table_name . "
                (
                    Nombre,
                    Status,
                    Deleted,
                    LastUpdatedDate
                ) VALUES
                (
                    :nombre,
                    :status,
                    :deleted,
                    :lastUpdatedDate
                )";
                
                try{
                    $stmt = $this->conn->prepare($sql);
                    $stmt->bindParam(':almacenId',$this->almacenId);
                    $stmt->bindParam(':nombre',$this->nombre);
                    $stmt->bindParam(':status',$this->status);
                    $stmt->bindParam(':deleted',$this->deleted);
                    $stmt->bindParam(':lastUpdatedDate',$this->lastUpdatedDate);
                    if($stmt->execute()){
                        $this->almacenId = $this->conn->lastInsertId();
                        return true;
                    }else{
                        return false;
                    }
                }
                catch(PDOException $ex){
                    $this->setLastErrorTxt($ex->getMessage());
                }
        }

        function update()
        {
            $sql = "
                UPDATE " . $this->table_name . "
                SET nombre = :nombre,
                    status = :status
                    Deleted = :deleted
                    lastUpdatedDate = :lastUpdatedDate
                WHERE AlmacenId = :almacenId
                LIMIT 1;
            ";
            try{
                $this->nombre =  htmlspecialchars(strip_tags($this->nombre));

                $stmt = $this->conn->prepare($sql);
                $stmt->bindParam(':almacenId',$this->almacenId);
                $stmt->bindParam(':nombre',$this->nombre);
                $stmt->bindParam(':status',$this->status);
                $stmt->bindParam(':deleted',$this->deleted);
                $stmt->bindParam(':lastUpdatedDate',$this->lastUpdatedDate);

                if ($stmt->execute())
                {
                    return true;
                }else{
                    return false;
                }
            }
            catch(PDOException $ex){
                $this->setLastErrorTxt($ex->getMessage());
            }
        }

        function Delete(){
            $sql = "DELETE FROM " . $this->table_name . " WHERE AlmacenId = :almacenId";

                try{
                    $stmt =  $this->conn->prepare($sql);

                    $stmt->bindParam(':almacenId',$this->almacenId);
        
                    if ($stmt->execute())
                    {
                        return true;
                    }else{
                        return false;
                    }
                }
                catch(PDOException $ex){
                    $this->setLastErrorTxt($ex->getMessage());
                }         
            
        }
        
    }
?>
<?php
    class Marca{

        // Connection
        private $conn;

        // Table
        private $db_table = "marcas";

        // Columns
        public $idmarca;
        public $nombre;

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        // GET ALL
        public function getMarcas(){
            $sqlQuery = "SELECT idmarca, nombre FROM " . $this->db_table . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        // CREATE
        public function createMarca(){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        nombre = :nombre";
        
            $stmt = $this->conn->prepare($sqlQuery);
            // sanitize
            $this->nombre=htmlspecialchars(strip_tags($this->nombre));
            // bind data
            $stmt->bindParam(":nombre", $this->nombre);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }

        // UPDATE
        public function getMarca(){
            //$sqlQuery = "SELECT idmarca, nombre FROM " . $this->db_table . "";
            $sqlQuery = "SELECT
                        idmarca, 
                        nombre
                    FROM
                        ". $this->db_table ."
                    WHERE 
                        idmarca = ?
                    LIMIT 0,1";

            $stmt = $this->conn->prepare($sqlQuery);

            $stmt->bindParam(1, $this->idmarca);

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
    
            $this->nombre = $dataRow['nombre'];
        }        

        // UPDATE
        public function updateMarca(){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                        nombre = :nombre
                    WHERE 
                        idmarca = :idmarca";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->nombre=htmlspecialchars(strip_tags($this->nombre));
        
            // bind data
            $stmt->bindParam(":nombre", $this->nombre);

            $stmt->execute();
        }

        // DELETE
        function deleteMarca(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE idmarca = ?";
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->idmarca=htmlspecialchars(strip_tags($this->idmarca));
        
            $stmt->bindParam(1, $this->idmarca);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }
    }
?>


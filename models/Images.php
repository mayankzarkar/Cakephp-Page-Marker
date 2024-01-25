<?php 

    class WorkshopImages {

        private $conn;
        private $table_name = "WORKSHOP_IMAGES";

        public $workshopId;
        public $images;

        public function __construct($db){
            $this->conn = $db;
        }

        // READ ALL DATA
        function read(){

            $query = "SELECT
                    wi.IMG_ID,
                    wi.WORKSHOP_ID,
                    wi.IMAGES                    
                FROM
                    " . $this->table_name . " wi
                ORDER BY
                    wi.IMG_ID DESC";

            $stmt = $this->conn->prepare($query);
            $stmt->execute();

            return $stmt;
        }

        // READ ONLY ONE DATA
        function readOne(){

            $query = "SELECT 
                    wi.IMG_ID,
                    wi.WORKSHOP_ID,
                    wi.IMAGES,   
                FROM
                    " . $this->table_name . " wi
                WHERE
                    wi.IMG_ID = ?
                LIMIT
                    0,1";

            $stmt = $this->conn->prepare( $query );

            $stmt->bindParam(1, $this->id);

            $stmt->execute();
            return $stmt;

        }

        // Create Images
        function create(){

            $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    WORKSHOP_ID=:workshopId, 
                    IMAGES=:images";

            $stmt = $this->conn->prepare($query);

            $this->workshopId=htmlspecialchars(strip_tags($this->workshopId));
            $this->images=htmlspecialchars(strip_tags($this->images));

            $stmt->bindParam(":workshopId", $this->workshopId);
            $stmt->bindParam(":images", $this->images);

            if($stmt->execute()){
                return true;
            }

            return false;
        }
    }
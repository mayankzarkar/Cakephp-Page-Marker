<?php

class Workshop{

    // database connection and table name
    private $conn;
    private $table_name = "WORKSHOP";

    public $id;
    public $title;
    public $location;
    public $workshopDate;
    public $course;
    public $project;
    public $overview;
    public $about;
    public $highlight;
    public $accepted;

    public function __construct($db){
        $this->conn = $db;
    }

    // READ ALL DATA
    function read(){

        $query = "SELECT
                w.WORKSHOP_ID, 
                w.TITLE, 
                w.LOCATION, 
                w.WORKSHOP_DATE, 
                w.COURSE,
                w.PROJECT,
                w.OVERVIEW,
                w.ABOUT,
                w.HIGHLIGHT,
                w.ACCEPTED,
                wi.IMG_ID,
                wi.IMAGES
            FROM
                " . $this->table_name . " w
                LEFT JOIN
                    WORKSHOP_IMAGES wi
                        ON w.WORKSHOP_ID = wi.IMG_ID
            ORDER BY
                w.WORKSHOP_ID DESC";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    // READ ONLY ONE DATA

    function readOne(){

        $query = "SELECT
                w.WORKSHOP_ID, 
                w.TITLE, 
                w.LOCATION, 
                w.WORKSHOP_DATE, 
                w.COURSE,
                w.PROJECT,
                w.OVERVIEW,
                w.ABOUT,
                w.HIGHLIGHT,
                w.ACCEPTED,
                wi.IMG_ID,
                wi.IMAGES
                
            FROM
                " . $this->table_name . " w
                LEFT JOIN
                    WORKSHOP_IMAGES wi
                        ON w.WORKSHOP_ID = wi.IMG_ID
            WHERE
                w.WORKSHOP_ID = ?
            LIMIT
                0,1";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(1, $this->id);

        $stmt->execute();
        return $stmt;

    }



    // Create Workshop
    function create(){

        $query = "INSERT INTO
                " . $this->table_name . "
            SET
                TITLE=:title, 
                LOCATION=:location, 
                WORKSHOP_DATE=:workshopDate, 
                COURSE=:course, 
                PROJECT=:project, 
                OVERVIEW=:overview, 
                ABOUT=:about, 
                HIGHLIGHT=:highlight,
                ACCEPTED=:accepted";

        $stmt = $this->conn->prepare($query);

        $this->title=htmlspecialchars(strip_tags($this->title));
        $this->location=htmlspecialchars(strip_tags($this->location));
        $this->workshopDate=htmlspecialchars(strip_tags($this->workshopDate));
        $this->course=htmlspecialchars(strip_tags($this->course));
        $this->project=htmlspecialchars(strip_tags($this->project));
        $this->overview=htmlspecialchars(strip_tags($this->overview));
        $this->about=htmlspecialchars(strip_tags($this->about));
        $this->highlight=htmlspecialchars(strip_tags($this->highlight));
        $this->accepted=htmlspecialchars(strip_tags($this->accepted));


        $stmt->bindParam(":title", $this->title);
        $stmt->bindParam(":location", $this->location);
        $stmt->bindParam(":workshopDate", $this->workshopDate);
        $stmt->bindParam(":course", $this->course);
        $stmt->bindParam(":project", $this->project);
        $stmt->bindParam(":overview", $this->overview);
        $stmt->bindParam(":about", $this->about);
        $stmt->bindParam(":highlight", $this->highlight);
        $stmt->bindParam(":accepted", $this->accepted);

        if($stmt->execute()){
            return true;
        }

        printf("Error : %s.\n", $stmt->error);

        return false;
    }
}
<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// Include Database File
include_once '../../config/database.php';

// Include Workshop class file
include_once '../../model/Workshop.php';

// Connect to Database

$database = new Database();
$db = $database->getConnection();

// Create Instance of workshop
$workshop = new Workshop($db);

// Call read method
$stmt = $workshop->read();

// Count number of rows
$num = $stmt->rowCount();

if($num > 0){

    $api = array();
    $api["server"] = array();
    $img = array();

    // Fetch All Record
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $workshop_detail=array(
            "id"            => $row['WORKSHOP_ID'],
            "title"         => $row['TITLE'],
            "location"      => $row['LOCATION'],
            "workshopDate"  => $row['WORKSHOP_DATE'],
            "course"        => $row['COURSE'],
            "project"       => $row['PROJECT'],
            "overview"      => $row['OVERVIEW'],
            "about"         => $row['ABOUT'],
            "highlight"     => $row['HIGHLIGHT'],
            "accepted"      => $row['ACCEPTED'],
            "imgId"         => $row['IMG_ID'],
            "images"        => $row['IMAGES']
        );

        // Insert all data into array
        // Use Key => records
        array_push($api["server"], $workshop_detail);
    }

    echo json_encode($api);
}

else{
    echo json_encode(
        array("message" => "No workshop found.")
    );
}
?>

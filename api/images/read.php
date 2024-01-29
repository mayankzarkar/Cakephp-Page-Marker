<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// Include Database File
include_once '../../config/database.php';

// Include Workshop class file
include_once '../../model/Images.php';

// Connect to Database

$database = new Database();
$db = $database->getConnection();

// Create Instance of workshop
$img = new WorkshopImages($db);

// Call read method
$stmt = $img->read();

// Count number of rows
$num = $stmt->rowCount();

if($num > 0){

    $api = array();
    $api["server"] = array();
    $imgs = array();

    // Fetch All Record
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $img_detail=array(
            "workshopId"    => $row['WORKSHOP_ID'],
            "imgId"         => $row['IMG_ID'],
            "images"        => $row['IMAGES']
        );

        // Insert all data into array
        // Use Key => records
        array_push($api["server"], $img_detail);
    }

    echo json_encode($api);
}

else{
    echo json_encode(
        array("message" => "No images found.")
    );
}
?>

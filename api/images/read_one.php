<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

include_once '../../config/database.php';
include_once '../../model/Images.php';

// Connect to Database
$database = new Database();
$db = $database->getConnection();

// Create Instance of WorkshopImages
$img = new WorkshopImages($db);

// Get ID of WorkshopImages through URL
$img->id = isset($_GET['id']) ? $_GET['id'] : die();

// Call readOne Method
$stmt = $img->readOne();

// Fetch Data
$row = $stmt->fetch(PDO::FETCH_ASSOC);

    $img_arr = array();
    $img_arr["server"] = array();

        $img_detail=array(
            "imgId"      => $row['IMG_ID'],
            "workshopId" => $row['WORKSHOP_ID'],
            "images"     => $row['IMAGES']
        );

        array_push($img_arr["server"], $img_detail);

    echo json_encode($img_arr);
?>
<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

include_once '../../config/database.php';
include_once '../../model/Workshop.php';

// Connect to Database
$database = new Database();
$db = $database->getConnection();

// Create Instance of Workshop
$workshop = new Workshop($db);

// Get ID of workshop through URL
$workshop->id = isset($_GET['id']) ? $_GET['id'] : die();

// Call readOne Method
$stmt = $workshop->readOne();

// Fetch Data
$row = $stmt->fetch(PDO::FETCH_ASSOC);

    $work_arr = array();
    $work_arr["server"] = array();

        $workshop_detail=array(
            "id" => $row['WORKSHOP_ID'],
            "title" => $row['TITLE'],
            "location" => $row['LOCATION'],
            "workshopDate" => $row['WORKSHOP_DATE'],
            "course" => $row['COURSE'],
            "project" => $row['PROJECT'],
            "overview" => $row['OVERVIEW'],
            "about" => $row['ABOUT'],
            "highlight" => $row['HIGHLIGHT'],
            "accepted" => $row['ACCEPTED'],
            "imgId" => $row['IMG_ID'],
            "images" =>$row['IMAGES']
        );

        array_push($work_arr["server"], $workshop_detail);

    echo json_encode($work_arr);
?>
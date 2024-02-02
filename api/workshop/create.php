<?php

// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


include_once '../../config/database.php';
include_once '../../model/Workshop.php';

$database = new Database();
$db = $database->getConnection();

$workshop = new Workshop($db);

$data = json_decode(file_get_contents("php://input"));

$workshop->title = $data->title;
$workshop->location = $data->location;
$workshop->workshopDate = $data->workshopDate;
$workshop->course = $data->course;
$workshop->project = $data->project;
$workshop->overview = $data->overview;
$workshop->about = $data->about;
$workshop->highlight = $data->highlight;
$workshop->accepted = $data->accepted;

if($workshop->create()){
    echo json_encode(
        array("message" => "Workshop was created.")
    );
}

else{
    echo json_encode(
        array("message" => "Workshop not created.")
    );
}
?>
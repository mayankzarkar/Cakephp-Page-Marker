<?php

// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


include_once '../../config/database.php';
include_once '../../model/Images.php';

$database = new Database();
$db = $database->getConnection();

$img = new WorkshopImages($db);

$data = json_decode(file_get_contents("php://input"));

$img->workshopId = $data->workshopId;
$img->images = $data->images;

if($img ->create()){
    echo json_encode(
        array("message" => "Images was created.")
    );
}

else{
    echo json_encode(
        array("message" => "Images not created.")
    );
}
?>
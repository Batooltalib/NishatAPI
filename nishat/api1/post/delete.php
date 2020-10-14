<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: DELETE");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
// // Makes IE to support cookies
header("Content-Type: application/json; charset=utf-8");
include_once '../../config/Database.php';
include_once '../../models/Post.php';

$database = new Database();
$db = $database->connect();

$post = new Post($db);

$data=json_decode(file_get_contents("php://input"));

$post->id = $data->id;

if($post->delete($id)) {
    echo json_encode(
     array('message'=> 'Post DELETED')
    );

} else {
    echo json_encode(
        array('message'=> 'Post Not DELETED')
    );
} 
<?php
// header('Access-Control-Allow_Origin: *');
// header('Content-type: application/json');
// header('Access-Control-Allow-Methods: POST');
// header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type,
//  Access-Control-Allow-Methods, Authorization, X-Requested-With, Origin, Accept');
// header('Access-Control-Request-Headers:content-type');
// header('Access-Control-Request-Method:POST');
// header('Access-Control-Allow-Credentials:true');


header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
// // Makes IE to support cookies
header("Content-Type: application/json; charset=utf-8");
include_once '../../config/Database.php';
include_once '../../models/Post.php';

$database = new Database();
$db = $database->connect();

$post = new Post($db);

$data=json_decode(file_get_contents("php://input"));




// // $post->name = $data->name;
// // $post->code = $data->code;
// // $post->brand = $data->brand;
// // $post->color = $data->color;
// // $post->material = $data->material;
// // $post->price = $data->price;
// // $post->type = $data->type;
// // $post->size_id = $data->size_id;
// // $post->category_id = $data->category_id;
// // $post->image = "string";

$post->name = $_POST["name"];
$post->code =  $_POST["code"];
$post->brand =  $_POST["brand"];
$post->color =  $_POST["color"];
$post->material =  $_POST["material"];
$post->price =  $_POST["price"];
$post->type =  $_POST["type"];
$post->size_id =  $_POST["size_id"];
$post->category_id =  $_POST["category_id"];
$post->image = $_FILES["file"]["name"] ;


$target_file = basename($_FILES["file"]["name"]);
$uploadOk = 1;
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["file"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file( ($_FILES["file"]["tmp_name"]),  $target_file  ))
     {
        echo "The file ".  $_FILES["file"]["name"]. " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}


if($post->create()) {
    echo json_encode(
     array('message'=> 'Post Created')
    );

} else {
    echo json_encode(
        array('message'=> 'Post Not Created')
    );
}


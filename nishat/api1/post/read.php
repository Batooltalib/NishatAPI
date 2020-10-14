<?php
header('Access-Control-Allow_Origin: *');
header('Content-type: application/json');
header('Access-Control-Allow-Methods: GET,POST,PUT,DELETE,OPTIONS');

header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
// // Makes IE to support cookies
header("Content-Type: application/json; charset=utf-8");

include_once '../../config/Database.php';
include_once '../../models/Post.php';

$database = new Database();
$db = $database->connect();

$post = new Post($db);

$result = $post->read();
$num=$result->rowCount();

if($num>0){
$posts_arr = array();
$posts_arr['data'] = array();

while($row = $result->fetch(PDO::FETCH_ASSOC)){
extract($row);

$post_item = array(
'id'=>$id,
'name' => $name,
'code' => $code,
'brand'=> $brand,
'color' => $color,
'material' => $material,
'price' => $price,
'type'=>$type,
'size_id'=>$size_id,
'size_type'=>$size_type,
'category_id'=>$category_id,
'category_name'=>$category_name,
'image'=>$image

);

array_push($posts_arr['data'],$post_item);
}
echo json_encode($posts_arr);
}else{
echo json_encode(
array('message' => 'No post found') 
);

}
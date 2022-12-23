<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once "../../library/function.php";
include_once "../../library/create_image.php";

if (
    isset($_POST["foo_name"]) &&
    isset($_POST["foo_price"]) &&
    isset($_POST["foo_offer"]) &&
    isset($_POST["foo_info"]) 
    
    
    && is_auth()
) {
            $cat_id =$_POST["cat_id"];
            $foo_name =$_POST["foo_name"];
            $foo_price =$_POST["foo_price"];
            $foo_offer =$_POST["foo_offer"] == null ? "" : $_POST["foo_offer"];
            $foo_info =$_POST["foo_info"] == null ? "" : $_POST["foo_info"];
           
            
    

    //$images = uploadImage("file" , '../../images/food' , 200 , 600);
    //$img_image = $images["image"];
    //$img_thumbnail = $images["thumbnail"];
    

    $insertArray = array();
    
    array_push($insertArray , htmlspecialchars(strip_tags($cat_id)));
            array_push($insertArray , htmlspecialchars(strip_tags($foo_name)));
            array_push($insertArray , htmlspecialchars(strip_tags($foo_price)));
            array_push($insertArray , htmlspecialchars(strip_tags($foo_offer)));
            array_push($insertArray , htmlspecialchars(strip_tags($foo_info)));
            
            
            


    //array_push($insertArray, htmlspecialchars(strip_tags($img_image)));
    //array_push($insertArray, htmlspecialchars(strip_tags($img_thumbnail)));
    
    

    $sql = "insert into food (cat_id, foo_name , foo_price , foo_offer , foo_info)
                values( ? , ? , ? , ? ,?)";
    $result = dbExec($sql, $insertArray);


    $resJson = array("result" => "success", "code" => "200", "message" => "done");
    echo json_encode($resJson, JSON_UNESCAPED_UNICODE);
} else {
    //bad request
    $resJson = array("result" => "fail", "code" => "400", "message" => "error");
    echo json_encode($resJson, JSON_UNESCAPED_UNICODE);
}
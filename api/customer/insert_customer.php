<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once "../../library/function.php";
include_once "../../library/create_image.php";

if (
    isset($_POST["cus_name"]) &&
    isset($_POST["cus_mobile"]) &&
    isset($_POST["cus_pwd"]) 
    
    && is_auth()
) {
           
            $cus_name =$_POST["cus_name"];
            $cus_mobile =$_POST["cus_mobile"];
            $cus_pwd =$_POST["cus_pwd"];
         
            $insertArray = array();
    
          
            array_push($insertArray , htmlspecialchars(strip_tags($cus_name)));
            array_push($insertArray , htmlspecialchars(strip_tags($cus_mobile)));
            array_push($insertArray , htmlspecialchars(strip_tags($cus_pwd)));
         
    //array_push($insertArray, htmlspecialchars(strip_tags($img_image)));
    //array_push($insertArray, htmlspecialchars(strip_tags($img_thumbnail)));
    
    

    $sql = "insert into customer ( cus_name , cus_mobile , cus_pwd)
                values( ? , ? , ?)";
    $result = dbExec($sql, $insertArray);


    $resJson = array("result" => "success", "code" => "200", "message" => "done");
    echo json_encode($resJson, JSON_UNESCAPED_UNICODE);
} else {
    //bad request
    $resJson = array("result" => "fail", "code" => "400", "message" => "error");
    echo json_encode($resJson, JSON_UNESCAPED_UNICODE);
}
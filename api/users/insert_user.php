<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once "../../library/function.php";
if (
    isset($_POST["use_name"])
    && isset($_POST["use_mobile"])
    && isset($_POST["use_pwd"])
    
    && is_auth()
) {
    $use_name = $_POST["use_name"];
    $use_pwd = $_POST["use_pwd"];
    $use_mobile = $_POST["use_mobile"];
    $use_note = isset($_POST["use_note"]) ? $_POST["use_note"] : "";
    

    $insertArray = array();
    array_push($insertArray, htmlspecialchars(strip_tags($use_name)));
    array_push($insertArray, htmlspecialchars(strip_tags($use_mobile)));
    array_push($insertArray, htmlspecialchars(strip_tags($use_pwd)));
    array_push($insertArray, htmlspecialchars(strip_tags($use_note)));
    

    $sql = "insert into users ( use_name , use_mobile , use_pwd , use_note , use_datetime , use_lastdate)
                values( ? , ? , ? , ? ,  now() , now())";
    $result = dbExec($sql, $insertArray);


    $resJson = array("result" => "success", "code" => "200", "message" => "done");
    echo json_encode($resJson, JSON_UNESCAPED_UNICODE);
} else {
    //bad request
    $resJson = array("result" => "fail", "code" => "400", "message" => "error");
    echo json_encode($resJson, JSON_UNESCAPED_UNICODE);
}
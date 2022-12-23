<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");

    include_once "../../library/function.php";
    if  (    
        isset($_POST["cus_id"]) 
        && is_numeric($_POST["cus_id"]) 
        && isset($_POST["cus_name"])
        && isset($_POST["cus_mobile"])
        && isset($_POST["cus_pwd"])
        
        
        && is_auth()
        )
        {
            $cus_name =$_POST["cus_name"];
            $cus_mobile =$_POST["cus_mobile"];
            $cus_pwd =$_POST["cus_pwd"];
            $cus_id = isset($_POST["cus_id"]);

            $updateArray = array();
            array_push($updateArray , htmlspecialchars(strip_tags($cus_name)));
            array_push($updateArray , htmlspecialchars(strip_tags($cus_mobile)));
            array_push($updateArray , htmlspecialchars(strip_tags($cus_pwd)));
            
            array_push($updateArray , htmlspecialchars(strip_tags($cus_id)));
            
            $sql = "update customer 
            set 
            cus_name=?,
            cus_mobile=?,
            cus_pwd=?,
            where cus_id=?";
            
            $result = dbExec($sql , $updateArray);
            
            $resJson = array("result" => "success" , "code" => "200" , "message" => "done");
            echo json_encode($resJson , JSON_UNESCAPED_UNICODE);
        }
        else
        {
            $resJson = array("result" => "fail" , "code" => "400" , "message" => "error");
            echo json_encode($resJson , JSON_UNESCAPED_UNICODE);
        }
    
?>
<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");

    include_once "../../library/function.php";
    if  (    
        isset($_POST["del_id"]) 
        && is_numeric($_POST["del_id"]) 
        && isset($_POST["del_name"])
        && isset($_POST["del_mobile"])
        && isset($_POST["del_pwd"])
        
        && is_auth()
        )
        {
            $del_name =$_POST["del_name"];
            $del_mobile =$_POST["del_mobile"];
            $del_pwd =$_POST["del_pwd"];
            
            $del_id = isset($_POST["del_id"]);

            $updateArray = array();
            array_push($updateArray , htmlspecialchars(strip_tags($del_name)));
            array_push($updateArray , htmlspecialchars(strip_tags($del_mobile)));
            array_push($updateArray , htmlspecialchars(strip_tags($del_pwd)));
            
            array_push($updateArray , htmlspecialchars(strip_tags($del_id)));

            $sql = "update delivery 
            set 
            del_name=?,
            del_mobile=?,
            del_pwd=?,
            where del_id=?";
            
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
<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");

    include_once "../../library/function.php";
    if  (    
        isset($_POST["foo_id"]) 
        && is_numeric($_POST["foo_id"]) 
        && isset($_POST["foo_name"])
        && isset($_POST["foo_price"])
        
        
        
        
        && is_auth()
        )
        {
            $foo_name =$_POST["foo_name"];
            $foo_price =$_POST["foo_price"];
            $foo_offer =$_POST["foo_offer"] == null ? "" : $_POST["foo_offer"];
            $foo_info =$_POST["foo_info"] == null ? "" : $_POST["foo_info"];
            
            $foo_id = isset($_POST["foo_id"]);

            $updateArray = array();
            array_push($updateArray , htmlspecialchars(strip_tags($foo_name)));
            array_push($updateArray , htmlspecialchars(strip_tags($foo_price)));
            array_push($updateArray , htmlspecialchars(strip_tags($foo_offer)));
            array_push($updateArray , htmlspecialchars(strip_tags($foo_info)));
            
            
            array_push($updateArray , htmlspecialchars(strip_tags($foo_id)));

            $sql = "update food 
            set 
            foo_name=?,
            foo_price=?,
            foo_offer=?,
            foo_info=?,
            
            where foo_id=?";
            
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
<?php
session_start();
$item;
if(isset($_POST)){
    if(isset($_SESSION['Cart'])){
        $check = 0; //flag
        foreach($_SESSION['Cart'] as $key => $value){
            if($value['id'] == $_POST['id']){
                $check++;
            }
        }
        if($check == 0){
            $item = $_POST;
            array_push($_SESSION['Cart'], $_POST);
        }
    }
    else{
        $item = $_POST;
        $_SESSION['Cart'][0] = $_POST;
    }

}
echo json_encode($item);
?>
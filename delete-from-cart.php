<?php
session_start();
// print_r($_GET['id']);
// if(isset($_SESSION['Cart'])){
//     print_r($_SESSION['Cart']);
//     // $search = array_search($_SESSION['Cart'],
foreach($_SESSION['Cart'] as $key => $val){
        // print_r($key);
        if($val['id'] === $_GET['id']){
            unset($_SESSION['Cart'][$key]);
        }
}
$total = 0;
$amount = 0;
$html = "";
foreach($_SESSION['Cart'] as $key => $value){
    if($value['id'] != $_GET['id']){
        $total = $value['price']*$value['quantity'];
    }
    $amount+= $total;
}
if(empty($_SESSION['Cart']) == true){
    session_destroy();
    $html = "Your cart is empty.";
}else{
    $html = "";
}
$result = array(
    'amount' => $amount,
    'html' => $html
);
echo json_encode($result);
?>
<?php
session_start();
// print_r($_GET);
$price = $_GET['price'];
$quantity = $_GET['quantity'];
$totalPrice = 0;
$amount = 0;
$html = "Your cart is empty.";
if(isset($_POST)){
    if(isset($_SESSION['Cart'])){
        foreach($_SESSION['Cart'] as $key => $val){
            if($val['id'] === $_GET['id']){
                if($quantity == 0){
                    unset($_SESSION['Cart'][$key]);
                    if(empty($_SESSION['Cart'])){
                        unset($_SESSION['Cart']);
                    }
                }else{
                    // $totalPrice = $price*$quantity;
                    $data = [
                        // 'price_total' => $totalPrice,
                        'quantity' => $quantity
                    ];
                    $_SESSION['Cart'][$key] = array_replace($_SESSION['Cart'][$key], $data);
                }
            }
        }       
    }
}
if(isset($_SESSION['Cart'])){
    foreach($_SESSION['Cart'] as $key => $val){
        $amount += round($val['price']*$val['quantity'], 2);
}
}
$result = [
    'price' => $price,
    'quantity' => $quantity,
    // 'priceItem' => $totalPrice,
    'amount' => $amount,
    'html' => $html
];
echo json_encode($result);
?>
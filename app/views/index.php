<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="assets/css/style.css" as="style" rel="preload"> -->
    <link rel="stylesheet" href="app/assets/css/main.css" as="style" rel="preload">
    <!-- <link href="assets/js/app.e65694c8.js" rel="preload" as="script"> -->
    <!-- <link href="assets/js/chunk-vendors.d8c3231a.js" rel="preload" as="script"> -->
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Demo</title>
    <!-- <style>
        .inactive{
            display: none;
        }
    </style> -->
</head>
<body>
    <div class="main-content">
        <div class="card">
            <div class="card-top">
                <img src="app/assets/img/nike.png" class="card-top-logo" alt="" >
            </div>
            <div class="card-title">
                Our Products
            </div>
            <div class="card-body">
                <div class="shop-items">
                    <?php
                        $data = file_get_contents('app/data/shoes.json');
                        $data = json_decode($data, true);
                        session_start();
                        // session_destroy();
                        echo '<pre>';
                        print_r($_SESSION);
                        echo '</pre>';
                        foreach($data as $key){
                            foreach ($key as $value){
                                
                    ?>
                        <div class="shop-item">
                            <div class="shop-item-image" id="color-<?php echo $value['id']?>" color="<?php echo $value['color']?>" style="background-color:<?php echo $value['color']?>">
                                
                                <img src="<?php echo $value['image']?>" alt="" id="image-<?php echo $value['id']?>">
                            </div>
                            <div class="shop-item-name" id="name-<?php echo $value['id']?>" value= "<?php echo $value['name']?>"><?php echo $value['name']?></div>
                            <div class="shop-item-description" id="description-<?php echo $value['id']?>">
                                <?php echo $value['description']?>
                            </div>
                            <div class="shop-item-bottom" id="shop-item-bottom-<?php echo $value['id']?>">
                                <div class="shop-item-price" id="price-<?php echo $value['id']?>" val="<?php echo $value['price']?>"><?php echo '$'.$value['price']?></div>
                                <button onclick="addCart(<?php echo $value['id']?>)" class="shop-item-button add-to-cart" id="add-to-cart-<?php echo $value['id']?>">
                                    <p>ADD TO CART</p>
                                </button>
                                
                                <!-- <button class="shop-item-button inactive" id="button-inactive-<?php echo $value['id']?>">
                                    <div class="shop-item-button-cover">
                                        <div class="shop-item-button-cover-check-icon">
                                            <img src="app/assets/img/check.png" alt="" style="height: 27px;width: 25px;transform: translate(-16%,3%) rotate(46deg);">
                                        </div>
                                    </div>
                                </button> -->
                            </div>
                        </div>
                        <?php }}?>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-top">
                <img src="app/assets/img/nike.png" class="card-top-logo" alt="" >
            </div>
            <div class="card-title">
                your cart
                <?php
                    $total = 0;
                    if(isset($_SESSION['Cart'])){
                        foreach($_SESSION['Cart'] as $key => $value){
                            $total += $value['price']*$value['quantity'];
                        }
                ?>
                    <span class="card-title-amount" id="amount" value="<?php echo $total?>"><?php echo '$'.$total?></span>
                <?php  
                }else{
                ?>
                    <span class="card-title-amount" id="amount" value="<?php echo $total?>">$0.00</span>
                <?php
                }?>
            </div>
            <div class="card-body" id="card-body-cart">
                <?php
                    if(!isset($_SESSION['Cart'])){
                ?>
                    <div class="cart-empty">
                        <div class="cart-empty-text">
                        Your cart is empty.
                        </div>
                    </div>
                <?php    
                }else{
                    foreach($_SESSION['Cart'] as $key => $value){
                ?>
                    <div class="cart-items" id="cart-items">
                            <div class="cart-item" id="cart-item-<?php echo $value['id']?>">
                                <div class="cart-item-left">
                                    <div class="cart-item-image">
                                        <div class="cart-item-image-block">
                                            <img src="<?php echo $value['image']?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="cart-item-right">
                                    <div class="cart-item-name"><?php echo $value['name'] ?></div>
                                    <div class="cart-item-price" id="cart-item-price-<?php echo $value['id']?>" data="<?php echo $value['price']?>" value="<?php echo $value['price']?>"><?php echo '$'.$value['price']?></div>
                                    <div class="cart-item-actions">
                                        <div class="cart-item-count">
                                            <button class="cart-item-count-button quantity-left-minus" id="quantity-left-<?php echo $value['id']?>" data-id="<?php echo $value['id']?>">-</button>
                                            <div class="cart-item-count-number" id="quantity-number-<?php echo $value['id']?>" data-id="<?php echo $value['id']?>" value="<?php echo $value['quantity']?>"><?php echo $value['quantity']?></div>
                                            <button class="cart-item-count-button quantity-right-plus" id="quantity-right-<?php echo $value['id']?>" data-id="<?php echo $value['id']?>">+</button>
                                        </div>
                                        <button onclick="deleteCart(<?php echo $value['id']?>)" class="cart-item-remove"  value="<?php echo $value['id']?>">
                                            <img src="app/assets/img/button_remove.png" alt="">
                                        </button>
                                    </div>
                                </div>
                            </div>
                    </div>
                <?php 
                }}?>
            </div>
        </div>
    </div>
    <!-- <script type="text/javascript" src="assets/js/app.js"></script> -->
    <!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script type="text/javascript">
        function addCart(id){
            var id = id;
            var image = $('#image-'+id).attr('src');
            var name = $('#name-'+id).text();
            var price = $('#price-'+id).attr('val');
            var color = $('#color-'+id).attr('color')
            var quantity = 1;
            var data = {
                id, image, name, price, color, quantity
            }
            if(!document.getElementById("cart-items")){
                var htmlItems = '<div class="cart-items" id="cart-items"></div>';
                $(document).find('div#card-body-cart').html(htmlItems);
            }
            $.ajax({
                url : "add-from-cart.php",
                type : "POST",
                data : data,
                dataType: 'json',
                success : function(reponse) {
                    // console.log(reponse);
                    // $(document).find('button#add-to-cart'+id).remove();
                    // var html = '<button class="shop-item-button inactive" id="button-inactive-<?php echo $value['id']?>">'+
                    //                 '<div class="shop-item-button-cover">'+
                    //                     '<div class="shop-item-button-cover-check-icon">'+
                    //                         '<img src="app/assets/img/check.png" alt="" style="height: 27px;width: 25px;transform: translate(-16%,3%) rotate(46deg);">'+
                    //                     '</div>'+
                    //                 '</div>'+
                    //             '</button>';
                    var item =  '<div class="cart-item" id="cart-item-'+reponse.id+'">'+
                                    '<div class="cart-item-left">'+
                                        '<div class="cart-item-image">'+
                                            '<div class="cart-item-image-block">'+
                                                '<img src="'+reponse.image+'">'+
                                            '</div>'+
                                        '</div>'+
                                    '</div>'+
                                    '<div class="cart-item-right">'+
                                        '<div class="cart-item-name">'+reponse.name+'</div>'+
                                        '<div class="cart-item-price" id="cart-item-price-'+reponse.id+'" data="'+reponse.price+'" value="'+reponse.price+'">$'+reponse.price+'</div>'+
                                        '<div class="cart-item-actions">'+
                                            '<div class="cart-item-count">'+
                                                '<button class="cart-item-count-button quantity-left-minus" id="quantity-left-'+reponse.id+'" data-id="'+reponse.id+'">-</button>'+
                                                '<div class="cart-item-count-number" id="quantity-number-'+reponse.id+'" data-id="'+reponse.id+'" value="'+reponse.quantity+'">'+reponse.quantity+'</div>'+
                                                '<button class="cart-item-count-button quantity-right-plus" id="quantity-right-'+reponse.id+'" data-id="'+reponse.id+'">+</button>'+
                                            '</div>'+
                                            '<button onclick="deleteCart('+reponse.id+')" class="cart-item-remove"  value="'+reponse.id+'">'+
                                                '<img src="app/assets/img/button_remove.png" alt="">'+
                                            '</button>'+
                                        '</div>'+
                                    '</div>'+
                                '</div>';
                    $(document).find('div#cart-items').html(item);
                }
            });
        }
        function deleteCart(id){
            var idItem = id;
            $.ajax({
                url : "delete-from-cart.php",
                type: "GET",
                data: 
                {
                    id: idItem
                },
                dataType: 'json',
                success : function(reponse) {
                    // console.log(reponse);
                    $('#cart-item-'+idItem).remove();
                    $(document).find('span#amount').html("$"+reponse.amount);
                    // var add =  '<div class="shop-item-price" id="price-'+idItem+'" val="'+reponse.price+'">$'+reponse.price+'</div>'+
                    //                     '<button onclick="addCart('+idItem+')" class="shop-item-button add-to-cart" id="add-to-cart-'+idItem+'">'+
                    //                             '<p>ADD TO CART</p>'+
                    //                     '</button>'+
                    //                 '</div>';
                    // $('#button-inactive-'+id).remove();
                    // $('#shop-item-bottom-'+id).html(add);
                    if(reponse.amount == 0){
                        var html = '<div class="cart-empty"><div class="cart-empty-text">'+reponse.html+'.</div></div>';
                        $(document).find('div#card-body-cart').html(html);
                    }
                }
            })
        }
        $('.quantity-left-minus').click(function(){
            var id = $(this).attr('data-id');
            var oldValue = parseInt($(document).find('div#quantity-number-'+id).text());
            // var quantity = 2;
            var price = $('#cart-item-price-'+ id).attr('value');
            var quantity = oldValue - 1;
            var data = {
                id, quantity, price
            }
            $.ajax({
                url: "update-from-cart.php",
                type: "GET",
                data: data,
                dataType: 'json',
                success: function(reponse){
                    if(quantity == 0){
                        $('div#cart-item-'+id).remove();
                        $('#button-inactive-'+id).remove();
                        var button =  '<div class="shop-item-price" id="price-'+id+'" val="'+price+'">$'+price+'</div>'+
                                            '<button onclick="addCart('+id+')" class="shop-item-button add-to-cart" id="add-to-cart-'+id+'">'+
                                                    '<p>ADD TO CART</p>'+
                                            '</button>'+
                                        '</div>';
                        $('#shop-item-bottom-'+id).html(button);
                        $(document).find('#amount').html("$"+ parseFloat(reponse.amount).toFixed(2));
                        $('span#amount').attr('value', parseFloat(reponse.amount).toFixed(2));
                        $('div#quantity-number-'+id).attr('value', reponse.quantity);
                        if(reponse.amount == 0){
                            $(document).find('#amount').html("$"+ parseFloat(reponse.amount).toFixed(2));
                            $('span#amount').attr('value', parseFloat(reponse.amount).toFixed(2));
                            var html = '<div class="cart-empty"><div class="cart-empty-text">'+reponse.html+'.</div></div>';
                            $(document).find('div#card-body-cart').html(reponse.html);
                        }
                    }else{
                        $(document).find('#amount').html("$"+ parseFloat(reponse.amount).toFixed(2));
                        $('span#amount').attr('value', parseFloat(reponse.amount).toFixed(2));
                        $(document).find('div#quantity-number-'+id).html(reponse.quantity);
                        $('div#quantity-number-'+id).attr('value', reponse.quantity);
                    }
                    // console.log(button);
                }
            })
        })
        $('.quantity-right-plus').click(function(){
            var quantity = 0;
            var id = $(this).attr('data-id');
            var oldValue = parseInt($(document).find('div#quantity-number-'+id).text());
            // var quantity = 2;
            var price = $('#cart-item-price-'+ id).attr('data');
            // if(oldValue > 0){
                var quantity = oldValue + 1;
            // }
            var data = {
                id, quantity, price
            }
            $.ajax({
                url: "update-from-cart.php",
                type: "GET",
                data: data,
                dataType: 'json',
                success: function(reponse){
                    $(document).find('#amount').html("$"+ parseFloat(reponse.amount).toFixed(2));
                    $('span#amount').attr('value', parseFloat(reponse.amount).toFixed(2));
                    $(document).find('div#quantity-number-'+id).html(reponse.quantity);
                    $('div#quantity-number-'+id).attr('value', reponse.quantity);
                    // $(document).find('div#cart-item-price-'+id).html('$'+ parseFloat(reponse.price*reponse.quantity).toFixed(2));
                    // $('div#cart-item-price-'+id).attr('value', parseFloat(reponse.price*reponse.quantity).toFixed(2));
                    console.log(reponse);
                }
            })
        })
    </script>
</body>
</html>
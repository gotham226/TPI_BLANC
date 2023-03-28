<?php

session_start();
require_once ('./php/user.php');
require_once('./php/utilitaire.php');
require_once('./php/panier.php');
require_once('./php/caps.php');

if(!isset($_SESSION['admin'])){
    header("Location: index.php");
    exit;
}
$message = "";
$orders = TakeAllOrders();

?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>CapShop</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    </head>
    <body>
        <!-- Navigation-->
        <?php
            require_once('./php/nav.php');
        
        ?>
        <!-- Header-->
        <header class="bg-dark py-5">
            <div class="container px-4 px-lg-5 my-5">
                <div class="text-center text-white">
                    <h1 class="display-4 fw-bolder">Gestion des commandes</h1>
                    <p class="lead fw-normal text-white-50 mb-0">Page admin des commandes</p>
                </div>
            </div>
        </header>
        <!-- Section-->
        <section class="py-5">
            <div class="container px-4 px-lg-5 mt-5" style="margin-bottom:5%;">
            
                <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                    
                    
                </div>
            </div>
            <?php
                            if($message == "Votre mot de passe a bien été modifier !"){
                                echo "<span style=\"color:green;margin-left:44%;\">$message</span>";
                            }else{
                                echo "<span style=\"color:red;margin-left:44%;\">$message</span>";
                            }
                        
                        if($orders != null){

                        
                        ?>
                        
                <h1 style="margin-left:40%;">Toutes les commandes du site </h1>
                <?php } ?>
                <br>
                <?php
                    foreach($orders as $order){
                        
                        $prixTotal = 0;
                        $idOrder = $order['id_order'];
                        $isConfirmed = $order['is_confirmed'];
                        echo "<div class=\"bg-dark\"style=\"width: 60%;color:white; margin-left:20%;padding: inherit; border-radius: 20px; margin-bottom: 2%;\">";
                        
                        echo "<div style=\"margin-left:5%;\">";
                        echo "<h5> Commande numéro :$idOrder </h5>";
                        echo "<br>";
                        echo "<h5>Date de la commande: " . $order['order_date']. "</h5>";
                        echo "</div><br>";
                        
                        $ordersCaps = TakeOrderById($idOrder);
                        foreach($ordersCaps as $orderCap){
                            $quantityOfOneCap = $orderCap['quantity'];
                            $unitPrice = $orderCap['unit_price'];

                            $cap = SelectProductById($orderCap['id_cap']);
                            $capBrand = $cap['brand'];
                            $capmodel = $cap['model'];
                            $image = $cap['image'];

                            $prixTotalDuneCasquette = $quantityOfOneCap * $unitPrice;
                            $prixTotal += $prixTotalDuneCasquette;
                        ?>
                            <div class="col mb-5" style="width: 90%;color:black; background-color: white; height:5%; border-radius: 20px;margin-left:5%;" >
                            
                                <!-- Product image-->
                                <ul style="display: inline-flex;list-style: none; flex-direction: row;">
                                    <li><img class="card-img-top" src="./img/<?=$image?>" alt="..." style="width:14rem;height:95%;margin-top:5%;" /></li>
                                    <li>
                                        <ul style="list-style: none; margin-top:5%;">
                                            
                                            <li><?="Marque: " . $capBrand?></li>
                                            <br>
                                            <li><?="Modèle: " . $capmodel?></li>
                                            <br>
                                            <li><?="Prix unitaire: " . $unitPrice . " CHF"?></li>
                                            <br>
                                            <li><?="Quantité: " . $quantityOfOneCap?></li>
                                            <br>
                                            <li><?="Prix Total: " . $prixTotalDuneCasquette . " CHF"?></li>
                                        </ul>
                                    </li>
                                </ul>
                                
                                <!-- Product details-->
                                        <!-- Product name-->
                                        <h5 class="fw-bolder"></h5>
                                        <!-- Product price-->
                                        
                            </div>
                        <?php
                    }
                    ?>
                    <div class="col mb-5" style="width: 90%;color:black; background-color: white; height:5%; border-radius: 20px;margin-left:5%;" >
                                
                        <!-- Product image-->
                        <ul style="display: inline-flex;list-style: none; flex-direction: row;">
                            <li>
                                <ul style="list-style: none; margin-top:5%;">
                                    <li><h3>Résumé</h3></li>
                                    <li><h5>Prix total de la commande: </h5> <h5><?=$prixTotal. " CHF"?></h5></li>
                                    <br>
                                    <li><h5>Etat commande: </h5><?php if($isConfirmed == 1){echo "<h5 style=\"color:green;\">Confirmé</h5";}else{echo "<h5 style=\"color:red;\">Non confirmé</h5";} ?></li>
                                    <br>
                                </ul>
                            </li>
                        </ul>
                        
                        <!-- Product details-->
                                <!-- Product name-->
                                <h5 class="fw-bolder"></h5>
                                <!-- Product price-->
                        </div>
                        <p style="margin-left: 47%;">
                        <?php
                        
                            echo "<a href=\"deleteOrder.php?idOrder=$idOrder\"> <button  style=\" color: red; background-color: #0a78df00; border: none;\"  class=\"material-icons button delete\">delete</button> </a></div>";
                                
                        ?>  
                        </p>
                </div>
                <?php
                
                }
                
                
                ?>
        </section>
        <!-- Footer-->
        <footer class="py-5 bg-dark">
            <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Gabriel Martin</p></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        
    </body>
</html>

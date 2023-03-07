<?php
session_start();

require_once('./php/caps.php');
require_once('./php/panier.php');
$cap = SelectProductById($_GET['idCap']);
$products = SelectProductLikeBrand($cap['brand']);

$quantity = filter_input(INPUT_POST, 'quantity', FILTER_DEFAULT);

if(isset($_POST['submit'])){
    if($quantity != 0 && $quantity !=null){
        $idCap = $cap['id_cap'];
        
        ajoutDansLePanier($idCap, $quantity);
    }

}



?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Shop Item - Start Bootstrap Template</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    </head>
    <body>
        <!-- Navigation-->
        <?php
            require_once('./php/nav.php');
        
        ?>
        <!-- Product section-->
        <section class="py-5">
            <div class="container px-4 px-lg-5 my-5">
                <div class="row gx-4 gx-lg-5 align-items-center">
                    <div class="col-md-6"><img class="card-img-top mb-5 mb-md-0" src="./img/<?=$cap['image']?>" alt="..." /></div>
                    <div class="col-md-6">  
                        <h1 class="display-5 fw-bolder"><?=$cap['model']?></h1>
                        <span> <b><?=$cap['brand']?></b></span>
                        <div class="fs-5 mb-5">
                            <span><?='CHF '.$cap['price']?></span>
                        </div>
                        <p class="lead"><?=$cap['description']?></p>
                        <div class="d-flex">
                            <form action="#" method="post">
                                <input name="quantity" class="form-control text-center me-3" id="inputQuantity" type="number" value="1" style="max-width: 4rem" />
                                <button type="submit" name="submit" class="btn btn-outline-dark flex-shrink-0" type="button">
                                    <i class="bi-cart-fill me-1"></i>
                                    Add to cart
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Related items section-->
        <?php
        
        if(count($products)>1){    

        
        
        ?>
        <section class="py-5 bg-light">
            <div class="container px-4 px-lg-5 mt-5">
                <h2 class="fw-bolder mb-4">Produits similaires </h2>
                <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                    <?php
                    foreach ($products as $product ) { 

                        $idCap = $product['id_cap'];
                        if($cap['id_cap'] != $idCap){

                        
                        $prix = $product['price'];
                        $model = $product['model'];
                        $brand = $product['brand'];
                        $image = $product['image'];
                    
                    
                    
                    ?>
                        <div class="col mb-5">
                            <div class="card h-100">
                                <!-- Product image-->
                                <img class="card-img-top" src="./img/<?=$image?>" alt="..." width=100% height=100%/>
                                <!-- Product details-->
                                <div class="card-body p-4">
                                    <div class="text-center">
                                        <!-- Product name-->
                                        <h5 class="fw-bolder"><?=$model?></h5>
                                        <!-- Product price-->
                                        <?=$prix?>

                                    </div>
                                </div>
                                <br>
                                <br>
                                <!-- Product actions-->
                                <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                    <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="produit.php?idCap=<?=$idCap?>">View options</a></div>
                                </div>
                            </div>
                        </div>
                    <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </section>
        <?php  } ?>
        <!-- Footer-->
        <footer class="py-5 bg-dark">
            <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Your Website 2022</p></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>

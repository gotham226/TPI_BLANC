<?php
session_start();
require_once('./php/caps.php');
$products = selectAllProductByDate();
if(isset($_GET['trie'])){
    if($_GET['trie'] == 'date'){
        $products = selectAllProductByDate();
    }else{
        if($_GET['trie'] == 'marque'){
            $products = selectAllProductByBrand();
        }else{
            if($_GET['trie'] == 'prix'){
                $products = selectAllProductByPrice();
            }
        }
    }
}
if(isset($_GET['search']) != ""){
    $products = SelectProductLike($_GET['search']);
}

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
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
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
                    <h1 class="display-4 fw-bolder"><?php if(isset($_SESSION['username'])){echo "Salut " . $_SESSION['username'];}else{echo "CapShop";}?></h1>
                    <p class="lead fw-normal text-white-50 mb-0">les casquettes du moment</p>
                    <br>
                    <br>
                    <form action="index.php" class="search" method="get">
                            <input class="searchInput" type="search" name="search" required href="inscripion.php">
                            <i class="fa fa-search"></i>
                            <a href="javascript:void(0)" id="clear-btn">Clear</a>
                    </form>
                </div>
            </div>
        </header>
        <!-- Section-->
        <section class="py-5">
            <!-- Filtre -->
            
            <div class="container px-4 px-lg-5 mt-5">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Filtrer</a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="index.php?trie=date">Date</a> </li>
                        <li><a class="dropdown-item" href="index.php?trie=prix">Prix</a></li>
                        <li><a class="dropdown-item" href="index.php?trie=marque">Marque</a></li>
                    </ul>

                </li>
            </ul>
                <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center" style="margin-top:2%;">
                
                    <?php
                    foreach ($products as $product) {
                        $idCap = $product['id_cap'];
                        $price = $product['price'];
                        $quantity = $product['quantity'];
                        $brand = $product['brand'];
                        $model = $product['model'];
                        $description = $product['description'];
                        $image = $product['image'];
                    ?>
                    <div class="col mb-5">
                        <div class="card h-100">
                            <!-- Product image-->
                            <img class="card-img-top" src="./img/<?=$image?>" alt="..." width=100% height=35%/>
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder"><?=$model?></h5>
                                    <!-- Product price-->
                                    
                                    <?=$brand?>
                                    <br>
                                    <?="CHF ".$price?>
                                    
                                    <p style="margin-top: 20%;" ><?=$description?></p>
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="produit.php?idCap=<?=$idCap?>">Voir le produit</a></div>
                            </div>
                        </div>
                    </div>
                    <?php

                    }
                    
                    ?>
                    
                </div>
            </div>
        </section>
        <!-- Footer-->
        <footer class="py-5 bg-dark">
            <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Gabriel Martin</p></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <script>const clearInput = () => {
                        const input = document.getElementsByTagName("input")[0];
                        input.value = "";
                        }

                        const clearBtn = document.getElementById("clear-btn");
                        clearBtn.addEventListener("click", clearInput);
        </script>
        <!-- Core theme JS-->
        
    </body>
</html>

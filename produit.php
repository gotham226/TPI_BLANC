<?php
session_start();

require_once('./php/caps.php');
require_once('./php/panier.php');
$cap = SelectProductById($_GET['idCap']);

$quantity = filter_input(INPUT_POST, 'quantity', FILTER_DEFAULT);


$marque = filter_input(INPUT_POST, 'marque', FILTER_DEFAULT);
$model = filter_input(INPUT_POST, 'model', FILTER_DEFAULT);
$prix = filter_input(INPUT_POST, 'prix', FILTER_VALIDATE_FLOAT);
$description = filter_input(INPUT_POST, 'description', FILTER_DEFAULT);
$quantity2 = filter_input(INPUT_POST, 'quantity2', FILTER_DEFAULT);

if(isset($_POST['modifier'])){

    if($marque != "" && $model != "" && $prix != "" && $description != "" && $quantity2 !=""){
        if($_FILES['fichier']['name'][0] != ""){

            if($_FILES['fichier']['size'][0] <= 3000000){
            
                $typeMedia = $_FILES['fichier']['type'][0];
                $extensionsFichier = substr(strrchr($_FILES['fichier']['name'][0],'.'),1);
                
                if($typeMedia==""){
                    $typeMedia= "image/".$extensionsFichier;
                }
                
                // Test si le fichier est bien une image
                if($typeMedia=="image/png" || $typeMedia=="image/jpeg" || $typeMedia=="image/jpg"){
                    
                    $dateDuPost = date( "Y-m-d H:i:s");
                    $nomImage = $_FILES['fichier']['name'][0].$dateDuPost.".".$extensionsFichier;
                    $oldNameImage = $cap['image'];
                    $message = UpdateCap($oldNameImage, $nomImage, $model, $marque, $description, $prix, $quantity2, $_GET['idCap'], $_FILES['fichier']);
    
                }else{
                    $message = "Le fichier ".$_FILES['fichier']['name'][0]." n'est pas une image";
                }
            }else{
                $message = "Le fichier ".$_FILES['fichier']['name'][0]." est trop volumineux";
            }
        
        }else{
            $message = UpdateCapWhitoutImage($model, $marque, $description, $prix, $quantity2, $_GET['idCap']);
        }
        
    }else{
        $message = "Tout les champs ne sont pas renseigner";
    }
}

$cap = SelectProductById($_GET['idCap']);
$products = SelectProductLikeBrand($cap['brand']);

if(isset($_POST['submit'])){
    if($quantity != 0 && $quantity !=null){
        $idCap = $cap['id_cap'];
        var_dump("asdasd");
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

            if(isset($_SESSION['admin']) == true){
                ?>

                <section class="py-5">
                    <div class="container px-4 px-lg-5 my-5">
                    <form action="#" method="post" enctype="multipart/form-data" >
                        <div class="row gx-4 gx-lg-5 align-items-center">
                        
                            <div class="col-md-6"><img class="card-img-top mb-5 mb-md-0" src="./img/<?=$cap['image']?>" alt="..." /><input class="glyphicon glyphicon-upload" type="file" name="fichier[]"  accept="image/png, image/jpeg, image/jpg"></div>
                            <div class="col-md-6">  
                                <label for="model">Model: </label>
                                <input type="text" name="model" value="<?=$cap['model']?>">

                                <label for="model">Marque:  </label>
                                <input type="text" name="marque" value="<?=$cap['brand']?>">
                                <div class="fs-5 mb-5">
                                    <label for="price">Prix: </label>
                                    <input type="number" name="prix" value="<?=$cap['price']?>" step="0.05">
                                    <br>
                                    <label for="Quantity">Quantité: </label>
                                    <input type="number" name="quantity2" value="<?=$cap['quantity']?>" >
                                </div>
                                <label for="description">Description: </label>
                                <input type="text" name="description" value="<?=$cap['description']?>">
                                    <button type="submit" name="modifier" class="btn btn-outline-dark flex-shrink-0" type="button">Modifier</button>
                                    <a href="deleteCap.php?idCap=<?=$cap['id_cap']?>"> <button type="button" name="supprimer" class="btn btn-outline-dark flex-shrink-0" type="button">Supprimer</button></a>
                            </div>
                        </div>
                    </form>
                    </div>
                </section>

        <?php
            }else{

            
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
            }
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

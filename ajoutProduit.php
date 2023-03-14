<?php

session_start();
require_once ('./php/user.php');
require_once('./php/utilitaire.php');
require('./php/caps.php');

$marque = filter_input(INPUT_POST, 'marque', FILTER_DEFAULT);
$model = filter_input(INPUT_POST, 'model', FILTER_DEFAULT);
$prix = filter_input(INPUT_POST, 'prix', FILTER_DEFAULT);
$description = filter_input(INPUT_POST, 'Description', FILTER_DEFAULT);
$quantity = filter_input(INPUT_POST, 'quantity', FILTER_DEFAULT);

$error ="";

if(isset($_POST['ajouter'])){
    if($marque != "" && $model != "" && $prix != "" && $description != "" && $_FILES['fichier'] != [] && $quantity !=""){
        
        if($_FILES['fichier']['size'][0] <= 3000000){
            
            $typeMedia = $_FILES['fichier']['type'][0];
            $extensionsFichier = substr(strrchr($_FILES['fichier']['name'][0],'.'),1);

            if($typeMedia==""){
                $typeMedia= "image/".$extensionsFichier;
            }
            
            // Test si le fichier est bien une image
            if($typeMedia=="image/png" || $typeMedia=="image/jpeg" || $typeMedia=="image/jpg"){
                var_dump($_FILES['fichier']['size']);
                $dateDuPost = date( "Y-m-d H:i:s");
                $nomImage = $_FILES['fichier']['name'][0].$dateDuPost.".".$extensionsFichier;
                var_dump($_POST);
                $message = AddProduct($nomImage, $model, $marque, $description, $prix, $quantity, $_FILES['fichier']);

            }else{
                $message = "Le fichier ".$_FILES['fichier']['name'][0]." n'est pas une image";
                
            }
        }
    }
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
                    <h1 class="display-4 fw-bolder">Ajouter une casquette</h1>
                    <p class="lead fw-normal text-white-50 mb-0">Page admin ajout de produit</p>
                </div>
            </div>
        </header>
        <!-- Section-->
        <section class="py-5">
            <div class="container px-4 px-lg-5 mt-5">
                <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                    
                    <form action="#" method="post" enctype="multipart/form-data">
                        <label for="Marque">Marque :</label>
                        <br>
                        <input type="text" name="marque">
                        <br>
                        <label for="Model">Model :</label>
                        <br>
                        <input type="text" name="model">
                        <br>
                        <label for="Prix">Prix :</label>
                        <br>
                        <input type="number" name="prix" step="0.05">
                        <label for="quantity">Quantié :</label>
                        <br>
                        <input type="number" name="quantity">
                        <br>
                        <label for="Description">Description</label>
                        <br>
                        <input type="text" name="Description">
                        <br>
                        <input class="glyphicon glyphicon-upload" type="file" name="fichier[]"  accept="image/png, image/jpeg, image/jpg">
                        <p style="color:red;"> <?=$error?> </p>
                        <button type="submit" name="ajouter" class="btn btn-outline-dark mt-auto" style="width:100%;">Ajouter</button>
                        
                    </form>
                    
                </div>
            </div>
        </section>
        <!-- Footer-->
        <footer class="py-5 bg-dark">
            <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Gabriel Martin</p></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        
    </body>
</html>

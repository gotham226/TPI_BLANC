<?php
session_start();
require_once('./php/caps.php');
$priceTotalCart = 0;
$message = "";

if(isset($_POST['submit'])){
    $_SESSION['panier']['totalItems']=0;

    foreach ($_SESSION['panier'] as $key => $value) {
        if($key!='totalItems'){
            $cap = SelectProductById($key);
            $idCap = $key;
            $nbCap = filter_input(INPUT_POST, "quantity$idCap");
            $_SESSION['panier'][$cap['id_cap']] = $nbCap;
            $_SESSION['panier']['totalItems'] += $nbCap;
        }
    }
    
}
if(isset($_GET['idCap']) && $_GET['idCap'] != "" ){
    $_SESSION['panier']['totalItems'] = $_SESSION['panier']['totalItems'] - $_SESSION['panier'][$_GET['idCap']];
    $_SESSION['panier'][$_GET['idCap']] = 0;
    unset($_SESSION['panier'][$_GET['idCap']]);
}

if(isset($_GET['commander']) == true){
    $message = "Votre commande a été éffectuer !";
    $_GET['commander'] == false;
    $_SESSION['panier'] = [];
}else{
    $message ="";
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
        
        <section class="h-100 h-custom" style="background-color: white;">
            <div class="container py-5 h-100" >
                <div class="row d-flex justify-content-center align-items-center h-100" >
                <div class="col-12">
                    <div class="card card-registration card-registration-2" style="border-radius: 15px;" >
                    <div class="card-body p-0" style="background-color: rgba(var(--bs-light-rgb)">
                        <div class="row g-0">
                        <div class="col-lg-8">
                            <div class="p-5">
                            <div class="d-flex justify-content-between align-items-center mb-5">
                                <h1 class="fw-bold mb-0 text-black">Panier</h1>
                                <h6 class="mb-0 text-muted"><?php if(isset($_SESSION['panier']['totalItems'])){echo $_SESSION['panier']['totalItems'];}else{echo "0";}?> items</h6>
                            </div>
                            
                            <form action="panier.php" method="post">
                            <?php
                            if(isset($_SESSION['panier'])){

                            
                            foreach ($_SESSION['panier'] as $key => $value) {
                                if($key!='totalItems'){
                                    $cap = SelectProductById($key);
                                    $priceTotalCap = $cap['price'] * $_SESSION['panier'][$cap['id_cap']];
                                    $priceTotalCart += $priceTotalCap;
                                    $quantity = $_SESSION['panier'][$cap['id_cap']];
                                    $idCap = $key;
                                ?>
                                    <hr class="my-4">

                                        <div class="row mb-4 d-flex justify-content-between align-items-center">
                                            <div class="col-md-2 col-lg-2 col-xl-2">
                                            <img
                                                src="./img/<?=$cap['image']?>"
                                                class="img-fluid rounded-3" alt="Cotton T-shirt">
                                            </div>
                                            <div class="col-md-3 col-lg-3 col-xl-3">
                                            <h6 class="text-muted"><?=$cap['brand']?></h6>
                                            <h6 class="text-black mb-0"><?=$cap['model']?></h6>
                                            </div>
                                            <div class="col-md-3 col-lg-3 col-xl-2 d-flex">
                                            <button class="btn btn-link px-2" type="button"
                                                onclick="this.parentNode.querySelector('input[type=number]').stepDown()">
                                                <i class="fas fa-minus"></i>
                                            </button>

                                            <?php
                                                echo "<input id=\"quantity$idCap\" min=\"0\" name=\"quantity$idCap\" value=\"$quantity\" type=\"number\"
                                                class=\"form-control form-control-sm\" style=\"width: 3rem;\"/>";
                                                ?>

                                            <button class="btn btn-link px-2" type="button"
                                                onclick="this.parentNode.querySelector('input[type=number]').stepUp()">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                            </div>
                                            <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                                            <h6 class="mb-0"><?=$priceTotalCap?> CHF</h6>
                                            </div>
                                            <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                                            <a href="panier.php?idCap=<?=$idCap?>" class="text-muted"><i class="fas fa-times"></i></a>
                                            </div>
                                        </div>

                                <?php
                                    }
                                }
                            }
                            
                            
                            if(isset($_SESSION['panier']) != []){

                                echo "<button type=\"submit\" name=\"submit\" class=\"btn btn-dark btn-block btn-lg\" data-mdb-ripple-color=\"dark\">Appliquer les modifications</button>";
                            }else{
                                echo "<h3>Panier vide</h3>";
                            }
                            ?>
                            </form>
                            <div class="pt-5">
                                <h6 class="mb-0"><a href="index.php" class="text-body"><i
                                    class="fas fa-long-arrow-alt-left me-2"></i>Retour au shop</a></h6>
                            </div>
                            </div>
                        </div>
                        <div class="col-lg-4 bg-grey">
                            <div class="p-5">
                            <h3 class="fw-bold mb-5 mt-2 pt-1">Résumé</h3>
                            <hr class="my-4">

                            

                            <div class="d-flex justify-content-between mb-5">
                                <h5 class="text-uppercase">Prix total</h5>
                                <h5><?=$priceTotalCart?> CHF</h5>
                            </div>

                            <?php
                            if(isset($_SESSION['panier']) != []){
                                echo "<span style=\"color:green\"> $message </span>";
                            if(isset($_SESSION['username'])){
                                echo " <a href=\"commander.php\"> <button type=\"button\" name=\"commander\" class=\"btn btn-dark btn-block btn-lg\"
                                data-mdb-ripple-color=\"dark\">Commander</button> </a>";
                            }else{
                                
                                echo "<h6>Connectez-vous pour commander !</h6> <a href=\"inscription.php\">
                                <button type=\"button\" class=\"btn btn-dark btn-block btn-lg\"
                                    data-mdb-ripple-color=\"dark\">Se connecter</button>
                                    </a>";
                            }
                            }
                            
                            
                            ?>
                            
                            

                            </div>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
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
        <script src="./js/script.js"></script>
        <!-- Core theme JS-->
        
    </body>
</html>



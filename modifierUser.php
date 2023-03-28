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
if(isset($_GET['idUser'])){
    $user = TakeUserById($_GET['idUser']);
}

$admin = filter_input(INPUT_POST, 'admin', FILTER_DEFAULT);
$actif = filter_input(INPUT_POST, 'actif', FILTER_DEFAULT);
$email = filter_input(INPUT_POST, 'email', FILTER_DEFAULT);
$username = filter_input(INPUT_POST, 'username', FILTER_DEFAULT);

if(isset($_POST['modifier'])){
    
    updateUserAdmin($email, $actif, $username, $admin, $_GET['idUser']);

    header("Location: userAdmin.php");
    exit;
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
                    <h1 class="display-4 fw-bolder">Gestion des utilisateurs</h1>
                    <p class="lead fw-normal text-white-50 mb-0">Page admin des utilisateurs</p>
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
                        
                        
                        ?>
                <h1 style="margin-left:45%;">Utilisateurs du site </h1>
                <br>
                <?php
                        
                        
                        $idUser = $user['id_user'];
                        $username = $user['username'];
                        $email = $user['email'];
                        $actif = $user['actif'];
                        $admin = $user['admin'];

                        echo "<div class=\"bg-dark\"style=\"width: 60%;color:white; margin-left:20%;padding: inherit; border-radius: 20px; margin-bottom: 2%;\">";
                        
                        echo "<div style=\"margin-left:5%;\">";
                        echo "<h5> Utilisateurs numéro :" . $idUser . "</h5>";
                        
                        echo "</div><br>";
                            ?>
                            <div class="col mb-5" style="width: 90%;color:black; background-color: white; height:5%; border-radius: 20px;margin-left:5%;" >
                            
                                
                                <ul style="display: inline-flex;list-style: none; flex-direction: row; width: 100%;">
                                    <li>
                                        <ul style="list-style: none; margin-top:5%; width: 100%;">
                                            <form action="#" method="post">

                                                <li><label for="pet-select">Username: </label></li>
                                                <li><input type="text" name="username" value="<?=$username?>"></li>

                                                <li><label for="pet-select">Email: </label></li>
                                                <li><input style="width:100%;"type="email" name="email" value="<?=$email?>"></li>

                                                <li><label for="actif">Actif: </label></li>
                                                <li>
                                                    <?php if($actif ==1){?>
                                                        <select name="actif" >
                                                            <option value="1">Oui</option>
                                                            <option value="0">Non</option>
                                                        </select>
                                                    <?php }else{?>

                                                        <select name="actif" >
                                                            <option value="0">Non</option>
                                                            <option value="1">Oui</option>
                                                        </select>

                                                        <?php
                                                    } ?>
                                                </li>
                                                
                                                <br>
                                                <li><label for="admin">Admin: </label></li>
                                                <li>
                                                    <?php if($admin ==1){?>
                                                        <select name="admin" >
                                                            <option value="1">Oui</option>
                                                            <option value="0">Non</option>
                                                        </select>
                                                    <?php }else{?>

                                                        <select name="admin" >
                                                            <option value="0">Non</option>
                                                            <option value="1">Oui</option>
                                                        </select>

                                                        <?php
                                                    } ?>
                                            </li>
                                                    <br>

                                            <button class="btn btn-outline-dark mt-auto" type="submit" name="modifier">Valider</button>
                                            </form>
                                        </ul>
                                    </li>
                                </ul>
                            
                                    
                            </div>  ?>
                            
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

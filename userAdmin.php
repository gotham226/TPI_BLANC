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
$users = TakeAllUser();

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
                    foreach($users as $user){
                        
                        
                        $idUser = $user['id_user'];
                        $username = $user['username'];
                        $email = $user['email'];
                        $actif = $user['actif'];
                        $admin = $user['admin'];

                        echo "<div class=\"bg-dark\"style=\"width: 60%;color:white; margin-left:20%;padding: inherit; border-radius: 20px; margin-bottom: 2%;\">";
                        
                        echo "<div style=\"margin-left:5%;\">";
                        echo "<h5> Utilisateurs numéro :" . $idUser . "</h5>";
                        echo "<br>";
                        echo "<h5>Pseudo : " . $username . "</h5>";
                        echo "<br>";
                        echo "</div><br>";
                        if($actif==1){

                        
                        ?>
                        
                            <div class="col mb-5" style="width: 90%;color:white; background-color: green; height:5%; border-radius: 20px;margin-left:5%;" >
                            
                                <!-- Product image-->
                                <ul style="display: inline-flex;list-style: none; flex-direction: row;">
                                    <li>
                                        <ul style="list-style: none; margin-top:5%;">
                                            
                                            <li><?="Email: ". $email ;?></li>
                                            <br>
                                            <li><?="Actif: oui"?></li>
                                            <br>
                                            <li><?php if($admin==1){echo "Admin: oui ";}else{echo "Admin: non";}?></li>
                                        </ul>
                                    </li>
                                </ul>
                                
                                        
                            </div>
                            <?php 
                        }else{
                            ?>
                            <div class="col mb-5" style="width: 90%;color:white; background-color: red; height:5%; border-radius: 20px;margin-left:5%;" >
                            
                                
                                <ul style="display: inline-flex;list-style: none; flex-direction: row;">
                                    <li>
                                        <ul style="list-style: none; margin-top:5%;">
                                            
                                            <li><?="Email: ". $email ;?></li>
                                            <br>
                                            <li><?="Actif: non"?></li>
                                            <br>
                                            <li><?php if($admin==1){echo "Admin: oui ";}else{echo "Admin: non";}?></li>
                                        </ul>
                                    </li>
                                </ul>
                            
                                    
                            </div>

                            <?php
                        }
                                        echo "<div class=\"text-center\"> <a href=\"modifierUser.php?idUser=$idUser\" style=\"color: transparent;\"> <button  style=\" color: blue; background-color: #0a78df00; border: none;\" class=\"material-icons button edit\">edit</button> </a>";
                                        echo "<a href=\"deleteUser.php?idUser=$idUser\"> <button  style=\" color: red; background-color: #0a78df00; border: none;\"  class=\"material-icons button delete\">delete</button> </a></div>";
                            ?>
                            
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

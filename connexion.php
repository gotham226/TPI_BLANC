<?php

session_start();
require_once ('./php/user.php');
require_once('./php/utilitaire.php');
$pwd = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$error ="";


if(isset($_POST['connexion'])){

    if($pwd!="" && $email!=""){


        $result = connexionCheck($email, $pwd);

        
        if($result){
            if(password_verify($pwd,$result['password'])){

                $user = takeUsernameByEmail($email);
                if($user['actif'] == 1){
                    $_SESSION['username'] = $user['username'];
                    $_SESSION['id_user'] = $user['id_user'];
                    $_SESSION['email'] = $email;
                    
                    if($user['admin'] == 1){
                        $_SESSION['admin'] = true;
                    }else{
                        $_SESSION['admin'] = false;
                    }

                    $_SESSION['connected'] = true;
                    header('Location: index.php');
                    exit;
                }else{
                    $error="Le compte n'est pas actif";
                }
                
    
            }else{
                $error="Le mail ou le mot de passe n'est pas bon";
            }
        }
        else{
            $error="Le mail ou le mot de passe n'est pas bon";
        }
        

    }else{
        $error = "Tout les champs ne sont pas renseigner";
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
                    <h1 class="display-4 fw-bolder">CapShop</h1>
                    <p class="lead fw-normal text-white-50 mb-0">les casquettes du moment</p>
                </div>
            </div>
        </header>
        <!-- Section-->
        <section class="py-5">
            <div class="container px-4 px-lg-5 mt-5">
                <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                    
                    <form action="#" method="post">
                        <label for="email">Email :</label>
                        <br>
                        <input type="email" name="email" id="email" placeholder="dupont@email.com" value="<?=$email?>">
                        <br>
                        <label for="password">Mot de passe :</label>
                        <br>
                        <input type="password" name="password" id="password" placeholder="********">
                        <p style="color:red;"> <?=$error?> </p>
                        <button type="submit" name="connexion" class="btn btn-outline-dark mt-auto" style="width:100%;">Se connecter</button>
                        
                        <p>Tu n'a pas de compte ? <a href="./inscription.php">S'inscrire</a></p>
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

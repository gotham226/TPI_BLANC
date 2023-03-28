<?php

session_start();
require_once ('./php/user.php');
require_once('./php/utilitaire.php');

if($_GET['idUser'] == null){
	header('Location: index.php');
    exit;
}

if(isset($_POST['supprimer'])){

    DeleteUserById($_GET['idUser']);
    header('Location: userAdmin.php');
    exit;

}else{
    if(isset($_POST['annuler'])){
        header('Location: userAdmin.php');
        exit;
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
                    <h1 class="display-4 fw-bolder">Supprimer un utilsateur</h1>
                    <p class="lead fw-normal text-white-50 mb-0">Page admin suppression d'utilisateur</p>
                </div>
            </div>
        </header>
        <!-- Section-->
        <section class="py-5">
            <div class="container px-4 px-lg-5 mt-5">
                <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                    
                    <form action="#" method="post">
                        <label for="suppression">Etes-vous sur de vouloir supprimer cet utilisateur ?</label>
                        <br></br>
                        <button type="submit" name="supprimer" class="btn btn-outline-dark mt-auto" style="width:100%;">Oui</button>
                        <br></br>
                        <button type="submit" name="annuler" class="btn btn-outline-dark mt-auto" style="width:100%;">Annuler</button>
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


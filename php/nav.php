<?php
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="index.php" >CapShop</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                        <li class="nav-item" ><a class="nav-link active" aria-current="page" href="index.php">Accueil</a></li>
                        <li class="nav-item" ><a class="nav-link active" aria-current="page" href="profil.php">Profil</a></li>
                        <?php
                        if(isset($_SESSION['admin']) && $_SESSION['admin'] == true){
                            echo "<li class=\"nav-item\" ><a class=\"nav-link active\" aria-current=\"page\" href=\"commandeAdmin.php\">Gestion commande</a></li>";
                        }
                        
                        ?>
                    </ul>

                    <?php if(isset($_SESSION['username'])){ ?>
                        
                        <div class="text-center" style="margin-right: 2%;"><a class="btn btn-outline-dark mt-auto" href="./deconnexion.php">Se déconnecter</a></div>
                        
                        <?php
                        
                        }else{
                            ?>
                            <div class="text-center" style="margin-right: 2%;"><a class="btn btn-outline-dark mt-auto" href="./inscription.php">S'inscrire / Se connecter</a></div>
                            

                            <?php
                        }?>
                    <h2> | </h2>
                    
                    <a href="./panier.php" style="margin-left: 2%;"><button class="btn btn-outline-dark" type="submit">
                            <i class="bi-cart-fill me-1"></i>
                            Panier
                            <span class="badge bg-dark text-white ms-1 rounded-pill"><?php if(isset($_SESSION['panier']['totalItems'])){echo $_SESSION['panier']['totalItems'];}else{echo "0";}?></span>
                        </button>
                        </a>
                        
                    
                </div>
            </div>
        </nav>
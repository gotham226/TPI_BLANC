<?php
session_start();
require_once('./php/panier.php');
require_once('./php/caps.php');

if(!isset($_SESSION['username'])){
    header("Location: index.php");
    exit;
}

$idOrder = CreerUneCommande(0, $_SESSION['id_user']);

foreach ($_SESSION['panier'] as $key => $value) {
    if($key!='totalItems'){
        $cap = SelectProductById($key);
        $capPrice = $cap['price'];
        $quantity = $_SESSION['panier'][$cap['id_cap']];
        $idCap = $key;
        AjouterUnArticleASaCommande($idOrder, $idCap, $quantity, $capPrice);
    }
}

header('Location: panier.php?commander=true');
exit;

?>
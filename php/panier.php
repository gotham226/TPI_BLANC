<?php

require_once('database.php');

function ajoutDansLePanier($idCap, $quantity){

    if(isset($_SESSION['panier'])==""){
        $_SESSION['panier']['totalItems'] = 0;
    }

    if(isset($_SESSION['panier'][$idCap])==""){
        $_SESSION['panier'][$idCap] = 0;
    }

    $_SESSION['panier']['totalItems'] += $quantity;
    $_SESSION['panier'][$idCap] += $quantity;

}


function CreerUneCommande($is_confirmed, $idUser){

    $sql = "INSERT INTO orders(is_confirmed, order_date, id_user) VALUES (?, ?, ?);";
    $data = [            
        $is_confirmed,             
        date( "Y-m-d H:i:s"),           
        $idUser
    ];

    dbRun($sql, $data);
    
    return LastIdOrders();
}

function AjouterUnArticleASaCommande($idOrder, $idCap, $quantity, $unitPrice){
    $sql = "INSERT INTO order_caps(id_order, id_cap, quantity, unit_price) VALUES (?, ?, ?, ?);";
    $data = [            
        $idOrder,             
        $idCap,           
        $quantity,
        $unitPrice
    ];
    return dbRun($sql, $data);
}

function LastIdOrders(){
    $sql = "SELECT * FROM orders ORDER BY id_order DESC LIMIT 1";
    $data = [];
    $result = dbRun($sql, $data)->fetchAll(PDO::FETCH_ASSOC);
    return $result[0]['id_order'];
}

function TakeAllOrdersFromAUser($idUser){

    $sql = "SELECT * FROM orders WHERE id_user = ?";
    $data = [
        $idUser
    ];
    return dbRun($sql, $data)->fetchAll(PDO::FETCH_ASSOC);
}

function TakeOrderById($idOrder){
    $sql = "SELECT * FROM order_caps WHERE id_order = ?";
    $data = [
        $idOrder
    ];
    return dbRun($sql, $data)->fetchAll(PDO::FETCH_ASSOC);
}

function TakeAllOrders(){
    $sql = "SELECT * FROM orders";
    $data = [
    ];
    return dbRun($sql, $data)->fetchAll(PDO::FETCH_ASSOC);
}
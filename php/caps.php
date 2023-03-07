<?php
require_once('database.php');

function selectAllProductByDate(){
    $sql = "SELECT * FROM caps ORDER BY id_cap DESC";
    $data = [
        
    ];
    return dbRun($sql, $data)->fetchAll(PDO::FETCH_ASSOC);
}

function selectAllProductByBrand(){

    $sql = "SELECT * FROM caps ORDER BY brand";
    $data = [
        
    ];
    return dbRun($sql, $data)->fetchAll(PDO::FETCH_ASSOC);
}

function selectAllProductByPrice(){

    $sql = "SELECT * FROM caps ORDER BY price";
    $data = [
        
    ];
    return dbRun($sql, $data)->fetchAll(PDO::FETCH_ASSOC);
}

function SelectProductLike($search){
    $sql = "SELECT * FROM caps WHERE model LIKE ?";
    $data = [
        "%$search%",
    ];
    return dbRun($sql, $data)->fetchAll(PDO::FETCH_ASSOC);
}

function SelectProductById($idCap){
    $sql = "SELECT * FROM caps WHERE id_cap = ?";
    $data = [
        $idCap
    ];
    return dbRun($sql, $data)->fetch(PDO::FETCH_ASSOC);
}

function SelectProductLikeBrand($search){
    $sql = "SELECT * FROM caps WHERE brand LIKE '%$search%'";
    
    return dbRun($sql)->fetchAll(PDO::FETCH_ASSOC);
}


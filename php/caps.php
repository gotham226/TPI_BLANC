<?php
require_once('database.php');

function selectAllProduct(){
    $sql = "SELECT * FROM caps";
    $data = [
        
    ];
    return dbRun($sql, $data)->fetchAll(PDO::FETCH_ASSOC);
}
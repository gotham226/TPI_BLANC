<?php
require_once('database.php');

function registerUser($username, $email, $password){

    $sql = "INSERT INTO users(username, email, password, actif) VALUES (?, ?, ?, ?);";
        $data = [            
            $username,             
            $email,            
            $password,            
            1        
        ];
        return dbRun($sql, $data);
}

function checkIfEmailExist($email){

    $sql = "SELECT * FROM users WHERE email = ?";
    $data = [
        $email
    ];
    return dbRun($sql, $data)->fetchAll(PDO::FETCH_ASSOC);
}

function connexionCheck($email, $pwd){

    $sql = "SELECT * FROM users WHERE email = ?";
    $data = [
        $email
    ];
    return dbRun($sql, $data)->fetch(PDO::FETCH_ASSOC);
}

function takeUsernameByEmail($email){

    $sql = "SELECT * FROM users WHERE email = ?";
    $data = [
        $email
    ];
    return dbRun($sql, $data)->fetch(PDO::FETCH_ASSOC);
}

function RemplacePassword($hashPassword, $idUser){
    $sql = "UPDATE users SET password = ? WHERE id_user = ?";

    $data=[
        $hashPassword,
        $idUser
    ];
    
    dbRun($sql, $data);
}

function setInactiveUser($idUser){
    $sql = "UPDATE users SET actif = ? WHERE id_user = ?";

    $data=[
        0,
        $idUser
    ];
    
    dbRun($sql, $data);
}

function updateUser($pwd, $email, $actif, $username){
    $sql = "UPDATE users SET actif = ?, username = ?, password = ? WHERE email = ?";

    $data=[
        $actif,
        $username,
        $pwd,
        $email
    ];
    
    return dbRun($sql, $data);
}

function TakeAllUser(){
    $sql = "SELECT * FROM users ORDER BY actif DESC";
    $data = [

    ];
    return dbRun($sql, $data)->fetchAll(PDO::FETCH_ASSOC);
}

function TakeUserById($idUser){
    $sql = "SELECT * FROM users WHERE id_user = ?";
    $data = [
        $idUser
    ];
    return dbRun($sql, $data)->fetch(PDO::FETCH_ASSOC);
}

function updateUserAdmin($email, $actif, $username, $admin, $idUser){
    $sql = "UPDATE users SET actif = ?, username = ?, admin = ?, email = ? WHERE id_user = ?";

    $data=[
        $actif,
        $username,
        $admin,
        $email,
        $idUser
    ];
    
    return dbRun($sql, $data);
}

function DeleteUserById($idUser){

    $sql = "DELETE FROM favorite WHERE id_user = ?";
    $data = [
        $idUser,
    ];

    dbRun($sql, $data); 

    $sql = "SELECT id_order FROM orders WHERE id_user = ?";
    $data = [
        $idUser
    ];

    $sql = "DELETE FROM orders WHERE id_user = ?";
    $data = [
        $idUser,
    ];

    dbRun($sql, $data); 

    $idsOrders = dbRun($sql, $data)->fetch(PDO::FETCH_ASSOC);

    foreach($idsOrders as $idOrder){
        $sql = "DELETE FROM order_caps WHERE id_order = ?";
        $data = [
            $idOrder,
        ];

        dbRun($sql, $data); 
    }


    $sql = "DELETE FROM users WHERE id_user = ?";
    $data = [
        $idUser,
    ];

    dbRun($sql, $data); 

    


}
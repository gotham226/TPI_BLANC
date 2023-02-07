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

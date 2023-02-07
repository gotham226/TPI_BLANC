<?php
/**
 * Fichier contenant les fonctins pour la base de donnée
 * 
 * Gabriel Martin
 * Calendrier
 * 06.09.2022
 */

require_once("config.php");
/**
 * Permet de se connecter a la base de données
 *
 * @return PDO
 */
function connexionDB(){
    static $myDb = null;

    if($myDb == null){
        $myDb = new PDO(
            "mysql:host=". DB_HOST . ";dbname=". DB_NAME . ";charset:utf8",DB_USER, DB_PASSWORD
        );
        
        $myDb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $myDb->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    }

    return $myDb;
}

/**
 * Permet de se décpnnecter de la base de données
 *
 * @return null
 */
function deconexBase()
{
    $dbh = null;
}

/**
 * Execute les commandes SQL
 *
 * @param string $sql
 * @param array $param
 */
function dbRun($sql, $param = null){
    // Préparer la requête SQL
    $statement = connexionDB()->prepare($sql);

    // Excécuter la requête
    $statement->execute($param);

    // Retourne le PDOStatement pour lire les données dans le code après 
    return $statement;
}
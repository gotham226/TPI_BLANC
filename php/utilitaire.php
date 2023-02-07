<?php 
/**
 * Fichier contenant des fonction simple et utile
 * 
 * Gabriel Martin
 * Calendrier
 * 06.09.2022
 */

$error = "";
/**
 * Redirige a la page exigé
 *
 * @param string $page
 * @return void
 */
function goToPage($page){
    header("Location: $page");
    exit;
}

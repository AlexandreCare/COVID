<?php
    //connection a la base
    $MaBase = new PDO('mysql:host=; dbname=; charset=utf8','', '');

    include "Objets/Objets_compte.php";

    function check() {
        if($_SESSION && ( $_SESSION["Logged"] == true )) {
            return false;
        }else {
            return true;
        }
    }

    function admin() {
        if($_SESSION && ( $_SESSION["admin"] == true )) {
            return false;
        }else {
            return true;
        }
    }
?>
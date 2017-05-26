<?php
    session_start();
    //error_reporting(0);
    
    require 'database/connect.php';
    require 'functions/general.php';
    require 'functions/users.php';
    
    if(logged_in()===true){
        $session_user_id = $_SESSION['IDKORISNIKA'];
        $user_data = user_data($session_user_id,'IDKORISNIKA','KORISNICKOIME','SIFRA','IME','PREZIME','MEJL','BRFILMOVA');
    }
    
    $errors = array();
?>
<?php

    include 'core/init.php';
    
    if (empty($_POST) === false) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        
        if (empty($username)===true || empty($password)===true) {
            $errors[] = 'You need to enter a username and password!';
        } else if (user_exists($username) === false) {
            $errors[] = 'We can\'t find that username. Have you registered?';
        } else {
            
            if(strlen($password) > 20){
                $errors[] = 'Password too long';
            }
            
            $login = login ($username,$password);
            if ($login===false) {
                $errors[] = 'That username/password combination is incorrect.';
            } else{
                $_SESSION['IDKORISNIKA'] = $login;
                header('Location: index.php');
                exit();
            }
        }
    } else {
        $errors[] = 'No data received!';
    }
    
    include 'includes/overall/header.php';  
    if(empty($errors)===false) {
    ?>
        <h2>We tried to log you in, but...</h2>
    <?php
        echo output_errors($errors);
    }   
    include 'includes/overall/footer.php';
?>


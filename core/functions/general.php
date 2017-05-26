<?php
    
    function logged_in_regirect() {
        if(logged_in() === true) {
            header('Location: index.php');
            exit();
        }
    }

    function protect_page(){
        if(logged_in() === false) {
            header('Location: protected.php');
            exit();
        }
    }
    
    function array_sanitize($item) {
        $connect = @mysqli_connect('localhost','root','','ljubiteljifilmovadb') OR die("Can't connect"); 
        $item = mysqli_real_escape_string($connect, $item);
    }

    function sanitize($data) {
        $connect = @mysqli_connect('localhost','root','','ljubiteljifilmovadb') OR die("Can't connect"); 
        return mysqli_real_escape_string($connect, $data);
    }
    
    function output_errors($errors){
        return '<ul><li>' . implode('</li><li>',$errors) . '</li></ul>';
    }
?>


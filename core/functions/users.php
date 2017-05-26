<?php
    
    function register_user($register_data){
        array_walk($register_data,'array_sanitize');
        $fields = '`' . implode('`, `',array_keys($register_data)) . '`';
        $data = '\'' . implode('\', \'',$register_data) . '\'';
        $connect = @mysqli_connect('localhost','root','','ljubiteljifilmovadb') OR die("Can't connect"); 
        mysqli_query($connect, "INSERT INTO `nalog` ($fields) VALUES ($data)");
    }

    function user_count() {
        $connect = @mysqli_connect('localhost','root','','ljubiteljifilmovadb') OR die("Can't connect"); 
        return mysqli_result(mysqli_query($connect, "SELECT COUNT(`IDKORISNIKA`) FROM `nalog`"),0);
    }

    function user_data($user_id) {
        $data = array();
        $user_id = (int)$user_id;
        
        $func_num_args = func_num_args();
        $func_get_args = func_get_args();
        
        if(func_get_args() > 1) {
            unset($func_get_args[0]);
            
            $fields ='`' . implode('`, `',$func_get_args) . '`';
            $connect = @mysqli_connect('localhost','root','','ljubiteljifilmovadb') OR die("Can't connect"); 
            $data = mysqli_fetch_assoc(mysqli_query($connect,"SELECT $fields FROM `nalog` WHERE `IDKORISNIKA`=$user_id"));
            
            return $data;
        }
    }

    function logged_in() {
        return (isset($_SESSION['IDKORISNIKA'])) ? true : false;
    }

    function user_exists($username){ 
        $username = sanitize($username); 
        $connect = @mysqli_connect('localhost','root','','ljubiteljifilmovadb') OR die("Can't connect"); 
        $query = mysqli_query($connect,"SELECT IDKORISNIKA FROM `nalog` WHERE KORISNICKOIME = '$username'"); 
        return(mysqli_num_rows($query) == 1) ? true : false; 
    }
    
    function email_exists($email){ 
        $email = sanitize($email); 
        $connect = @mysqli_connect('localhost','root','','ljubiteljifilmovadb') OR die("Can't connect"); 
        $query = mysqli_query($connect,"SELECT IDKORISNIKA FROM `nalog` WHERE MEJL = '$email'"); 
        return(mysqli_num_rows($query) == 1) ? true : false; 
    }

    /*function user_id_from_username($username) { 
        $con = mysqli_connect('localhost','root','','ljubiteljifilmovadb'); 
        $username = sanitize($username); 
        return mysqli_result(mysqli_query( $connect ,"SELECT 'IDKORISNIKA' FROM `nalog` WHERE `KORISNICKOIME` = '$username'"), 0, 'IDKORISNIKA');
    }*/
    
    function mysqli_result($res, $row, $field=0) { 
        $res->data_seek($row); 
        $datarow = $res->fetch_array(); 
        return $datarow[$field]; 
    } 
    
    function user_id_from_username($username){
        $username = sanitize($username);
        $link = mysqli_connect('localhost', 'root', '', 'ljubiteljifilmovadb');
        $query = mysqli_query($link,"SELECT IDKORISNIKA FROM nalog WHERE KORISNICKOIME = '$username'");

        return mysqli_result($query,0,'IDKORISNIKA');

    }

    function login($username, $password) { 
        $user_id = user_id_from_username($username); 
        $connect = @mysqli_connect('localhost','root','','ljubiteljifilmovadb'); 
        $username = sanitize($username); 
        $password = sanitize($password); 

        return (mysqli_result(mysqli_query( $connect ,"SELECT COUNT('IDKORISNIKA') FROM `nalog` WHERE `KORISNICKOIME`='$username' AND `SIFRA`='$password'"), 0)==1) ? $user_id : false; 
    }
    
?>


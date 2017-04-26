<?php
    session_start();

    //konektovanje na bazu
    
    $db = mysqli_connect('localhost','root','','ljubiteljifilmovadb')
    or die('Error connecting to MySQL server.');
    
    if($_SERVER['REQUEST_METHOD']=='POST') {
        
        //sifre su identicne
        if($_POST['password'] == $_POST['password2']) {
            $ime = $_POST['ime'];
            $prezime = $_POST['prezime'];
            $username = $_POST['username'];
            $password = $_POST['password'];
            $email = $_POST['email'];
            
                              
            $query = "INSERT INTO nalog (ime,prezime,korisnickoime,sifra,mejl) 
                    VALUES ('$ime','$prezime','$username','$password','$email')";
    
            mysqli_query($db, $query) or die('Error querying database.');
            
            header("location: sadrzaj.php");
            
        } else {
                $_SESSION['message'] = "Sifre se ne podudaraju!";
        }
        
    }
    
    
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Register account</title>
    </head>
    <body>
        <div>
            <h1>Register</h1> 
        </div>
        
        <form method="POST" action="registracija.php">
            <table>
                <tr>
                    <td>First Name:</td>
                    <td><input type="text" name="ime" class="textInput" required</td>
                </tr>
                <tr>
                    <td>Last Name:</td>
                    <td><input type="text" name="prezime" class="textInput" required</td>
                </tr>
                <tr>
                    <td>Username:</td>
                    <td><input type="text" name="username" class="textInput" required</td>
                </tr>
                <tr>
                    <td>Password:</td>
                    <td><input type="password" name="password" class="textInput" required</td>
                </tr>
                <tr>
                    <td>Password again:</td>
                    <td><input type="password" name="password2" class="textInput" required</td>
                </tr>
                <tr>
                    <td>Email:</td>
                    <td><input type="email" name="email" class="textInput" required</td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" name="register_btn" value="Register"</td>
                </tr>
            </table>
        </form>
    </body>
</html>
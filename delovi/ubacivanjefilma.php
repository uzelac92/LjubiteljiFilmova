<?php
    session_start();

    //konektovanje na bazu
    
    $db = mysqli_connect('localhost','root','','ljubiteljifilmovadb')
    or die('Error connecting to MySQL server.');
    $opis = '';
    $trailer = '';
    if(isset($_POST['newfilm_btn'])) {

        $naziv = $_POST['naziv'];
        $trajanje = $_POST['trajanje'];
        $zanr = $_POST['uloge'];
        $uloge = $_POST['uloge'];
        $opis .= $_POST['opis'];
        $trailer .= $_POST['trailer'];
        $grad = $_POST['grad'];
        $datum = date('Y-m-d', strtotime($_POST['datum']));
        $slika = addslashes(file_get_contents($_FILES['slika']['tmp_name']));

        $query = "INSERT INTO kalendarpremijera (datumpremijere,grad) 
                VALUES ('$datum','$grad')";
        
        mysqli_query($db, $query) or die('Error querying database.');

        $query = "INSERT INTO film (idkorisnika,idpremijere,naziv,trajanje,zanr,uloge,opis,trailer,slikafilma) 
                VALUES (1,LAST_INSERT_ID(),'$naziv','$trajanje','$zanr','$uloge','$opis','$trailer','$slika')";

        mysqli_query($db, $query) or die('Error querying database.');

        //header("location: sadrzaj.php");
        
    }
    
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Register account</title>
    </head>
    <body>
        <div>
            <h1>Novi Film!</h1> 
        </div>
        
        <form method="POST" action="ubacivanjefilma.php">
            <table>
                <tr>
                    <td>Naziv: </td>
                    <td><input type="text" name="naziv" class="textInput" required</td>
                </tr>
                <tr>
                    <td>Trajanje: </td>
                    <td><input type="text" name="trajanje" class="textInput" required</td>
                </tr>
                <tr>
                    <td>Zanr: </td>
                    <td><input type="text" name="zanr" class="textInput" required</td>
                </tr>
                <tr>
                    <td>Uloge: </td>
                    <td><input type="text" name="uloge" class="textInput" required</td>
                </tr>
                <tr>
                    <td>Slika: </td>
                    <td><input type="file" name="slika"</td>
                </tr>
                <tr>
                    <td>Opis: </td>
                    <td><input type="text" name="opis" class="textInput"</td>
                </tr>
                <tr>
                    <td>Trailer: </td>
                    <td><input type="text" name="trailer" class="textInput"</td>
                </tr>
                <tr>
                    <td>Datum premijere: </td>
                    <td><input type="date" name="datum" value="" required</td>
                </tr>
                <tr>
                    <td>Grad premijere: </td>
                    <td><input type="text" name="grad" class="textInput" required</td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" name="newfilm_btn" value="Unesi"</td>
                </tr>
            </table>
        </form>
    </body>
</html>
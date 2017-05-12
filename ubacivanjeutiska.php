<?php

    session_start();
    
    $db = mysqli_connect('localhost','root','','ljubiteljifilmovadb')
        or die('Error connecting to MySQL server.');

    if(isset($_POST['search'])) {
         
        $naziv = $_POST['search'];
        $naziv = preg_replace("#[^a-zA-Z0-9-]#i", "", $naziv);
        
        $query = mysqli_query($db, "SELECT idfilma FROM film 
                WHERE naziv LIKE '%$naziv%'") or die('Error querying database.');
        
        $count = mysqli_num_rows($query);
        
        if($count == 0) {
            $output = 'Nema rezultata!';
        } else {
            while ($row = mysqli_fetch_array($query)) {
                $idfilma = $row['idfilma'];
            }
        }
        
        $idkorisnika = $_POST['identifikacija'];
        $coment = $_POST['utisak'];
        $datum = $_POST['datum'];
        
        $query = mysqli_query($db, "INSERT INTO komentar (idfilma, idkorisnika, datumkomentara,tekst) 
                    VALUES ($idfilma,$idkorisnika,'$datum','$coment')") or die('Error querying database.');
    }
    
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Comment Film</title>
    </head>
    <body>
        
        <form method="POST">
            <input type="text" name="search" placeholder="Pretraga filmova..."/>
        </form>
        
        <form method="POST" action="ubacivanjeutiska.php">
            <table>
                <tr>
                    <td>ID:</td>
                    <td><input type="text" name="identifikacija" class="textInput" required</td>
                </tr>
                <tr>
                    <td>Comment: </td>
                    <td><input type="text" name="utisak" class="textInput" required</td>
                </tr>
                <tr>
                    <td>Datum: </td>
                    <td><input type="date" name="datum" value="2012-12-31" required</td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" name="insert_comment" value="Unesi"</td>
                </tr>
            </table>
        </form>
    </body>
</html>

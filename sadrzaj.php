<?php

    session_start();
    
    $db = mysqli_connect('localhost','root','','ljubiteljifilmovadb')
        or die('Error connecting to MySQL server.');
    
    $output = '';

    if(isset($_POST['search'])) {
        $naziv = $_POST['search'];
        $naziv = preg_replace("#[^a-zA-Z0-9-]#i", "", $naziv);
        
        $query = mysqli_query($db, "SELECT naziv,trajanje,zanr,uloge,opis,trailer,slikafilma FROM film 
                WHERE naziv LIKE '%$naziv%'") or die('Error querying database.');
        
        $count = mysqli_num_rows($query);
        
        if($count == 0) {
            $output = 'Nema rezultata!';
        } else {
            while ($row = mysqli_fetch_array($query)) {
                $naziv = $row['naziv'];
                $trajanje = $row['trajanje'];
                $zanr = $row['zanr'];
                $uloge = $row['uloge'];
                $opis = $row['opis'];
                $trailer = $row['trailer'];
                $slika = $row['slikafilma'];
                
                $output .= '<table> <tr> <td> <img src="data:image/jpeg;base64,'.base64_encode($slika).'"/></td>';
                $output .= '<td> <div><br/>Naziv filma:'.$naziv.'<br/>Trajanje: '.$trajanje;
                $output .= '<br/>Zanr: '.$zanr.'<br/>Uloge: '.$uloge.'<br/>Opis: ';
                $output .= $opis.'<br/>Trailer: '.$trailer.'<br/></div> </td></tr> </table>';
            }
        }
    }
    
?>

<!DOCTYPE html>
<html>
    
    <head>
        <title>Sadržaj Filmova</title>
    </head>

    <body>
        <form method="POST" action="sadrzaj.php">
            <input type="text" name="search" placeholder="Pretraga filmova..."/>
            <input type="submit" value=">>"/>
        </form>

        <?php print("$output");?>
    </body>

</html>
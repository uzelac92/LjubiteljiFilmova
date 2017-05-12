<?php

    session_start();
    
    $db = mysqli_connect('localhost','root','','ljubiteljifilmovadb')
        or die('Error connecting to MySQL server.');
    
    $output = '';

    if(isset($_POST['datepickerID'])) {
        $datum = $_POST['datepickerID'];
        
        $query = mysqli_query($db, "SELECT idpremijere FROM kalendarpremijera
                WHERE datumpremijere='$datum'") or die('Error querying database.');
        
        $count = mysqli_num_rows($query);
        
        if($count == 0) {
            $output = 'Nema rezultata!';
        } else {
            while ($row = mysqli_fetch_array($query)) {
                $idpremijere = $row['idpremijere'];
            }
        }
        
        $query = mysqli_query($db, "SELECT naziv,trajanje,zanr,uloge,opis,trailer,slikafilma FROM film 
                WHERE idpremijere=$idpremijere") or die('Error querying database.');
        
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
        <title>Premijera Filma</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="jquery-ui-1.9.2.custom.css"/>
        <script type="text/javascript" src="jquery-1.8.3.js"></script>
        <script type="text/javascript" src="jquery-ui-1.9.2.custom.min"></script>
        
        <script type="text/javascript">
            $("document").ready(function(){
                
                $("#datepickerID").datepicker({
                    changeYear: true,
                    changeMonth: true,
                    dateFormat: 'yy-mm-dd'
                });
                
            });
        </script>
    </head>
    <body>
        <form id="form1" method="post" action="">
            <label for="datepickerID"></label>
            <input type="text" name="datepickerID" id="datepickerID"/>
            <input type="submit" value=">>"/>
        </form>
        
        <?php print("$output");?>
    </body>
</html>
<?php

    session_start();
    
    $db = mysqli_connect('localhost','root','','ljubiteljifilmovadb')
        or die('Error connecting to MySQL server.');
    
    $output = '';

    $query = mysqli_query($db, "select * from temaforuma") or die('Error querying database.');
        
    $count = mysqli_num_rows($query);
        
    if($count == 0) {
            $output = 'Nema rezultata!';
    } else {
        while ($row = mysqli_fetch_array($query)) {
            $IDkorisnika = $row['idkorisnika'];
            $IDteme = $row['idteme'];
            $datumTeme = $row['datumteme'];
            $txtTeme = $row['tekstteme'];
            
            $output .= '<form method="POST" action="novatema.php?id='.$IDkorisnika.'">';
            $output .= '<input type="submit" value="Nova tema"/></form>';

            $output .= '<form method="post" action="editforum.php?id="'.$IDteme.'>';
            $output .= '<a href="temaforuma.php?id="'.$IDteme.'">'.$txtTeme.'</a>';
            $output .= '<br>'.$datumTeme.'<br>';
            $output .= '<input type="submit" value="Edituj"/>';
            $output .= '</form>';

        }
    }        
    
?>

<!DOCTYPE html>
<html>
    
    <head>
        <title>Forum</title>
    </head>

    <body>
        <?php print("$output");?>
    </body>

</html>
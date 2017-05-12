<?php
    
    $IDteme = $_GET['id'];
    
    $db = mysqli_connect('localhost','root','','ljubiteljifilmovadb')
        or die('Error connecting to MySQL server.');
    
    if(isset($_POST['dodaj'])) {
        $odgovor = $_POST['search'];
        
        $query = mysqli_query($db, "SELECT * FROM komentarteme WHERE idteme='$IDteme'") 
                or die('Error querying database.');
        
        $count = mysqli_num_rows($query);
        
        if($count == 0) {
            $output = 'Nema rezultata!';
        } else {
            while ($row = mysqli_fetch_array($query)) {
                $komentar = $row['tekstcoment'];
                
                $output .= $komentar.'<br>';
            }
        }
    }

?>

<!DOCTYPE html>
<html>
    
    <head>
        <title>Odgovori teme</title>
    </head>

    <body>
        <?php print("$output");?>
        
        <form method="POST">
            <textarea rows="4" type="text" name="dodaj" placeholder="Unesi odgovor..."/><br>
            <input type="submit" value="Submit"/>
        </form>
                
    </body>

</html>
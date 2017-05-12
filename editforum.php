<?php
    
    $IDteme = $_GET['id'];

    $db = mysqli_connect('localhost','root','','ljubiteljifilmovadb')
        or die('Error connecting to MySQL server.');

    $output = '';

    $query = mysqli_query($db, "SELECT * FROM temaforuma WHERE idteme='$IDteme'") 
                or die('Error querying database.');

    $count = mysqli_num_rows($query);

    if($count == 0) {
        $output = 'Nema rezultata!';
    } else {
        while ($row = mysqli_fetch_array($query)) {
            $IDkorisnika = $row['idkorisnika'];
            $IDteme = $row['idteme'];
            $datumTeme = $row['datumteme'];
            $txtTeme = $row['tekstteme'];
        }
    }
    
    function updateDB() {
        
        $datum = $_POST['datepickerID'];
        $tekst = $_POST['txtTeme'];
        mysqli_query($db, "UPDATE temaforuma SET datumteme='$datum',tekstteme='$tekst'"
                . " WHERE idkorisnika='$IDkorisnika',idteme='$IDteme'") 
                    or die('Error querying database.');
    }
    
    if(isset($_POST['update'])) {
        updateDB();
    }
?>
<!DOCTYPE html>
<html>
    
    <head>
        <title>Edit Tema</title>
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
        <form id="form1" method="post">
            <textarea rows="4" name="txtTeme" value=<?php $txtTeme?> required/><br>
            <label for="datepickerID"></label>
            <input type="text" name="datepickerID" value=<?php $datumTeme?> id="datepickerID" required/>
            <br><input type="submit" name="delete" value="Izbrisi Temu"/>;
            <input type="submit" name="update" value="Promeni Temu"/>
        </form>
    </body>

</html>
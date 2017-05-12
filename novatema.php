<?php

    $ID = $_GET['id'];
    
    $db = mysqli_connect('localhost','root','','ljubiteljifilmovadb')
        or die('Error connecting to MySQL server.');
    
    if(isset($_POST['insert'])) {
        $tekst = $_POST['tekst'];
        $datum = $_POST['datepickerID'];
        
        $query = "INSERT INTO temaforuma (idkorisnika,datumteme,tekstteme) 
                    VALUES ('$ID','$datum','$tekst')";
        
        mysqli_query($db, $query) or die('Error querying database.');
    }

?>

<html>
    <head>
        <title>Nova tema</title>
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
            <input type="text" name="datepickerID" id="datepickerID"/><br>
            <textarea rows="4" name="tekst" placeholder="Unesi temu..."/><br>
            <input type="submit" name="insert" value="Insert"/>
        </form>
    </body>
</html>
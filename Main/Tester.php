
<?php 
require_once('database_helpers/config.inc.php'); 
require_once('database_helpers/DatabaseHelper.php');

try{
    $conn = Databasehelper::createConnection(array(DBCONNSTRING,DBUSER,DBPASS));
    $artGateway = new ArtistDB($conn);
    $artist = $artGateway->getAll();

    }catch(Exception $e){$e->getMessage();}
?>
 <!DOCTYPE html> 
 <html> 
    <body> 
        <h1>Database Tester</h1> 
        Artist: </br>
                <?php
                foreach($artist as $row){
                    echo $row['artist_name'] . "</br>";
                }
                ?>
      
    </body>
</html>
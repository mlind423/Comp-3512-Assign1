<?php 
require_once('database_helpers/config.inc.php'); 
require_once('database_helpers/DatabaseHelper.php');
try{
    $conn = Databasehelper::createConnection(array(DBCONNSTRING,DBUSER,DBPASS));
    $musicGateway = new MusicDB($conn);
    //$music = $musicGateWay->getAll();
    
    if(!empty($_GET['songID'])){
        $song = $musicGateway->getSong($_GET['songID']);
      }else{
        $song = $musicGateway->getSong(1001);//will be set to the first song in the database unless otherwise specified
      }

    }catch(Exception $e){$e->getMessage();}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div>
        <table> 
                <?php //used a table since I was originally displaying every item in the database in the page 
                foreach($song as $row){ //TODO change this from being in a table once we start styling
                    echo "<tr>"; 
                    echo "<td>" . $row['title']  . ' </td>'; 
                    echo "<td>" . $row['artist_name']  . ' </td>';  
                    echo "<td>" . $row['type_name']  . ' </td>';
                    echo "<td>" . $row['genre_name']  . ' </td>'; 
                    echo "<td>" . $row['year']  . ' </td>'; 
                    echo "<td>" . $row['duration']  . ' </td>'; 
                    echo "</tr>";
                }
                ?>
                
        </table>

    </div>
    <div>
        <ul>
            <?php foreach($song as $row){?> <!-- TODO Change this format once we start styling-->
                <li>bpm, <?= $row['bpm']?></li>
                <li>energy, <?= $row['energy']?></li>
                <li>danceability, <?= $row['danceability']?></li>
                <li>liveness, <?= $row['liveness']?></li>
                <li>valence, <?= $row['valence']?></li>
                <li>acousticness, <?= $row['acousticness']?></li>
                <li>speechiness, <?= $row['speechiness']?></li>
                <li>popularity, <?= $row['popularity']?></li>
            <?php }?>
        </ul>
    </div>
</body>
</html>
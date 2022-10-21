<?php 
require_once('database_helpers/config.inc.php'); 
require_once('database_helpers/DatabaseHelper.php');
try{
    $conn = Databasehelper::createConnection(array(DBCONNSTRING,DBUSER,DBPASS));
    $musicGateway = new MusicDB($conn);
    
    if(!empty($_GET['songID'])){
        $song = $musicGateway->getSong($_GET['songID']);
      }else{
        $song = $musicGateway->getSong(1001);//will be set to the first song in the database unless otherwise specified
      }
      $conn = null;
    }catch(Exception $e){$e->getMessage();}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/primary.css">
    <title>Song Info</title>
</head>
<body>
    <?php include('Header.php')?>
    <div class="content">
        <table class="songInfo"> 
            <tr>
                <th>Title</th>
                <th>Artist</th>
                <th>Artist Type</th>
                <th>Genre</th>
                <th>Year</th>
                <th>Length</th>
            </tr>
                <?php //used a table since I was originally displaying every item in the database in the page 
                foreach($song as $row){ //TODO change this from being in a table once we start styling
                    $length = $row['duration'];
                    $minutes = number_format($length/60, 0);
                    $seconds = number_format($length%60);
                    if ($seconds < 10){
                        $seconds = "0$seconds";
                    }
                    echo "<tr>"; 
                    echo "<td>" . $row['title']  . ' </td>'; 
                    echo "<td>" . $row['artist_name']  . ' </td>';  
                    echo "<td>" . $row['type_name']  . ' </td>';
                    echo "<td>" . $row['genre_name']  . ' </td>'; 
                    echo "<td>" . $row['year']  . ' </td>'; 
                    echo "<td>" . $minutes . ":"  . $seconds . ' </td>';  
                    echo "</tr>";
                }
                ?>
                
        </table>
            <div class="progress">
                <?php foreach($song as $row){?> 
                    <label for="bpm">Beats per minute</label>
                    <progress min="0" max="300" value="<?= $row['bpm']?>" id="bpm"></progress></br>
                    <label>Energy</label>
                    <progress min="0" max="100" value="<?= $row['energy']?>"></progress></br>
                    <label>Danceability</label>
                    <progress min="0" max="100" value="<?= $row['danceability']?>"></progress></br>
                    <label>Liveness</label>
                    <progress min="0" max="100" value="<?= $row['liveness']?>"></progress></br>
                    <label>Valence</label>
                    <progress min="0" max="100" value="<?= $row['valence']?>"></progress></br>
                    <label>Acousticness</label>
                    <progress min="0" max="100" value="<?= $row['acousticness']?>"></progress></br>
                    <label>Speechiness</label>
                    <progress min="0" max="100" value="<?= $row['speechiness']?>"></progress></br>
                    <label>Popularity</label>
                    <progress min="0" max="100" value="<?= $row['popularity']?>"></progress></br>
                <?php }?>
            </div>
    </div>
    <?php include('Footer.php')?>
</body>
</html>
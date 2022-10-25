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
    <?php include('include/header.php')?>
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
                <?php 
                foreach($song as $row){ 
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
                    <div class="bars">
                    <label for="bpm">Beats per minute</label></br>
                    Low <progress min="0" max="300" value="<?= $row['bpm']?>" id="bpm"></progress> High</br>
                    </div>
                    <div class="bars">
                    <label>Energy</label></br>
                    Low <progress min="0" max="100" value="<?= $row['energy']?>"></progress> High</br>
                    </div>
                    <div class="bars">
                    <label>Danceability</label></br>
                    Low <progress min="0" max="100" value="<?= $row['danceability']?>"></progress> High</br>
                    </div>
                    <div class="bars">
                    <label>Liveness</label></br>
                    Low <progress min="0" max="100" value="<?= $row['liveness']?>"></progress> High</br>
                    </div>
                    <div class="bars">
                    <label>Valence</label></br>
                    Low <progress min="0" max="100" value="<?= $row['valence']?>"></progress> High</br>
                    </div>
                    <div class="bars">
                    <label>Acousticness</label></br>
                    Low <progress min="0" max="100" value="<?= $row['acousticness']?>"></progress> High</br>
                    </div>
                    <div class="bars">
                    <label>Speechiness</label></br>
                    Low <progress min="0" max="100" value="<?= $row['speechiness']?>"></progress> High</br>
                    </div>
                    <div class="bars">
                    <label>Popularity</label></br>
                    Low <progress min="0" max="100" value="<?= $row['popularity']?>"></progress> High</br>
                    </div>
                <?php }?>
            </div>
    </div>
    <?php include('include/Footer.php')?>
</body>
</html>
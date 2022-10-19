<?php
    require_once('database_helpers/config.inc.php'); 
    require_once('database_helpers/DatabaseHelper.php');
    
    try{
        $conn = Databasehelper::createConnection(array(DBCONNSTRING,DBUSER,DBPASS));
        $feat = new Featured($conn);
        //Using the databasehelper to run all the query since it will make this page less crowded.
        // Top Genres
        $tg = $feat->getTopGenres();
        // Top Artists
        $ta = $feat->getTopArtists();
        // Most Popular Songs
        $topSong = $feat->getTopSongs();
        //One hit wonders 
        $oneHitWonder = $feat->getOneHitWonders();
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
    <?php include('Header.php')?>   
        <ul>
        <h1>Top Genres</h1>
            <?php foreach($tg as $row){
                    echo "<li>" . $row['genre_name'] . "</li>";}?>
        </ul>
        <ul>
        <h1>Top Artists</h1>
        <?php foreach($ta as $row){
                echo "<li>" . $row['artist_name'] . "</li>";}?>
                
        </ul>
        <ul>
        <h1>Top Songs</h1>
        <?php foreach($topSong as $row){
                echo "<li>" . $row['title'] . " By " . $row['artist_name'] . "</li>";}?>
        </ul>
        <ul>
        <h1>One Hit Wonders</h1>
        <?php foreach($oneHitWonder as $row){
                echo "<li>" . $row['title'] . " By " . $row['artist_name'] . "</li>";}?>
        </ul>
        <ul>
        
        </ul>
        <ul>
          
        </ul>
        <ul>

        </ul> 
        <ul>
        
        </ul>
    <?php include('Footer.php')?>
</body>
</html>
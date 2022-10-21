<?php
    require_once('database_helpers/config.inc.php'); 
    require_once('database_helpers/DatabaseHelper.php');
    
    try{
        $conn = Databasehelper::createConnection(array(DBCONNSTRING,DBUSER,DBPASS));
        $feat = new Featured($conn);
        //Using the databasehelper to run all the query since it will make this page less crowded.
        // Top Genres
        $topGenre = $feat->getTopGenres();
        // Top Artists
        $topArtist = $feat->getTopArtists();
        // Most Popular Songs
        $topSong = $feat->getTopSongs();
        // One hit wonders 
        $oneHitWonder = $feat->getOneHitWonders();
        // acousticness
        $acoustic = $feat->getLongestAcousticSong();
        //At the club
        $club = $feat->getAtTheClub();
        //running
        $run = $feat->getRunning();
        //study
        $study = $feat->getStudy();
        
    }catch(Exception $e){$e->getMessage();}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/primary.css">
    <title>Document</title>
</head>
<body>
    <?php include('Header.php')?>   
        <div class="content home_container">
            <div class="homepage_grid"> 
                <h1>Top Genres</h1>
                <ul>
                    <?php foreach($topGenre as $row){
                            echo "<li>" . $row['genre_name'] . "</li>";}?>
                </ul>
            </div>
            <div class="homepage_grid">
                <h1>Top Artists</h1>
                <ul>
                <?php foreach($topArtist as $row){
                        echo "<li>" . $row['artist_name'] . "</li>";}?>     
                </ul>
            </div>
            <div class="homepage_grid">
                <h1>Top Songs</h1>
                <ul>
                <?php foreach($topSong as $row){
                        echo "<li><a href='SongInfo.php?songID=" . $row['song_id'] . "'>" . $row['title'] . '</a> By ' . $row['artist_name'] . "</li>";}?>
                </ul>
            </div>
            <div class="homepage_grid">
                <h1>One Hit Wonders</h1>
                <ul>
                <?php foreach($oneHitWonder as $row){
                        echo "<li><a href='SongInfo.php?songID=" . $row['song_id'] . "'>" . $row['title'] . '</a> By ' . $row['artist_name'] . "</li>";}?>
                </ul>
            </div>
            <div class="homepage_grid">
                <h1>Longest Acoustic Song</h1>
                <ul>
                <?php foreach($acoustic as $row){
                        echo "<li><a href='SongInfo.php?songID=" . $row['song_id'] . "'>" . $row['title'] . '</a> By ' . $row['artist_name'] . "</li>";}?>
                </ul>
            </div>
            <div class="homepage_grid">
                <h1>At The Club</h1>
                <ul>
                <?php foreach($club as $row){
                        echo "<li><a href='SongInfo.php?songID=" . $row['song_id'] . "'>" . $row['title'] . '</a> By ' . $row['artist_name'] . "</li>";}?>
                </ul>
            </div>
            <div class="homepage_grid">
                <h1>Running songs</h1>
                <ul>
                <?php foreach($run as $row){
                        echo "<li><a href='SongInfo.php?songID=" . $row['song_id'] . "'>" . $row['title'] . '</a> By ' . $row['artist_name'] . "</li>";}?>
                </ul> 
            </div>
            <div class="homepage_grid">
                <h1>Study Songs</h1>
                <ul>
                <?php foreach($study as $row){
                        echo "<li><a href='SongInfo.php?songID=" . $row['song_id'] . "'>" . $row['title'] . '</a> By ' . $row['artist_name'] . "</li>";}?>
                </ul>
            </div>
        </div>
    <?php include('Footer.php')?>
</body>
</html>
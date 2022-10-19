<?php
    require_once('database_helpers/config.inc.php'); 
    require_once('database_helpers/DatabaseHelper.php');
    
    try{
        $conn = Databasehelper::createConnection(array(DBCONNSTRING,DBUSER,DBPASS));
        // Top Genres
        $sql = "SELECT genres.genre_name, count(genres.genre_id)
        FROM genres, songs
        WHERE songs.genre_id = genres.genre_id
        GROUP BY genres.genre_id
        ORDER BY count(genres.genre_id) DESC
        LIMIT 10";
        
        $Top_Genres =  Databasehelper::runQuery($conn, $sql, null);

        // Top Artists
        $sql = "SELECT artists.artist_name, count(artists.artist_id)
        FROM artists, songs
        WHERE songs.artist_id = artists.artist_id
        GROUP BY artists.artist_id
        ORDER BY count(artists.artist_id) DESC
        LIMIT 10";

        $Top_Genres =  Databasehelper::runQuery($conn, $sql, null);

        // Most Popular Songs
        $sql = "SELECT artists.artist_name, title
        FROM artists, songs
        WHERE songs.artist_id = artists.artist_id
        ORDER BY popularity DESC
        LIMIT 10";

        $Most_Popular_Songs = Databasehelper::runQuery($conn, $sql, null);
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
        <div>
        <h1>Top Genres</h1>

        </div>
        <div>
        <a href="featured.php?feat=top_artists">Top Artists</a>
        </div>
        <div>
        <a href="featured.php?feat=most_pop_songs">Most Popular Songs</a>
        </div>
        <div>
        <a href="featured.php?feat=one_hit_wonder">One Hit Wonders</a>
        </div>
        <div>
        <a href="featured.php?feat=longest_acoustic">Longest Acoutic Songs</a>
        </div>
        <div>
        <a href="featured.php?feat=at_the_club">At the Club</a>
        </div>
        <div>
        <a href="featured.php?feat=running_songs">Running Songs</a>
        </div> 
        <div>
        <a href="featured.php?feat=studying">Studying</a>
        </div>
    <?php include('Footer.php')?>
</body>
</html>
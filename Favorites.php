<!-- You are going to need to do a lot of if/else statements to determine the search params -->
<?php
    require_once('database_helpers/config.inc.php'); 
    require_once('database_helpers/DatabaseHelper.php');

    try{
        $conn = Databasehelper::createConnection(array(DBCONNSTRING,DBUSER,DBPASS));
        $songGateway = new MusicDB($conn);
        
        if(empty($AddSQL)){
            $songs = $songGateway->getAll();  
        }
        else{
            $songs = $songGateway->getConditions($AddSQL, $AddValue);
        }
    }catch(Exception $e){$e->getMessage();}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Song browser</title>
</head>
<body>
    <?php include('Header.php')?>
    <div>
        <table>
            <tr>
                <th>Title</th>
                <th>Artist</th>
                <th>Year</th>
                <th>Genre</th>
                <th>Popularity</th>
            </tr>
            <?php
            foreach($songs as $curr){
                ?>
                <tr>
                    <th><?=$curr['title']?></th>
                    <th><?=$curr['artist_name']?></th>
                    <th><?=$curr['year']?></th>
                    <th><?=$curr['genre_name']?></th>
                    <th><?=$curr['popularity']?></th>
                    <th><a class="Fav_Button" href="Favorites.php?AddID=<?=$curr["song_id"]?>">
                        Add to Favorites
                    </a></th>
                    <th><a class="View_Button" href="SongInfo.php?songID=<?=$curr["song_id"]?>">
                        View
                    </a></th>
                </tr>    
                <?php
            }
            
            ?>
        </table>    
    </div> 
    <?php include('Footer.php')?>
</body>
</html>
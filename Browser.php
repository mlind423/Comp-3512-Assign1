<!-- You are going to need to do a lot of if/else statements to determine the search params -->
<?php
    session_start();//This will start the session so we can to the superglobal.
    require_once('database_helpers/config.inc.php'); 
    require_once('database_helpers/DatabaseHelper.php');

    try{
        $conn = Databasehelper::createConnection(array(DBCONNSTRING,DBUSER,DBPASS));
        $songGateway = new MusicDB($conn); //If this is not working you might want to create a new helper class databaseHelper file since it might not work with the one you are useing right now.
        if(!empty($_GET['title'])){
            $AddSQL[] = " title LIKE ?";
            $AddValue[] = "%".$_GET['title']."%";
        }
        if(!empty($_GET['artist'])){
            $AddSQL[] = " artist_name LIKE ?";
            $AddValue[] = $_GET['artist'];
        }
        if(!empty($_GET['year'])){
            $AddSQL[] = " year = ?";
            $AddValue[] = $_GET['year'];
        }
        if(!empty($_GET['genre_name'])){
            $AddSQL[] = " genre_name LIKE ?";
            $AddValue[] = $_GET['genre_name'];
        }
        if(!empty($_GET['popularity'])){
            $AddSQL[] = " popularity LIKE ?";
            $AddValue[] = $_GET['popularity'];
        }

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
                    <th><a class="Fav_Button" href="Favorites.php?songID=<?=$curr["song_id"]?>">
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
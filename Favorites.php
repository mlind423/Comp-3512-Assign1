<?php
    session_start();
    require_once('database_helpers/config.inc.php'); 
    require_once('database_helpers/DatabaseHelper.php');

    if(!empty($_GET["RemID"])){
        
        unset($_SESSION["Song" . $_GET["RemID"]]); 
    }
    if(!empty($_GET["RemAll"]) && ($_GET["RemAll"] == "yes")){
        session_unset();
    }
    try{
        $conn = Databasehelper::createConnection(array(DBCONNSTRING,DBUSER,DBPASS));
        $songGateway = new MusicDB($conn);
        $AddSQL = " AND (";
        foreach($_SESSION as $key => $val){                     
            if($AddSQL == " AND ("){
                $AddSQL .= " song_id = ?";
            }
            else{
                $AddSQL .= " OR song_id = ?";
            }
            $AddValue[] = $val; 
        }
        $AddSQL .= ")";
        if(!empty($AddValue)){
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
    <link rel="stylesheet" href="CSS/primary.css">
    <title>Song browser</title>
</head>
<body>
    <?php include('Header.php')?>
    <div class="content">
        <table>
            <tr>
                <th>Title</th>
                <th>Artist</th>
                <th>Year</th>
                <th>Genre</th>
                <th>Popularity</th>
                <th><a href="Favorites.php?RemAll=yes">Remove All</a></th>
            </tr>
            <?php
            if(!empty($songs)){
                foreach($songs as $curr){
                    ?>
                    <tr>
                        <td><?=$curr['title']?></td>
                        <td><?=$curr['artist_name']?></td>
                        <td class="table_year"><?=$curr['year']?></td>
                        <td><?=$curr['genre_name']?></td>
                        <td><?=$curr['popularity']?></td>
                        <td><a class="Fav_Button" href="Favorites.php?RemID=<?=$curr["song_id"]?>">
                            Remove From Favorites
                        </a></td>
                        <td><a class="View_Button" href="SongInfo.php?songID=<?=$curr["song_id"]?>">
                            View
                        </a></td>
                    </tr>    
                <?php
                }
            }
            ?>
        </table>    
    </div> 
    <?php include('Footer.php')?>
</body>
</html>
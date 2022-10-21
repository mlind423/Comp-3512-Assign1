<!-- You are going to need to do a lot of if/else statements to determine the search params -->
<?php
    require_once('database_helpers/config.inc.php'); 
    require_once('database_helpers/DatabaseHelper.php');

    try{
        $conn = Databasehelper::createConnection(array(DBCONNSTRING,DBUSER,DBPASS));
        $songGateway = new MusicDB($conn); //If this is not working you might want to create a new helper class databaseHelper file since it might not work with the one you are useing right now.
        $AddSQL = "";
        if(!empty($_GET['title'])){
            $AddSQL .= " AND title LIKE ?";
            $AddValue[] = "%".$_GET['title']."%";
        }
        if(!empty($_GET['artist'])){
            $AddSQL  .= " AND artist_name LIKE ?";
            $AddValue[] = $_GET['artist'];
        }
        /* if(!empty($_GET['year'])){
            $AddSQL[] = " year = ?";
            $AddValue[] = $_GET['year'];
        } */
        if(!empty($_GET['year'])){
            if ($_GET['year']== "less"){
                $AddSQL= " AND year <= ?";
                $AddValue[] = $_GET['year_less'];
            }elseif($_GET['year']== "greater"){
                $AddSQL  .= " AND year >= ?";
                $AddValue[] = $_GET['year_greater'];
            }
        }
        if(!empty($_GET['genre_name'])){
            $AddSQL .= " AND genre_name LIKE ?";
            $AddValue[] = (string)$_GET['genre_name'];
        }
        /* if(!empty($_GET['popularity'])){
            $AddSQL[] = " popularity LIKE ?";
            $AddValue[] = $_GET['popularity'];
        } */
        if(!empty($_GET['popu'])){
            if ($_GET['popu']== "greater"){
                $AddSQL .= " AND popularity >= ?";
                $AddValue[] = $_GET['pop_greater'];
                
            }elseif ($_GET['popu']== "less"){
                $AddSQL .= " AND popularity < ?";
                $AddValue[] = $_GET['pop_less'];
            }
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
            </tr>
            <?php
            foreach($songs as $curr){
                ?>
                <tr>
                    <td><?=$curr['title']?></td>
                    <td><?=$curr['artist_name']?></td>
                    <td class="table_year"><?=$curr['year']?></td>
                    <td><?=$curr['genre_name']?></td>
                    <td><?=$curr['popularity']?></td>
                    <td><a class="Fav_Button" href="addToFavorites.php?AddID=<?=$curr["song_id"]?>">
                        Add to Favorites
                    </a></td>
                    <td><a class="View_Button" href="SongInfo.php?songID=<?=$curr["song_id"]?>">
                        View
                    </a></td>
                </tr>    
                <?php
            }
            
            ?>
        </table>    
    </div> 
    <?php include('Footer.php')?>
</body>
</html>
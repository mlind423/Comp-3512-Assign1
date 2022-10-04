<?php 
    require_once('database_helpers/config.inc.php'); 
    require_once('database_helpers/DatabaseHelper.php');

    try{
        $conn = Databasehelper::createConnection(array(DBCONNSTRING,DBUSER,DBPASS));
        $artistGateway = new Artistdb($conn);
        $artist = $artistGateway->getAll();
        
        
    
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
        <form>
            <fieldset id="title">
                <input type="radio" id="title" name="main" value="Title">
                <label for="title">Title</label></br>
                <select>
                    <?php foreach($artist as $row){?>
                        <option><?= $row['artist_name']//this is putting all the artists into a drop down menu?></option> 
                        <?php }?>
                </select>
            </fieldset>
            <fieldset id="artist">
                <input type="radio" name="main" value="artist" id="artist">
                <label for="artist">Artist</label></br>
            </fieldset>
            <fieldset id="genre">
                <input type="radio" name="main" value="Genre" id="genre">
                <label for="genre">Genre</label></br>
            </fieldset>
            <fieldset id="year">
                <input type="radio" name="main" value="Year" id="year">
                <label for="year">Year</label></br>
            </fieldset>
            <fieldset id="popularity">
                <input type="radio" name="main" value="Popularity" id="popularity">
                <label for="popularity">Popularity</label>
            </fieldset>
            
        </form>
    </div>
</body>
</html>
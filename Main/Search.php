<?php 
    require_once('database_helpers/config.inc.php'); 
    require_once('database_helpers/DatabaseHelper.php');

    try{
        $conn = Databasehelper::createConnection(array(DBCONNSTRING,DBUSER,DBPASS));
        $artistGateway = new Artistdb($conn);
        $artist = $artistGateway->getAll();
        $genreGateway = new GenreDB($conn);
        $genre = $genreGateway->getAll();

        }catch(Exception $e){$e->getMessage();}
        
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search</title>
</head>
<body>
    <header><h1?>Search</h1></header>
    <div>
        <form action="/Comp-3532-Assign1/Main/Browser.php" method="GET"><!-- I set this to GET but we might want to change it to POST so the URL is not massive -->
            <fieldset id="title">
                <input type="radio" id="title" name="main" value="Title">
                <label for="title">Title</label></br>
                <input type="text" name="title">
            </fieldset>
            <fieldset id="artist">
                <input type="radio" name="main" value="artist" id="artist">
                <label for="artist">Artist</label></br>
                <select name="artist">
                    <option value="" disabled selected>Select your option</option>
                    <?php foreach($artist as $row){?>
                        <option><?= $row['artist_name']//this is putting all the artists into a drop down menu?></option> 
                        <?php }?>
                </select>
            </fieldset>
            <fieldset id="genre">
                <input type="radio" name="main" value="Genre" id="genre">
                <label for="genre">Genre</label></br>
                <select name="genre">
                    <option value="" disabled selected>Select your option</option>
                    <?php foreach($genre as $row){?>
                        <option><?= $row['genre_name']//this is putting all the genres into a drop down menu?></option> 
                        <?php }?>
                </select>
            </fieldset>
            <fieldset id="year">
                <input type="radio" name="main" value="Year" id="year">
                <label for="year">Year</label></br>
                <fieldset>
                    <label for="greater">Greater</label>
                    <input type="radio" name="year" value="greater" id="greater">
                    <input type="number" min="2016" max="2018">
                    <label for="less">Less</label>
                    <input type="radio" name="year" value="less" id="less">
                    <input type="number" min="2016" max="2018">
                </fieldset>
            </fieldset>
            <fieldset id="popularity">
                <input type="radio" name="main" value="Popularity" id="popularity">
                <label for="popularity">Popularity</label>
                <fieldset>
                    <label for="greater">Greater</label>
                    <input type="radio" name="year" value="greater" id="greater">
                    <input type="number" min="0" max="100">
                    <label for="less">Less</label>
                    <input type="radio" name="year" value="less" id="less">
                    <input type="number" min="0" max="100">
                </fieldset>
            </fieldset>
            <input type="submit">
        </form>
    </div>
    <footer></footer>
</body>
</html>
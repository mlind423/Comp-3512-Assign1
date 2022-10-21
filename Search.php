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
    <link rel="stylesheet" href="CSS/primary.css">
    <title>Search</title>
</head>
<body>
    <?php include('Header.php')?>
    <div class="content">
        <h1>Search</h1>
        <form action="/Comp-3512-Assign1/Browser.php" method="GET"><!-- I set this to GET but we might want to change it to POST so the URL is not massive -->
            <div id="title" class="title">
                <input type="radio" id="title" name="main" value="Title">
                <label for="title">Title</label></br>
                <input type="text" name="title"> <!-- the query string will show up with the name of each of the input fields-->
            </div>
            <div id="artist" class="artist">
                <input type="radio" name="main" value="Artist" id="artist">
                <label for="artist">Artist</label></br>
                <select name="artist">
                    <option value="" disabled selected>Select your option</option>
                    <?php foreach($artist as $row){?>
                        <option><?= $row['artist_name']//this is putting all the artists into a drop down menu?></option> 
                        <?php }?>
                </select>
            </div>
            <div id="genre">
                <input type="radio" name="main" value="Genre" id="genre">
                <label for="genre">Genre</label></br>
                <select name="genre_name">
                    <option value="" disabled selected>Select your option</option>
                    <?php foreach($genre as $row){?>
                        <option><?= $row['genre_name']//this is putting all the genres into a drop down menu?></option> 
                        <?php }?>
                </select>
                    </div>
            <div id="year">
                <input type="radio" name="main" value="Year" id="year">
                <label for="year">Year</label></br>
                <fieldset id="year_radio">
                    <input type="radio" name="year" value="greater" id="greater">
                    <label for="greater">Greater</label>
                    <input type="number" name="year_greater" min="2016" max="2018">
                    </br></br>
                    <input type="radio" name="year" value="less" id="less">
                    <label for="less">Less</label>
                    <input type="number" name="year_less" min="2016" max="2018">
                </fieldset>
                    </div>
            <div id="popularity">
                <input type="radio" name="main" value="Popularity" id="popularity">
                <label for="popularity">Popularity</label>
                <fieldset id="pop_radio">
                    <input type="radio"  value="greater" id="greater" name="popu">
                    <label for="greater">Greater</label>
                    <input type="number" name="pop_greater" min="0" max="100">
                    </br></br>
                    <input type="radio"  value="less" id="less" name="popu">
                    <label for="less">Less</label>
                    <input type="number" name="pop_less" min="0" max="100">
                </fieldset>
            </div>
            <input type="submit" id="submit">
        </form>
    </div>
    <?php include('Footer.php')?>
</body>
</html>
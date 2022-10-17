<?php
//used this class from the labs
class Databasehelper{
    //Returns a connection object to a database 
    public static function createConnection($value=array()){
        $connString = $value[0];
        $user = $value[1];
        $password = $value[2];
        $pdo = new PDO($connString,$user,$password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        return $pdo;
        $pdo=null;
        }
    public static function runQuery($connection, $sql, $parameters){
        $s = null; //$s == Statement
        if(isset($parameters)){
            if(!is_array($parameters)){
                $parameters = array($parameters);
            }
            $s = $connection->prepare($sql);
            $executedOk = $s->execute($parameters);
            if(!$executedOk) throw new PDOException;
        }
        else{
            $s = $connection->query($sql);
            if (!$s) throw new PDOException;
        }
        return $s;
    }

}
class Artistdb{
    private static $baseSQL = "SELECT * FROM artists ORDER BY artist_id";

    public function __construct($connection)
    {
        $this->pdo = $connection;
    }

    public function getAll(){
        $sql = self::$baseSQL;
        $s = Databasehelper::runQuery($this->pdo, $sql, null);
        return $s->fetchAll();

    }
}
class SongDB{
    private static $baseSQL = "SELECT * FROM songs";

    public function __construct($connection){
        $this->pdo = $connection;
    }
    public function getAll(){
        $sql = self::$baseSQL . " INNER JOIN artists ORDER BY artist_id";
        $s = Databasehelper::runQuery($this->pdo, $sql, null);
        return $s->fetchAll();
    }
    public function get50(){
        $sql = self::$baseSQL . " INNER JOIN artists ORDER BY artist_id LIMIT 50";
        $s = Databasehelper::runQuery($this->pdo, $sql, null);
        return $s->fetchAll();
    }
}
class MusicDB{
    //I should change this later im just lazy 
    private static $baseSQL = "SELECT * FROM songs, artists, types, genres WHERE songs.genre_id = genres.genre_id AND artists.artist_type_id = types.type_id AND songs.artist_id = artists.artist_id"; //This will display everything in the database so this should NOT be used without a where statement

    public function __construct($connection){
        $this->pdo = $connection;
    }
    public function getAll(){ 
        $sql = self::$baseSQL . " ORDER BY title";
        $s = Databasehelper::runQuery($this->pdo, $sql, null);
        return $s->fetchAll();
    }
    public function get50(){ 
        $sql = self::$baseSQL . " LIMIT 50 ORDER BY title";
        $s = Databasehelper::runQuery($this->pdo, $sql, null);
        return $s->fetchAll();
    }
    public function getConditions($sqlArray, $valueArray){ 
        $sql = self::$baseSQL;
        for($i=0; $i<count($sqlArray); $i++){
            $sql .= " AND" . $sqlArray[$i];
        }
        $s = Databasehelper::runQuery($this->pdo, $sql, $valueArray);
        return $s->fetchAll();
    }
    public function getSong($song_id){
        $sql = self::$baseSQL . " AND songs.song_id=?";
        $s = Databasehelper::runQuery($this->pdo, $sql, array($song_id));
        return $s->fetchAll(); //idk if i should be using this or just the fetch function
    }
    
}
class GenreDB{
    private static $baseSQL = "SELECT * FROM genres order by genre_id";

    public function __construct($connection)
    {
        $this->pdo = $connection;
    }

    public function getAll(){
        $sql = self::$baseSQL;
        $s = Databasehelper::runQuery($this->pdo, $sql, null);
        return $s->fetchAll();

    }
}
?>
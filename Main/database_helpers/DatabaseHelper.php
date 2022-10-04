<?php

use Databasehelper as GlobalDatabasehelper;

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
        }
    public static function runQuery($connection, $sql, $parameters){
        $s = null; //$s == Statement
        //if there are parameters then do a prepared statement
        if(isset($parameters)){
            //ensure parameters are in an array
            if(!is_array($parameters)){
                $parameters = array($parameters);
            }
            // use prepared statement if parameters
            $s = $connection->prepare($sql);
            $executedOk = $s->execute($parameters);
            if(!$executedOk) throw new PDOException;
        }
        else{
            //execute normal query
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
        $s = GlobalDatabasehelper::runQuery($this->pdo, $sql, null);
        return $s->fetchAll();
    }
}
class MusicDB{
    private static $baseSQL = "SELECT * FROM songs, artists, types, genres"; //This will display everything in the database connected together

    public function __construct($connection){
        $this->pdo = $connection;
    }
    public function getAll(){
        $sql = self::$baseSQL;
        $s = Databasehelper::runQuery($this->pdo, $sql, null);
        return $s->fetchAll();
    }
    public function getSong($song_id){
        $sql = self::$baseSQL . " WHERE songs.genre_id = genres.genre_id AND artists.artist_type_id = types.type_id AND songs.artist_id = artists.artist_id AND songs.song_id=?";
        $s = Databasehelper::runQuery($this->pdo, $sql, array($song_id));
        return $s->fetchAll();
    }
    
}

?>
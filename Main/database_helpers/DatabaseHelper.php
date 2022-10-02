<?php
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
class Musicdb{
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
?>
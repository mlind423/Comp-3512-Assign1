<?php
class Databasehelper{
    //Returns a connection object to a database 
    public static function createConnection($value=array()){
        $host = $value[0];
        $user = $value[1];
        $password = $value[2];
        $name = $value[3];
        $connection = mysqli_connect($host,$user,$password,$name);
        return $connection;
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
            if(!$executedOk) throw new mysqli_sql_exception;
        }
        else{
            //execute normal query
            $s = mysqli_query($connection, $sql);
            if (!$s) throw new mysqli_sql_exception;
        }
        return $s;
    }

}
class MusicDB{
    private static $baseSQL = "SELECT title FROM music";
    public function __construct($connection)
    {
        $this->sqlite = $connection;
    }
    public function getAll(){
        $sql = self::$baseSQL;
        $s = Databasehelper::runQuery($this->pdo, $sql, null);
        return $s->fetchAll();

    }
}
?>
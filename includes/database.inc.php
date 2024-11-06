
<?php
// singleton mintájú adatbázis csatlakozási osztályt valósít meg
//A kód megvalósítja a singleton mintát, ami azt jelenti, hogy az adatbázis kapcsolatot csak egyszer hozza létre az alkalmazás futása során. 
//Minden további hívás során már a meglévő kapcsolatot adja vissza. Ez hatékonyabbá teszi az alkalmazás működését, mivel nem szükséges minden egyes adatbázis művelethez új kapcsolatot létrehozni.

    define('HOST', 'localhost');
    define('DATABASE', 'webprog_beadando');
    define('USER', 'root');
    define('PASSWORD', '');
    
    class Database {
        private static $connection = FALSE;
        
        //PDO: PHP Data Objects : lehetővé teszi az adatbázisokkal való egységes és biztonságos kommunikációt
        public static function getConnection() {
            if(! self::$connection) {
                self::$connection = new PDO('mysql:host='.HOST.';dbname='.DATABASE, USER, PASSWORD,
                      array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
                self::$connection->query('SET NAMES utf8 COLLATE utf8_hungarian_ci');
            }
            return self::$connection;
        }
    }

?>
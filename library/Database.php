<?php
class Database {
    /* @var $pdo \PDO */
    private $pdo;

    public function getPdo(){
        return $this->pdo;
    }

    private function setPdo(){
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];
        $appConfig = parse_ini_file(__DIR__ . "/../config/application.ini");
        $dsn = "mysql:host={$appConfig['hostname']};dbname={$appConfig['database']};charset={$appConfig['charset']}";
        $this->pdo = new PDO($dsn, $appConfig['username'], $appConfig['password'], $options);
        return $this;
    }

    public function __construct(){
        try{
            $this->setPdo();
        }
        catch(PDOException $e){
            throw new Exception("<h1>Something bad happened make sure to have ".
                "your credentials ready in config/application.ini \n<br/> {$e->getMessage()}");
        }
        catch(Exception $e){
            throw new Exception("<h1>Something TERRIBLE happened an we don't ".
            "know what it was \n<br/> {$e->getMessage()}");
        }
    }
}
<?php
require_once 'Database.php';
class TopicsRepository {
    private $pdo;

    public function getPdo(){
        return $this->pdo;
    }

    public function __construct() {
        $db = new Database();
        $this->pdo = $db->getPdo();
    }
    public function fetchAll(){
        $result = $this->pdo->query("SELECT * FROM 
          (SELECT * FROM `topics` ORDER BY `topic_id` DESC LIMIT 10)
          sub ORDER BY topic_id ASC")->fetchAll();
        return $result;
    }

    public function saveTopic($topicName){
        $insert = $this->pdo->prepare("INSERT INTO `topics` (`topic_name`) VALUES (:topicName)");
        $insert->bindParam(':topicName', $topicName);
        $insert->execute();
    }
}
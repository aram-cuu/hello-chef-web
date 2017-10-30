<?php
require_once __DIR__ . '/../library/TopicsRepository.php';
$topicsRepository = new TopicsRepository();
$topicsList = $topicsRepository->fetchAll();
header('Content-Type: application/json');
echo json_encode($topicsList);
<?php
require_once __DIR__ . '/../library/TopicsRepository.php';
$topicsRepository = new TopicsRepository();
$topicsRepository->saveTopic($_POST['topic']);

json_encode(['success' => true]);
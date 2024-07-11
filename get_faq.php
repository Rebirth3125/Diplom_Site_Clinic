<?php

$dbHost = 'localhost';
$dbUsername = 'root';
$dbPassword = '';
$dbName = 'mydatabase';

$conn = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$question = isset($_GET['question']) ? $_GET['question'] : '';

if ($question) {
  $sql = "SELECT question, answer FROM faq";
  $result = $conn->query($sql);
  
  $bestMatch = null;
  $bestScore = 0;

  $userWords = explode(" ", $question);

  while ($row = $result->fetch_assoc()) {
      $faqQuestion = $row['question'];
      $faqAnswer = $row['answer'];

      $faqWords = explode(" ", $faqQuestion);

      $score = 0;
      foreach ($userWords as $userWord) {
          foreach ($faqWords as $faqWord) {
              if (strcasecmp($userWord, $faqWord) == 0) {
                  $score += 2;
              }
              elseif (strpos($faqWord, $userWord) !== false || strpos($userWord, $faqWord) !== false) {
                  $score++;
              }
          }
      }

      if ($score > $bestScore) {
          $bestScore = $score;
          $bestMatch = $faqAnswer;
      }
  }

  echo json_encode(array("answer" => $bestMatch ? $bestMatch : "Извините, я не знаю ответа на этот вопрос. Могу помочь в чем-то еще?"));
} else {
  echo json_encode(array("error" => "No question provided"));
}

$conn->close();
?>
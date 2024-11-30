<?php
$quizFile = 'questions.txt';
$quizContent = file_get_contents($quizFile);

$questions = explode("ANSWER:", $quizContent);

$answers = [];

foreach ($questions as $questionBlock) {
    $lines = explode("\n", trim($questionBlock));
    if (count($lines) > 1) {
        $answers[] = trim(end($lines));
    }
}


$userAnswers = $_POST;
$score = 0;

foreach ($answers as $index => $correctAnswer) {
    $userAnswerKey = "question_$index";
    if (isset($userAnswers[$userAnswerKey]) && $userAnswers[$userAnswerKey] === $correctAnswer) {
        $score++;
    }
}

$totalQuestions = count($answers);
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kết Quả</title>
</head>
<body>
    <div style="text-align: center;">
        <h1>Kết Quả</h1>
        <p>Bạn đã trả lời đúng <?php echo $score; ?> trên tổng số <?php echo $totalQuestions; ?> câu hỏi.</p>
        <a href="index.php">Làm lại</a>
    </div>
</body>
</html>
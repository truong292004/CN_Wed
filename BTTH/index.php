<?php
$quizFile = 'questions.txt';
$quizContent = file_get_contents($quizFile);

$questions = explode("ANSWER:", $quizContent);

$quizData = [];

foreach ($questions as $questionBlock) {
    $lines = explode("\n", trim($questionBlock));
    if (count($lines) > 1) {
        $question = implode("\n", array_slice($lines, 0, -1)); 
        $answer = trim(end($lines)); 
        $quizData[] = ['question' => $question, 'answer' => $answer];
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bài Trắc Nghiệm</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="quiz-container">
        <h1>Bài Trắc Nghiệm Android</h1>
        <form method="POST" action="result.php">
            <?php foreach ($currentQuestions as $index => $quiz): ?>
                <div class="question">
                    <p><strong>Câu hỏi <?php echo $startIndex + $index + 1; ?>:</strong> <?php echo nl2br(htmlspecialchars($quiz['question'])); ?></p>
                    <ul class="options">
                        <?php
                        // Tìm các đáp án từ câu hỏi
                        preg_match_all('/[A-D]\. (.+)/', $quiz['question'], $matches);
                        if (!empty($matches[1])) {
                            foreach ($matches[1] as $optionIndex => $optionText): ?>
                                <li>
                                    <label>
                                        <input type="radio" name="question_<?php echo $startIndex + $index; ?>" value="<?php echo chr(65 + $optionIndex); ?>">
                                        <?php echo chr(65 + $optionIndex) . ". " . htmlspecialchars($optionText); ?>
                                    </label>
                                </li>
                            <?php endforeach;
                        }
                        ?>
                    </ul>
                </div>
            <?php endforeach; ?>
            <div class="pagination">
                <?php if ($currentPage > 1): ?>
                    <a href="?page=<?php echo $currentPage - 1; ?>">Trang trước</a>
                <?php endif; ?>
                <?php if ($endIndex < count($quizData)): ?>
                    <a href="?page=<?php echo $currentPage + 1; ?>">Trang tiếp</a>
                <?php endif; ?>
            </div>
        </form>
    </div>
</body>
</html>
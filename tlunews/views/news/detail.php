<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News Detail</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link file CSS của bạn -->
</head>
<body>
    <h1><?= htmlspecialchars($news['title']) ?></h1>
    <p><strong>Category:</strong> <?= htmlspecialchars($news['category_name']) ?></p> <!-- Hiển thị tên danh mục -->
    <p><strong>Published:</strong> <?= date('d M Y', strtotime($news['created_at'])) ?></p> <!-- Hiển thị ngày đăng -->
    <p><?= nl2br(htmlspecialchars($news['content'])) ?></p> <!-- Hiển thị nội dung tin tức -->
    <a href="index.php">Back to list</a>
</body>
</html>

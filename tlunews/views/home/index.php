<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News List</title>
    <link rel="stylesheet" href="styles.css"> <!-- Tạo file styles.css để làm đẹp giao diện -->
</head>
<body>
    <h2>Latest News</h2>

    <!-- Form tìm kiếm -->
    <form method="GET" action="index.php?action=search">
        <input type="text" name="keyword" placeholder="Search news..." required>
        <input type="submit" value="Search">
    </form>

    <!-- Lọc tin tức theo danh mục -->
    <form method="GET" action="index.php?action=filter">
        <label for="category">Select Category:</label>
        <select name="categoryId" id="category">
            <option value="">All Categories</option>
            <?php foreach ($categoryList as $category): ?>
                <option value="<?= $category['id'] ?>"><?= htmlspecialchars($category['name']) ?></option>
            <?php endforeach; ?>
        </select>
        <input type="submit" value="Filter">
    </form>

    <ul>
        <?php foreach ($newsList as $news): ?>
            <li>
                <a href="index.php?action=detail&id=<?= $news['id'] ?>">
                    <?= htmlspecialchars($news['title']) ?>
                </a>
                <p><?= htmlspecialchars(substr($news['content'], 0, 100)) ?>...</p> <!-- Hiển thị đoạn tóm tắt -->
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>


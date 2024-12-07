<h1>Danh sách Tin tức</h1>
<ul>
    <?php foreach ($newsList as $news): ?>
        <li>
            <img src="uploads/<?= htmlspecialchars($news['image']) ?>" alt="<?= htmlspecialchars($news['title']) ?>" style="width: 100px; height: auto;">
            <a href="index.php?controller=news&action=detail&id=<?= $news['id'] ?>">
                <?= htmlspecialchars($news['title']) ?>
            </a>
            <p>Danh mục: <?= htmlspecialchars($news['category_name']) ?></p>
            <p>Ngày đăng: <?= htmlspecialchars($news['created_at']) ?></p>
        </li>
    <?php endforeach; ?>
</ul>
<form method="GET" action="index.php">
    <input type="hidden" name="controller" value="news">
    <input type="hidden" name="action" value="search">
    <input type="text" name="keyword" placeholder="Tìm kiếm tin tức...">
    <button type="submit">Tìm kiếm</button>
</form>

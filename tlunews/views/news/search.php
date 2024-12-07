<h1>Kết quả tìm kiếm</h1>
<?php if (count($searchResults) > 0): ?>
    <ul>
        <?php foreach ($searchResults as $news): ?>
            <li>
                <img src="uploads/<?= htmlspecialchars($news['image']) ?>" alt="<?= htmlspecialchars($news['title']) ?>" style="width: 100px; height: auto;">
                <a href="index.php?controller=news&action=detail&id=<?= $news['id'] ?>">
                    <?= htmlspecialchars($news['title']) ?>
                </a>
                <p>Danh mục: <?= htmlspecialchars($news['category_name']) ?></p>
            </li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p>Không tìm thấy kết quả nào.</p>
<?php endif; ?>
<a href="index.php?controller=news&action=index">Quay lại danh sách</a>

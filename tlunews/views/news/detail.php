<h1><?= htmlspecialchars($news['title']) ?></h1>
<img src="uploads/<?= htmlspecialchars($news['image']) ?>" alt="<?= htmlspecialchars($news['title']) ?>" style="width: 300px; height: auto;">
<p><?= htmlspecialchars($news['content']) ?></p>
<p><strong>Danh mục:</strong> <?= htmlspecialchars($news['category_name']) ?></p>
<p><strong>Ngày đăng:</strong> <?= htmlspecialchars($news['created_at']) ?></p>
<a href="index.php?controller=news&action=index">Quay lại danh sách</a>



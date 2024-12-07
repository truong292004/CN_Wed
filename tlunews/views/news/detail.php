<?php include 'views/header.php'; ?>

<div class="row">
    <div class="col-md-8">
        <article>
            <h1 class="mb-4"><?php echo htmlspecialchars($news['title']); ?></h1>
            <div class="mb-3">
                <small class="text-muted">
                    Đăng ngày: <?php echo date('d/m/Y', strtotime($news['created_at'])); ?>
                    | Danh mục: <?php echo htmlspecialchars($category); ?>
                </small>
            </div>
            
            <?php if ($news['image']): ?>
                <img src="<?php echo htmlspecialchars($news['image']); ?>"
                     class="img-fluid mb-4" alt="<?php echo htmlspecialchars($news['title']); ?>">
            <?php endif; ?>
            
            <div class="content">
                <?php echo nl2br(htmlspecialchars($news['content'])); ?>
            </div>
        </article>
    </div>
</div>

<?php include 'views/footer.php'; ?>

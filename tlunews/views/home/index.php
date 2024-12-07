
<?php include 'views/header.php'; ?>

<div class="row">
    <div class="col-md-8">
        <div class="d-flex justify-content-between">
            <h2 class="mb-4 mt-auto">Tin Tức</h2>
            <div class="d-flex  mt-4 mb-4">
    <input type="text" class="form-control form-control-sm" placeholder="Tìm kiếm...">
    <button class="btn btn-sm bi bi-search btn-success"></button>
</div>
        </div>
        <?php foreach ($_SESSION['news'] as $item): ?>
            <div class="card mb-4">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="<?php echo htmlspecialchars($item['image']); ?>"
                             class="img-fluid rounded-start" alt="<?php echo htmlspecialchars($item['title']); ?>">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">
                                <a href="?action=news&method=detail&id=<?php echo $item['id']; ?>" class="text-decoration-none">
                                    <?php echo htmlspecialchars($item['title']); ?>
                                </a>
                            </h5>
                            <p class="card-text"><?php echo substr(htmlspecialchars($item['content']), 0, 200) . '...'; ?></p>
                            <p class="card-text">
                                <small class="text-muted">
                                    Đăng ngày: <?php echo date('d/m/Y', strtotime($item['created_at'])); ?>
                                </small>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h3>Danh Mục</h3>
            </div>
            <div class="list-group list-group-flush">
                <?php foreach ($_SESSION['category'] as $category): ?>
                    <a href="?action=filter&categoryId=<?php echo $category['id']; ?>" 
                       class="list-group-item list-group-item-action">
                        <?php echo htmlspecialchars($category['name']); ?>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>

<?php include 'views/footer.php'; ?>


<?php include 'views/header.php'; ?>

<div class="card">
    <div class="card-header">
        <h2>Sửa Tin Tức</h2>
    </div>
    <div class="card-body">
        <form action="index.php?action=news&method=edit&id=<?php echo $news['id']; ?>" method="POST"
            enctype="multipart/form-data">
            <div class="mb-3">
                <label for="title" class="form-label">Tiêu Đề</label>
                <input type="text" class="form-control" id="title" name="title"
                    value="<?php echo htmlspecialchars($news['title']); ?>" required>
            </div>

            <div class="mb-3">
                <label for="category_id" class="form-label">Danh Mục</label>
                <select class="form-select" id="category_id" name="category_id" required>
                    <option value="">Chọn danh mục</option>
                    <?php foreach ($categories as $category): ?>
                    <option value="<?php echo $category['id']; ?>"
                        <?php echo $category['id'] == $news['category_id'] ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($category['name']); ?>
                    </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="content" class="form-label">Nội Dung</label>
                <textarea class="form-control" id="content" name="content" rows="10" required>
                    <?php echo htmlspecialchars($news['content']); ?>
                </textarea>
            </div>

            <?php if ($news['image']): ?>
            <div class="mb-3">
                <label class="form-label">Hình Ảnh Hiện Tại</label>
                <div>
                    <img src="<?php echo htmlspecialchars($news['image']); ?>" alt="Current image"
                        style="max-width: 200px;">
                </div>
            </div>
            <?php endif; ?>

            <div class="mb-3">
                <label for="image" class="form-label">Thay Đổi Hình Ảnh</label>
                <input type="file" class="form-control" id="image" name="image">
            </div>

            <button type="submit" class="btn btn-primary">Cập Nhật</button>
            <a href="index.php?action=dashboard" class="btn btn-secondary">Hủy</a>
        </form>
    </div>
</div>

<?php include 'views/footer.php'; ?>
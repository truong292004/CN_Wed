<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Quản Lý Tin Tức</h2>
    <a href="index.php?action=news&method=add" class="btn btn-primary">Thêm Tin Tức</a>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Tiêu Đề</th>
                        <th>Danh Mục</th>
                        <th>Ngày Đăng</th>
                        <th>Chức Năng</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($news as $item): ?>
                    <tr>
                        <!--                            <td>--><?php //echo $item['id']; ?>
                        <!--</td>-->
                        <td><?php echo htmlspecialchars($item['title']); ?></td>
                        <td><?php echo htmlspecialchars($item['category_name']); ?></td>
                        <td><?php echo date('d/m/Y', strtotime($item['created_at'])); ?></td>
                        <td>
                            <a href="index.php?action=news&method=edit&id=<?php echo $item['id']; ?>"
                                class="btn btn-sm btn-warning"><i class="bi bi-pencil-square"></i></a>
                            <a href="index.php?action=news&method=delete&id=<?php echo $item['id']; ?>"
                                class="btn btn-sm btn-danger"
                                onclick="return confirm('Bạn có chắc muốn xóa tin này?')"><i
                                    class="bi bi-trash-fill"></i></a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Nhập - Hệ Thống Quản Trị NewsFlash</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h2>Đăng Nhập</h2>
                    </div>
                    <div class="card-body">
                        <?php if (!empty($error)): ?>
                        <div class="alert alert-danger">
                            <?php echo htmlspecialchars($error); ?>
                        </div>
                        <?php endif; ?>

                        <form action="index.php?action=login" method="POST">
                            <div class="mb-3">
                                <label for="username" class="form-label">Tên Đăng Nhập</label>
                                <input type="text" class="form-control" id="username" name="username" required
                                    value="<?php echo htmlspecialchars($username ?? ''); ?>">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Mật Khẩu</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Đăng Nhập</button>
                            <a href="?action=guest" class="btn btn-secondary">Người dùng</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <?php include 'views/footer.php'; ?>

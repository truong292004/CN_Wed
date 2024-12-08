<?php
class User {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    // Lấy thông tin người dùng từ cơ sở dữ liệu theo tên người dùng
    public function getUserByUsername($username) {
        $sql = "SELECT * FROM users WHERE username = :username";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC); // Trả về người dùng nếu tìm thấy
    }

    public function login($username, $password) {
        $sql = "SELECT * FROM users WHERE username = :username LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Kiểm tra mật khẩu
        if ($user && password_verify($password, $user['password'])) {
            return $user;  // Đăng nhập thành công
        }

        return false;  // Đăng nhập thất bại
    }
}
?>

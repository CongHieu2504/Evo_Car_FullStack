<?php
// Script cập nhật password admin thành MD5 hash
echo "<h2>Cập nhật Password Admin</h2>";

$host = 'localhost';
$username = 'root';
$password_db = '';
$database = 'kholanh_db';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$database", $username, $password_db);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // MD5 hash của '123456'
    $new_password_hash = md5('123456');
    
    // Cập nhật password admin
    $stmt = $pdo->prepare("UPDATE users SET password = ? WHERE username = 'admin'");
    $result = $stmt->execute([$new_password_hash]);
    
    if ($result) {
        echo "<p style='color: green;'><strong>✅ Đã cập nhật password admin thành công!</strong></p>";
        echo "<p>Password mới (MD5): $new_password_hash</p>";
        
        // Kiểm tra lại
        $stmt = $pdo->prepare("SELECT password FROM users WHERE username = 'admin'");
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($user['password'] === $new_password_hash) {
            echo "<p style='color: green;'><strong>✅ Xác nhận: Password đã được cập nhật đúng!</strong></p>";
        } else {
            echo "<p style='color: red;'><strong>❌ Lỗi: Password chưa được cập nhật!</strong></p>";
        }
        
    } else {
        echo "<p style='color: red;'><strong>❌ Lỗi khi cập nhật password!</strong></p>";
    }
    
} catch(PDOException $e) {
    echo "<p style='color: red;'>Database Error: " . $e->getMessage() . "</p>";
}
?> 
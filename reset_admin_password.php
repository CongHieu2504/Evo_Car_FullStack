<?php
// Script reset password admin về "123456"
echo "<h2>🔧 RESET ADMIN PASSWORD</h2>";

try {
    $pdo = new PDO("mysql:host=localhost;dbname=webdoanh_demobanhang", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Password mới
    $new_password = "123456";
    $hashed_password = md5($new_password);
    
    echo "Password mới: $new_password<br>";
    echo "Hash: $hashed_password<br><br>";
    
    // Update password cho user admin
    $stmt = $pdo->prepare("UPDATE users SET password = ? WHERE username = 'admin'");
    $result = $stmt->execute([$hashed_password]);
    
    if ($result) {
        echo "✅ Đã reset password admin thành công!<br>";
        echo "Bây giờ có thể đăng nhập với:<br>";
        echo "- Username: admin<br>";
        echo "- Password: 123456<br>";
    } else {
        echo "❌ Lỗi khi reset password<br>";
    }
    
    // Kiểm tra lại
    echo "<br><h3>Kiểm tra lại:</h3>";
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = 'admin'");
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($user) {
        echo "UserID: " . $user['userid'] . "<br>";
        echo "Username: " . $user['username'] . "<br>";
        echo "Password Hash: " . $user['password'] . "<br>";
        echo "Match với '123456': " . ($user['password'] === $hashed_password ? "✅ ĐÚNG" : "❌ SAI") . "<br>";
    }
    
} catch(PDOException $e) {
    echo "❌ Lỗi database: " . $e->getMessage();
}
?> 
<?php
// Debug script để test authentication
require_once 'application/config/database.php';

try {
    $pdo = new PDO("mysql:host=localhost;dbname=webdoanh_demobanhang", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "<h2>🔍 DEBUG AUTHENTICATION TEST</h2>";
    
    // Test 1: Kiểm tra user admin
    echo "<h3>1. Kiểm tra user 'admin':</h3>";
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = 'admin' OR email = 'admin'");
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($user) {
        echo "✅ Tìm thấy user admin:<br>";
        echo "- UserID: " . $user['userid'] . "<br>";
        echo "- Username: " . $user['username'] . "<br>";
        echo "- Email: " . $user['email'] . "<br>";
        echo "- Password Hash: " . $user['password'] . "<br>";
        echo "- Active: " . $user['active'] . "<br>";
        
        // Test password
        $test_password = "123456";
        $hashed_password = md5($test_password);
        echo "- Test password '123456' hash: " . $hashed_password . "<br>";
        echo "- Password match: " . ($hashed_password === $user['password'] ? "✅ ĐÚNG" : "❌ SAI") . "<br>";
    } else {
        echo "❌ Không tìm thấy user admin<br>";
    }
    
    // Test 2: Test với thông tin sai
    echo "<h3>2. Test với thông tin sai 'abc123xyz':</h3>";
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = 'abc123xyz' OR email = 'abc123xyz'");
    $stmt->execute();
    $fake_user = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($fake_user) {
        echo "❌ Tìm thấy user giả (không nên có):<br>";
        print_r($fake_user);
    } else {
        echo "✅ Không tìm thấy user giả (đúng)<br>";
    }
    
    // Test 3: Test password hash
    echo "<h3>3. Test password hash:</h3>";
    $test_passwords = ['123456', 'password123', 'abc123xyz'];
    foreach ($test_passwords as $pwd) {
        $hash = md5($pwd);
        echo "- Password '$pwd' → Hash: $hash<br>";
    }
    
} catch(PDOException $e) {
    echo "❌ Lỗi database: " . $e->getMessage();
}
?> 
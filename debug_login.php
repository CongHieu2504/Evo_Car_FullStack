<?php
// Debug file để kiểm tra login
echo "<h2>Debug Login System</h2>";

// 1. Kiểm tra MD5 hash
$password = '123456';
$md5_hash = md5($password);
echo "<p><strong>Password:</strong> $password</p>";
echo "<p><strong>MD5 Hash:</strong> $md5_hash</p>";

// 2. Kết nối database
$host = 'localhost';
$username = 'root';
$password_db = '';
$database = 'kholanh_db';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$database", $username, $password_db);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // 3. Kiểm tra user admin
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute(['admin']);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($user) {
        echo "<h3>User Admin Found:</h3>";
        echo "<p><strong>Username:</strong> " . $user['username'] . "</p>";
        echo "<p><strong>Password Hash:</strong> " . $user['password'] . "</p>";
        echo "<p><strong>Active:</strong> " . $user['active'] . "</p>";
        echo "<p><strong>Email:</strong> " . $user['email'] . "</p>";
        
        // 4. So sánh password
        if ($user['password'] === $md5_hash) {
            echo "<p style='color: green;'><strong>✅ Password khớp!</strong></p>";
        } else {
            echo "<p style='color: red;'><strong>❌ Password không khớp!</strong></p>";
            echo "<p>Expected: $md5_hash</p>";
            echo "<p>Actual: " . $user['password'] . "</p>";
        }
        
        // 5. Kiểm tra active status
        if ($user['active'] == 1) {
            echo "<p style='color: green;'><strong>✅ User đang active!</strong></p>";
        } else {
            echo "<p style='color: red;'><strong>❌ User không active!</strong></p>";
        }
        
    } else {
        echo "<p style='color: red;'><strong>❌ Không tìm thấy user 'admin'!</strong></p>";
    }
    
    // 6. Kiểm tra tất cả users
    echo "<h3>Tất cả Users:</h3>";
    $stmt = $pdo->query("SELECT username, password, active, email FROM users LIMIT 10");
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo "<table border='1' style='border-collapse: collapse;'>";
    echo "<tr><th>Username</th><th>Password Hash</th><th>Active</th><th>Email</th></tr>";
    foreach ($users as $u) {
        echo "<tr>";
        echo "<td>" . $u['username'] . "</td>";
        echo "<td>" . $u['password'] . "</td>";
        echo "<td>" . $u['active'] . "</td>";
        echo "<td>" . $u['email'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
    
} catch(PDOException $e) {
    echo "<p style='color: red;'>Database Error: " . $e->getMessage() . "</p>";
}
?> 
<?php
echo "PHP hoạt động bình thường<br>";

// Test CodeIgniter
require_once 'index.php';

echo "CodeIgniter đã load thành công<br>";
echo "Base URL: " . base_url() . "<br>";
echo "Current URL: " . current_url() . "<br>";
?> 
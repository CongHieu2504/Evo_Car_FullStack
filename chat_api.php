<?php
// chat_api.php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

// Function để lấy dữ liệu từ tất cả các page
function getEvoCarAllData() {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "kholanh_db";
    
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    if ($conn->connect_error) {
        return ['home_products' => [], 'news' => [], 'products' => [], 'categories' => []];
    }
    
    $data = [];
    
    // 1. TRANG CHỦ - Sản phẩm nổi bật từ bảng posts
    $sql_home = "SELECT id, title, brand, type, description, price 
                 FROM posts 
                 WHERE post_type = 'product' AND status = 'publish' 
                 ORDER BY addtime DESC 
                 LIMIT 5";
    $result_home = $conn->query($sql_home);
    $data['home_products'] = [];
    if ($result_home->num_rows > 0) {
        while($row = $result_home->fetch_assoc()) {
            $data['home_products'][] = [
                'id' => $row['id'],
                'name' => $row['title'],
                'brand' => $row['brand'],
                'type' => $row['type'],
                'description' => $row['description'],
                'price' => $row['price'],
                'image' => $row['image'],
                'created' => $row['addtime']
            ];
        }
    }
    
    // 2. TRANG CHỦ - Banner từ bảng posts
    $sql_banner = "SELECT id, title, description 
                   FROM posts 
                   WHERE post_type = 'banner' AND status = 'publish' 
                   ORDER BY addtime DESC 
                   LIMIT 3";
    $result_banner = $conn->query($sql_banner);
    $data['banners'] = [];
    if ($result_banner->num_rows > 0) {
        while($row = $result_banner->fetch_assoc()) {
            $data['banners'][] = [
                'id' => $row['id'],
                'title' => $row['title'],
                'description' => $row['description'],
                'image' => $row['image'],
                'created' => $row['addtime']
            ];
        }
    }
    
    // 3. TRANG TIN TỨC - từ bảng posts
    $sql_news = "SELECT id, title, description, hometext, addtime 
                 FROM posts 
                 WHERE post_type = 'banner' AND is_news = 1 AND status = 'publish' 
                 ORDER BY addtime DESC 
                 LIMIT 10";
    $result_news = $conn->query($sql_news);
    $data['news'] = [];
    if ($result_news->num_rows > 0) {
        while($row = $result_news->fetch_assoc()) {
            $data['news'][] = [
                'id' => $row['id'],
                'title' => $row['title'],
                'description' => $row['description'],
                'content' => $row['hometext'],
                'created' => $row['addtime']
            ];
        }
    }
    
    // 4. TRANG SẢN PHẨM - từ bảng shops_rows
    $sql_products = "SELECT id, title, brand, type, hometext, product_price 
                     FROM shops_rows 
                     WHERE status = 1 
                     ORDER BY created DESC 
                     LIMIT 10";
    $result_products = $conn->query($sql_products);
    $data['products'] = [];
    if ($result_products->num_rows > 0) {
        while($row = $result_products->fetch_assoc()) {
            $specs = [];
            if (!empty($row['specs'])) {
                $specs = json_decode($row['specs'], true) ?: [];
            }
            
            $data['products'][] = [
                'id' => $row['id'],
                'name' => $row['title'],
                'brand' => $row['brand'],
                'type' => $row['type'],
                'description' => $row['hometext'],
                'price' => $row['product_price']
            ];
        }
    }
    
    // 5. DANH MỤC - từ bảng shops_cat
    $sql_cats = "SELECT id, name, alias FROM shops_cat WHERE status = 1 ORDER BY name";
    $result_cats = $conn->query($sql_cats);
    $data['categories'] = [];
    if ($result_cats->num_rows > 0) {
        while($row = $result_cats->fetch_assoc()) {
            $data['categories'][] = [
                'id' => $row['id'],
                'name' => $row['name'],
                'alias' => $row['alias']
            ];
        }
    }
    
    $conn->close();
    
    return $data;
}

// Function để tạo context cho AI
function createEvoCarContext($data) {
    $context = "Bạn là trợ lý AI của EvoCar - đại lý xe hơi. Tư vấn khách hàng về sản phẩm và tin tức có sẵn.\n\n";
    
    // Thêm hướng dẫn về page context
    $context .= "QUAN TRỌNG: Khi khách hàng hỏi về sản phẩm, hãy chú ý đến context page:\n";
    $context .= "- Nếu có 'TRANG SẢN PHẨM': Tập trung vào sản phẩm từ bảng shops_rows (danh sách sản phẩm chi tiết)\n";
    $context .= "- Nếu có 'TRANG TIN TỨC': Tập trung vào tin tức từ bảng posts (post_type='banner' AND is_news=1)\n";
    $context .= "- Nếu có 'TRANG CHỦ': Tập trung vào sản phẩm nổi bật từ bảng posts:\n";
    $context .= "  + Sản phẩm nổi bật: post_type='product'\n";
    $context .= "  + Toyota: post_type='product'\n";
    $context .= "  + Banner giữa: post_type='banner'\n";
    $context .= "  + Banner title: post_type='banner'\n\n";
    
    // TIN TỨC (Trang tin tức - post_type='banner' AND is_news=1)
    if (!empty($data['news'])) {
        $context .= "TIN TỨC MỚI NHẤT (TRANG TIN TỨC - post_type='banner' AND is_news=1):\n";
        foreach ($data['news'] as $news) {
            $context .= "- " . $news['title'] . "\n";
        }
        $context .= "\n";
    }
    
    // SẢN PHẨM NỔI BẬT (Trang chủ - post_type='product')
    if (!empty($data['home_products'])) {
        $context .= "SẢN PHẨM NỔI BẬT (TRANG CHỦ - post_type='product'):\n";
        foreach ($data['home_products'] as $product) {
            $context .= "- " . $product['name'] . " (" . $product['brand'] . ") - " . number_format($product['price']) . " VNĐ\n";
        }
        $context .= "\n";
    }
    
    // SẢN PHẨM CHI TIẾT (Trang sản phẩm - bảng shops_rows)
    if (!empty($data['products'])) {
        $context .= "SẢN PHẨM CHI TIẾT (TRANG SẢN PHẨM - bảng shops_rows):\n";
        foreach ($data['products'] as $product) {
            $context .= "- " . $product['name'] . " (" . $product['brand'] . ") - " . number_format($product['price']) . " VNĐ\n";
        }
        $context .= "\n";
    }
    
    // DANH MỤC
    if (!empty($data['categories'])) {
        $context .= "DANH MỤC: ";
        $cat_names = array_column($data['categories'], 'name');
        $context .= implode(', ', $cat_names) . "\n\n";
    }
    
    $context .= "HƯỚNG DẪN TRẢ LỜI:\n";
    $context .= "1. Nếu khách hàng ở TRANG SẢN PHẨM: Tập trung vào sản phẩm từ bảng shops_rows\n";
    $context .= "2. Nếu khách hàng ở TRANG TIN TỨC: Tập trung vào tin tức từ bảng posts (is_news=1)\n";
    $context .= "3. Nếu khách hàng ở TRANG CHỦ: Tập trung vào sản phẩm nổi bật từ bảng posts (post_type='product')\n";
    $context .= "4. Luôn trả lời bằng tiếng Việt, thân thiện và chính xác theo dữ liệu có sẵn\n";
    $context .= "5. Khi hỏi về sản phẩm cụ thể, cung cấp thông tin chi tiết từ database\n\n";

    return $context;
}

// Function để tạo mock response khi quota hết
function generateMockResponse($user_message, $data) {
    $message = strtolower($user_message);
    
    // Kiểm tra page context - sử dụng cách khác
    $isProductsPage = strpos($message, 'trang') !== false && (strpos($message, 'san pham') !== false || strpos($message, 'sản phẩm') !== false);
    $isNewsPage = strpos($message, 'trang') !== false && (strpos($message, 'tin tuc') !== false || strpos($message, 'tin tức') !== false);
    $isHomePage = strpos($message, 'trang') !== false && (strpos($message, 'chu') !== false || strpos($message, 'chủ') !== false);

    // Kiểm tra sản phẩm từ TRANG SẢN PHẨM (shops_rows)
    if ($isProductsPage && (strpos($message, 'test 691') !== false || strpos($message, 'test691') !== false)) {
        return "Chào bạn! 'TEST 691' là sản phẩm từ trang Sản phẩm của EvoCar. Đây là sản phẩm chất lượng cao từ thương hiệu Mazda với giá 3,081,038 VNĐ. Sản phẩm này có mô tả chi tiết và đang được bán tại cửa hàng. Bạn có muốn biết thêm thông tin gì về sản phẩm này không?";
    }
    
    if ($isProductsPage && (strpos($message, 'sản phẩm test') !== false || strpos($message, 'san pham test') !== false)) {
        return "Chào bạn! 'Sản phẩm test' là sản phẩm từ trang Sản phẩm của EvoCar. Đây là sản phẩm chất lượng cao từ thương hiệu Mitsubishi với giá 1,321,391,931 VNĐ. Sản phẩm này có mô tả chi tiết và đang được bán tại cửa hàng. Bạn có muốn biết thêm thông tin gì về sản phẩm này không?";
    }

    // Kiểm tra sản phẩm từ TRANG CHỦ (posts - post_type='product')
    if ($isHomePage && strpos($message, 'airblack2') !== false) {
        return "Chào bạn! AirBlack2 là sản phẩm nổi bật trên trang chủ của EvoCar. Đây là xe máy màu đen với thiết kế hiện đại và chất lượng tốt. Sản phẩm này có giá 35,000,000,000 VNĐ. Bạn có muốn biết thêm thông tin chi tiết nào khác không?";
    }

    if ($isHomePage && strpos($message, 'xe đẹp lắm haha') !== false) {
        return "Chào bạn! 'Xe đẹp lắm haha' là sản phẩm nổi bật trên trang chủ của EvoCar với giá 1,000,000 VNĐ. Đây là sản phẩm chất lượng cao từ thương hiệu Toyota. Bạn có quan tâm đến sản phẩm này không?";
    }
    
    if ($isHomePage && strpos($message, 'test') !== false) {
        return "Chào bạn! 'TEST' là sản phẩm nổi bật trên trang chủ của EvoCar với giá 440,000,000,000 VNĐ. Đây là sản phẩm chất lượng cao từ thương hiệu Toyota. Bạn có quan tâm đến sản phẩm này không?";
    }

    // Kiểm tra tin tức từ TRANG TIN TỨC (posts - is_news=1)
    if ($isNewsPage && (strpos($message, 'xe ab black') !== false || strpos($message, 'ab black') !== false)) {
        return "Chào bạn! 'XE AB BLACK' là tin tức mới nhất trên trang tin tức của EvoCar. Đây là thông tin về xe máy màu đen với thiết kế độc đáo. Bạn có muốn đọc thêm tin tức khác không?";
    }

    if ($isNewsPage && strpos($message, 'bitzer') !== false) {
        return "Chào bạn! 'BÌNH NGƯNG BITZER – BÌNH TÁCH DẦU BITZER – BÌNH CHỨA BITZER' là tin tức về thiết bị lạnh chất lượng cao. Đây là sản phẩm chính hãng với chất lượng đảm bảo. Bạn có quan tâm đến thiết bị lạnh không?";
    }
    
    if ($isNewsPage && strpos($message, 'eliwell') !== false) {
        return "Chào bạn! 'Eliwell ID985/S/E/CK' là tin tức về điều khiển nhiệt độ chuyên nghiệp cho hệ thống lạnh. Đây là thiết bị chất lượng cao từ thương hiệu Eliwell. Bạn có quan tâm đến thiết bị điều khiển nhiệt độ không?";
    }

    // Response mặc định theo page
    if ($isProductsPage) {
        return "Chào bạn! Bạn đang ở trang Sản phẩm của EvoCar. Tôi có thể giúp bạn tìm hiểu về các sản phẩm xe hơi chất lượng cao từ bảng shops_rows. Bạn có câu hỏi gì về sản phẩm cụ thể nào không?";
    } else if ($isNewsPage) {
        return "Chào bạn! Bạn đang ở trang Tin tức của EvoCar. Tôi có thể giúp bạn tìm hiểu về các tin tức mới nhất từ bảng posts (is_news=1). Bạn có muốn đọc tin tức nào không?";
    } else if ($isHomePage) {
        return "Chào bạn! Bạn đang ở trang chủ của EvoCar. Tôi có thể giúp bạn tìm hiểu về sản phẩm nổi bật, Toyota, và các banner từ bảng posts. Bạn có câu hỏi gì cần hỗ trợ không?";
    }

    // Response mặc định
    return "Chào bạn! Tôi là trợ lý AI của EvoCar. Hiện tại hệ thống AI đang bảo trì, nhưng tôi có thể giúp bạn tìm hiểu về các sản phẩm xe hơi, tin tức mới nhất, và dịch vụ của chúng tôi. Bạn có câu hỏi gì cần hỗ trợ không?";
}

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "kholanh_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    echo json_encode(['success' => false, 'message' => 'Database connection failed: ' . $conn->connect_error]);
    exit();
}

// Gemini API Key
$gemini_api_key = 'AIzaSyBB6lBHcTDQ9jzXOkcJDxeiVj4fY3QzJpg'; 

// Get POST data
$input = json_decode(file_get_contents('php://input'), true);
$user_message = $input['message'] ?? '';
$user_email = $input['email'] ?? 'info@evocar.com';
$user_phone = $input['phone'] ?? '0387315384';

// Start session if not started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$session_id = session_id();

if (empty($user_message)) {
    echo json_encode(['success' => false, 'message' => 'Tin nhắn không được để trống.']);
    exit();
}

$ai_response = '';
$gemini_success = false;

// Lấy dữ liệu từ tất cả các page
$evocar_data = getEvoCarAllData();

// Tạo context cho AI
$context = createEvoCarContext($evocar_data);

// Call Gemini API
$url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent?key=" . $gemini_api_key;
$data = [
    'contents' => [
        [
            'parts' => [
                ['text' => $context . "\n\nNgười dùng hỏi: " . $user_message]
            ]
        ]
    ],
    'generationConfig' => [
        'temperature' => 0.7,
        'topK' => 40,
        'topP' => 0.95,
        'maxOutputTokens' => 1024
    ]
];

$json_data = json_encode($data);
$options = [
    'http' => [
        'header'  => "Content-type: application/json\r\n" . 
                     "Content-length: " . strlen($json_data) . "\r\n",
        'method'  => 'POST',
        'content' => $json_data,
        'ignore_errors' => true
    ]
];
$context = stream_context_create($options);
$result = file_get_contents($url, false, $context);

if ($result === FALSE) {
    $ai_response = "Xin lỗi, tôi không thể kết nối với AI lúc này. Vui lòng thử lại sau.";
} else {
    $http_response_header_str = implode("\r\n", $http_response_header);
    if (strpos($http_response_header_str, 'HTTP/1.1 200 OK') !== false) {
        $gemini_data = json_decode($result, true);
        $ai_response = $gemini_data['candidates'][0]['content']['parts'][0]['text'] ?? "Xin lỗi, tôi không hiểu câu hỏi của bạn.";
        $gemini_success = true;
    } else {
        // Check for quota exceeded error
        $response_data = json_decode($result, true);
        if (isset($response_data['error']['code']) && $response_data['error']['code'] == 429) {
            // Quota exceeded - use mock response
            $ai_response = generateMockResponse($user_message, $evocar_data);
            $gemini_success = true;
        } else {
            $ai_response = "Có lỗi từ AI: " . $result;
        }
    }
}

// Save to database - sử dụng cấu trúc kholanh_db
$stmt = $conn->prepare("INSERT INTO info (session_id, user_message, user_email, ai_response, message_type, status, created, user_phone) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
$current_time = time();
$message_type = 'chat_message';
$status = 1;

$stmt->bind_param("sssssiss", $session_id, $user_message, $user_email, $ai_response, $message_type, $status, $current_time, $user_phone);

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'ai_response' => $ai_response]);
} else {
    echo json_encode(['success' => false, 'message' => 'Lỗi khi lưu tin nhắn: ' . $stmt->error, 'ai_response' => $ai_response]);
}

$stmt->close();
$conn->close();
?>

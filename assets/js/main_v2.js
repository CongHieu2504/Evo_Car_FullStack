console.log('==== MAIN JS LOADED ====');

// Function để load lịch sử chat từ localStorage
function loadChatHistory() {
    const chatHistory = localStorage.getItem('evocar_chat_history');
    if (chatHistory) {
        const messages = JSON.parse(chatHistory);
        const chatMessages = document.getElementById('chat-messages');

        if (chatMessages && messages.length > 0) {
            // Hiện messages area
            chatMessages.style.display = 'block';
            // Clear cũ trước khi render lại
            chatMessages.innerHTML = '';

            // Load từng message
            messages.forEach(msg => {
                addMessageToChat(msg.message, msg.type, false);
            });

            // Chuyển sang chat mode
            switchToChatMode();

            // Scroll xuống cuối
            scrollToBottom();
        }
    }
}

// Function để detect page hiện tại
function getCurrentPageContext() {
    const currentUrl = window.location.pathname;
    const currentPage = currentUrl.split('/').pop();

    let pageContext = '';

    if (currentPage === 'products' || currentUrl.includes('/products')) {
        pageContext = 'TRANG SẢN PHẨM - Hiện tại bạn đang xem danh sách sản phẩm từ bảng shops_rows. ';
    } else if (currentPage === 'news' || currentUrl.includes('/news') || currentUrl.includes('/tin-tuc')) {
        pageContext = 'TRANG TIN TỨC - Hiện tại bạn đang xem tin tức từ bảng posts. ';
    } else if (currentPage === '' || currentPage === 'index' || currentUrl.includes('/trang-chu')) {
        pageContext = 'TRANG CHỦ - Hiện tại bạn đang xem sản phẩm nổi bật từ bảng posts. ';
    } else {
        pageContext = 'TRANG KHÁC - Bạn đang ở trang khác. ';
    }

    return pageContext;
}

// Function để setup logout event listener
function setupLogoutListener() {
    // Tìm tất cả nút logout
    const logoutLinks = document.querySelectorAll('a[href*="logout"]');

    logoutLinks.forEach(link => {
        link.addEventListener('click', function (e) {
            // Xóa chat trước khi logout
            clearChatOnLogout();
            console.log('✅ Chat cleared before logout');
        });
    });
}

// Setup logout listener khi DOM ready
document.addEventListener('DOMContentLoaded', function () {
    setupLogoutListener();
});

// Setup logout listener khi page load
window.addEventListener('load', function () {
    setupLogoutListener();
});

// Function để lưu chat vào localStorage
function saveChatToHistory(message, type) {
    const chatHistory = JSON.parse(localStorage.getItem('evocar_chat_history') || '[]');
    chatHistory.push({
        message: message,
        type: type,
        timestamp: new Date().toISOString()
    });

    // Chỉ lưu 50 tin nhắn gần nhất
    if (chatHistory.length > 50) {
        chatHistory.splice(0, chatHistory.length - 50);
    }

    localStorage.setItem('evocar_chat_history', JSON.stringify(chatHistory));
}

// Function để xóa cuộc trò chuyện
function clearChatHistory() {
    if (confirm('Bạn có chắc chắn muốn xóa cuộc trò chuyện này không?')) {
        // Xóa localStorage
        localStorage.removeItem('evocar_chat_history');

        // Xóa tin nhắn trên màn hình
        const chatMessages = document.getElementById('chat-messages');
        if (chatMessages) {
            chatMessages.innerHTML = '';
            chatMessages.style.display = 'none';
        }

        // Reset về trạng thái ban đầu
        const popupBody = document.querySelector('.chat-popup-body');
        if (popupBody) {
            popupBody.classList.remove('chat-mode');
        }

        // Hiện lại greeting
        const greeting = document.querySelector('.chat-assistant-greeting');
        if (greeting) {
            greeting.style.display = 'block';
        }

        // Reset button
        const sendBtn = document.getElementById('chat-send-btn');
        const hint = document.getElementById('chat-hint');

        if (sendBtn) {
            sendBtn.innerHTML = '<i class="bi bi-send"></i> BẮT ĐẦU TRÒ CHUYỆN';
            sendBtn.onclick = function () { startChat(); };
        }

        if (hint) {
            hint.textContent = 'Hãy nhập';
        }

        // Clear input
        const input = document.getElementById('chat-message-input');
        if (input) {
            input.value = '';
        }

        console.log('✅ Chat history cleared');
    }
}

// Function để xóa chat khi logout (không cần confirm)
function clearChatOnLogout() {
    // Xóa localStorage
    localStorage.removeItem('evocar_chat_history');

    // Xóa tin nhắn trên màn hình
    const chatMessages = document.getElementById('chat-messages');
    if (chatMessages) {
        chatMessages.innerHTML = '';
        chatMessages.style.display = 'none';
    }

    // Reset về trạng thái ban đầu
    const popupBody = document.querySelector('.chat-popup-body');
    if (popupBody) {
        popupBody.classList.remove('chat-mode');
    }

    // Hiện lại greeting
    const greeting = document.querySelector('.chat-assistant-greeting');
    if (greeting) {
        greeting.style.display = 'block';
    }

    // Reset button
    const sendBtn = document.getElementById('chat-send-btn');
    const hint = document.getElementById('chat-hint');

    if (sendBtn) {
        sendBtn.innerHTML = '<i class="bi bi-send"></i> BẮT ĐẦU TRÒ CHUYỆN';
        sendBtn.onclick = function () { startChat(); };
    }

    if (hint) {
        hint.textContent = 'Hãy nhập';
    }

    // Clear input
    const input = document.getElementById('chat-message-input');
    if (input) {
        input.value = '';
    }

    console.log('✅ Chat history cleared on logout');
}

// Chat Popup Functions
window.toggleChatPopup = function () {
    console.log('toggleChatPopup called');
    const chatPopup = document.getElementById('chat-popup');
    console.log('chatPopup element:', chatPopup);

    if (chatPopup) {
        chatPopup.classList.toggle('show');
        console.log('chatPopup classes:', chatPopup.classList.toString());
        if (chatPopup.classList.contains('show')) {
            // Load lịch sử chat khi mở popup
            loadChatHistory();

            setTimeout(() => {
                const input = document.getElementById('chat-message-input');
                if (input) input.focus();
            }, 300);
        }
    } else {
        console.error('chat-popup element not found!');
    }
};

window.startChat = function () {
    const input = document.getElementById('chat-message-input');
    const message = input.value.trim();

    if (!message) {
        alert('Vui lòng nhập tin nhắn của bạn!');
        return;
    }

    // Disable button và hiện loading
    const sendBtn = document.querySelector('.chat-send-btn');
    const originalText = sendBtn.innerHTML;
    sendBtn.innerHTML = '<i class="bi bi-hourglass-split"></i> Đang gửi...';
    sendBtn.disabled = true;

    // Get current page context
    const pageContext = getCurrentPageContext();
    const messageWithContext = pageContext + message;

    // Gửi tin nhắn đến API
    console.log('Sending message to:', '/kholanh/chat_api.php');
    console.log('Page Context:', pageContext);
    console.log('Message with Context:', messageWithContext);
    fetch('/kholanh/chat_api.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            message: messageWithContext,
            email: 'info@evocar.com',
            phone: '0387315384'
        })
    })
        .then(response => {
            console.log('Response status:', response.status);
            return response.text();
        })
        .then(text => {
            console.log('Response text:', text);
            try {
                const data = JSON.parse(text);
                if (data.success) {
                    // Chuyển sang chế độ chat (ẩn greeting, hiện messages)
                    switchToChatMode();

                    // Thêm tin nhắn user vào chat
                    addMessageToChat(message, 'user');

                    // Thêm phản hồi AI vào chat
                    addMessageToChat(data.ai_response, 'ai');

                    // Clear input
                    input.value = '';

                    // Scroll xuống cuối
                    scrollToBottom();
                } else {
                    addMessageToChat('Lỗi: ' + data.message, 'ai');
                }
            } catch (e) {
                console.error('JSON parse error:', e);
                addMessageToChat('Lỗi kết nối. Vui lòng thử lại!', 'ai');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Có lỗi xảy ra khi gửi tin nhắn. Vui lòng thử lại!');
        })
        .finally(() => {
            // Restore button
            sendBtn.innerHTML = originalText;
            sendBtn.disabled = false;
        });
};

// Function để thêm tin nhắn vào chat
function addMessageToChat(message, type, persist = true) {
    const chatMessages = document.getElementById('chat-messages');
    if (!chatMessages) return;

    const messageDiv = document.createElement('div');
    messageDiv.className = `chat-message ${type}`;

    const avatar = document.createElement('div');
    avatar.className = 'chat-message-avatar';
    avatar.innerHTML = type === 'user' ? '<i class="bi bi-person-fill"></i>' : '<i class="bi bi-robot"></i>';

    const content = document.createElement('div');
    content.className = 'chat-message-content';
    content.innerHTML = message.replace(/\n/g, '<br>');

    const time = document.createElement('div');
    time.className = 'chat-message-time';
    time.textContent = new Date().toLocaleTimeString('vi-VN', { hour: '2-digit', minute: '2-digit' });

    content.appendChild(time);
    messageDiv.appendChild(avatar);
    messageDiv.appendChild(content);

    chatMessages.appendChild(messageDiv);

    // Lưu vào localStorage chỉ khi không phải render từ history
    if (persist) {
        saveChatToHistory(message, type);
    }
}

// Function để scroll xuống cuối
function scrollToBottom() {
    const chatMessages = document.getElementById('chat-messages');
    if (chatMessages) {
        chatMessages.scrollTop = chatMessages.scrollHeight;
    }

    // Auto scroll to input section
    setTimeout(() => {
        const inputSection = document.querySelector('.chat-input-section');
        if (inputSection) {
            inputSection.scrollIntoView({ behavior: 'smooth', block: 'end' });
        }
    }, 100);
}

// Function để chuyển sang chế độ chat
function switchToChatMode() {
    console.log('=== Switching to chat mode ===');

    // Thêm class chat-mode cho popup body
    const popupBody = document.querySelector('.chat-popup-body');
    if (popupBody) {
        popupBody.classList.add('chat-mode');
        console.log('✅ Added chat-mode class');
    }

    // Ẩn greeting
    const greeting = document.querySelector('.chat-assistant-greeting');
    if (greeting) {
        greeting.style.display = 'none';
        console.log('✅ Greeting hidden');
    }

    // Hiện messages area
    const chatMessages = document.getElementById('chat-messages');
    if (chatMessages) {
        chatMessages.style.display = 'block';
        console.log('✅ Messages area shown');
    }

    // Thay đổi button text và hint
    const sendBtn = document.getElementById('chat-send-btn');
    const hint = document.getElementById('chat-hint');

    if (sendBtn) {
        sendBtn.innerHTML = '<i class="bi bi-send"></i> Gửi';
        sendBtn.onclick = function () { sendMessage(); };
        console.log('✅ Button changed to "Gửi"');
    }

    if (hint) {
        hint.textContent = 'Nhập tin nhắn...';
        console.log('✅ Hint changed');
    }
}

// Function để gửi tin nhắn (sau khi đã chuyển sang chat mode)
function sendMessage() {
    const input = document.getElementById('chat-message-input');
    const message = input.value.trim();

    if (!message) {
        alert('Vui lòng nhập tin nhắn của bạn!');
        return;
    }

    // Disable button và hiện loading
    const sendBtn = document.getElementById('chat-send-btn');
    const originalText = sendBtn.innerHTML;
    sendBtn.innerHTML = '<i class="bi bi-hourglass-split"></i> Đang gửi...';
    sendBtn.disabled = true;

    // Get current page context
    const pageContext = getCurrentPageContext();
    const messageWithContext = pageContext + message;

    // Gửi tin nhắn đến API
    console.log('=== SENDING MESSAGE ===');
    console.log('Message:', message);
    console.log('Page Context:', pageContext);
    console.log('Message with Context:', messageWithContext);

    fetch('/kholanh/chat_api.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            message: messageWithContext,
            email: 'info@evocar.com',
            phone: '0387315384'
        })
    })
        .then(response => {
            console.log('Response status:', response.status);
            return response.text();
        })
        .then(text => {
            console.log('Response text:', text);
            try {
                const data = JSON.parse(text);
                console.log('Parsed data:', data);
                if (data.success) {
                    console.log('✅ API success, adding messages to chat');

                    // Thêm tin nhắn user vào chat
                    addMessageToChat(message, 'user');
                    console.log('✅ User message added');

                    // Thêm phản hồi AI vào chat
                    addMessageToChat(data.ai_response, 'ai');
                    console.log('✅ AI response added');

                    // Clear input
                    input.value = '';

                    // Scroll xuống cuối
                    scrollToBottom();
                    console.log('✅ Chat completed successfully');
                } else {
                    console.error('❌ API error:', data.message);
                    addMessageToChat('Lỗi: ' + data.message, 'ai');
                }
            } catch (e) {
                console.error('❌ JSON parse error:', e);
                console.error('Raw response:', text);
                addMessageToChat('Lỗi kết nối. Vui lòng thử lại!', 'ai');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Có lỗi xảy ra khi gửi tin nhắn. Vui lòng thử lại!');
        })
        .finally(() => {
            // Restore button
            sendBtn.innerHTML = originalText;
            sendBtn.disabled = false;
        });
}

// Header
document.querySelectorAll('.dropdown').forEach(dropdown => {
    dropdown.addEventListener('click', (e) => {
        const mainLink = dropdown.querySelector('a');
        if (e.target === mainLink) {
            return;
        }
        e.preventDefault();
        dropdown.classList.toggle('active');
    });
});

// Toggle modal khi nhấn nút ☰ trên mobile
document.querySelector('.mobile-nav-toggle').addEventListener('click', () => {
    if (window.innerWidth <= 768) {
        const modal = document.querySelector('#mobile-nav-modal');
        modal.classList.toggle('active');
    }
});

// Đóng modal khi nhấn nút close
document.querySelector('#modal-close').addEventListener('click', () => {
    const modal = document.querySelector('#mobile-nav-modal');
    modal.classList.remove('active');
});

// Đóng modal khi nhấn vào overlay
document.querySelector('.modal-overlay').addEventListener('click', (e) => {
    if (e.target === document.querySelector('.modal-overlay')) {
        const modal = document.querySelector('#mobile-nav-modal');
        modal.classList.remove('active');
    }
});

// Toggle sub-menu for Sản Phẩm
document.querySelector('.modal-product-toggle').addEventListener('click', (e) => {
    e.preventDefault();
    const dropdown = e.currentTarget.closest('.modal-dropdown');
    const subMenu = dropdown.querySelector('.modal-sub-menu');
    const toggleIcon = dropdown.querySelector('.toggle-icon');
    const isActive = dropdown.classList.contains('active');

    if (!isActive) {
        subMenu.innerHTML = `
            <li><a href="#">Hatch Back</a></li>
            <li><a href="#">Sedan</a></li>
            <li><a href="#">Pick Up</a></li>
            <li><a href="#">MPV</a></li>
            <li><a href="#">SUV</a></li>
            <li><a href="#">Crossover</a></li>
            <li><a href="#">Coupe - Xe Thế Thao</a></li>
            <li><a href="#">Convertible - Xe Mui Trần</a></li>
        `;
        dropdown.classList.add('active');
        toggleIcon.textContent = '-';
    } else {
        subMenu.innerHTML = '';
        dropdown.classList.remove('active');
        toggleIcon.textContent = '+';
    }
});

// Toggle sub-menu for Tin tức
document.querySelector('.modal-news-toggle').addEventListener('click', (e) => {
    e.preventDefault();
    const dropdown = e.currentTarget.closest('.modal-dropdown');
    const subMenu = dropdown.querySelector('.modal-news-sub-menu');
    const toggleIcon = dropdown.querySelector('.toggle-icon');
    const isActive = dropdown.classList.contains('active');

    if (!isActive) {
        dropdown.classList.add('active');
        toggleIcon.textContent = '-';
    } else {
        dropdown.classList.remove('active');
        toggleIcon.textContent = '+';
    }
});

// Thêm sự kiện click cho các mục menu mobile
// Sản Phẩm
const mobileProduct = document.querySelector('.modal-product-toggle');
if (mobileProduct) {
    mobileProduct.addEventListener('dblclick', function (e) {
        // Nếu người dùng double click vào "Sản Phẩm" thì chuyển trang
        window.location.href = '/kholanh/san-pham';
    });
}
// Tin tức
const mobileNews = document.querySelector('.modal-news-toggle');
if (mobileNews) {
    mobileNews.addEventListener('dblclick', function (e) {
        window.location.href = '/kholanh/tin-tuc';
    });
}
// Liên hệ
const mobileContact = document.querySelector('.modal-menu a[href="/kholanh/lien-he"]');
if (mobileContact) {
    mobileContact.addEventListener('click', function (e) {
        window.location.href = '/kholanh/lien-he';
    });
}

document.addEventListener('DOMContentLoaded', function () {
    // KHỞI TẠO SWIPER CHO TOYOTA
    if (document.querySelector('.toyota-swiper')) {
        var toyotaSwiper = new Swiper('.toyota-swiper', {
            slidesPerView: 4,
            spaceBetween: 24,
            loop: true,
            navigation: {
                nextEl: '.toyota-swiper .swiper-button-next',
                prevEl: '.toyota-swiper .swiper-button-prev',
            },
            pagination: {
                el: '.toyota-swiper .swiper-pagination',
                clickable: true,
            },
            allowTouchMove: false,
            breakpoints: {
                0: { slidesPerView: 1, spaceBetween: 10 },
                576: { slidesPerView: 2, spaceBetween: 15 },
                992: { slidesPerView: 4, spaceBetween: 24 }
            }
        });
        console.log('Swiper Toyota đã khởi tạo:', toyotaSwiper);
        // Ép khởi tạo lại sau 200ms nếu lần đầu không bấm được
        setTimeout(function () {
            if (typeof toyotaSwiper.update === 'function') {
                toyotaSwiper.update();
                toyotaSwiper.updateSlides && toyotaSwiper.updateSlides();
                toyotaSwiper.updateProgress && toyotaSwiper.updateProgress();
                toyotaSwiper.updateSlidesClasses && toyotaSwiper.updateSlidesClasses();
                console.log('Swiper Toyota ép update lại!');
            }
        }, 200);
    }

    // Khởi tạo Swiper cho Banner
    var bannerSwiper = new Swiper('.banner-swiper', {
        slidesPerView: 4,
        slidesPerGroup: 4,
        spaceBetween: 20,
        loop: true,
        loopFillGroupWithBlank: true,
        pagination: {
            el: '.banner-swiper .swiper-pagination',
            clickable: true,
        },
        breakpoints: {
            0: {
                slidesPerView: 1,
                slidesPerGroup: 1,
                spaceBetween: 10,
            },
            576: {
                slidesPerView: 2,
                slidesPerGroup: 2,
                spaceBetween: 15,
            },
            992: {
                slidesPerView: 3,
                slidesPerGroup: 3,
                spaceBetween: 20,
            },
            1200: {
                slidesPerView: 4,
                slidesPerGroup: 4,
                spaceBetween: 20,
            }
        }
    });

    // Khởi tạo Swiper cho Banner Title
    var bannerTitleSwiper = new Swiper('.banner-title-swiper', {
        slidesPerView: 3,
        spaceBetween: 20,
        loop: true,
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        breakpoints: {
            0: {
                slidesPerView: 1,
                spaceBetween: 10,
            },
            576: {
                slidesPerView: 2,
                spaceBetween: 15,
            },
            992: {
                slidesPerView: 3,
                spaceBetween: 20,
            }
        }
    });

    // --- Floating AI Chat & Notification Bell ---
    if (!document.getElementById('floating-chat-btn')) {
        const chatBtn = document.createElement('div');
        chatBtn.id = 'floating-chat-btn';
        chatBtn.className = 'floating-chat-btn';
        chatBtn.innerHTML = '<i class="bi bi-chat-dots-fill"></i>';
        chatBtn.title = 'Chat với tư vấn';
        chatBtn.onclick = function () {
            toggleChatPopup();
        };
        document.body.appendChild(chatBtn);
    }
    if (!document.getElementById('floating-bell-btn')) {
        const bellBtn = document.createElement('div');
        bellBtn.id = 'floating-bell-btn';
        bellBtn.className = 'floating-bell-btn';
        bellBtn.innerHTML = '<i class="bi bi-bell-fill"></i>';
        bellBtn.title = 'Thông báo';
        bellBtn.onclick = function () {
            const popup = document.getElementById('bell-popup');
            popup.classList.toggle('active');
        };
        document.body.appendChild(bellBtn);
    }
    if (!document.getElementById('bell-popup')) {
        const popup = document.createElement('div');
        popup.id = 'bell-popup';
        popup.className = 'bell-popup';
        popup.innerHTML = `
            <button class="bell-popup-close" title="Đóng">&times;</button>
            <h4>Tích hợp sẵn các ứng dụng</h4>
            <ul>
                <li><i class="bi bi-chevron-double-right"></i> Đánh giá sản phẩm</li>
                <li><i class="bi bi-chevron-double-right"></i> Mua X tặng Y</li>
                <li><i class="bi bi-chevron-double-right"></i> Ứng dụng Affiliate</li>
                <li><i class="bi bi-chevron-double-right"></i> Đa ngôn ngữ</li>
                <li><i class="bi bi-chevron-double-right"></i> Chatlive Facebook</li>
            </ul>
            <div class="bell-popup-note">
                Lưu ý với các ứng dụng trả phí bạn cần cài đặt và mua ứng dụng này trên App store Sapo để sử dụng ngay
            </div>
        `;
        document.body.appendChild(popup);
        popup.querySelector('.bell-popup-close').onclick = function () {
            popup.classList.remove('active');
        };
    }

    // Logic hiệu ứng cho mục Toyota (từ FE gốc)
    const toyotaContainer = document.getElementById('toyota-container');
    if (toyotaContainer) {
        // Thêm sự kiện click cho icon toggle (flip card)
        toyotaContainer.addEventListener('click', (e) => {
            const icon = e.target.closest('.product-icon i');
            if (icon) {
                const card = icon.closest('.product-card');
                const front = card.querySelector('.product-front');
                const back = card.querySelector('.product-back');
                card.classList.toggle('show-details');
                if (card.classList.contains('show-details')) {
                    front.style.display = 'none';
                    back.style.display = 'block';
                } else {
                    front.style.display = 'block';
                    back.style.display = 'none';
                }
                e.stopPropagation();
            }
        });

        // Thêm sự kiện click để chuyển hướng chi tiết sản phẩm
        toyotaContainer.addEventListener('click', (e) => {
            const card = e.target.closest('.product-card');
            if (card && !e.target.closest('.product-icon')) {
                const productId = card.getAttribute('data-product-id');
                if (productId && !productId.startsWith('toyota-sample-')) {
                    // Chuyển đến trang chi tiết sản phẩm
                    window.location.href = '/kholanh/shops/rows/site_details/' + productId;
                }
            }
        });

        // Thêm sự kiện hover cho icon
        document.querySelectorAll('.toyota-swiper .product-card').forEach(card => {
            const icon = card.querySelector('.product-icon i');
            if (icon) {
                card.addEventListener('mouseover', () => {
                    if (!card.classList.contains('show-details')) {
                        icon.style.opacity = '1';
                    }
                });
                card.addEventListener('mouseout', () => {
                    if (!card.classList.contains('show-details')) {
                        icon.style.opacity = '0';
                    }
                });
            }
        });
    }
});
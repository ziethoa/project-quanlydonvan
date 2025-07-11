<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ - Minh Khôi Logistics</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/home.css">
    @stack('css')

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" />
    <link rel="icon" type="image/x-icon" href="../images/favicon.ico" />
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/xlsx@0.18.5/dist/xlsx.full.min.js"></script>
</head>

<body>
    @yield('overlay')
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <img src="images/newlogo2-removebg.png" alt="Mien Tay Express Logo" class="logo">
        </div>
        <nav class="menu-items" aria-label="Main Navigation">
            <ul>
                <li><a href="/" class="active"><i class="fa-solid fa-house icon"></i><span class="menu-text">TRANG
                            CHỦ</span></a></li>
                <li><a href="/create_package"><i class="fa-solid fa-plus icon"></i><span class="menu-text">TẠO
                            ĐƠN HÀNG</span></a></li>
                <li>
                    <a href="#" class="submenu-parent"> <i class="fa-solid fa-chart-pie icon"></i><span
                            class="menu-text">QUẢN LÝ</span><i class="fa-solid fa-chevron-down submenu-arrow"></i> </a>
                    <div class="submenu">
                        <ul>
                            <li><a href="/package_manager"><i class="fa-solid fa-box-archive icon"></i><span
                                        class="menu-text">Quản lý đơn hàng</span></a></li>
                            <li><a href="/landing_status"><i
                                        class="fa-solid fa-list-check icon"></i><span class="menu-text">Quản lý trạng
                                        thái</span></a></li>
                            <li><a href="/pickup_package"><i class="fa-solid fa-truck-fast icon"></i><span
                                        class="menu-text">Quản lý vận chuyển</span></a></li>
                            <li><a href="#"><i class="fa-solid fa-building-user icon"></i><span class="menu-text">Quản
                                        lý chi nhánh</span></a></li>
                            <li><a href="/payment_management"><i
                                        class="fa-solid fa-dollar-sign icon"></i><span class="menu-text">Quản lý thanh
                                        toán</span></a></li>
                        </ul>
                    </div>
                </li>
                <li><a href="/statistics_management"><i class="fa-solid fa-chart-line icon"></i><span
                            class="menu-text">THỐNG KÊ</span></a></li>
                <li><a href="/service_management"><i class="fa-solid fa-screwdriver-wrench icon"></i><span
                            class="menu-text">QL DỊCH VỤ</span></a></li>
                <li>
                    <a href="/customer_list"><i class="fa-solid fa-users icon"></i><span class="menu-text">QL KHÁCH
                            HÀNG</span></a>
                </li>
                <li><a href="/employee_list"><i class="fa-solid fa-user-tie icon"></i><span
                            class="menu-text">QL NHÂN SỰ</span></a></li>
                <li><a href="#"><i class="fa-solid fa-circle-info icon"></i><span class="menu-text">THÔNG TIN CÔNG
                            TY</span></a></li>
                <li>
                    <a href="#" class="submenu-parent"><i class="fa-solid fa-scroll icon"></i><span class="menu-text">QL
                            CHÍNH SÁCH</span><i class="fa-solid fa-chevron-down submenu-arrow"></i></a>
                    <div class="submenu">
                        <ul>
                            <li><a href="#"><span class="menu-text">Chính sách A</span></a></li>
                            <li><a href="#"><span class="menu-text">Chính sách B</span></a></li>
                        </ul>
                    </div>
                </li>
                <li><a href="#"><i class="fa-solid fa-circle-question icon"></i><span class="menu-text">HƯỚNG DẪN SỬ
                            DỤNG</span></a></li>
                <li>
                    <a href="#" class="submenu-parent"><i class="fa-solid fa-gear icon"></i><span class="menu-text">CÀI
                            ĐẶT CHUNG</span><i class="fa-solid fa-chevron-down submenu-arrow"></i></a>
                    <div class="submenu">
                        <ul>
                            <li><a href="#"><span class="menu-text">Cài đặt A</span></a></li>
                            <li><a href="#"><span class="menu-text">Cài đặt B</span></a></li>
                        </ul>
                    </div>
                </li>
            </ul>
        </nav>
    </aside>
    <div class="sidebar-overlay" id="sidebar-overlay"></div>

    <main class="main-content" >
        <header class="header">
            <button class="mobile-sidebar-toggle" id="mobile-sidebar-toggle" aria-label="Toggle Navigation Menu"
                aria-controls="sidebar" aria-expanded="false" style="display: inline-flex;"><i
                    class="fa-solid fa-bars"></i></button>
            <div class="header-left">
                <div class="search-container">
                    <i class="fa-solid fa-magnifying-glass search-icon" id="mobile-search-toggle"></i>
                    <input type="text" class="header-search-input" placeholder="Tìm kiếm...">
                    <div class="mobile-search-overlay" id="mobile-search-overlay" style="display:none;">
                        <input type="text" id="mobile-search-input" class="mobile-search-input"
                            placeholder="Tìm kiếm...">
                        <button id="mobile-search-close" class="icon-button" type="button" aria-label="Đóng tìm kiếm"><i
                                class="fa-solid fa-xmark"></i></button>
                    </div>
                </div>
            </div>
            <div class="header-actions" style="display: flex; align-items: center; gap: 1.2rem; margin-left: auto;">
                <div class="notification-wrapper">
                    <button class="notification-button" id="notification-button" title="Thông báo">
                        <i class="fa-regular fa-bell"></i>
                        <span class="notification-badge">5</span>
                    </button>
                    <div class="notification-dropdown" id="notification-dropdown">
                        <div class="dropdown-header">Thông báo</div>
                        <ul class="notification-list" id="notification-list">
                            <li class="notification-item" data-title="Thông báo: DỜI CUT OFF CANADA 24/08/2024"
                                data-body="Do lượng hàng T7 (24/08/2024) không đủ tải, chuyến tuyến MTE-CAD sẽ kết nối hàng vào chuyến bay sớm nhất (Cs sẽ update giờ cut off mới)||MTE xin lỗi Quý khách vì sự chậm trễ gây ra bất tiện cho khách hàng.||Rất mong nhận sự thông cảm của Quý khách hàng.||Cs tuyến Canada."
                                data-timestamp="2024-07-25 13:53:27">
                                <div class="item-icon"><i class="fa-solid fa-calendar-xmark"></i></div>
                                <div class="item-content">
                                    <div class="item-title">Dời Cut off Canada 24/08/2024</div>
                                    <div class="item-time">25 Jul 2024</div>
                                </div>
                            </li>
                            <li class="notification-item" data-title="Thông báo: Cập nhật hệ thống"
                                data-body="Hệ thống sẽ được bảo trì vào lúc 02:00 AM ngày 30/07/2024. Vui lòng lưu lại công việc trước thời gian này."
                                data-timestamp="2024-07-28 10:00:00">
                                <div class="item-icon"><i class="fa-solid fa-wrench"></i></div>
                                <div class="item-content">
                                    <div class="item-title">Cập nhật hệ thống 30/07</div>
                                    <div class="item-time">28 Jul 2024</div>
                                </div>
                            </li>
                            <li class="notification-item" data-title="Thông báo: Khuyến mãi mới"
                                data-body="Chương trình khuyến mãi hè 2024 đã bắt đầu! Giảm giá 10% cho các tuyến đi Mỹ."
                                data-timestamp="2024-07-20 09:00:00">
                                <div class="item-icon"><i class="fa-solid fa-tags"></i></div>
                                <div class="item-content">
                                    <div class="item-title">Khuyến mãi hè 2024!</div>
                                    <div class="item-time">20 Jul 2024</div>
                                </div>
                            </li>
                        </ul>
                        <div class="dropdown-footer"><a href="#">Xem tất cả</a></div>
                    </div>
                </div>
                <div class="user-container" style="position: relative;">
                    <div class="user-dropdown-toggle" id="user-dropdown-toggle"
                        style="display: flex; align-items: center; gap: 6px; background: #6366f1; border-radius: 7px; padding: 6px 14px; cursor: pointer;">
                        <i class="fa-regular fa-circle-user user-icon" id="user-icon"
                            style="color: #fff; font-size: 1.25em;"></i>
                    </div>
                    <div class="user-dropdown" id="user-dropdown">
                    </div>
                </div>
        </header>


        @yield('main_content')

        @yield('notification')
        <footer class="site-footer">
            Minh Khôi Logistics © <span id="current-year"></span>. All rights reserved. Design by Nina Co.,Ltd
        </footer>


        <div class="announcement-overlay" id="announcement-overlay">
            <div class="announcement-box" id="announcement-box">
                <div class="announcement-header">
                    <h3 id="announcement-title"></h3><button class="announcement-close-btn" id="announcement-close-btn"
                        title="Đóng thông báo">×</button>
                </div>
                <div class="announcement-body" id="announcement-body"></div>
                <div class="announcement-footer"><span id="announcement-timestamp"></span></div>
            </div>
        </div>

    </main>
@stack('script')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const menuItems = document.querySelectorAll('.menu-items a');
        const submenus = document.querySelectorAll('.submenu');
        const submenuParents = document.querySelectorAll('.submenu-parent');

        // Xóa tất cả class active
        function clearActiveClasses() {
            menuItems.forEach(item => item.classList.remove('active'));
            submenus.forEach(submenu => submenu.classList.remove('active'));
        }

        // Set active dựa trên URL
        function setActiveMenu() {
            const currentPath = window.location.pathname;
            clearActiveClasses();

            menuItems.forEach(item => {
                const href = item.getAttribute('href');
                if (href === currentPath || (href === '/' && currentPath === '')) {
                    item.classList.add('active');
                    const submenu = item.closest('.submenu');
                    if (submenu) {
                        submenu.classList.add('active');
                        const parent = submenu.previousElementSibling;
                        if (parent?.classList.contains('submenu-parent')) {
                            parent.classList.add('active');
                        }
                    }
                }
            });
        }

        // Xử lý click cho menu items
        menuItems.forEach(item => {
            item.addEventListener('click', () => {
                clearActiveClasses();
                item.classList.add('active');
                const submenu = item.closest('.submenu');
                if (submenu) {
                    submenu.classList.add('active');
                    const parent = submenu.previousElementSibling;
                    if (parent?.classList.contains('submenu-parent')) {
                        parent.classList.add('active');
                    }
                }
            });
        });

        // Xử lý click cho submenu parents
        submenuParents.forEach(parent => {
            parent.addEventListener('click', () => {
                const submenu = parent.nextElementSibling;
                if (submenu?.classList.contains('submenu')) {
                    const isActive = submenu.classList.contains('active');
                    clearActiveClasses();
                    if (!isActive) {
                        parent.classList.add('active');
                        submenu.classList.add('active');
                    }
                }
            });
        });

        // Set active khi load trang
        setActiveMenu();

        // Xử lý thay đổi URL (browser history)
        window.addEventListener('popstate', setActiveMenu);
    });
</script>

{{-- login --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Hàm render dropdown người dùng
        function renderUserDropdown() {
            const isLoggedIn = localStorage.getItem('isLoggedIn') === 'true';
            const userToggle = document.getElementById('user-dropdown-toggle');
            const userDropdown = document.getElementById('user-dropdown');
            if (!userToggle || !userDropdown) return;

            if (!isLoggedIn) {
                // Chưa đăng nhập: Hiển thị biểu tượng user và mục đăng nhập
                userToggle.innerHTML = `
                    <div style="background: linear-gradient(135deg, #ffe066 0%, #a78bfa 100%); border-radius: 50%; width: 44px; height: 44px; display: flex; align-items: center; justify-content: center;">
                        <i class="fa-regular fa-circle-user user-icon" style="color: #4F46E5; font-size: 1.5em;"></i>
                    </div>
                `;
                userDropdown.innerHTML = `
                    <a href="#" class="user-dropdown-item" id="login-menu-item">
                        <i class="fa-solid fa-right-to-bracket"></i> Đăng nhập
                    </a>
                `;
                document.getElementById('username-display')?.classList.add('d-none');
            } else {
                // Đã đăng nhập: Hiển thị menu đầy đủ
                userToggle.innerHTML = `
                    <div style="background: linear-gradient(135deg, #ffe066 0%, #a78bfa 100%); border-radius: 50%; width: 44px; height: 44px; display: flex; align-items: center; justify-content: center;">
                        <i class="fa-regular fa-circle-user user-icon" style="color: #4F46E5; font-size: 1.5em;"></i>
                    </div>
                `;
                userDropdown.innerHTML = `
                    <div class="user-info">
                        <div class="user-avatar"><i class="fa-regular fa-circle-user"></i></div>
                        <div class="user-details">
                            <h4>Phạm Hoàng Đình</h4>
                            <span class="user-role">Quản trị viên</span>
                        </div>
                    </div>
                    <hr>
                    <a href="#" class="user-dropdown-item"><i class="fa-regular fa-user"></i> Thông tin cá nhân</a>
                    <a href="#" class="user-dropdown-item"><i class="fa-solid fa-gear"></i> Cài đặt tài khoản</a>
                    <a href="#" class="user-dropdown-item"><i class="fa-solid fa-bell"></i> Thông báo</a>
                    <a href="#" class="user-dropdown-item"><i class="fa-solid fa-shield-halved"></i> Bảo mật</a>
                    <hr>
                    <a href="#" class="user-dropdown-item" id="logout-menu-item"><i class="fa-solid fa-right-from-bracket"></i> Đăng xuất</a>
                `;
                document.getElementById('username-display')?.classList.remove('d-none');
            }

            // Gắn sự kiện cho menu đăng nhập/đăng xuất
            setTimeout(() => {
                const loginItem = document.getElementById('login-menu-item');
                if (loginItem) loginItem.onclick = function (e) {
                    e.preventDefault();
                    window.location.href = '/login'; // Có thể đổi thành 'pages/login.html' nếu cần
                };
                const logoutItem = document.getElementById('logout-menu-item');
                if (logoutItem) logoutItem.onclick = function (e) {
                    e.preventDefault();
                    localStorage.removeItem('isLoggedIn');
                    window.location.reload();
                };
            }, 100);
        }

        // Khởi tạo dropdown
        renderUserDropdown();
        window.addEventListener('storage', renderUserDropdown);

        // Xử lý toggle dropdown
        const userToggle = document.getElementById('user-dropdown-toggle');
        const userDropdown = document.getElementById('user-dropdown');
        if (userToggle && userDropdown) {
            userToggle.addEventListener('click', function (e) {
                e.stopPropagation();
                userDropdown.classList.toggle('show');
            });
            document.addEventListener('click', function (e) {
                if (!userDropdown.contains(e.target) && e.target !== userToggle) {
                    userDropdown.classList.remove('show');
                }
            });
        }
    });
</script>
</body>

</html>
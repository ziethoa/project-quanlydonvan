@extends('index')

@push('css')
<link rel="stylesheet" href="css/package_manager.css">
@endpush

@section('main_content')
<div class="content-wrapper dashboard-wrapper">
    <section class="welcome-header">
        <h1 id="welcome-message">Chào mừng trở lại, Phạm Hoàng Đình!</h1>
        <p>Tổng quan nhanh về hoạt động hôm nay của bạn.</p>
    </section>

    <section class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon icon-orders"><i class="fa-solid fa-box-open"></i></div>
            <div class="stat-content">
                <div class="stat-value">125</div>
                <div class="stat-label">Đơn hàng mới (hôm nay)</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon icon-pending"><i class="fa-solid fa-truck-fast"></i></div>
            <div class="stat-content">
                <div class="stat-value">42</div>
                <div class="stat-label">Đang vận chuyển</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon icon-revenue"><i class="fa-solid fa-dollar-sign"></i></div>
            <div class="stat-content">
                <div class="stat-value">15.6M</div>
                <div class="stat-label">Doanh thu (tháng này)</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon icon-issues"><i class="fa-solid fa-triangle-exclamation"></i></div>
            <div class="stat-content">
                <div class="stat-value">3</div>
                <div class="stat-label">Cần chú ý</div>
            </div>
        </div>
    </section>

    <section class="quick-actions">
        <h2>Truy cập nhanh</h2>
        <div class="action-buttons-group">
            <a href="/create_package" class="button primary"><i class="fa-solid fa-plus"></i> Tạo đơn
                hàng</a>
            <a href="/package_manager" class="button secondary"><i class="fa-solid fa-list-check"></i>
                Xem đơn hàng</a>
            <a href="/order_tracking" class="button"><i
                    class="fa-solid fa-magnifying-glass-chart"></i> Theo dõi vận đơn</a>
            <a href="/service_management" class="button"><i class="fa-solid fa-chart-line"></i> Xem
                báo cáo</a>
        </div>
    </section>

    <section class="recent-activity card">
        <h2>Hoạt động gần đây</h2>
        <ul id="activity-list">
            <li><span class="activity-icon icon-new"><i class="fa-solid fa-plus"></i></span><span
                    class="activity-desc">Đơn hàng <strong>MTE240815712</strong> vừa được tạo bởi <em>Alice
                        H.B</em>.</span><span class="activity-time">2 phút trước</span></li>
            <li><span class="activity-icon icon-update"><i class="fa-solid fa-truck"></i></span><span
                    class="activity-desc">Đơn hàng <strong>MTE240814998</strong> đã cập nhật trạng thái:
                    <strong>Đang phát hàng</strong>.</span><span class="activity-time">15 phút trước</span></li>
            <li><span class="activity-icon icon-complete"><i class="fa-solid fa-check-double"></i></span><span
                    class="activity-desc">Đơn hàng <strong>MTE240813015</strong> đã <strong>Hoàn
                        tất</strong>.</span><span class="activity-time">1 giờ trước</span></li>
            <li><span class="activity-icon icon-new"><i class="fa-solid fa-plus"></i></span><span
                    class="activity-desc">Đơn hàng <strong>MTE240815616</strong> vừa được tạo bởi <em>Trần
                        Q.Đ</em>.</span><span class="activity-time">3 giờ trước</span></li>
            <li><span class="activity-icon icon-alert"><i class="fa-solid fa-flag"></i></span><span
                    class="activity-desc">Đơn hàng <strong>MTE240812550</strong> cần kiểm tra thông tin người
                    nhận.</span><span class="activity-time">Hôm qua</span></li>
        </ul>
        <div class="card-footer-link">
            <a href="/package_manager">Xem tất cả hoạt động →</a>
        </div>
    </section>

    <footer class="site-footer">
        Minh Khôi Logistics © <span id="current-year">2025</span>. All rights reserved. Design by Nina Co.,Ltd
    </footer>

</div>
@endsection

@push('script')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const body = document.body;
        const sidebar = document.getElementById('sidebar');
        const sidebarOverlay = document.getElementById('sidebar-overlay');
        const mobileSidebarToggleBtn = document.getElementById('mobile-sidebar-toggle');
        const desktopSidebarToggleBtn = document.querySelector('.sidebar-toggle-desktop');
        const usernameDisplay = document.getElementById('username-display');
        const welcomeMessageElement = document.getElementById('welcome-message');
        const currentDateSpan = document.getElementById('current-date');
        const currentTimeSpan = document.getElementById('current-time');
        const currentYearSpan = document.getElementById('current-year');
        const fullscreenBtn = document.getElementById('fullscreen-btn');
        const notificationButton = document.getElementById('notification-button');
        const notificationDropdown = document.getElementById('notification-dropdown');
        const notificationList = document.getElementById('notification-list');
        const announcementOverlay = document.getElementById('announcement-overlay');
        const announcementBox = document.getElementById('announcement-box');
        const announcementCloseBtn = document.getElementById('announcement-close-btn');
        const announcementTitle = document.getElementById('announcement-title');
        const announcementBody = document.getElementById('announcement-body');
        const announcementTimestamp = document.getElementById('announcement-timestamp');
        const serviceTableBody = document.getElementById('service-table-body');
        const selectAllCheckbox = document.getElementById('select-all-checkbox');


        const manageBodyScroll = () => {
            const isSidebarOpen = body.classList.contains('sidebar-mobile-open');
            const isAnnounceVisible = announcementOverlay && announcementOverlay.classList.contains('visible');
            const isAnyOtherModalVisible = document.querySelector('.filter-modal.visible, .confirmation-modal.visible');
            if (isSidebarOpen || isAnnounceVisible || isAnyOtherModalVisible) {
                body.classList.add('overflow-hidden');
            } else {
                body.classList.remove('overflow-hidden');
            }
        };

        function toggleSidebarMobileOrDesktop() {
            if (window.innerWidth > 768) {
                // Desktop: thu/phóng sidebar
                body.classList.toggle('sidebar-collapsed');
            } else {
                // Mobile: mở/đóng sidebar
                body.classList.toggle('sidebar-mobile-open');
                const isOpen = body.classList.contains('sidebar-mobile-open');
                if (mobileSidebarToggleBtn) mobileSidebarToggleBtn.setAttribute('aria-expanded', String(isOpen));
            }
        }
        function toggleSidebarDesktop() {
            body.classList.toggle('sidebar-collapsed');
            const isCollapsed = body.classList.contains('sidebar-collapsed');
            if (desktopSidebarToggleBtn) {
                desktopSidebarToggleBtn.title = isCollapsed ? "Phóng Sidebar" : "Thu Sidebar";
                desktopSidebarToggleBtn.querySelector('i').style.transform = isCollapsed ? 'rotate(180deg)' : '';
            }
            if (isCollapsed) {
                document.querySelectorAll('.menu-items .submenu.active').forEach(submenu => {
                    submenu.classList.remove('active');
                    submenu.previousElementSibling?.classList.remove('active');
                });
            }
        }
        function toggleSubmenu(event) {
            event.preventDefault();
            const parentLink = event.currentTarget;
            const submenuWrapper = parentLink.nextElementSibling;
            if (!submenuWrapper || !submenuWrapper.classList.contains('submenu')) return;
            if (!parentLink.classList.contains('active')) {
                document.querySelectorAll('.menu-items .submenu-parent.active').forEach(activeParent => {
                    if (activeParent !== parentLink) {
                        activeParent.classList.remove('active');
                        activeParent.nextElementSibling?.classList.remove('active');
                    }
                });
            }
            submenuWrapper.classList.toggle('active');
            parentLink.classList.toggle('active');
        }
        function initializeActiveSubmenu() {
            const activeLink = document.querySelector('.sidebar .menu-items > li > a.active');
            const activeSubmenuLink = document.querySelector('.sidebar .submenu a.active');
            if (activeSubmenuLink) {
                const submenuDiv = activeSubmenuLink.closest('.submenu');
                const parentLink = submenuDiv?.previousElementSibling;
                if (submenuDiv && parentLink && parentLink.classList.contains('submenu-parent')) {
                    if (!activeLink || activeLink !== parentLink) {
                        submenuDiv.classList.add('active');
                        parentLink.classList.add('active');
                    }
                }
            }
        }

        function updateDateTime() {
            const now = new Date();
            const optionsDate = { weekday: 'short', day: '2-digit', month: '2-digit', year: 'numeric' };
            const optionsTime = { hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: true };
            try {
                let dayOfWeek; switch (now.getDay()) { case 0: dayOfWeek = "Sun"; break; case 1: dayOfWeek = "Mon"; break; case 2: dayOfWeek = "Tue"; break; case 3: dayOfWeek = "Wed"; break; case 4: dayOfWeek = "Thu"; break; case 5: dayOfWeek = "Fri"; break; case 6: dayOfWeek = "Sat"; break; default: dayOfWeek = ""; }
                const dateString = `${dayOfWeek} ${now.toLocaleDateString('en-GB', { day: '2-digit', month: '2-digit', year: 'numeric' })}`;
                if (currentDateSpan) currentDateSpan.textContent = dateString;
                if (currentTimeSpan) currentTimeSpan.textContent = now.toLocaleTimeString('en-US', optionsTime);
            } catch (e) { if (currentDateSpan) currentDateSpan.textContent = now.toLocaleDateString(); if (currentTimeSpan) currentTimeSpan.textContent = now.toLocaleTimeString(); }
            if (currentYearSpan) currentYearSpan.textContent = now.getFullYear();
        }
        function toggleFullscreen() {
            if (!document.fullscreenElement) { document.documentElement.requestFullscreen().catch(err => console.error(`Fullscreen error: ${err.message}`)); } else if (document.exitFullscreen) { document.exitFullscreen(); }
        }
        function handleFullscreenChange() {
            const isFullscreen = !!document.fullscreenElement; const icon = fullscreenBtn?.querySelector('i'); if (icon) { icon.classList.toggle('fa-expand', !isFullscreen); icon.classList.toggle('fa-compress', isFullscreen); } if (fullscreenBtn) { fullscreenBtn.setAttribute('title', isFullscreen ? 'Exit Fullscreen' : 'Fullscreen'); }
        }

        function toggleNotificationDropdown() {
            if (notificationDropdown) notificationDropdown.classList.toggle('visible');
        }
        function closeNotificationDropdown() {
            if (notificationDropdown) notificationDropdown.classList.remove('visible');
        }

        function showAnnouncement() {
            if (announcementOverlay) {
                announcementOverlay.classList.add('visible');
                manageBodyScroll();
            }
        }
        function closeAnnouncement() {
            if (announcementOverlay) {
                announcementOverlay.classList.remove('visible');
                manageBodyScroll();
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            console.log("DOM loaded - Initializing Dashboard...");
            initializeActiveSubmenu();
            updateDateTime();
            setInterval(updateDateTime, 1000);

            if (mobileSidebarToggleBtn) mobileSidebarToggleBtn.addEventListener('click', toggleSidebarMobileOrDesktop);
            if (sidebarOverlay) sidebarOverlay.addEventListener('click', toggleSidebarMobileOrDesktop);

            document.querySelectorAll('.menu-items .submenu-parent').forEach(link => link.addEventListener('click', toggleSubmenu));
            if (fullscreenBtn) fullscreenBtn.addEventListener('click', toggleFullscreen);
            document.addEventListener('fullscreenchange', handleFullscreenChange);

            if (notificationButton) notificationButton.addEventListener('click', (event) => { event.stopPropagation(); toggleNotificationDropdown(); });
            if (notificationList) {
                notificationList.addEventListener('click', (event) => {
                    const clickedItem = event.target.closest('.notification-item');
                    if (clickedItem && announcementTitle && announcementBody && announcementTimestamp) {
                        const title = clickedItem.dataset.title || 'Thông báo';
                        const bodyText = clickedItem.dataset.body || 'Không có nội dung.';
                        const timestamp = clickedItem.dataset.timestamp || '';
                        announcementTitle.textContent = title;
                        announcementBody.innerHTML = '';
                        bodyText.split('||').forEach(paragraphText => {
                            if (paragraphText.trim()) {
                                const p = document.createElement('p');
                                p.textContent = paragraphText.trim();
                                announcementBody.appendChild(p);
                            }
                        });
                        announcementTimestamp.textContent = timestamp;
                        showAnnouncement();
                        closeNotificationDropdown();
                    }
                });
            }
            document.addEventListener('click', (event) => {
                if (notificationDropdown && notificationDropdown.classList.contains('visible')) {
                    if (!notificationDropdown.contains(event.target) && event.target !== notificationButton && !notificationButton.contains(event.target)) {
                        closeNotificationDropdown();
                    }
                }
            });

            if (announcementCloseBtn) announcementCloseBtn.addEventListener('click', closeAnnouncement);
            if (announcementOverlay) announcementOverlay.addEventListener('click', (event) => { if (event.target === announcementOverlay) closeAnnouncement(); });

            if (usernameDisplay && welcomeMessageElement) {
                welcomeMessageElement.textContent = `Chào mừng trở lại, ${usernameDisplay.textContent}!`;
            }

            const setupCharts = () => {
                const showFallback = (canvasId) => {
                    const canvas = document.getElementById(canvasId);
                    const fallback = canvas?.parentElement?.querySelector('.chart-fallback');
                    if (fallback) fallback.style.display = 'block';
                };

                if (typeof Chart === 'undefined') {
                    console.warn("Chart.js library not loaded.");
                    showFallback('orderStatusChart');
                    showFallback('revenueChart');
                    return;
                }

                const orderStatusCtx = document.getElementById('orderStatusChart')?.getContext('2d');
                if (orderStatusCtx) {
                    new Chart(orderStatusCtx, { type: 'doughnut', data: { labels: ['Mới tạo', 'Đang xử lý', 'Đang giao', 'Hoàn tất', 'Hủy'], datasets: [{ label: 'Trạng thái đơn hàng', data: [15, 42, 35, 210, 8], backgroundColor: ['#3b82f6', '#f97316', '#facc15', '#16a34a', '#64748b'], borderColor: '#ffffff', borderWidth: 2 }] }, options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { position: 'bottom', labels: { padding: 15 } } } } });
                } else { showFallback('orderStatusChart'); }

                const revenueCtx = document.getElementById('revenueChart')?.getContext('2d');
                if (revenueCtx) {
                    new Chart(revenueCtx, { type: 'line', data: { labels: ['Thg 2', 'Thg 3', 'Thg 4', 'Thg 5', 'Thg 6', 'Thg 7'], datasets: [{ label: 'Doanh thu (Triệu VND)', data: [8.5, 10.2, 9.8, 12.1, 14.5, 15.6], borderColor: '#0891b2', backgroundColor: 'rgba(8, 145, 178, 0.1)', fill: true, tension: 0.3 }] }, options: { responsive: true, maintainAspectRatio: false, scales: { y: { beginAtZero: true } }, plugins: { legend: { display: false } } } });
                } else { showFallback('revenueChart'); }
            };
            setTimeout(setupCharts, 100);

            console.log("Full Initialization complete.");
        });

        
    </script>
@endpush
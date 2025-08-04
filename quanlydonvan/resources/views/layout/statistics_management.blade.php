@extends('index')

@push("css")
<link rel="stylesheet" href="../css/package_manager.css">
<link rel="stylesheet" href="../css/statistics_management.css">
@endpush

@section('main_content')
<div class="content-wrapper">
    <section class="page-header">
        <div class="page-header-left">
            <h1 class="page-title">BẢNG THỐNG KÊ</h1>
            <nav class="breadcrumb" aria-label="breadcrumb">
                <a href="#">Quản lý</a> / <span>Bảng thống kê</span>
            </nav>
        </div>
        <div class="page-header-right">
            <button class="layout-toggle-btn" id="layout-toggle-btn" title="Chuyển sang bố cục dọc">
                <i class="fa-solid fa-table-list"></i>
            </button>
            <button class="mobile-filter-toggle" id="mobile-filter-toggle-stats">
                <i class="fa-solid fa-filter"></i> Bộ lọc
            </button>
        </div>
    </section>

    <section class="filter-bar card" aria-label="Filters">
        <div class="filter-controls-desktop stats-filters">
            <div class="filter-group">
                <label for="stats-branch">Chi nhánh</label>
                <select id="stats-branch" title="Chọn chi nhánh">
                    <option value="all">Tất cả</option>
                    <option value="tp">CN Tân Phú</option>
                    <option value="bt">CN Bình Tân</option>
                </select>
            </div>
            <div class="filter-group date-range">
                <label for="stats-date-start">Thời gian</label>
                <div class="date-range-row">
                    <input type="date" id="stats-date-start" title="Từ ngày" value="2024-08-04">
                    <span>→</span>
                    <input type="date" id="stats-date-end" title="Đến ngày" value="2024-09-03">
                </div>
            </div>
            <div class="filter-group">
                <label for="stats-sale">Sale</label>
                <select id="stats-sale" title="Chọn Sale">
                    <option value="all">Tất cả Sale</option>
                    <option value="SALE01" selected>SALE01 - Phạm Hoàng Đình</option>
                    <option value="SALE02">SALE02 - Nguyễn Văn An</option>
                </select>
            </div>
            <button class="button primary filter-apply-btn"><i class="fa-solid fa-eye"></i> Xem</button>
        </div>
    </section>

    <div id="statistics-content-area" class="layout-grid">
        <section class="kpi-cards-grid">
            <div class="kpi-card card">
                <div class="kpi-header"> <span class="kpi-title">Doanh thu công ty</span> </div>
                <div class="kpi-value">912,527,800 đ</div>
                <div class="kpi-change increase"> <i class="fa-solid fa-arrow-trend-up"></i> 28.36% </div>
                <div class="mini-chart"> <canvas id="mini-chart-revenue"></canvas> </div>
            </div>
            <div class="kpi-card card">
                <div class="kpi-header"> <span class="kpi-title">Đơn hàng</span> </div>
                <div class="kpi-value">517 đơn</div>
                <div class="kpi-change increase"> <i class="fa-solid fa-arrow-trend-up"></i> 44.16% </div>
                <div class="mini-chart"> <canvas id="mini-chart-orders"></canvas> </div>
            </div>
            <div class="kpi-card card">
                <div class="kpi-header"> <span class="kpi-title">Khối lượng</span> </div>
                <div class="kpi-value">3,897 Kg</div>
                <div class="kpi-change decrease"> <i class="fa-solid fa-arrow-trend-down"></i> 12.25% </div>
                <div class="mini-chart"> <canvas id="mini-chart-weight"></canvas> </div>
            </div>
            <div class="kpi-card card">
                <div class="kpi-header"> <span class="kpi-title">Lượt truy cập tracking</span> </div>
                <div class="kpi-value">8,498 lượt</div>
                <div class="kpi-change decrease"> <i class="fa-solid fa-arrow-trend-down"></i> 7.39% </div>
                <div class="mini-chart"> <canvas id="mini-chart-tracking"></canvas> </div>
            </div>
        </section>

        <section class="report-grid">
            <section class="report-card card" id="service-volume-report">
                <div class="report-card-header">
                    <h3 class="report-title">Báo cáo khối lượng dịch vụ</h3>
                    <div class="report-legend">
                        <span class="legend-item"><span class="legend-color"
                                style="background-color: #36a2eb;"></span> Gross weight</span>
                        <span class="legend-item"><span class="legend-color"
                                style="background-color: #ff6384;"></span> Charged weight</span>
                    </div>
                </div>
                <div class="report-card-body">
                    <canvas id="serviceVolumeChart"></canvas>
                </div>
            </section>

            <section class="report-card card" id="revenue-profit-report">
                <div class="report-card-header">
                    <h3 class="report-title">Báo cáo doanh thu - lợi nhuận</h3>
                    <div class="report-legend">
                        <span class="legend-item"><span class="legend-color"
                                style="background-color: #4bc0c0;"></span> Doanh thu</span>
                        <span class="legend-item"><span class="legend-color"
                                style="background-color: #ffcd56;"></span> Chi phí khác</span>
                        <span class="legend-item"><span class="legend-color"
                                style="background-color: #ff9f40;"></span> Giá net</span>
                    </div>
                </div>
                <div class="report-card-body">
                    <canvas id="revenueProfitChart"></canvas>
                </div>
            </section>

            <section class="report-card card" id="national-usage-report">
                <div class="report-card-header">
                    <h3 class="report-title" id="national-report-title">Báo cáo quốc gia sử dụng dịch vụ</h3>
                    <button class="back-to-list-btn" style="display: none;" title="Quay lại danh sách"><i
                            class="fa-solid fa-arrow-left"></i></button>
                </div>
                <div class="report-card-body">
                    <div class="national-list-view">
                        <ul class="national-list">
                            <li class="national-list-item" data-country="us" data-country-name="United States">
                                <img src="https://flagcdn.com/w40/us.png" alt="US Flag" class="country-flag">
                                <span class="country-name">United States</span> <span class="country-value">50
                                    đơn</span> <button class="view-details-btn"><i
                                        class="fa-solid fa-chevron-right"></i></button> </li>
                            <li class="national-list-item" data-country="au" data-country-name="Australia"> <img
                                    src="https://flagcdn.com/w40/au.png" alt="AU Flag" class="country-flag">
                                <span class="country-name">Australia</span> <span class="country-value">25
                                    đơn</span> <button class="view-details-btn"><i
                                        class="fa-solid fa-chevron-right"></i></button> </li>
                            <li class="national-list-item" data-country="kp" data-country-name="North Korea">
                                <img src="https://flagcdn.com/w40/kp.png" alt="KP Flag" class="country-flag">
                                <span class="country-name">North Korea</span> <span class="country-value">45
                                    đơn</span> <button class="view-details-btn"><i
                                        class="fa-solid fa-chevron-right"></i></button> </li>
                            <li class="national-list-item" data-country="cn" data-country-name="China"> <img
                                    src="https://flagcdn.com/w40/cn.png" alt="CN Flag" class="country-flag">
                                <span class="country-name">China</span> <span class="country-value">47
                                    đơn</span> <button class="view-details-btn"><i
                                        class="fa-solid fa-chevron-right"></i></button> </li>
                            <li class="national-list-item" data-country="ru" data-country-name="Russia"> <img
                                    src="https://flagcdn.com/w40/ru.png" alt="RU Flag" class="country-flag">
                                <span class="country-name">Russia</span> <span class="country-value">36
                                    đơn</span> <button class="view-details-btn"><i
                                        class="fa-solid fa-chevron-right"></i></button> </li>
                            <li class="national-list-item" data-country="ru2" data-country-name="Russia"> <img
                                    src="https://flagcdn.com/w40/ru.png" alt="RU Flag" class="country-flag">
                                <span class="country-name">Russia</span> <span class="country-value">38
                                    đơn</span> <button class="view-details-btn"><i
                                        class="fa-solid fa-chevron-right"></i></button> </li>
                        </ul>
                    </div>
                    <div class="national-table-view" style="display: none;">
                        <div class="table-container">
                            <table class="national-details-table">
                                <thead>
                                    <tr>
                                        <th>United States</th>
                                        <th>SL đơn hàng</th>
                                        <th>Gross weight</th>
                                        <th>Charged weight</th>
                                        <th>Doanh thu</th>
                                    </tr>
                                </thead>
                                <tbody id="national-details-tbody"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>

            <section class="report-card card" id="personnel-report">
                <div class="report-card-header">
                    <h3 class="report-title">Báo cáo doanh thu nhân sự</h3>
                    <select id="personnel-report-type" class="report-select">
                        <option value="revenue" selected>Doanh thu</option>
                        <option value="weight">Khối lượng</option>
                    </select>
                </div>
                <div class="report-card-body personnel-report-body-switchable">
                    <div class="personnel-chart-views-container">
                        <div class="personnel-view personnel-overview-view" id="personnel-overview-view">
                            <div class="personnel-chart-container">
                                <canvas id="personnelOverviewChart"></canvas>
                                <div class="donut-center-text"> <span id="personnel-center-value">0</span> <span
                                        id="personnel-center-unit"></span> </div>
                            </div>
                        </div>
                        <div class="personnel-view personnel-payment-view" id="personnel-payment-view"
                            style="display: none;">
                            <div class="personnel-chart-container-v3">
                                <canvas id="personnelPaymentChart"></canvas>
                                <div class="donut-center-text-v3"> <span id="personnel-paid-value">0</span>
                                    <span id="personnel-unpaid-value">0</span> <span
                                        id="personnel-total-unit"></span> </div>
                            </div>
                            <div class="personnel-payment-legend-inline">
                                <span class="legend-item"><span class="legend-color"
                                        style="background-color: #0284c7;"></span> Đã thanh toán</span>
                                <span class="legend-item"><span class="legend-color"
                                        style="background-color: #f97316;"></span> Chưa thanh toán</span>
                            </div>
                        </div>
                    </div>
                    <div class="personnel-selection-legend">
                        <span class="legend-title">Tên sale</span>
                        <ul class="personnel-checkbox-list">
                            <li class="personnel-checkbox-item" data-person-id="pham_hoang_dinh"> <label><input
                                        type="checkbox" value="pham_hoang_dinh"
                                        style="--checkbox-color: #0284c7;"><span class="person-name">Phạm Hoàng
                                        Định</span><i class="fa-solid fa-medal"
                                        style="color: #ffd700;"></i></label> </li>
                            <li class="personnel-checkbox-item" data-person-id="alice"> <label><input
                                        type="checkbox" value="alice" style="--checkbox-color: #f43f5e;"><span
                                        class="person-name">Alice</span><i class="fa-solid fa-medal"
                                        style="color: #c0c0c0;"></i></label> </li>
                            <li class="personnel-checkbox-item" data-person-id="hoang_yen"> <label><input
                                        type="checkbox" value="hoang_yen"
                                        style="--checkbox-color: #14b8a6;"><span class="person-name">Hoàng
                                        Yến</span><i class="fa-solid fa-medal"
                                        style="color: #cd7f32;"></i></label> </li>
                            <li class="personnel-checkbox-item" data-person-id="van_anh"> <label><input
                                        type="checkbox" value="van_anh" style="--checkbox-color: #f97316;"><span
                                        class="person-name">Văn Anh</span></label> </li>
                            <li class="personnel-checkbox-item" data-person-id="phuong_anh"> <label><input
                                        type="checkbox" value="phuong_anh"
                                        style="--checkbox-color: #ea580c;"><span class="person-name">Phượng
                                        Anh</span></label> </li>
                            <li class="personnel-checkbox-item" data-person-id="thuy_anh"> <label><input
                                        type="checkbox" value="thuy_anh"
                                        style="--checkbox-color: #60a5fa;"><span class="person-name">Thùy
                                        Anh</span></label> </li>
                            <li class="personnel-checkbox-item" data-person-id="hoang_anh"> <label><input
                                        type="checkbox" value="hoang_anh"
                                        style="--checkbox-color: #a855f7;"><span class="person-name">Hoàng
                                        Anh</span></label> </li>
                            <li class="personnel-checkbox-item" data-person-id="ngan_ha"> <label><input
                                        type="checkbox" value="ngan_ha" style="--checkbox-color: #dbeafe;"><span
                                        class="person-name">Ngân Hà</span></label> </li>
                            <li class="personnel-checkbox-item" data-person-id="sin"> <label><input
                                        type="checkbox" value="sin" style="--checkbox-color: #22c55e;"><span
                                        class="person-name">Sin</span></label> </li>
                        </ul>
                    </div>
                </div>
            </section>
        </section>
    </div>

</div>
@endsection

@section('notification')
<div class="filter-modal" id="filter-modal-stats">
    <div class="filter-modal-content card">
        <div class="filter-modal-header">
            <h3><i class="fa-solid fa-filter"></i> Bộ lọc thống kê</h3>
            <button class="filter-modal-close-btn icon-button" aria-label="Close Filters"> <i
                    class="fa-solid fa-xmark"></i> </button>
        </div>
        <div class="filter-modal-body">
            <div class="filter-group">
                <label for="modal-stats-branch">Chi nhánh</label>
                <select id="modal-stats-branch" title="Chọn chi nhánh">
                    <option value="all">Tất cả</option>
                    <option value="tp">CN Tân Phú</option>
                    <option value="bt">CN Bình Tân</option>
                </select>
            </div>
            <div class="filter-group date-range">
                <label for="modal-stats-date-start">Thời gian</label>
                <div class="date-range-row">
                    <input type="date" id="modal-stats-date-start" title="Từ ngày"><span>→</span><input type="date"
                        id="modal-stats-date-end" title="Đến ngày">
                </div>
            </div>
            <div class="filter-group">
                <label for="modal-stats-sale">Sale</label>
                <select id="modal-stats-sale" title="Chọn Sale">
                    <option value="all">Tất cả Sale</option>
                    <option value="SALE01">SALE01 - P.H. Đình</option>
                    <option value="SALE02">SALE02 - N.V. An</option>
                </select>
            </div>
        </div>
        <div class="filter-modal-footer">
            <button class="button secondary" id="modal-reset-filter-stats-btn">Reset</button>
            <button class="button primary" id="modal-apply-filter-stats-btn">Áp dụng</button>
        </div>
    </div>
</div>
@endsection

@push('script')
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-date-fns/dist/chartjs-adapter-date-fns.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const body = document.body;
            const sidebar = document.getElementById('sidebar');
            const sidebarOverlay = document.getElementById('sidebar-overlay');
            const mobileSidebarToggleBtn = document.getElementById('mobile-sidebar-toggle');
            const desktopSidebarToggleBtn = document.querySelector('.sidebar-toggle-desktop');
            const filterModalStats = document.getElementById('filter-modal-stats');
            const mobileFilterToggleBtnStats = document.getElementById('mobile-filter-toggle-stats');
            const currentDateSpan = document.getElementById('current-date');
            const currentTimeSpan = document.getElementById('current-time');
            const currentYearSpan = document.getElementById('current-year');
            const fullscreenBtn = document.getElementById('fullscreen-btn');
            const layoutToggleButton = document.getElementById('layout-toggle-btn');
            const statisticsContentArea = document.getElementById('statistics-content-area');

            const notificationButton = document.getElementById('notification-button');
            const notificationDropdown = document.getElementById('notification-dropdown');
            const notificationList = document.getElementById('notification-list');
            const announcementOverlay = document.getElementById('announcement-overlay');
            const announcementBox = document.getElementById('announcement-box');
            const announcementCloseBtn = document.getElementById('announcement-close-btn');
            const announcementTitle = document.getElementById('announcement-title');
            const announcementBodyEl = document.getElementById('announcement-body');
            const announcementTimestamp = document.getElementById('announcement-timestamp');

            let serviceVolumeChartInstance = null;
            let revenueProfitChartInstance = null;
            let personnelOverviewChartInstance = null;
            let personnelPaymentChartInstance = null;
            let miniChartRevenueInstance, miniChartOrdersInstance, miniChartWeightInstance, miniChartTrackingInstance;

            const personnelPaymentData = { revenue: { 'pham_hoang_dinh': { paid: 85, unpaid: 15 }, 'alice': { paid: 70, unpaid: 30 }, 'hoang_yen': { paid: 50, unpaid: 10 }, 'van_anh': { paid: 40, unpaid: 5 }, 'phuong_anh': { paid: 35, unpaid: 8 }, 'thuy_anh': { paid: 30, unpaid: 12 }, 'hoang_anh': { paid: 25, unpaid: 15 }, 'ngan_ha': { paid: 20, unpaid: 20 }, 'sin': { paid: 15, unpaid: 5 } }, weight: { 'pham_hoang_dinh': { paid: 1200, unpaid: 300 }, 'alice': { paid: 1000, unpaid: 200 }, 'hoang_yen': { paid: 700, unpaid: 100 }, 'van_anh': { paid: 450, unpaid: 50 }, 'phuong_anh': { paid: 350, unpaid: 50 }, 'thuy_anh': { paid: 280, unpaid: 20 }, 'hoang_anh': { paid: 150, unpaid: 50 }, 'ngan_ha': { paid: 100, unpaid: 50 }, 'sin': { paid: 90, unpaid: 27 } } };
            const personnelOverviewData = { revenue: { 'pham_hoang_dinh': 100, 'alice': 100, 'hoang_yen': 60, 'van_anh': 45, 'phuong_anh': 43, 'thuy_anh': 42, 'hoang_anh': 40, 'ngan_ha': 40, 'sin': 20 }, weight: { 'pham_hoang_dinh': 1500, 'alice': 1200, 'hoang_yen': 800, 'van_anh': 500, 'phuong_anh': 400, 'thuy_anh': 300, 'hoang_anh': 200, 'ngan_ha': 150, 'sin': 117 } };
            const personnelDetails = { 'pham_hoang_dinh': { name: 'Phạm Hoàng Định', color: '#0284c7' }, 'alice': { name: 'Alice', color: '#f43f5e' }, 'hoang_yen': { name: 'Hoàng Yến', color: '#14b8a6' }, 'van_anh': { name: 'Văn Anh', color: '#f97316' }, 'phuong_anh': { name: 'Phượng Anh', color: '#ea580c' }, 'thuy_anh': { name: 'Thùy Anh', color: '#60a5fa' }, 'hoang_anh': { name: 'Hoàng Anh', color: '#a855f7' }, 'ngan_ha': { name: 'Ngân Hà', color: '#dbeafe' }, 'sin': { name: 'Sin', color: '#22c55e' } };
            const countryDetailsData = { us: [{ service: 'MTE-US SIN', orders: 5, gross: '365.5 Kg', charged: '366 Kg', revenue: '125,372,000 đ' }, { service: 'FEDEX THỰC PHẨM', orders: 8, gross: '99.5 Kg', charged: '100 Kg', revenue: '76,899,000 đ' }], au: [{ service: 'AUS Express', orders: 15, gross: '150 Kg', charged: '155 Kg', revenue: '90,000,000 đ' }, { service: 'DHL AUS', orders: 10, gross: '80 Kg', charged: '82 Kg', revenue: '65,000,000 đ' }] };

            const manageBodyScroll = () => {
                const isSidebarOpen = body.classList.contains('sidebar-mobile-open');
                const isAnyModalVisible = document.querySelector('.filter-modal.visible, .confirmation-modal.visible, .announcement-overlay.visible');
                body.classList.toggle('overflow-hidden', isSidebarOpen || !!isAnyModalVisible);
            };

            function toggleSidebarMobileOrDesktop() {
                if (window.innerWidth > 768) {
                    document.body.classList.toggle('sidebar-collapsed');
                } else {
                    document.body.classList.toggle('sidebar-mobile-open');
                    const mobileSidebarToggleBtn = document.getElementById('mobile-sidebar-toggle');
                    const isOpen = document.body.classList.contains('sidebar-mobile-open');
                    if (mobileSidebarToggleBtn) mobileSidebarToggleBtn.setAttribute('aria-expanded', String(isOpen));
                }
                manageBodyScroll();
            }

            // function toggleSubmenu(event) {
            //     event.preventDefault();
            //     if (document.body.classList.contains('sidebar-collapsed') && window.innerWidth > 768) return;
            //     const parentLink = event.currentTarget;
            //     const submenuWrapper = parentLink.nextElementSibling;
            //     if (!submenuWrapper || !submenuWrapper.classList.contains('submenu')) return;
            //     const isActive = parentLink.classList.toggle('active');
            //     submenuWrapper.classList.toggle('active', isActive);
            //     if (isActive) {
            //         document.querySelectorAll('.menu-items .submenu-parent.active').forEach(activeParent => {
            //             if (activeParent !== parentLink) {
            //                 activeParent.classList.remove('active');
            //                 activeParent.nextElementSibling?.classList.remove('active');
            //             }
            //         });
            //     }
            // }

            function initializeActiveSubmenu() {
                const activeSubmenuLink = document.querySelector('.sidebar .submenu a.active');
                if (activeSubmenuLink) {
                    const submenuDiv = activeSubmenuLink.closest('.submenu');
                    const parentLink = submenuDiv?.previousElementSibling;
                    if (submenuDiv && parentLink?.classList.contains('submenu-parent')) {
                        if (!(document.body.classList.contains('sidebar-collapsed') && window.innerWidth > 768)) {
                            submenuDiv.classList.add('active');
                            parentLink.classList.add('active');
                            parentLink.querySelector('.submenu-arrow')?.style.setProperty('transform', 'rotate(180deg)');
                        } else {
                            submenuDiv.classList.remove('active');
                            parentLink.classList.remove('active');
                            parentLink.querySelector('.submenu-arrow')?.style.setProperty('transform', 'rotate(0deg)');
                        }
                    }
                }
            }

            function toggleFilterModalStats() {
                if (filterModalStats) {
                    filterModalStats.classList.toggle('visible');
                    manageBodyScroll();
                }
            }
            function applyFiltersStats(source) {
                if (source === 'modal') { toggleFilterModalStats(); }
            }
            function resetFiltersStats(source) {
                const formContainer = source === 'modal' ? filterModalStats?.querySelector('.filter-modal-body') : document.querySelector('.stats-filters');
                if (formContainer) {
                    formContainer.querySelectorAll('input:not([type="radio"]):not([type="checkbox"]), select').forEach(el => {
                        if (el.tagName === 'SELECT') el.selectedIndex = 0; else el.value = '';
                    });
                    formContainer.querySelectorAll('input[type="radio"], input[type="checkbox"]').forEach(el => el.checked = false);
                }
            }

            function updateDateTime() {
                const now = new Date();
                const optionsDate = { weekday: 'short', day: '2-digit', month: '2-digit', year: 'numeric' };
                const optionsTime = { hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: true };
                if (currentDateSpan) currentDateSpan.textContent = now.toLocaleDateString('en-GB', optionsDate).replace(/,/g, '');
                if (currentTimeSpan) currentTimeSpan.textContent = now.toLocaleTimeString('en-US', optionsTime);
                if (currentYearSpan) currentYearSpan.textContent = now.getFullYear();
            }

            function toggleFullscreen() {
                if (!document.fullscreenElement) {
                    document.documentElement.requestFullscreen().catch(err => { });
                } else if (document.exitFullscreen) {
                    document.exitFullscreen();
                }
            }
            function handleFullscreenChange() {
                const isFullscreen = !!document.fullscreenElement;
                const icon = fullscreenBtn?.querySelector('i');
                if (icon) { icon.classList.toggle('fa-expand', !isFullscreen); icon.classList.toggle('fa-compress', isFullscreen); }
                if (fullscreenBtn) { fullscreenBtn.setAttribute('title', isFullscreen ? 'Exit Fullscreen' : 'Fullscreen'); }
            }

            function initCharts() {
                Chart.defaults.font.family = "'Segoe UI', Tahoma, Geneva, Verdana, sans-serif";
                const serviceVolumeCtx = document.getElementById('serviceVolumeChart')?.getContext('2d');
                if (serviceVolumeCtx) { const labels = ['Th.1', 'Th.2', 'Th.3', 'Th.4', 'Th.5', 'Th.6', 'Th.7', 'Th.8', 'Th.9', 'Th.10', 'Th.11', 'Th.12']; const grossWeightData = [1200, 1900, 1500, 2500, 2200, 3000, 2800, 3500, 3200, 4000, 3800, 4500]; const chargedWeightData = [1000, 1700, 1300, 2300, 2000, 2800, 2600, 3300, 3000, 3800, 3600, 4300]; serviceVolumeChartInstance = new Chart(serviceVolumeCtx, { type: 'line', data: { labels: labels, datasets: [{ label: 'Gross weight', data: grossWeightData, borderColor: '#36a2eb', backgroundColor: 'rgba(54, 162, 235, 0.1)', tension: 0.4, fill: true, pointRadius: 3, pointHoverRadius: 5 }, { label: 'Charged weight', data: chargedWeightData, borderColor: '#ff6384', backgroundColor: 'rgba(255, 99, 132, 0.1)', tension: 0.4, fill: true, pointRadius: 3, pointHoverRadius: 5 }] }, options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { display: false } }, scales: { y: { beginAtZero: true, grid: { color: '#e5e7eb' } }, x: { grid: { display: false } } }, interaction: { intersect: false, mode: 'index' }, tooltips: { enabled: true } } }); }
                const revenueProfitCtx = document.getElementById('revenueProfitChart')?.getContext('2d');
                if (revenueProfitCtx) { const labels = ['Th.1', 'Th.2', 'Th.3', 'Th.4', 'Th.5', 'Th.6', 'Th.7', 'Th.8', 'Th.9', 'Th.10', 'Th.11', 'Th.12']; revenueProfitChartInstance = new Chart(revenueProfitCtx, { type: 'bar', data: { labels: labels, datasets: [{ label: 'Doanh thu', data: [500, 600, 450, 700, 650, 800, 750, 900, 850, 1000, 950, 1100], backgroundColor: '#4bc0c0' }, { label: 'Chi phí khác', data: [100, 120, 90, 140, 130, 160, 150, 180, 170, 200, 190, 220], backgroundColor: '#ffcd56' }, { label: 'Giá net', data: [80, 100, 70, 120, 110, 140, 130, 160, 150, 180, 170, 200], backgroundColor: '#ff9f40' }] }, options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { display: false } }, scales: { y: { beginAtZero: true, grid: { color: '#e5e7eb' }, stacked: false }, x: { grid: { display: false }, stacked: false } }, barPercentage: 0.7, categoryPercentage: 0.6 } }); }
                initPersonnelOverviewChart(); initPersonnelPaymentChart();
                const miniChartOptions = { responsive: true, maintainAspectRatio: false, plugins: { legend: { display: false }, tooltip: { enabled: false } }, scales: { y: { display: false }, x: { display: false } } }; const miniData = { labels: ['1', '2', '3', '4', '5'], datasets: [{ data: [10, 15, 8, 12, 18], backgroundColor: '#cbd5e1', barPercentage: 0.6 }] }; const miniRevenueCtx = document.getElementById('mini-chart-revenue')?.getContext('2d'); if (miniRevenueCtx) miniChartRevenueInstance = new Chart(miniRevenueCtx, { type: 'bar', data: miniData, options: miniChartOptions }); const miniOrdersCtx = document.getElementById('mini-chart-orders')?.getContext('2d'); if (miniOrdersCtx) miniChartOrdersInstance = new Chart(miniOrdersCtx, { type: 'bar', data: miniData, options: miniChartOptions }); const miniWeightCtx = document.getElementById('mini-chart-weight')?.getContext('2d'); if (miniWeightCtx) miniChartWeightInstance = new Chart(miniWeightCtx, { type: 'bar', data: miniData, options: miniChartOptions }); const miniTrackingCtx = document.getElementById('mini-chart-tracking')?.getContext('2d'); if (miniTrackingCtx) miniChartTrackingInstance = new Chart(miniTrackingCtx, { type: 'bar', data: miniData, options: miniChartOptions });
            }

            function initPersonnelOverviewChart() {
                const overviewCtx = document.getElementById('personnelOverviewChart')?.getContext('2d');
                if (overviewCtx) {
                    personnelOverviewChartInstance = new Chart(overviewCtx, {
                        type: 'doughnut',
                        data: {
                            labels: [],
                            datasets: [{
                                label: 'Tổng quan Nhân sự',
                                data: [],
                                backgroundColor: [],
                                borderColor: '#ffffff',
                                borderWidth: 2,
                                hoverOffset: 8
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            cutout: '70%',
                            plugins: {
                                legend: { display: false },
                                tooltip: {
                                    callbacks: {
                                        label: function (context) {
                                            let label = context.label || '';
                                            if (label) { label += ': '; }
                                            if (context.parsed !== null) {
                                                const unitEl = document.getElementById('personnel-center-unit');
                                                const unit = unitEl ? unitEl.textContent : '';
                                                if (unit.toLowerCase().includes('triệu đồng')) {
                                                    label += new Intl.NumberFormat('vi-VN').format(context.raw) + ' Triệu đồng';
                                                } else if (unit.toLowerCase().includes('kg')) {
                                                    label += new Intl.NumberFormat('de-DE').format(context.raw) + ' Kg';
                                                } else {
                                                    label += new Intl.NumberFormat('vi-VN').format(context.raw);
                                                }
                                            }
                                            return label;
                                        }
                                    }
                                }
                            }
                        }
                    });
                }
            }

            function updatePersonnelOverviewChart() {
                if (!personnelOverviewChartInstance) return;
                const reportType = document.getElementById('personnel-report-type')?.value ?? 'revenue';
                const dataForMetric = personnelOverviewData[reportType];
                const centerValueEl = document.getElementById('personnel-center-value');
                const centerUnitEl = document.getElementById('personnel-center-unit');
                if (!dataForMetric || !centerValueEl || !centerUnitEl) {
                    if (personnelOverviewChartInstance) {
                        personnelOverviewChartInstance.data.labels = [];
                        personnelOverviewChartInstance.data.datasets[0].data = [];
                        personnelOverviewChartInstance.data.datasets[0].backgroundColor = [];
                        personnelOverviewChartInstance.update();
                    }
                    if (centerValueEl) centerValueEl.textContent = 'N/A';
                    if (centerUnitEl) centerUnitEl.textContent = '-';
                    return;
                }
                const labels = [];
                const data = [];
                const backgroundColors = [];
                let totalValue = 0;
                Object.keys(personnelDetails).forEach(personId => {
                    if (dataForMetric[personId] !== undefined) {
                        labels.push(personnelDetails[personId].name);
                        const value = dataForMetric[personId];
                        data.push(value);
                        backgroundColors.push(personnelDetails[personId].color);
                        totalValue += value;
                    }
                });
                personnelOverviewChartInstance.data.labels = labels;
                personnelOverviewChartInstance.data.datasets[0].data = data;
                personnelOverviewChartInstance.data.datasets[0].backgroundColor = backgroundColors;
                personnelOverviewChartInstance.update();
                let formattedTotal, unitText;
                if (reportType === 'revenue') {
                    formattedTotal = new Intl.NumberFormat('vi-VN').format(totalValue);
                    unitText = 'Triệu đồng';
                } else if (reportType === 'weight') {
                    formattedTotal = new Intl.NumberFormat('de-DE').format(totalValue);
                    unitText = 'Kg';
                } else {
                    formattedTotal = new Intl.NumberFormat('vi-VN').format(totalValue);
                    unitText = 'Đơn vị';
                }
                centerValueEl.textContent = formattedTotal;
                centerUnitEl.textContent = unitText;
            }

            function initPersonnelPaymentChart() {
                const paymentCtx = document.getElementById('personnelPaymentChart')?.getContext('2d');
                if (paymentCtx) {
                    personnelPaymentChartInstance = new Chart(paymentCtx, {
                        type: 'doughnut',
                        data: {
                            labels: ['Đã thanh toán', 'Chưa thanh toán'],
                            datasets: [{
                                label: 'Trạng thái thanh toán',
                                data: [0, 0],
                                backgroundColor: ['#0284c7', '#f97316'],
                                borderColor: '#ffffff',
                                borderWidth: 2,
                                hoverOffset: 4
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            cutout: '70%',
                            plugins: {
                                legend: { display: false },
                                tooltip: {
                                    callbacks: {
                                        label: function (context) {
                                            let label = context.label || '';
                                            if (label) { label += ': '; }
                                            if (context.parsed !== null) {
                                                const unitEl = document.getElementById('personnel-total-unit');
                                                const unit = unitEl ? unitEl.textContent : '';
                                                if (unit.toLowerCase().includes('triệu đồng')) {
                                                    label += new Intl.NumberFormat('vi-VN').format(context.raw) + ' Triệu đồng';
                                                } else if (unit.toLowerCase().includes('kg')) {
                                                    label += new Intl.NumberFormat('de-DE').format(context.raw) + ' Kg';
                                                } else {
                                                    label += new Intl.NumberFormat('vi-VN').format(context.raw);
                                                }
                                            }
                                            return label;
                                        }
                                    }
                                }
                            }
                        }
                    });
                }
            }

            function updatePersonnelPaymentChart() {
                if (!personnelPaymentChartInstance) return;
                const reportType = document.getElementById('personnel-report-type')?.value ?? 'revenue';
                const selectedPersonnelIds = Array.from(document.querySelectorAll('.personnel-checkbox-item input[type="checkbox"]:checked')).map(checkbox => checkbox.value);
                const dataForMetric = personnelPaymentData[reportType];
                const paidValueEl = document.getElementById('personnel-paid-value');
                const unpaidValueEl = document.getElementById('personnel-unpaid-value');
                const unitEl = document.getElementById('personnel-total-unit');
                if (!dataForMetric || !paidValueEl || !unpaidValueEl || !unitEl) {
                    if (personnelPaymentChartInstance) {
                        personnelPaymentChartInstance.data.datasets[0].data = [0, 0];
                        personnelPaymentChartInstance.update();
                    }
                    if (paidValueEl) paidValueEl.textContent = 'N/A';
                    if (unpaidValueEl) unpaidValueEl.textContent = 'N/A';
                    if (unitEl) unitEl.textContent = '-';
                    return;
                }
                let totalPaid = 0;
                let totalUnpaid = 0;
                selectedPersonnelIds.forEach(personId => {
                    const personData = dataForMetric[personId];
                    if (personData) {
                        totalPaid += personData.paid || 0;
                        totalUnpaid += personData.unpaid || 0;
                    }
                });
                personnelPaymentChartInstance.data.datasets[0].data = [totalPaid, totalUnpaid];
                personnelPaymentChartInstance.update();
                let formattedPaid, formattedUnpaid, unitText;
                if (reportType === 'revenue') {
                    formattedPaid = new Intl.NumberFormat('vi-VN').format(totalPaid);
                    formattedUnpaid = new Intl.NumberFormat('vi-VN').format(totalUnpaid);
                    unitText = 'Triệu đồng';
                } else if (reportType === 'weight') {
                    formattedPaid = new Intl.NumberFormat('de-DE').format(totalPaid);
                    formattedUnpaid = new Intl.NumberFormat('de-DE').format(totalUnpaid);
                    unitText = 'Kg';
                } else {
                    formattedPaid = new Intl.NumberFormat('vi-VN').format(totalPaid);
                    formattedUnpaid = new Intl.NumberFormat('vi-VN').format(totalUnpaid);
                    unitText = 'Đơn vị';
                }
                paidValueEl.textContent = formattedPaid;
                unpaidValueEl.textContent = formattedUnpaid;
                unitEl.textContent = unitText;
            }

            function togglePersonnelReportView() {
                const checkboxes = document.querySelectorAll('.personnel-checkbox-item input[type="checkbox"]');
                const anyChecked = Array.from(checkboxes).some(cb => cb.checked);
                const overviewView = document.getElementById('personnel-overview-view');
                const paymentView = document.getElementById('personnel-payment-view');
                if (!overviewView || !paymentView) return;
                if (anyChecked) {
                    overviewView.style.display = 'none';
                    paymentView.style.display = 'flex';
                    updatePersonnelPaymentChart();
                } else {
                    overviewView.style.display = 'flex';
                    paymentView.style.display = 'none';
                    updatePersonnelOverviewChart();
                }
            }

            function setupNationalReportInteraction() {
                const reportContainer = document.getElementById('national-usage-report'); if (!reportContainer) return;
                const listView = reportContainer.querySelector('.national-list-view');
                const tableView = reportContainer.querySelector('.national-table-view');
                const detailsTableBody = document.getElementById('national-details-tbody');
                const backButton = reportContainer.querySelector('.back-to-list-btn');
                const reportTitle = document.getElementById('national-report-title');
                const originalTitle = reportTitle ? reportTitle.textContent : 'Báo cáo quốc gia';
                if (listView && tableView && detailsTableBody && backButton && reportTitle) {
                    listView.addEventListener('click', (event) => {
                        const button = event.target.closest('.view-details-btn'); if (!button) return;
                        const listItem = button.closest('.national-list-item');
                        const countryCode = listItem.dataset.country; const countryName = listItem.dataset.countryName || 'Chi tiết';
                        const detailsData = countryDetailsData[countryCode] || [];
                        detailsTableBody.innerHTML = '';
                        detailsData.forEach(item => {
                            const row = detailsTableBody.insertRow();
                            row.innerHTML = `<td>${item.service}</td><td>${item.orders}</td><td>${item.gross}</td><td>${item.charged}</td><td class="currency">${item.revenue}</td>`;
                        });
                        const firstHeader = tableView.querySelector('thead th:first-child'); if (firstHeader) firstHeader.textContent = countryName;
                        listView.style.display = 'none'; tableView.style.display = 'block'; backButton.style.display = 'inline-flex'; reportTitle.textContent = `Chi tiết: ${countryName}`;
                    });
                    backButton.addEventListener('click', () => {
                        tableView.style.display = 'none'; backButton.style.display = 'none'; listView.style.display = 'block'; reportTitle.textContent = originalTitle;
                    });
                }
            }

            function toggleNotificationDropdown() {
                if (notificationDropdown) {
                    notificationDropdown.classList.toggle('visible');
                }
            }

            function closeNotificationDropdown() {
                if (notificationDropdown) {
                    notificationDropdown.classList.remove('visible');
                }
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

            function toggleLayout() {
                if (!statisticsContentArea || !layoutToggleButton) return;
                const isGrid = statisticsContentArea.classList.contains('layout-grid');
                const icon = layoutToggleButton.querySelector('i');

                if (isGrid) {
                    statisticsContentArea.classList.remove('layout-grid');
                    statisticsContentArea.classList.add('layout-stack');
                    layoutToggleButton.title = "Chuyển sang bố cục lưới";
                    if (icon) { icon.classList.remove('fa-table-list'); icon.classList.add('fa-grip'); }
                    localStorage.setItem('statisticsLayout', 'stack');
                } else {
                    statisticsContentArea.classList.remove('layout-stack');
                    statisticsContentArea.classList.add('layout-grid');
                    layoutToggleButton.title = "Chuyển sang bố cục dọc";
                    if (icon) { icon.classList.remove('fa-grip'); icon.classList.add('fa-table-list'); }
                    localStorage.setItem('statisticsLayout', 'grid');
                }

                setTimeout(() => {
                    [serviceVolumeChartInstance, revenueProfitChartInstance, personnelOverviewChartInstance, personnelPaymentChartInstance, miniChartRevenueInstance, miniChartOrdersInstance, miniChartWeightInstance, miniChartTrackingInstance].forEach(chart => {
                        if (chart && typeof chart.resize === 'function') chart.resize();
                    });
                }, 50);
            }

            function applySavedLayout() {
                if (!statisticsContentArea || !layoutToggleButton) return;
                const savedLayout = localStorage.getItem('statisticsLayout');
                const icon = layoutToggleButton.querySelector('i');

                if (savedLayout === 'stack') {
                    statisticsContentArea.classList.remove('layout-grid');
                    statisticsContentArea.classList.add('layout-stack');
                    layoutToggleButton.title = "Chuyển sang bố cục lưới";
                    if (icon) { icon.classList.remove('fa-table-list'); icon.classList.add('fa-grip'); }
                } else {
                    statisticsContentArea.classList.remove('layout-stack');
                    statisticsContentArea.classList.add('layout-grid');
                    layoutToggleButton.title = "Chuyển sang bố cục dọc";
                    if (icon) { icon.classList.remove('fa-grip'); icon.classList.add('fa-table-list'); }
                }
            }


            initializeActiveSubmenu();
            updateDateTime();
            setInterval(updateDateTime, 1000);
            applySavedLayout();
            initCharts();
            setupNationalReportInteraction();
            togglePersonnelReportView();


            if (mobileSidebarToggleBtn) mobileSidebarToggleBtn.addEventListener('click', toggleSidebarMobileOrDesktop);
            if (sidebarOverlay) sidebarOverlay.addEventListener('click', toggleSidebarMobileOrDesktop);
            // if (desktopSidebarToggleBtn) desktopSidebarToggleBtn.addEventListener('click', toggleSidebarMobileOrDesktop);
            // document.querySelectorAll('.menu-items .submenu-parent').forEach(link => link.addEventListener('click', toggleSubmenu));
            if (mobileFilterToggleBtnStats) mobileFilterToggleBtnStats.addEventListener('click', toggleFilterModalStats);
            if (filterModalStats) {
                filterModalStats.querySelector('.filter-modal-close-btn')?.addEventListener('click', toggleFilterModalStats);
                filterModalStats.addEventListener('click', (event) => { if (event.target === filterModalStats) toggleFilterModalStats(); });
                document.getElementById('modal-apply-filter-stats-btn')?.addEventListener('click', () => applyFiltersStats('modal'));
                document.getElementById('modal-reset-filter-stats-btn')?.addEventListener('click', () => resetFiltersStats('modal'));
            }
            document.querySelector('.stats-filters .filter-apply-btn')?.addEventListener('click', () => applyFiltersStats('desktop'));
            const reportTypeSelect = document.getElementById('personnel-report-type');
            if (reportTypeSelect) reportTypeSelect.addEventListener('change', togglePersonnelReportView);
            const personnelCheckboxes = document.querySelectorAll('.personnel-checkbox-item input[type="checkbox"]');
            personnelCheckboxes.forEach(checkbox => checkbox.addEventListener('change', togglePersonnelReportView));
            if (fullscreenBtn) fullscreenBtn.addEventListener('click', toggleFullscreen);
            document.addEventListener('fullscreenchange', handleFullscreenChange);
            if (layoutToggleButton) layoutToggleButton.addEventListener('click', toggleLayout);


            if (announcementOverlay && announcementOverlay.classList.contains('visible')) {
                closeAnnouncement();
            }
            if (notificationButton) notificationButton.addEventListener('click', (event) => { event.stopPropagation(); toggleNotificationDropdown(); });
            if (notificationList) {
                notificationList.addEventListener('click', (event) => {
                    const clickedItem = event.target.closest('.notification-item');
                    if (clickedItem && announcementTitle && announcementBodyEl && announcementTimestamp) {
                        const title = clickedItem.dataset.title || 'Thông báo';
                        const bodyText = clickedItem.dataset.body || 'Không có nội dung.';
                        const timestamp = clickedItem.dataset.timestamp || '';
                        announcementTitle.textContent = title;
                        announcementBodyEl.innerHTML = '';
                        bodyText.split('||').forEach(paragraphText => {
                            if (paragraphText.trim()) {
                                const p = document.createElement('p');
                                p.textContent = paragraphText.trim();
                                announcementBodyEl.appendChild(p);
                            }
                        });
                        announcementTimestamp.textContent = timestamp ? new Date(timestamp).toLocaleString('vi-VN') : '';
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
                if (announcementOverlay && announcementOverlay.classList.contains('visible')) {
                    if (!announcementBox.contains(event.target) && event.target !== announcementOverlay) {
                    }
                }
            });
            if (announcementCloseBtn) announcementCloseBtn.addEventListener('click', closeAnnouncement);
            if (announcementOverlay) {
                announcementOverlay.addEventListener('click', (event) => { if (event.target === announcementOverlay) closeAnnouncement(); });
            }
            document.addEventListener('keydown', (event) => {
                if (event.key === 'Escape') {
                    if (announcementOverlay && announcementOverlay.classList.contains('visible')) {
                        closeAnnouncement();
                    } else if (notificationDropdown && notificationDropdown.classList.contains('visible')) {
                        closeNotificationDropdown();
                    } else if (filterModalStats && filterModalStats.classList.contains('visible')) {
                        toggleFilterModalStats();
                    }
                }
            });

            // Add event listeners to show date picker when date inputs are clicked
            const dateInputs = document.querySelectorAll('input[type="date"]');
            dateInputs.forEach(input => {
                input.addEventListener('click', function () {
                    // Try to show the native date picker
                    if (typeof this.showPicker === 'function') {
                        this.showPicker();
                    } else {
                        // Fallback for browsers that don't support showPicker
                        this.focus();
                        // You might need a library for full cross-browser compatibility
                    }
                });
            });
        });

    </script>
    <!-- Thêm JS dropdown user và đăng nhập/đăng xuất -->
    <script>
        
    </script>
@endpush
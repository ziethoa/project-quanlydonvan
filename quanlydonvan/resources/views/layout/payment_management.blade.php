@extends('index')
@push('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<link rel="stylesheet" href="../css/package_manager.css">
<link rel="stylesheet" href="../css/payment-management.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/vi.js"></script>
@endpush

@section('main_content')
<div class="content-wrapper">
    <section class="page-header">
        <div class="page-header-left">
            <h1 class="page-title">Tình trạng thanh toán - MTE192775</h1>
            <nav class="breadcrumb" aria-label="breadcrumb">
                <a href="#">Quản lý</a> / <span>Quản lý thanh toán</span>
            </nav>
        </div>
    </section>

    <div class="payment-content-area">
        <form id="payment-status-form">
            <section class="detail-section-original">
                <header class="section-header-original">
                    <div class="title-part">
                        <i class="fa-solid fa-file-invoice-dollar"></i>
                        <h2>Trị giá đơn hàng</h2>
                    </div>
                    <div class="actions">
                        <p class="order-value-note">Lưu ý: Tiền tệ được quy đổi theo tỷ lệ bạn nhập ở mục Tỷ giá
                            USD/VNĐ</p>
                        <button type="button" class="section-toggle-btn"><i
                                class="fas fa-chevron-up"></i></button>
                    </div>
                </header>
                <div class="section-content-original">
                    <div class="order-value-grid-original">
                        <label for="exchange_rate">Quy đổi tiền tệ:</label>
                        <div class="input-group currency-group">
                            <input type="number" id="exchange_rate" value="5">
                            <span>USD</span>
                            <button type="button" class="currency-switch-btn"><i
                                    class="fa-solid fa-repeat"></i></button>
                            <input type="text" id="exchange_rate_vnd" value="127.500" readonly>
                            <span>VNĐ</span>
                        </div>
                        <label for="custom_exchange_rate">Tỷ giá USD/VNĐ:</label>
                        <div class="input-group">
                            <input type="number" id="custom_exchange_rate" value="25500" step="1">
                            <span>VNĐ</span>
                        </div>
                        <label>Tiền cước:</label>
                        <div class="input-group">
                            <input type="text" value="2.318.000" readonly>
                            <span>VNĐ</span>
                        </div>
                        <label>Chi phí khác:</label>
                        <div class="input-group">
                            <input type="text" value="45.000" readonly>
                            <span>VNĐ</span>
                        </div>

                        <label for="net_agent">NET Đại lý:</label>
                        <div class="input-group">
                            <input type="number" id="net_agent" value="800.000">
                            <span>VNĐ</span>
                        </div>
                        <label for="vat_rate">VAT:</label>
                        <div class="input-group vat-group">
                            <input type="number" id="vat_rate" value="8">
                            <span>%</span>
                            <i class="fa-solid fa-repeat info-icon" title="Quy đổi VAT"></i>
                            <label class="vat-converted-label">Quy đổi VAT:</label>
                            <input type="text" class="vat-converted-value" value="185.440" readonly>
                            <span>VNĐ</span>
                        </div>
                        <label>Hoa hồng Sale:</label>
                        <div class="input-group">
                            <input type="text" value="159.942" readonly>
                            <span>VNĐ</span>
                        </div>

                        <label>Tổng cước:</label>
                        <div class="input-group">
                            <input type="text" id="total_billing_original" value="3.198.840" readonly>
                            <span>VNĐ</span>
                        </div>
                        <label>Tổng cước Đại lý:</label>
                        <div class="input-group">
                            <input type="text" value="1.680.840" readonly>
                            <span>VNĐ</span>
                        </div>
                        <label for="sale_notes">Ghi chú cho Sale:</label>
                        <textarea id="sale_notes" rows="1">Nhờ chụp lại ảnh kiện nhé Alice</textarea>
                    </div>
                    <div class="order-value-summary-original">
                        <div class="summary-item"> <label>Tổng chi phí lô hàng:</label> <span
                                class="value value-purple"><i class="fa-solid fa-boxes-stacked"></i> 2.318.000
                                đ</span> </div>
                        <div class="summary-item"> <label>Lợi nhuận tạm tính:</label> <span
                                class="value value-warning"><i class="fa-solid fa-wallet"></i> 2.318.000
                                đ</span> </div>
                        <div class="summary-item"> <label>Lợi nhuận công ty:</label> <span
                                class="value value-confirm"><i class="fa-solid fa-chart-line"></i> 2.318.000
                                đ</span> </div>
                        <div class="summary-item"> <label>Tổng khấu hao phí:</label> <span
                                class="value value-danger"><i class="fa-solid fa-calculator"></i> 390.382
                                đ</span> </div>
                    </div>
                </div>
            </section>

            <div class="payment-columns-original">
                <div class="payment-column-original">
                    <section class="detail-section-original payment-details-original">
                        <header class="section-header-original payment-details-header">
                            <div class="title-part">
                                <i class="fa-solid fa-user-check"></i>
                                <h2>Khách hàng thanh toán</h2>
                            </div>
                            <div class="actions">
                                <button type="button" class="update-button-original"><i
                                        class="fa-solid fa-check"></i> Cập nhật</button>
                                <button type="button" class="section-toggle-btn"><i
                                        class="fas fa-chevron-up"></i></button>
                            </div>
                        </header>
                        <div class="section-content-original">
                            <div class="payment-info-grid-original">
                                <label>Trạng thái:</label>
                                <div class="date-display">
                                    <select>
                                        <option selected>Đã thanh toán đủ</option>
                                        <option>Chưa thanh toán</option>
                                        <option>Thanh toán một phần</option>
                                    </select>
                                    <span>17/10/2024 13:24:15</span>
                                </div>
                                <label for="customer_bank">Chọn ngân hàng:</label> <select id="customer_bank">
                                    <option selected>MB Bank</option>
                                    <option>VCB</option>
                                    <option>ACB</option>
                                </select>
                                <label for="customer_pay_date">Ngày thanh toán:</label>
                                <input type="text" id="customer_pay_date" class="date-picker"
                                    placeholder="dd/mm/yy" readonly>
                                <label for="customer_pay_notes">Nội dung thanh toán:</label> <textarea
                                    id="customer_pay_notes" rows="2"></textarea>
                            </div>
                            <div class="payment-history-table-wrapper">
                                <table class="payment-history-table-original">
                                    <thead>
                                        <tr>
                                            <th>Ngày thanh toán</th>
                                            <th>Nội dung thanh toán</th>
                                            <th>Số tiền</th>
                                            <th>Ngân hàng</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>23/08/2024</td>
                                            <td>Thanh toán 30%</td>
                                            <td>3.000.000đ</td>
                                            <td>MB Bank</td>
                                        </tr>
                                        <tr>
                                            <td>24/08/2024</td>
                                            <td>Thanh toán gối đầu công nợ tạm thời</td>
                                            <td>15.250.000đ</td>
                                            <td>MB Bank</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </section>
                </div>

                <div class="payment-column-original">
                    <section class="detail-section-original payment-details-original">
                        <header class="section-header-original payment-details-header">
                            <div class="title-part">
                                <i class="fa-solid fa-building-columns"></i>
                                <h2>Đại lý thanh toán</h2>
                            </div>
                            <div class="actions">
                                <button type="button" class="update-button-original"><i
                                        class="fa-solid fa-check"></i> Cập nhật</button>
                                <button type="button" class="section-toggle-btn"><i
                                        class="fas fa-chevron-up"></i></button>
                            </div>
                        </header>
                        <div class="section-content-original">
                            <div class="payment-info-grid-original">
                                <label>Trạng thái:</label>
                                <div class="date-display">
                                    <select>
                                        <option selected>Chưa thanh toán</option>
                                        <option>Đã thanh toán đủ</option>
                                        <option>Thanh toán một phần</option>
                                    </select>
                                    <span>17/10/2024 13:24:15</span>
                                </div>
                                <label for="agent_bank">Chọn ngân hàng:</label> <select id="agent_bank">
                                    <option selected>MB Bank</option>
                                    <option>VCB</option>
                                    <option>ACB</option>
                                </select>
                                <label for="agent_pay_date">Ngày thanh toán:</label>
                                <input type="text" id="agent_pay_date" class="date-picker"
                                    placeholder="dd/mm/yy" readonly>
                                <label for="agent_pay_notes">Nội dung thanh toán:</label> <textarea
                                    id="agent_pay_notes" rows="2"></textarea>
                            </div>
                            <div class="payment-history-table-wrapper">
                                <table class="payment-history-table-original">
                                    <thead>
                                        <tr>
                                            <th>Ngày thanh toán</th>
                                            <th>Nội dung thanh toán</th>
                                            <th>Số tiền</th>
                                            <th>Ngân hàng</th>
                                            <th>Đại lý</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>23/08/2024</td>
                                            <td>Thanh toán 30%</td>
                                            <td>3.000.000đ</td>
                                            <td>MB Bank</td>
                                            <td>Gia Phú</td>
                                        </tr>
                                        <tr>
                                            <td>24/08/2024</td>
                                            <td>Thanh toán gối đầu công nợ tạm thời</td>
                                            <td>15.250.000đ</td>
                                            <td>MB Bank</td>
                                            <td>Gia Phú</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </form>
    </div>

    <section class="content-actions-original">
        <div class="confirmation-check-original">
            <input type="checkbox" id="confirm_payment_info" name="confirm_payment_info" required checked>
            <label for="confirm_payment_info">Tôi đã kiểm tra thông tin đầy đủ và hoàn toàn chịu trách nhiệm với
                những sai sót</label>
        </div>
        <div class="action-buttons-original">
            <button type="button" class="btn-danger-original" onclick="window.history.back();"> <i
                    class="fa-solid fa-xmark"></i> Thoát </button>
            <button type="reset" class="btn-warning-original" form="payment-status-form"> <i
                    class="fa-solid fa-arrows-rotate"></i> Làm mới </button>
            <button type="submit" class="btn-success-original" form="payment-status-form"> <i
                    class="fa-solid fa-check"></i> Hoàn thành </button>
        </div>
    </section>
</div>
@endsection

@push('script')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Khởi tạo biến toàn cục
        const body = document.body;
        const sidebar = document.getElementById('sidebar');
        const sidebarOverlay = document.getElementById('sidebar-overlay');
        const mobileSidebarToggleBtn = document.getElementById('mobile-sidebar-toggle');
        const currentDateSpan = document.getElementById('current-date');
        const currentTimeSpan = document.getElementById('current-time');
        const currentYearSpan = document.getElementById('current-year');
        const fullscreenBtn = document.getElementById('fullscreen-btn');
        const usdInput = document.getElementById('exchange_rate');
        const vndInput = document.getElementById('exchange_rate_vnd');
        const customExchangeRateInput = document.getElementById('custom_exchange_rate');
        const currencySwitchBtn = document.querySelector('.currency-switch-btn');
        const form = document.getElementById('payment-status-form');
        const notificationButton = document.getElementById('notification-button');
        const notificationDropdown = document.getElementById('notification-dropdown');
        const notificationList = document.getElementById('notification-list');
        const announcementOverlay = document.getElementById('announcement-overlay');
        const announcementCloseBtn = document.getElementById('announcement-close-btn');
        const announcementTitle = document.getElementById('announcement-title');
        const announcementBodyEl = document.getElementById('announcement-body');
        const announcementTimestamp = document.getElementById('announcement-timestamp');
        const pageTitleElement = document.querySelector('.page-title');

        // Tiện ích
        const isElementVisible = (el) => el && !el.hasAttribute('hidden') && el.offsetParent !== null;

        // Quản lý scroll
        const manageBodyScroll = () => {
            const isSidebarOpen = body.classList.contains('sidebar-mobile-open');
            const isAnyModalVisible = document.querySelector('.confirmation-modal.visible, .announcement-overlay.visible');
            body.classList.toggle('overflow-hidden', isSidebarOpen || isAnyModalVisible);
        };

        // Sidebar
        const toggleSidebarMobileOrDesktop = () => {
            if (window.innerWidth > 768) {
                body.classList.toggle('sidebar-collapsed');
            } else {
                body.classList.toggle('sidebar-mobile-open');
            }
            const isOpen = body.classList.contains('sidebar-mobile-open') || !body.classList.contains('sidebar-collapsed');
            mobileSidebarToggleBtn?.setAttribute('aria-expanded', String(isOpen));
            manageBodyScroll();
        };

        // Date và Fullscreen
        const updateDateTime = () => {
            const now = new Date();
            const optionsDate = { weekday: 'short', day: '2-digit', month: '2-digit', year: 'numeric' };
            const optionsTime = { hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: true };
            currentDateSpan.textContent = now.toLocaleDateString('en-GB', optionsDate).replace(/,/g, '');
            currentTimeSpan.textContent = now.toLocaleTimeString('en-US', optionsTime); // 03:06 PM +07
            currentYearSpan.textContent = now.getFullYear();
        };

        const toggleFullscreen = () => {
            if (!document.fullscreenElement) {
                document.documentElement.requestFullscreen().catch(err => console.error(`Fullscreen error: ${err.message}`));
            } else if (document.exitFullscreen) {
                document.exitFullscreen();
            }
        };

        const handleFullscreenChange = () => {
            const isFullscreen = !!document.fullscreenElement;
            const icon = fullscreenBtn?.querySelector('i');
            if (icon) {
                icon.classList.toggle('fa-expand', !isFullscreen);
                icon.classList.toggle('fa-compress', isFullscreen);
            }
            fullscreenBtn?.setAttribute('title', isFullscreen ? 'Exit Fullscreen' : 'Fullscreen');
        };

        // Confirmation Modal
        const showConfirmationModal = (modalId, targetData = {}) => {
            const modal = document.getElementById(modalId);
            if (!modal) return;
            modal.dataset.targetData = JSON.stringify(targetData);
            modal.classList.add('visible');
            manageBodyScroll();
        };

        const hideConfirmationModal = (modalId) => {
            const modal = document.getElementById(modalId);
            if (modal) {
                delete modal.dataset.targetData;
                modal.classList.remove('visible');
                manageBodyScroll();
            }
        };

        // Section Toggle
        const toggleSectionOriginal = (buttonElement) => {
            const section = buttonElement.closest('.detail-section-original');
            const content = section?.querySelector('.section-content-original');
            const icon = buttonElement.querySelector('i');
            if (section && content && icon) {
                const isCollapsed = section.classList.toggle('collapsed');
                icon.classList.toggle('fa-chevron-down', isCollapsed);
                icon.classList.toggle('fa-chevron-up', !isCollapsed);
            }
        };

        // Currency Conversion
        const calculateAndUpdateVND = () => {
            if (!usdInput || !vndInput) return;
            const usdValue = parseFloat(usdInput.value) || 0;
            const currentExchangeRate = parseFloat(customExchangeRateInput.value) || 25500;
            const vndValue = usdValue * currentExchangeRate;
            vndInput.value = vndValue.toLocaleString('vi-VN');
        };

        // Notification và Announcement
        const toggleNotificationDropdown = () => notificationDropdown?.classList.toggle('visible');
        const closeNotificationDropdown = () => notificationDropdown?.classList.remove('visible');
        const showAnnouncement = () => {
            announcementOverlay?.classList.add('visible');
            manageBodyScroll();
        };
        const closeAnnouncement = () => {
            announcementOverlay?.classList.remove('visible');
            manageBodyScroll();
        };

        // Payment Status Handling
        const urlParams = new URLSearchParams(window.location.search);
        const orderId = urlParams.get('orderId');
        if (pageTitleElement && orderId) {
            pageTitleElement.textContent = `Tình trạng thanh toán - ${orderId}`;
            const savedStatusDL = localStorage.getItem('paymentStatusDL_' + orderId);
            const agentStatusSelect = document.querySelectorAll('.payment-details-original select')[0];
            if (savedStatusDL && agentStatusSelect) {
                const options = agentStatusSelect.options;
                for (let i = 0; i < options.length; i++) {
                    if (options[i].value === savedStatusDL) {
                        agentStatusSelect.selectedIndex = i;
                        break;
                    }
                }
            }
        } else if (pageTitleElement) {
            pageTitleElement.textContent = `Tình trạng thanh toán`;
        }

        const updatePaymentStatus = (type) => {
            const currentOrderId = orderId;
            if (!currentOrderId) return alert('Không tìm thấy mã đơn hàng để lưu!');
            const status = document.querySelectorAll('.payment-details-original select')[type === 'KH' ? 0 : 0].value; // Sửa logic select index nếu cần
            const key = `paymentStatus${type}_` + currentOrderId;
            localStorage.setItem(key, status);
            alert(`Đã lưu trạng thái thanh toán ${type} cho đơn ${currentOrderId}!`);
        };

        // Event Listeners
        mobileSidebarToggleBtn?.addEventListener('click', toggleSidebarMobileOrDesktop);
        sidebarOverlay?.addEventListener('click', toggleSidebarMobileOrDesktop);
        fullscreenBtn?.addEventListener('click', toggleFullscreen);
        document.addEventListener('fullscreenchange', handleFullscreenChange);

        document.querySelectorAll('.section-toggle-btn').forEach(button => {
            button.addEventListener('click', () => toggleSectionOriginal(button));
            const section = button.closest('.detail-section-original');
            const icon = button.querySelector('i');
            if (section && icon) {
                const isCollapsed = section.classList.contains('collapsed');
                icon.classList.toggle('fa-chevron-down', isCollapsed);
                icon.classList.toggle('fa-chevron-up', !isCollapsed);
            }
        });

        document.querySelectorAll('.update-button-original').forEach((button, index) => {
            button.addEventListener('click', () => {
                updatePaymentStatus(index === 0 ? 'KH' : 'DL');
            });
        });

        if (form) {
            form.addEventListener('submit', (e) => {
                e.preventDefault();
                const confirmCheckbox = document.getElementById('confirm_payment_info');
                if (confirmCheckbox && confirmCheckbox.required && !confirmCheckbox.checked) {
                    alert('Vui lòng xác nhận đã kiểm tra thông tin trước khi hoàn thành.');
                    return;
                }
                alert('Đã hoàn thành cập nhật thanh toán (demo)!');
                window.location.href = 'package_manager.html';
            });
            const resetButton = form.querySelector('button[type="reset"]');
            if (resetButton) resetButton.addEventListener('click', () => {});
        }

        currencySwitchBtn?.addEventListener('click', () => alert('Chức năng chuyển đổi tiền tệ (demo)!'));
        usdInput?.addEventListener('input', calculateAndUpdateVND);
        customExchangeRateInput?.addEventListener('input', calculateAndUpdateVND);
        calculateAndUpdateVND();

        document.querySelectorAll('.confirmation-modal').forEach(modal => {
            const modalId = modal.id;
            modal.querySelector('.confirm-yes')?.addEventListener('click', () => {
                const data = JSON.parse(modal.dataset.targetData || '{}');
                hideConfirmationModal(modalId);
            });
            modal.querySelector('.confirm-cancel')?.addEventListener('click', () => hideConfirmationModal(modalId));
            modal.addEventListener('click', (event) => { if (event.target === modal) hideConfirmationModal(modalId); });
        });

        notificationButton?.addEventListener('click', (event) => {
            event.stopPropagation();
            toggleNotificationDropdown();
        });

        notificationList?.addEventListener('click', (event) => {
            const clickedItem = event.target.closest('.notification-item');
            if (clickedItem && announcementTitle && announcementBodyEl && announcementTimestamp) {
                announcementTitle.textContent = clickedItem.dataset.title || 'Thông báo';
                announcementBodyEl.innerHTML = '';
                (clickedItem.dataset.body || 'Không có nội dung.').split('||').forEach(text => {
                    if (text.trim()) {
                        const p = document.createElement('p');
                        p.textContent = text.trim();
                        announcementBodyEl.appendChild(p);
                    }
                });
                announcementTimestamp.textContent = clickedItem.dataset.timestamp || '';
                showAnnouncement();
                closeNotificationDropdown();
            }
        });

        document.addEventListener('click', (event) => {
            if (notificationDropdown?.classList.contains('visible') && !notificationDropdown.contains(event.target) && event.target !== notificationButton && !notificationButton.contains(event.target)) {
                closeNotificationDropdown();
            }
        });

        announcementCloseBtn?.addEventListener('click', closeAnnouncement);
        announcementOverlay?.addEventListener('click', (event) => { if (event.target === announcementOverlay) closeAnnouncement(); });

        document.addEventListener('keydown', (event) => {
            if (event.key === 'Escape') {
                if (announcementOverlay?.classList.contains('visible')) closeAnnouncement();
                else if (notificationDropdown?.classList.contains('visible')) closeNotificationDropdown();
            }
        });

        // Initialize date pickers
        const datePickers = document.querySelectorAll('.date-picker');
        datePickers.forEach(input => {
            flatpickr(input, {
                locale: (window.flatpickr && flatpickr.l10ns && flatpickr.l10ns.vi) ? flatpickr.l10ns.vi : 'default',
                dateFormat: 'd/m/Y',
                allowInput: false,
                disableMobile: false,
                static: false,
                position: 'auto',
                appendTo: document.body,
                onChange: function (selectedDates, dateStr) {}
            });
        });

        // Khởi tạo
        updateDateTime();
        setInterval(updateDateTime, 1000);
    });
</script>
@endpush
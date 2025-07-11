@extends('index')

@push('css')
<link rel="stylesheet" href="../css/package_manager.css">
<link rel="stylesheet" href="../css/straking_bill.css">
@endpush

@section('main_content')
<div class="content-wrapper">
    <section class="page-header">
        <div class="page-header-left">
            <h1 class="page-title">Theo Dõi Trạng thái Vận đơn - MTE192775</h1>
            <nav class="breadcrumb" aria-label="breadcrumb">
                <a href="#">Quản lý</a> / <span>Quản lý trạng thái</span>
            </nav>
        </div>
    </section>

    <div class="straking-content-screenshot">
        <form id="tracking-status-form">
            <section class="top-section-ss">
                <div class="action-bar-ss">
                    <div class="status-selector-ss">
                        <i class="fas fa-tags"></i>
                        <label for="tracking_status_select">Trạng thái đơn hàng</label>
                        <select id="tracking_status_select" name="tracking_status">
                            <option value="received">Nhận yêu cầu đơn hàng</option>
                            <option value="warehouse">Đã nhận hàng về kho</option>
                            <option value="shipping" selected>Hàng đang vận chuyển</option>
                            <option value="delivered">Đã giao hàng</option>
                        </select>
                    </div>
                    <div class="action-buttons-ss">
                        <button type="button" class="button danger btn-cancel-ss"><i
                                class="fa-solid fa-xmark"></i> Thoát</button>
                        <button type="submit" class="button confirm btn-update-ss"><i
                                class="fa-solid fa-check"></i> Cập nhật</button>
                    </div>
                </div>

                <div class="progress-bar-ss" id="shipment-progress">
                    <div class="progress-line-ss"></div>
                    <div class="progress-step-ss completed" data-label="Nhận yêu cầu đơn hàng">
                        <div class="step-icon-ss"><i class="fa-solid fa-file-alt"></i></div>
                    </div>
                    <div class="progress-step-ss completed" data-label="Đã nhận hàng về kho">
                        <div class="step-icon-ss"><i class="fa-solid fa-warehouse"></i></div>
                    </div>
                    <div class="progress-step-ss active" data-label="Hàng đang vận chuyển">
                        <div class="step-icon-ss"><i class="fa-solid fa-truck"></i></div>
                    </div>
                    <div class="progress-step-ss" data-label="Đã giao hàng">
                        <div class="step-icon-ss"><i class="fa-solid fa-box-open"></i></div>
                    </div>
                </div>
                <div class="step-labels-ss">
                    <span>Nhận yêu cầu đơn hàng</span>
                    <span>Đã nhận hàng về kho</span>
                    <span>Hàng đang vận chuyển</span>
                    <span>Đã giao hàng</span>
                </div>
            </section>

            <div class="content-columns-ss">
                <div class="column-left-ss">
                    <section class="card info-card-ss">
                        <header class="card-header info-header-ss">
                            <h2 class="card-title"><i class="fas fa-box-open"></i> Thông tin kiện hàng</h2>
                            <button type="button" class="icon-button section-toggle-btn"
                                title="Thu gọn/Mở rộng"><i class="fas fa-chevron-up"></i></button>
                        </header>
                        <div class="card-body info-body-ss">
                            <h3 class="info-group-title-ss"><i class="fa-solid fa-ticket"></i> Thông tin dịch vụ
                            </h3>
                            <dl class="info-list-ss">
                                <dt><i class="fas fa-barcode"></i> Mã Tracking (REF Code)</dt>
                                <dd>1ZY5W1730491854782</dd>
                                <dt><i class="fas fa-map-marker-alt"></i> Từ</dt>
                                <dd>HO CHI MINH, VN</dd>
                                <dt><i class="fas fa-map-pin"></i> Tới</dt>
                                <dd>United States</dd>
                                <dt><i class="fas fa-shipping-fast"></i> Dịch vụ</dt>
                                <dd>MTE-US</dd>
                                <dt><i class="far fa-calendar-alt"></i> Ngày gửi</dt>
                                <dd>15-08-2024</dd>
                                <dt><i class="far fa-calendar-check"></i> Ngày xuất</dt>
                                <dd>18-08-2024</dd>
                            </dl>
                            <h3 class="info-group-title-ss"><i class="fa-solid fa-box"></i> Chi tiết gói hàng
                            </h3>
                            <dl class="info-list-ss">
                                <dt><i class="fas fa-boxes-stacked"></i> Loại kiện</dt>
                                <dd>Hàng hóa</dd>
                                <dt><i class="fas fa-calculator"></i> Tổng số kiện</dt>
                                <dd>2</dd>
                            </dl>
                        </div>
                    </section>
                </div>

                <div class="column-right-ss">
                    <section class="card history-card-ss">
                        <header class="card-header history-header-ss">
                            <h2 class="card-title"><i class="fas fa-history"></i> Lịch sử & Cập nhật</h2>
                            <button type="button" class="icon-button section-toggle-btn"
                                title="Thu gọn/Mở rộng"><i class="fas fa-chevron-up"></i></button>
                        </header>
                        <div class="card-body history-body-ss">
                            <div class="add-history-toggle-ss"
                                style="cursor:pointer;display:flex;align-items:center;gap:8px;margin-bottom:8px;">
                                <i class="fas fa-plus-circle" style="color:#6366f1;font-size:1.1em;"></i>
                                <span class="section-subtitle"
                                    style="margin:0;font-weight:600;font-size:1em;user-select:none;">Thêm mục
                                    lịch sử</span>
                            </div>
                            <form class="add-history-form-ss card-section">
                                <div class="add-history-grid-ss">
                                    <label for="history_time_ss">Thời gian:</label>
                                    <input type="datetime-local" id="history_time_ss"
                                        aria-label="Thời gian lịch sử">
                                    <label for="history_location_ss">Địa chỉ:</label>
                                    <input type="text" id="history_location_ss" placeholder="VD: HONGKONG"
                                        aria-label="Địa chỉ lịch sử">
                                    <label for="history_description_ss">Nội dung trạng thái:</label>
                                    <input type="text" id="history_description_ss"
                                        placeholder="VD: Hàng cập bến..." aria-label="Nội dung trạng thái">
                                </div>
                                <div class="form-actions">
                                    <button type="submit" class="button confirm btn-add-history-ss"
                                        title="Thêm"><i class="fa-solid fa-plus"></i> Thêm</button>
                                    <button type="reset" class="button warning btn-reset-history-ss"
                                        title="Làm mới"><i class="fa-solid fa-arrows-rotate"></i> Làm
                                        mới</button>
                                </div>
                            </form>

                            <div class="timeline-section-ss card-section">
                                <div class="timeline-header-ss"
                                    style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 10px;">
                                    <h3 class="section-subtitle" style="margin-bottom: 0;"><i
                                            class="fas fa-list-ul"></i> Chi tiết lịch sử</h3>
                                    <button type="button" class="timeline-toggle-btn-ss" title="Thu gọn/Mở rộng"
                                        style="background: none; border: none; color: #6366f1; font-size: 1.3em; cursor: pointer; padding: 4px 10px; border-radius: 6px;"><i
                                            class="fas fa-chevron-up"></i></button>
                                </div>
                                <ul class="timeline-ss">
                                    <li class="timeline-item-ss completed">
                                        <span class="timeline-icon-ss"><i class="fas fa-check"></i></span>
                                        <div class="timeline-content-ss">
                                            <div class="time-info"><strong>Thứ sáu</strong>, 25/08/2024 - 1:04
                                                PM</div>
                                            <div class="description"> Giao hàng thành công <br> <span
                                                    class="location">Điểm đến: NEW YORK CITY - United
                                                    States</span> </div>
                                            <button class="timeline-delete-btn-ss" title="Xóa"><i
                                                    class="fas fa-trash-can"></i></button>
                                        </div>
                                    </li>
                                    <li class="timeline-item-ss pending">
                                        <span class="timeline-icon-ss"><i
                                                class="fa-solid fa-location-arrow"></i></span>
                                        <div class="timeline-content-ss">
                                            <div class="time-info"><strong>Thứ năm</strong>, 24/08/2024 - 11:04
                                                PM</div>
                                            <div class="description"> Hàng cập bến sân bay New York <br> <span
                                                    class="location">NEWYORK, UNITED STATES</span> </div>
                                            <button class="timeline-delete-btn-ss" title="Xóa"><i
                                                    class="fas fa-trash-can"></i></button>
                                        </div>
                                    </li>
                                    <li class="timeline-item-ss pending">
                                        <span class="timeline-icon-ss"><i
                                                class="fa-solid fa-location-arrow"></i></span>
                                        <div class="timeline-content-ss">
                                            <div class="time-info">09:04 AM</div>
                                            <div class="description"> Hàng cập bến Hong Kong đến New York <br>
                                                <span class="location">HONGKONG - NEWYORK</span>
                                            </div>
                                            <button class="timeline-delete-btn-ss" title="Xóa"><i
                                                    class="fas fa-trash-can"></i></button>
                                        </div>
                                    </li>
                                    <li class="timeline-item-ss pending">
                                        <span class="timeline-icon-ss"><i
                                                class="fa-solid fa-location-arrow"></i></span>
                                        <div class="timeline-content-ss">
                                            <div class="time-info">09:04 AM</div>
                                            <div class="description"> Hàng đang bay từ kho DHL đến New York <br>
                                                <span class="location">HCM - HONGKONG - NEWYORK</span>
                                            </div>
                                            <button class="timeline-delete-btn-ss" title="Xóa"><i
                                                    class="fas fa-trash-can"></i></button>
                                        </div>
                                    </li>
                                    <li class="timeline-item-ss pending">
                                        <span class="timeline-icon-ss"><i
                                                class="fa-solid fa-location-arrow"></i></span>
                                        <div class="timeline-content-ss">
                                            <div class="time-info"><strong>Thứ ba</strong>, 22/08/2024 - 1:24 AM
                                            </div>
                                            <div class="description"> Hàng đã được giữ tại Hãng <br> <span
                                                    class="location">TÂN SƠN NHẤT, HCM</span> </div>
                                            <button class="timeline-delete-btn-ss" title="Xóa"><i
                                                    class="fas fa-trash-can"></i></button>
                                        </div>
                                    </li>
                                    <li class="timeline-item-ss pending">
                                        <span class="timeline-icon-ss"><i
                                                class="fa-solid fa-location-arrow"></i></span>
                                        <div class="timeline-content-ss">
                                            <div class="time-info">05:04 PM</div>
                                            <div class="description"> Hàng đã được cân lại tại Hàng <br> <span
                                                    class="location">TÂN SƠN NHẤT, HCM</span> </div>
                                            <button class="timeline-delete-btn-ss" title="Xóa"><i
                                                    class="fas fa-trash-can"></i></button>
                                        </div>
                                    </li>
                                    <li class="timeline-item-ss pending">
                                        <span class="timeline-icon-ss"><i
                                                class="fa-solid fa-location-arrow"></i></span>
                                        <div class="timeline-content-ss">
                                            <div class="time-info"><strong>Thứ hai</strong>, 16/08/2024 - 5:24
                                                AM</div>
                                            <div class="description"> Hàng đã xuất kho <br> <span
                                                    class="location">TÂN PHÚ, HCM</span> </div>
                                            <button class="timeline-delete-btn-ss" title="Xóa"><i
                                                    class="fas fa-trash-can"></i></button>
                                        </div>
                                    </li>
                                    <li class="timeline-item-ss pending">
                                        <span class="timeline-icon-ss error-icon">!</span>
                                        <div class="timeline-content-ss">
                                            <div class="time-info"><strong>Chủ Nhật</strong>, 15/08/2024 - 1:24
                                                AM</div>
                                            <div class="description"> Đơn hàng được tạo <br> <span
                                                    class="location">Quận 7, HCM</span> </div>
                                            <button class="timeline-delete-btn-ss" title="Xóa"><i
                                                    class="fas fa-trash-can"></i></button>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('script')
<script>
    const body = document.body;
    const sidebar = document.getElementById('sidebar');
    const sidebarOverlay = document.getElementById('sidebar-overlay');
    const mobileSidebarToggleBtn = document.getElementById('mobile-sidebar-toggle');
    const desktopSidebarToggleBtn = document.querySelector('.sidebar-toggle-desktop');
    const currentDateSpan = document.getElementById('current-date');
    const currentTimeSpan = document.getElementById('current-time');
    const currentYearSpan = document.getElementById('current-year');
    const fullscreenBtn = document.getElementById('fullscreen-btn');

    const manageBodyScroll = () => {
        const isSidebarOpen = body.classList.contains('sidebar-mobile-open');
        const isAnyModalVisible = document.querySelector('.confirmation-modal.visible, .announcement-overlay.visible');
        if (isSidebarOpen || isAnyModalVisible) {
            body.classList.add('overflow-hidden');
        } else {
            body.classList.remove('overflow-hidden');
        }
    };

    function toggleSidebarMobileOrDesktop() {
        if (window.innerWidth > 768) {
            body.classList.toggle('sidebar-collapsed');
        } else {
            body.classList.toggle('sidebar-mobile-open');
            const isOpen = body.classList.contains('sidebar-mobile-open');
            if (mobileSidebarToggleBtn) mobileSidebarToggleBtn.setAttribute('aria-expanded', String(isOpen));
        }
        manageBodyScroll();
    }

    function toggleSidebarDesktop() {
        body.classList.toggle('sidebar-collapsed');
        const isCollapsed = body.classList.contains('sidebar-collapsed');
        if (desktopSidebarToggleBtn) {
            desktopSidebarToggleBtn.title = isCollapsed ? "Phóng Sidebar" : "Thu Sidebar";
        }
        if (isCollapsed) {
            document.querySelectorAll('.menu-items .submenu.active').forEach(submenu => {
                submenu.classList.remove('active');
                const parentLink = submenu.previousElementSibling;
                if (parentLink?.classList.contains('submenu-parent')) {
                    parentLink.classList.remove('active');
                    parentLink.querySelector('.submenu-arrow')?.style.setProperty('transform', 'rotate(0deg)');
                }
            });
        } else {
            initializeActiveSubmenu();
        }
    }

    function toggleSubmenu(event) {
        event.preventDefault();
        if (body.classList.contains('sidebar-collapsed') && window.innerWidth > 768) return;
        const parentLink = event.currentTarget;
        const submenuWrapper = parentLink.nextElementSibling;
        const arrow = parentLink.querySelector('.submenu-arrow');
        if (!submenuWrapper?.classList.contains('submenu')) return;
        const parentList = parentLink.closest('ul');
        if (parentList) {
            parentList.querySelectorAll(':scope > li > .submenu-parent.active').forEach(activeParent => {
                if (activeParent !== parentLink) {
                    activeParent.classList.remove('active');
                    activeParent.nextElementSibling?.classList.remove('active');
                    activeParent.querySelector('.submenu-arrow')?.style.setProperty('transform', 'rotate(0deg)');
                }
            });
        }
        const isActive = submenuWrapper.classList.toggle('active');
        parentLink.classList.toggle('active', isActive);
        if (arrow) arrow.style.setProperty('transform', isActive ? 'rotate(180deg)' : 'rotate(0deg)');
    }

    function initializeActiveSubmenu() {
        const activeSubmenuLink = document.querySelector('.sidebar .submenu a.active');
        if (activeSubmenuLink) {
            const submenuDiv = activeSubmenuLink.closest('.submenu');
            const parentLink = submenuDiv?.previousElementSibling;
            if (submenuDiv && parentLink?.classList.contains('submenu-parent')) {
                if (!(body.classList.contains('sidebar-collapsed') && window.innerWidth > 768)) {
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
            document.documentElement.requestFullscreen().catch(err => console.error(`Fullscreen error: ${err.message}`));
        } else if (document.exitFullscreen) {
            document.exitFullscreen();
        }
    }

    function handleFullscreenChange() {
        const isFullscreen = !!document.fullscreenElement;
        const icon = fullscreenBtn?.querySelector('i');
        if (icon) {
            icon.classList.toggle('fa-expand', !isFullscreen);
            icon.classList.toggle('fa-compress', isFullscreen);
        }
        if (fullscreenBtn) {
            fullscreenBtn.setAttribute('title', isFullscreen ? 'Exit Fullscreen' : 'Fullscreen');
        }
    }

    document.addEventListener('DOMContentLoaded', () => {
        initializeActiveSubmenu();
        updateDateTime();
        setInterval(updateDateTime, 1000);

        if (mobileSidebarToggleBtn) mobileSidebarToggleBtn.addEventListener('click', toggleSidebarMobileOrDesktop);
        else console.error("Mobile toggle button not found");
        if (sidebarOverlay) sidebarOverlay.addEventListener('click', toggleSidebarMobileOrDesktop);
        else console.error("Sidebar overlay not found");
        if (desktopSidebarToggleBtn) desktopSidebarToggleBtn.addEventListener('click', toggleSidebarDesktop);
        document.querySelectorAll('.menu-items .submenu-parent').forEach(link => { link.addEventListener('click', toggleSubmenu); });
        if (fullscreenBtn) fullscreenBtn.addEventListener('click', toggleFullscreen);
        document.addEventListener('fullscreenchange', handleFullscreenChange);

        function toggleCardSection(buttonElement) {
            const card = buttonElement.closest('.card');
            const icon = buttonElement.querySelector('i');
            if (card && icon) {
                const isCollapsed = card.classList.toggle('collapsed');
                icon.classList.toggle('fa-chevron-down', isCollapsed);
                icon.classList.toggle('fa-chevron-up', !isCollapsed);
            }
        }

        document.querySelectorAll('.card-header .section-toggle-btn').forEach(button => {
            button.addEventListener('click', () => toggleCardSection(button));
            const card = button.closest('.card');
            const icon = button.querySelector('i');
            if (card && icon) {
                const isCollapsed = card.classList.contains('collapsed');
                icon.classList.toggle('fa-chevron-down', isCollapsed);
                icon.classList.toggle('fa-chevron-up', !isCollapsed);
            }
        });

        function updateScreenshotProgressBar(activeIndex) {
            const steps = document.querySelectorAll('.progress-step-ss');
            const totalSteps = steps.length;
            if (!steps || totalSteps === 0) return;
            activeIndex = Math.max(0, Math.min(activeIndex, totalSteps - 1));
            steps.forEach((step, index) => {
                step.classList.remove('active', 'completed');
                if (index < activeIndex) { step.classList.add('completed'); }
                else if (index === activeIndex) { step.classList.add('active'); }
            });
            const progressPercent = totalSteps <= 1 ? 100 : (activeIndex / (totalSteps - 1)) * 100;
            document.documentElement.style.setProperty('--straking-progress-width-ss', progressPercent + '%');
        }

        const statusUpdateForm = document.getElementById('tracking-status-form');
        const mainUpdateButton = statusUpdateForm?.querySelector('.btn-update-ss');
        const mainCancelButton = statusUpdateForm?.querySelector('.btn-cancel-ss');
        const mainStatusSelect = document.getElementById('tracking_status_select');

        if (mainUpdateButton && mainStatusSelect) {
            mainUpdateButton.addEventListener('click', (e) => {
                e.preventDefault();
                const selectedValue = mainStatusSelect.value;
                const selectedText = mainStatusSelect.options[mainStatusSelect.selectedIndex].text;
                alert(`Cập nhật trạng thái thành: ${selectedText} (Demo)`);
                let newIndex = 0;
                switch (selectedValue) {
                    case 'received': newIndex = 0; break;
                    case 'warehouse': newIndex = 1; break;
                    case 'shipping': newIndex = 2; break;
                    case 'delivered': newIndex = 3; break;
                    default: newIndex = 0;
                }
                updateScreenshotProgressBar(newIndex);
            });
        }
        if (mainCancelButton) { mainCancelButton.addEventListener('click', () => window.history.back()); }

        const addHistoryToggle = document.querySelector('.add-history-toggle-ss');
        const addHistoryForm = document.querySelector('.add-history-form-ss');
        if (addHistoryForm) addHistoryForm.style.display = 'none';
        if (addHistoryToggle && addHistoryForm) {
            addHistoryToggle.addEventListener('click', () => {
                const isHidden = addHistoryForm.style.display === 'none' || addHistoryForm.style.display === '';
                addHistoryForm.style.display = isHidden ? 'block' : 'none';
            });
        }

        const handleDeleteHistory = (e) => {
            e.stopPropagation();
            if (confirm('Bạn có chắc muốn xóa mục lịch sử này?')) {
                e.target.closest(".timeline-item-ss")?.remove();
                alert('Đã xóa mục lịch sử (Demo)!');
            }
        };
        document.querySelectorAll('.timeline-delete-btn-ss').forEach(button => { button.addEventListener('click', handleDeleteHistory); });

        updateScreenshotProgressBar(2);

        const timelineSection = document.querySelector('.timeline-section-ss');
        const timelineList = timelineSection?.querySelector('.timeline-ss');
        const timelineToggleBtn = timelineSection?.querySelector('.timeline-toggle-btn-ss');
        if (timelineToggleBtn && timelineList) {
            timelineList.classList.add('collapsed');
            timelineList.style.display = 'none';
            const icon = timelineToggleBtn.querySelector('i');
            icon.classList.remove('fa-chevron-up');
            icon.classList.add('fa-chevron-down');
            timelineToggleBtn.addEventListener('click', () => {
                const isCollapsed = timelineList.classList.toggle('collapsed');
                const icon = timelineToggleBtn.querySelector('i');
                if (isCollapsed) {
                    timelineList.style.display = 'none';
                    icon.classList.remove('fa-chevron-up');
                    icon.classList.add('fa-chevron-down');
                } else {
                    timelineList.style.display = '';
                    icon.classList.remove('fa-chevron-down');
                    icon.classList.add('fa-chevron-up');
                }
            });
        }

        // Add event listener to history time input to show picker on click
        const historyTimeInput = document.getElementById('history_time_ss');
        if (historyTimeInput) {
            historyTimeInput.addEventListener('click', function () {
                // Attempt to show the picker directly
                if (typeof this.showPicker === 'function') {
                    this.showPicker();
                } else {
                    // Fallback: focus the element, which often triggers the picker
                    this.focus();
                }
            });
        }

    });

    document.addEventListener('DOMContentLoaded', () => {
        const notificationBody = document.body;
        const notificationButton = document.getElementById('notification-button');
        const notificationDropdown = document.getElementById('notification-dropdown');
        const notificationList = document.getElementById('notification-list');
        const announcementOverlay = document.getElementById('announcement-overlay');
        const announcementBox = document.getElementById('announcement-box');
        const announcementCloseBtn = document.getElementById('announcement-close-btn');
        const announcementTitle = document.getElementById('announcement-title');
        const announcementBodyEl = document.getElementById('announcement-body');
        const announcementTimestamp = document.getElementById('announcement-timestamp');

        const manageNotificationBodyScroll = () => {
            const isAnnounceVisible = announcementOverlay && announcementOverlay.classList.contains('visible');
            const isAnyOtherModalVisible = false;

            if (isAnnounceVisible || isAnyOtherModalVisible) {
                notificationBody.classList.add('overflow-hidden');
            } else {
                if (!isAnyOtherModalVisible) {
                    notificationBody.classList.remove('overflow-hidden');
                }
            }
        };

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
                manageNotificationBodyScroll();
            }
        }

        function closeAnnouncement() {
            if (announcementOverlay) {
                announcementOverlay.classList.remove('visible');
                manageNotificationBodyScroll();
            }
        }

        if (announcementOverlay && announcementOverlay.classList.contains('visible')) {
            closeAnnouncement();
        }

        if (notificationButton) {
            notificationButton.addEventListener('click', (event) => {
                event.stopPropagation();
                toggleNotificationDropdown();
            });
        }

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

        if (announcementCloseBtn) {
            announcementCloseBtn.addEventListener('click', closeAnnouncement);
        }

        if (announcementOverlay) {
            announcementOverlay.addEventListener('click', (event) => {
                if (event.target === announcementOverlay) {
                    closeAnnouncement();
                }
            });
        }

        document.addEventListener('keydown', (event) => {
            if (event.key === 'Escape') {
                if (announcementOverlay && announcementOverlay.classList.contains('visible')) {
                    closeAnnouncement();
                } else if (notificationDropdown && notificationDropdown.classList.contains('visible')) {
                    closeNotificationDropdown();
                }
            }
        });
    });

    
</script>
@endpush
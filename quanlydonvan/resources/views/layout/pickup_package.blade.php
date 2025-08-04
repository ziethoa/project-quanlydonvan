@extends('index')

@push('css')
<link rel="stylesheet" href="../css/package_manager.css">
<link rel="stylesheet" href="../css/pickup-package.css">
<link href="https://cdn.jsdelivr.net/npm/@eonasdan/tempus-dominus@6.9.6/dist/css/tempus-dominus.min.css"
    rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@eonasdan/tempus-dominus@6.9.6/dist/js/tempus-dominus.min.js"></script>
@endpush

@section('main_content')
<div class="content-wrapper">
    <section class="page-header">
        <div class="page-header-left">
            <h1 class="page-title">PICKUP ĐƠN HÀNG</h1>
            <nav class="breadcrumb" aria-label="breadcrumb"> <a href="#">Quản lý</a> / <span>Quản lý vận
                    chuyển</span> / <span>Pickup Đơn Hàng</span> </nav>
        </div>
    </section>
    <form id="pickup-order-form">
        <div class="content-layout card">
            <div class="content-column-left">
                <div class="data-section">
                    <div class="section-header"><span><i class="fa-solid fa-truck"></i> Hình thức lấy
                            hàng</span></div>
                    <div class="form-group"> <label for="pickup_vehicle">Hình thức vận chuyển:</label> <select
                            id="pickup_vehicle" name="pickup_vehicle">
                            <option value="minivan" selected>Xe bán tải / Minivan</option>
                            <option value="motorbike">Xe máy</option>
                            <option value="truck">Xe tải</option>
                        </select> </div>
                    <div class="form-group"> <label for="pickup_time">Thời gian Pickup:</label>
                        <div class="input-with-icon"> <input type="text" id="pickup_time" name="pickup_time">
                        </div>
                    </div>
                    <div class="form-group"> <label for="pickup_address">Địa chỉ lấy hàng:</label> <textarea
                            id="pickup_address" name="pickup_address" rows="3"></textarea> </div>
                    <div class="form-group"> <label for="pickup_notes">Ghi chú lấy hàng:</label> <textarea
                            id="pickup_notes" name="pickup_notes" rows="2"></textarea> </div>
                </div>
                <div class="data-section">
                    <div class="section-header"><span><i class="fa-solid fa-clipboard-check"></i> Trạng thái lấy
                            hàng</span></div>
                    <div class="form-grid-2col">
                        <div class="form-group"> <label for="pickup_status">Trạng thái lấy hàng:</label> <select
                                id="pickup_status" name="pickup_status">
                                <option value="pending" selected>Chờ lấy hàng</option>
                                <option value="picked_up">Đã lấy hàng</option>
                                <option value="failed">Lấy thất bại</option>
                            </select> </div>
                        <div class="form-group"> <label for="pickup_cs">CS xử lý:</label> <select id="pickup_cs"
                                name="pickup_cs">
                                <option value="alice" selected>Alice in the Wonder La...</option>
                            </select> </div>
                    </div>
                    <div class="form-group"> <label for="received_time">Thời gian nhận hàng:</label>
                        <div class="input-with-icon"> <input type="text" id="received_time"
                                name="received_time"> </div>
                    </div>
                    <div class="form-group"> <label for="export_time">Thời gian xuất hàng:</label>
                        <div class="input-with-icon"> <input type="text" id="export_time" name="export_time">
                        </div>
                    </div>
                    <div class="form-group"> <label for="status_notes">Ghi chú:</label> <textarea
                            id="status_notes" name="status_notes" rows="2"></textarea> </div>
                    <div class="form-group">
                        <label>Ảnh đính kèm:</label>
                        <div class="attachment-group">
                            <button type="button" class="file-trigger-button button secondary"
                                id="select_images_btn"> <i class="fa-solid fa-image"></i> Chọn ảnh </button>
                            <input type="file" id="pickup_images" name="pickup_images[]" multiple
                                accept="image/jpeg, image=" image/png", image="image/gif"
                                style="display: none;">
                            <span class="file-type-note">(.jpg/.png/.jpeg)</span>
                        </div>
                        <div id="selected_files_list"><i>Chưa chọn file nào.</i></div>
                    </div>
                </div>
            </div>

            <div class="content-column-right">
                <div class="data-section">
                    <div class="section-header">
                        <span><i class="fa-solid fa-circle-info"></i> Thông tin đơn hàng</span>
                        <div class="creator-info" id="order-creator-info">Người tạo: </div>
                    </div>
                    <div class="readonly-info-section" id="order-info-dynamic">
                        <!-- Thông tin đơn hàng sẽ được render ở đây bằng JS -->
                    </div>
                </div>
            </div>
        </div>

        <div class="content-actions card">
            <div class="confirmation-check">
                <input type="checkbox" id="confirm_info_pickup" name="confirm_info_pickup" required checked>
                <label for="confirm_info_pickup">Tôi đã đọc kỹ và kiểm tra thông tin đầy đủ</label>
            </div>
            <div class="action-buttons">
                <button type="button" class="button secondary" onclick="window.history.back();"> <i
                        class="fa-solid fa-xmark"></i> Thoát </button>
                <button type="reset" class="button warning" form="pickup-order-form"> <i
                        class="fa-solid fa-arrows-rotate"></i> Làm mới </button>
                <button type="button" class="button info btn-save-draft"> <i
                        class="fa-solid fa-floppy-disk"></i> Lưu nháp </button>
                <button type="submit" class="button confirm btn-complete" form="pickup-order-form"> <i
                        class="fa-solid fa-check"></i> Hoàn thành </button>
            </div>
        </div>
    </form>
</div>
@endsection

@section('notification')
<div class="confirmation-modal" id="complete-order-modal"></div>
<div class="confirmation-modal" id="cancel-order-modal"></div>
<div class="confirmation-modal" id="receive-order-modal"></div>
<div class="confirmation-modal" id="delete-order-modal"></div>
@endsection

@push('script')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Khởi tạo biến toàn cục
        const body = document.body;
        const sidebar = document.getElementById('sidebar');
        const sidebarOverlay = document.getElementById('sidebar-overlay');
        const mobileSidebarToggleBtn = document.getElementById('mobile-sidebar-toggle');
        const desktopSidebarToggleBtn = document.querySelector('.sidebar-toggle-desktop');
        const currentDateSpan = document.getElementById('current-date');
        const currentTimeSpan = document.getElementById('current-time');
        const currentYearSpan = document.getElementById('current-year');
        const fullscreenBtn = document.getElementById('fullscreen-btn');
        const notificationButton = document.getElementById('notification-button');
        const notificationDropdown = document.getElementById('notification-dropdown');
        const notificationList = document.getElementById('notification-list');
        const announcementOverlay = document.getElementById('announcement-overlay');
        const announcementCloseBtn = document.getElementById('announcement-close-btn');
        const announcementTitle = document.getElementById('announcement-title');
        const announcementBodyEl = document.getElementById('announcement-body');
        const announcementTimestamp = document.getElementById('announcement-timestamp');
        const infoSection = document.getElementById('order-info-dynamic');
        const creatorInfo = document.getElementById('order-creator-info');
        const form = document.getElementById('pickup-order-form');
        const saveDraftButton = document.querySelector('.btn-save-draft');
        const selectImagesBtn = document.getElementById('select_images_btn');
        const fileInput = document.getElementById('pickup_images');
        const fileListDisplay = document.getElementById('selected_files_list');

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

        const toggleSidebarDesktop = () => {
            body.classList.toggle('sidebar-collapsed');
            const isCollapsed = body.classList.contains('sidebar-collapsed');
            if (desktopSidebarToggleBtn) {
                desktopSidebarToggleBtn.title = isCollapsed ? 'Phóng Sidebar' : 'Thu Sidebar';
                const icon = desktopSidebarToggleBtn.querySelector('i');
                if (icon) {
                    icon.classList.toggle('fa-arrow-left', !isCollapsed);
                    icon.classList.toggle('fa-arrow-right', isCollapsed);
                }
            }
        };

        // Date và Fullscreen
        const updateDateTime = () => {
            const now = new Date();
            const optionsDate = { weekday: 'short', day: '2-digit', month: '2-digit', year: 'numeric' };
            const optionsTime = { hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: true };
            try {
                currentDateSpan.textContent = now.toLocaleDateString('en-GB', optionsDate).replace(/,/g, '');
                currentTimeSpan.textContent = now.toLocaleTimeString('en-US', optionsTime);
            } catch (e) {
                currentDateSpan.textContent = now.toLocaleDateString();
                currentTimeSpan.textContent = now.toLocaleTimeString();
            }
            currentYearSpan.textContent = now.getFullYear();
        };

        const toggleFullscreen = () => {
            if (!document.fullscreenElement) {
                document.documentElement.requestFullscreen().catch(err => console.error(`Fullscreen error: ${err.message} (${err.name})`));
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
        const showConfirmationModal = (modalId, targetInfo = {}) => {
            const modal = document.getElementById(modalId);
            if (!modal) { console.error("Modal not found:", modalId); return; }
            modal.dataset.targetInfo = JSON.stringify(targetInfo);
            modal.classList.add('visible');
            manageBodyScroll();
        };

        const hideConfirmationModal = (modalId) => {
            const modal = document.getElementById(modalId);
            if (modal) {
                delete modal.dataset.targetInfo;
                modal.classList.remove('visible');
                manageBodyScroll();
            }
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

        // Form Handling
        const handleFormSubmit = (event) => {
            event.preventDefault();
            if (!form.checkValidity()) { form.reportValidity(); return; }
            const confirmCheckbox = document.getElementById('confirm_info_pickup');
            if (!confirmCheckbox.checked) { alert('Vui lòng xác nhận đã đọc kỹ và kiểm tra thông tin.'); return false; }

            const step1Data = JSON.parse(localStorage.getItem('createPackageWizardData') || localStorage.getItem('createPackageStep1') || '{}');
            const data = {
                pickup_vehicle: document.getElementById('pickup_vehicle').value,
                pickup_time: document.getElementById('pickup_time').value,
                pickup_address: document.getElementById('pickup_address').value,
                pickup_notes: document.getElementById('pickup_notes').value,
                pickup_status: document.getElementById('pickup_status').value,
                pickup_cs: document.getElementById('pickup_cs').value,
                received_time: document.getElementById('received_time').value,
                export_time: document.getElementById('export_time').value,
                status_notes: document.getElementById('status_notes').value,
            };
            const completeOrderData = { ...step1Data, ...data };

            const files = Array.from(fileInput.files);
            const imagePromises = files.map(file => {
                return new Promise((resolve, reject) => {
                    const reader = new FileReader();
                    reader.onload = (e) => resolve(e.target.result);
                    reader.onerror = (e) => reject(e);
                    reader.readAsDataURL(file);
                });
            });

            Promise.all(imagePromises).then(base64Images => {
                completeOrderData.pickup_images_base64 = base64Images;
                localStorage.setItem('pickupOrder', JSON.stringify(completeOrderData));
                console.log('Order data saved to localStorage under key "pickupOrder":', completeOrderData);
                alert('Thông tin Pickup đã được hoàn thành và lưu!');
                window.location.href = '/package_manager';
            }).catch(error => {
                console.error('Error reading image files:', error);
                alert('Đã xảy ra lỗi khi xử lý ảnh.');
            });
        };

        const handleSaveDraft = () => {
            console.log('Save Draft clicked');
            const formData = new FormData(form);
            console.log('Saving draft data:', Object.fromEntries(formData));
            alert('Đã lưu nháp thông tin (demo)!');
        };

        const handleFileSelection = (event) => {
            const files = event.target.files;
            let existingFileNames = fileListDisplay.querySelector('ul') ? Array.from(fileListDisplay.querySelectorAll('li [data-file-name]')).map(btn => btn.dataset.fileName) : [];
            const uniqueFilesMap = new Map();
            Array.from(fileInput.files).forEach(file => { if (existingFileNames.includes(file.name)) uniqueFilesMap.set(file.name, file); });
            Array.from(files).forEach(file => { uniqueFilesMap.set(file.name, file); });

            fileListDisplay.innerHTML = '';
            if (uniqueFilesMap.size > 0) {
                const list = document.createElement('ul');
                uniqueFilesMap.forEach(file => {
                    const listItem = document.createElement('li');
                    const imgPreview = document.createElement('img');
                    imgPreview.style.cssText = 'max-width:50px;max-height:50px;margin-right:10px;vertical-align:middle;border:1px solid #ddd;border-radius:4px;object-fit:cover;';
                    const reader = new FileReader();
                    reader.onload = (e) => { if (file.type.startsWith('image/')) imgPreview.src = e.target.result; };
                    if (file.type.startsWith('image/')) reader.readAsDataURL(file);
                    listItem.appendChild(imgPreview);

                    listItem.appendChild(document.createTextNode(file.name));
                    const removeBtn = document.createElement('button');
                    removeBtn.type = 'button'; removeBtn.className = 'remove-file-btn'; removeBtn.innerHTML = '×'; removeBtn.title = 'Gỡ bỏ file này'; removeBtn.dataset.fileName = file.name;
                    listItem.appendChild(removeBtn);
                    list.appendChild(listItem);
                });
                fileListDisplay.appendChild(list);
                const dataTransfer = new DataTransfer();
                uniqueFilesMap.forEach(file => dataTransfer.items.add(file));
                fileInput.files = dataTransfer.files;
            } else {
                fileListDisplay.innerHTML = '<i>Chưa chọn file nào.</i>';
                fileInput.value = '';
            }
        };

        const handleRemoveFile = (event) => {
            if (event.target.classList.contains('remove-file-btn')) {
                const fileNameToRemove = event.target.dataset.fileName;
                const dataTransfer = new DataTransfer();
                Array.from(fileInput.files).forEach(file => { if (file.name !== fileNameToRemove) dataTransfer.items.add(file); });
                fileInput.files = dataTransfer.files;
                event.target.closest('li').remove();
                if (!fileListDisplay.querySelector('li')) fileListDisplay.innerHTML = '<i>Chưa chọn file nào.</i>';
                console.log(`Removed ${fileNameToRemove}. Updated FileList:`, fileInput.files);
            }
        };

        // Render Order Info
        const renderOrderInfo = () => {
            const data = JSON.parse(localStorage.getItem('currentOrderDetail') || '{}');
            if (!data || Object.keys(data).length === 0) {
                infoSection.innerHTML = '<div style="color:red;padding:12px 0;">Không có dữ liệu đơn hàng!</div>';
                creatorInfo.textContent = 'Người tạo: ...';
                return;
            }
            let totalWeight = Array.isArray(data.dimensions) && data.dimensions.length > 0 ? data.dimensions.reduce((sum, d) => sum + (parseFloat(d.weight) || 0), 0).toFixed(1) + ' Kg' : '';
            let soKien = Array.isArray(data.dimensions) ? data.dimensions.length : '';
            let phones = data.sender_phone || '';
            let fragile = (data.is_fragile == '1' || data.is_fragile === true || data.is_fragile === 'true') ? 'Yes' : 'No';
            const html = `
                <div class="info-pair"><span class="info-label">Tên Công ty:</span><span class="info-value">${data.sender_company || ''}</span></div>
                <div class="info-pair"><span class="info-label">Tên người gửi:</span><span class="info-value">${data.sender_name || ''}</span></div>
                <div class="info-pair"><span class="info-label">Số điện thoại:</span><span class="info-value">${phones}</span></div>
                <div class="info-pair"><span class="info-label">Cân nặng:</span><span class="info-value">${totalWeight}</span></div>
                <div class="info-pair"><span class="info-label">Số lượng kiện:</span><span class="info-value">${soKien}</span></div>
                <div class="info-pair"><span class="info-label">Tên hàng hóa:</span><span class="info-value">${data.product_name || ''}</span></div>
                <div class="info-pair-row">
                    <div class="info-sub-pair"><span class="info-label">Chi nhánh:</span><span class="info-value">${data.branch || ''}</span></div>
                    <div class="info-sub-pair"><span class="info-label">Hình thức gửi:</span><span class="info-value">${data.pickup_method || ''}</span></div>
                </div>
                <div class="info-pair"><span class="info-label">Hàng dễ vỡ:</span><span class="info-value">${fragile}</span></div>
                <div class="info-pair"><span class="info-label">Dịch vụ:</span><span class="info-value">${data.service_type || ''}</span></div>
                <div class="info-pair"><span class="info-label">Đại lý:</span><span class="info-value">${data.agent || ''}</span></div>
                <div class="info-pair"><span class="info-label">Địa chỉ:</span><span class="info-value">${data.sender_address || ''}</span></div>
            `;
            infoSection.innerHTML = html;
            creatorInfo.textContent = 'Người tạo: ' + (data.creator || 'Phạm Hoàng Đình - S1');
        };

        // Datetime Picker
        const initDateTimePicker = (inputId, callback) => {
            const input = document.getElementById(inputId);
            if (input) {
                const picker = new tempusDominus.TempusDominus(input, {
                    display: {
                        components: { decades: true, year: true, month: true, date: true, hours: true, minutes: true, seconds: false, useTwentyfourHour: true },
                        icons: {
                            type: 'icons', time: 'fa fa-clock', date: 'fa fa-calendar', up: 'fa fa-arrow-up', down: 'fa fa-arrow-down',
                            previous: 'fa fa-chevron-left', next: 'fa fa-chevron-right', today: 'fa fa-calendar-check',
                            clear: 'fa fa-trash', close: 'fa fa-times'
                        }
                    },
                    localization: { format: 'dd/MM/yyyy HH:mm' }
                });
                picker.subscribe('change.datetimepicker', (e) => {
                    if (e.detail.date) {
                        const selectedDate = e.detail.date;
                        const formattedDate = `${selectedDate.getDate().toString().padStart(2, '0')}/${(selectedDate.getMonth() + 1).toString().padStart(2, '0')}/${selectedDate.getFullYear()} ${selectedDate.getHours().toString().padStart(2, '0')}:${selectedDate.getMinutes().toString().padStart(2, '0')}`;
                        input.value = formattedDate;
                        callback?.(formattedDate);
                    } else {
                        input.value = '';
                        callback?.(null);
                    }
                });
            }
        };

        initDateTimePicker('pickup_time', (date) => console.log('Pickup Time selected:', date));
        initDateTimePicker('received_time', (date) => console.log('Received Time selected:', date));
        initDateTimePicker('export_time', (date) => console.log('Export Time selected:', date));

        // Event Listeners
        mobileSidebarToggleBtn?.addEventListener('click', toggleSidebarMobileOrDesktop);
        sidebarOverlay?.addEventListener('click', toggleSidebarMobileOrDesktop);
        desktopSidebarToggleBtn?.addEventListener('click', toggleSidebarDesktop);
        fullscreenBtn?.addEventListener('click', toggleFullscreen);
        document.addEventListener('fullscreenchange', handleFullscreenChange);

        document.querySelectorAll('.confirmation-modal').forEach(modal => {
            const modalId = modal.id;
            modal.querySelector('.confirm-yes')?.addEventListener('click', () => {
                const info = JSON.parse(modal.dataset.targetInfo || '{}');
                console.log(`CONFIRMED: ${modalId}`, info);
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

        form?.addEventListener('submit', handleFormSubmit);
        saveDraftButton?.addEventListener('click', handleSaveDraft);
        selectImagesBtn?.addEventListener('click', () => fileInput?.click());
        fileInput?.addEventListener('change', handleFileSelection);
        fileListDisplay?.addEventListener('click', handleRemoveFile);

        // Khởi tạo
        updateDateTime();
        setInterval(updateDateTime, 1000);
        renderOrderInfo();
    });
</script>
@endpush
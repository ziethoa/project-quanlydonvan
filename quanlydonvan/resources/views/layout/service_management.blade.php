@extends('index')

@push('css')
<link rel="stylesheet" href="../css/service-management.css">
<link rel="stylesheet" href="../css/package_manager.css">
@endpush

@section('main_content')
<div class="content-wrapper">
    <section class="page-header">
        <div class="page-header-left">
            <h1 class="page-title">DANH SÁCH DỊCH VỤ</h1>
            <nav class="breadcrumb" aria-label="breadcrumb"><a href="#">Quản lý</a> / <span>Quản lý dịch
                    vụ</span></nav>
        </div>
    </section>

    <!-- Service Filter -->
    <div class="filter-container">
        <h3>Bộ lọc dịch vụ</h3>
        <div class="filter-section">
            <div class="filter-group">
                <div class="filter-item">
                    <label for="filterServiceName">Tên dịch vụ</label>
                    <input type="text" class="filter-input" id="filterServiceName"
                        placeholder="Lọc theo Tên DV">
                </div>
                <div class="filter-item">
                    <label for="filterServiceStatus">Trạng thái hiển thị</label>
                    <select class="filter-select" id="filterServiceStatus">
                        <option value="">Tất cả</option>
                        <option value="true">Đang hiển thị</option>
                        <option value="false">Đang ẩn</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="actions-container">
        <!-- Service Actions Buttons -->
        <div class="service-actions">
            <button class="button danger"><i class="fa-solid fa-trash-can"></i> Xóa đã chọn</button>
            <button class="button primary" id="addServiceBtn"><i class="fa-solid fa-plus"></i> Thêm dịch vụ
                mới</button>
        </div>
        <div class="items-per-page-control">
            <select id="items-per-page-select" class="form-select">
                <option value="5">5</option>
                <option value="10">10</option>
                <option value="20">20</option>
                <option value="50">50</option>
            </select>
            <span>dịch vụ/trang</span>
        </div>
    </div>
    <section class="table-area card" aria-labelledby="service-table-heading">
        <div class="card-header">
            <h2 id="service-table-heading">Danh sách Dịch vụ</h2>
        </div>
        <div class="table-container">
            <div class="table-wrapper">
                <table id="serviceTable">
                    <thead>
                        <tr>
                            <th scope="col" class="col-center"><input type="checkbox" id="select-all-checkbox"
                                    title="Chọn tất cả"></th>
                            <th scope="col" class="col-center">STT</th>
                            <th scope="col">Mã dịch vụ</th>
                            <th scope="col">Tên dịch vụ</th>
                            <th scope="col">Ngày cập nhật</th>
                            <th scope="col" class="col-center">Hiển thị</th>
                            <th scope="col" class="col-center">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody id="service-table-body"></tbody>
                </table>
            </div>
        </div>
        <div class="card-footer">
            <nav class="pagination" aria-label="Table navigation"><span class="pagination-info"
                    id="pagination-info">Hiển thị <b>1</b> đến <b>6</b> của <b>15</b> mục</span>
                <div class="pagination-buttons">
                    <!-- Các nút phân trang sẽ được đặt trong một div riêng -->
                    <div class="pagination-nav-buttons">
                        <button class="button" disabled="">Trước</button>
                        <button class="button active" aria-current="page">1</button>
                        <button class="button">2</button>
                        <button class="button">3</button>
                        <button class="button">Sau</button>
                    </div>
                </div>
            </nav>
            <div class="footer-actions" style="display: none;"><!-- Moved buttons here --><button
                    class="button danger"><i class="fa-solid fa-trash-can"></i> Xóa đã chọn</button><button
                    class="button primary" id="addServiceBtn"><i class="fa-solid fa-plus"></i> Thêm dịch vụ
                    mới</button></div>
        </div>
    </section>
    <footer class="site-footer">Minh Khôi Logistics © <span id="current-year">2025</span>. All rights reserved.
        Design by Nina Co.,Ltd</footer>
</div>
@endsection

@section('notification')
<!-- Modal Sửa Dịch Vụ -->
<div id="editServiceModalOverlay" class="modal-overlay">
    <div id="editServiceModal" class="modal-container">
        <form id="editServiceForm">
            <div class="modal-header">
                <h3 class="modal-title">Sửa thông tin dịch vụ</h3>
                <button type="button" class="modal-close-btn" id="editServiceModalClose">×</button>
            </div>
            <div class="modal-body">
                <div class="modal-form-group">
                    <label class="modal-label" for="editMaDV">Mã dịch vụ</label>
                    <input type="text" id="editMaDV" class="modal-input" required readonly>
                </div>
                <div class="modal-form-group">
                    <label class="modal-label" for="editTenDV">Tên dịch vụ</label>
                    <input type="text" id="editTenDV" class="modal-input" required>
                </div>
                <div class="modal-form-group">
                    <label class="modal-label" for="editNgayCapNhat">Ngày cập nhật</label>
                    <input type="date" id="editNgayCapNhat" class="modal-input" required>
                </div>
                <div class="modal-checkbox-group">
                    <input type="checkbox" id="editHienThi">
                    <label for="editHienThi">Hiển thị</label>
                </div>
            </div>
            <div class="modal-footer">
                <div class="modal-actions">
                    <button type="button" class="button secondary" id="cancelEditService">Hủy</button>
                    <button type="submit" class="button primary">Lưu</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Modal Xác nhận Xóa Dịch Vụ -->
<div id="deleteServiceModalOverlay" class="modal-overlay">
    <div id="deleteServiceModal" class="modal-container small-modal">
        <div class="modal-header">
            <h3 class="modal-title"><i class="fa-solid fa-triangle-exclamation icon"></i> Xác nhận xóa dịch vụ</h3>
            <button type="button" class="modal-close-btn" id="deleteServiceModalClose">×</button>
        </div>
        <div class="modal-body">
            <div id="deleteServiceInfo" class="modal-confirmation-info"></div>
        </div>
        <div class="modal-footer">
            <div class="modal-actions">
                <button type="button" class="button secondary" id="cancelDeleteService">Hủy</button>
                <button type="button" class="button danger" id="confirmDeleteService">Xác nhận</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Xác nhận Xóa Nhiều Dịch Vụ -->
<div id="deleteMultipleModalOverlay" class="modal-overlay">
    <div id="deleteMultipleModal" class="modal-container small-modal">
        <div class="modal-header">
            <h3 class="modal-title"><i class="fa-solid fa-triangle-exclamation icon"></i> Xác nhận xóa dịch vụ</h3>
            <button type="button" class="modal-close-btn" id="deleteMultipleModalClose">×</button>
        </div>
        <div class="modal-body">
            <div id="deleteMultipleInfo" class="modal-confirmation-info"></div>
        </div>
        <div class="modal-footer">
            <div class="modal-actions">
                <button type="button" class="button secondary" id="cancelDeleteMultiple">Hủy</button>
                <button type="button" class="button danger" id="confirmDeleteMultiple">Xác nhận</button>
            </div>
        </div>
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
    const serviceTableBody = document.getElementById('service-table-body');
    const selectAllCheckbox = document.getElementById('select-all-checkbox');
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

    function toggleSidebarMobile() { body.classList.toggle('sidebar-mobile-open'); const isOpen = body.classList.contains('sidebar-mobile-open'); if (mobileSidebarToggleBtn) mobileSidebarToggleBtn.setAttribute('aria-expanded', String(isOpen)); manageBodyScroll(); }
    function toggleSidebarDesktop() { body.classList.toggle('sidebar-collapsed'); const isCollapsed = body.classList.contains('sidebar-collapsed'); if (desktopSidebarToggleBtn) { desktopSidebarToggleBtn.title = isCollapsed ? "Phóng Sidebar" : "Thu Sidebar"; desktopSidebarToggleBtn.querySelector('i').style.transform = isCollapsed ? 'rotate(180deg)' : ''; } if (isCollapsed) { document.querySelectorAll('.menu-items .submenu.active').forEach(submenu => { submenu.classList.remove('active'); submenu.previousElementSibling?.classList.remove('active'); }); } }
    function toggleSubmenu(event) { event.preventDefault(); const parentLink = event.currentTarget; const submenuWrapper = parentLink.nextElementSibling; if (!submenuWrapper || !submenuWrapper.classList.contains('submenu')) return; if (!parentLink.classList.contains('active')) { document.querySelectorAll('.menu-items .submenu-parent.active').forEach(activeParent => { if (activeParent !== parentLink) { activeParent.classList.remove('active'); activeParent.nextElementSibling?.classList.remove('active'); } }); } submenuWrapper.classList.toggle('active'); parentLink.classList.toggle('active'); }
    function initializeActiveSubmenu() { const activeLink = document.querySelector('.sidebar .menu-items > li > a.active'); const activeSubmenuLink = document.querySelector('.sidebar .submenu a.active'); if (activeSubmenuLink) { const submenuDiv = activeSubmenuLink.closest('.submenu'); const parentLink = submenuDiv?.previousElementSibling; if (submenuDiv && parentLink && parentLink.classList.contains('submenu-parent')) { if (!activeLink || activeLink !== parentLink) { submenuDiv.classList.add('active'); parentLink.classList.add('active'); } } } }
    function updateDateTime() { const now = new Date(); const optionsDate = { weekday: 'short', day: '2-digit', month: '2-digit', year: 'numeric' }; const optionsTime = { hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: true }; try { let dayOfWeek; switch (now.getDay()) { case 0: dayOfWeek = "Sun"; break; case 1: dayOfWeek = "Mon"; break; case 2: dayOfWeek = "Tue"; break; case 3: dayOfWeek = "Wed"; break; case 4: dayOfWeek = "Thu"; break; case 5: dayOfWeek = "Fri"; break; case 6: dayOfWeek = "Sat"; break; default: dayOfWeek = ""; } const dateString = `${dayOfWeek} ${now.toLocaleDateString('en-GB', { day: '2-digit', month: '2-digit', year: 'numeric' })}`; if (currentDateSpan) currentDateSpan.textContent = dateString; if (currentTimeSpan) currentTimeSpan.textContent = now.toLocaleTimeString('en-US', optionsTime); } catch (e) { if (currentDateSpan) currentDateSpan.textContent = now.toLocaleDateString(); if (currentTimeSpan) currentTimeSpan.textContent = now.toLocaleTimeString(); } if (currentYearSpan) currentYearSpan.textContent = now.getFullYear(); }
    function toggleFullscreen() { if (!document.fullscreenElement) { document.documentElement.requestFullscreen().catch(err => console.error(`Fullscreen error: ${err.message}`)); } else if (document.exitFullscreen) { document.exitFullscreen(); } }
    function handleFullscreenChange() { const isFullscreen = !!document.fullscreenElement; const icon = fullscreenBtn?.querySelector('i'); if (icon) { icon.classList.toggle('fa-expand', !isFullscreen); icon.classList.toggle('fa-compress', isFullscreen); } if (fullscreenBtn) { fullscreenBtn.setAttribute('title', isFullscreen ? 'Exit Fullscreen' : 'Fullscreen'); } }

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

    // ================== DuyKha: Hàm chuẩn hóa tiếng Việt cho tìm kiếm ==================
    function normalizeVietnameseString(str) {
        if (!str) return '';
        str = str.toLowerCase();
        str = str.replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/g, "a");
        str = str.replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/g, "e");
        str = str.replace(/ì|í|ị|ỉ|ĩ/g, "i");
        str = str.replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/g, "o");
        str = str.replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/g, "u");
        str = str.replace(/ỳ|ý|ỵ|ỷ|ỹ/g, "y");
        str = str.replace(/đ/g, "d");
        str = str.replace(/[^a-z0-9\s]/g, '');
        str = str.replace(/\s+/g, ' ').trim();
        return str;
    }
    // ================== END DuyKha ==================

    // Helper functions for localStorage (Modified to handle full service objects) - KEEP THESE
    function getServiceData() {
        const data = localStorage.getItem('serviceData');
        return data ? JSON.parse(data) : [];
    }

    function saveServiceData(data) {
        localStorage.setItem('serviceData', JSON.stringify(data));
    }

    // --- Modal Functions (Moved to top of script) ---

    // Function to close the edit/add service modal
    function closeEditServiceModal() {
        const modalOverlay = document.getElementById('editServiceModalOverlay');
        const modal = document.getElementById('editServiceModal');
        modalOverlay.classList.remove('visible');
        modal._isAddMode = false;
        modal._editingIndex = null;
        modal.classList.remove('add-mode');
        modal.classList.remove('edit-mode');
        modal.classList.remove('modal-form-layout-2col'); // Remove layout class
        const maDVInput = document.getElementById('editMaDV'); // Get input here
        if (maDVInput) maDVInput.readOnly = false; // Reset readonly for maDV
        // Clear form fields if necessary (form submission already clears inputs, but good for consistency)
        const tenDVInput = document.getElementById('editTenDV');
        const ngayCapNhatInput = document.getElementById('editNgayCapNhat');
        const hienThiInput = document.getElementById('editHienThi');
        if (maDVInput) maDVInput.value = '';
        if (tenDVInput) tenDVInput.value = '';
        if (ngayCapNhatInput) ngayCapNhatInput.value = '';
        if (hienThiInput) hienThiInput.checked = true;
    };

    // Sửa dịch vụ
    let editingMaDV = null; // Use maDV to track the service being edited
    function openEditModalById(maDV) {
        editingMaDV = maDV; // Store the maDV
        const serviceData = getServiceData();
        const service = serviceData.find(s => s.maDV === maDV); // Find service by maDV

        if (!service) { // Check if service exists
            console.error('Service not found for editing:', maDV);
            return;
        }

        const modal = document.getElementById('editServiceModal');
        if (modal) modal.classList.add('show');

        const maDVInput = document.getElementById('editMaDV');
        const tenDVInput = document.getElementById('editTenDV');
        const ngayCapNhatInput = document.getElementById('editNgayCapNhat');
        const hienThiInput = document.getElementById('editHienThi');

        if (maDVInput) maDVInput.value = service.maDV;
        if (maDVInput) maDVInput.readOnly = true; // Mã dịch vụ không cho sửa
        if (tenDVInput) tenDVInput.value = service.tenDV;

        // Convert dd-mm-yyyy to yyyy-mm-dd for input type=date
        if (ngayCapNhatInput) {
            const [d, m, y] = service.ngayCapNhat.split('-');
            ngayCapNhatInput.value = `${y}-${m}-${d}`;
        }

        if (hienThiInput) hienThiInput.checked = service.hienThi;

        document.getElementById('editServiceModalOverlay').classList.add('visible');
        modal._isAddMode = false; // Explicitly set to edit mode
        modal.classList.remove('add-mode'); // Remove add-mode class
        modal.classList.add('edit-mode'); // Add edit-mode class for styling
        modal.classList.add('modal-form-layout-2col'); // Add layout class

        // Change modal title for Edit mode
        const modalTitle = modal.querySelector('h3');
        if (modalTitle) modalTitle.textContent = 'Sửa thông tin dịch vụ';

        setTimeout(() => { if (tenDVInput) tenDVInput.focus(); }, 100); // Focus on name input
    }

    // Xóa dịch vụ
    let deletingMaDV = null; // Use maDV to track the service being deleted
    function openDeleteModalById(maDV) {
        deletingMaDV = maDV;
        const serviceData = getServiceData();
        const service = serviceData.find(s => s.maDV === maDV);

        if (!service) { // Check if service exists
            console.error('Service not found for deletion:', maDV);
            return;
        }

        const modal = document.getElementById('deleteServiceModal');
        const info = document.getElementById('deleteServiceInfo');

        if (modal && info) {
            info.textContent = `Bạn có chắc muốn xóa dịch vụ: ${service.maDV} - ${service.tenDV} không?`;
            document.getElementById('deleteServiceModalOverlay').classList.add('visible');
        }
    }

    // Thêm dịch vụ mới opener
    function openAddServiceModal() {
        // Clear form for new entry
        const maDVInput = document.getElementById('editMaDV');
        const tenDVInput = document.getElementById('editTenDV');
        const ngayCapNhatInput = document.getElementById('editNgayCapNhat');
        const hienThiInput = document.getElementById('editHienThi');

        if (maDVInput) maDVInput.value = '';
        if (maDVInput) maDVInput.readOnly = false; // Ensure maDV is editable in add mode
        if (tenDVInput) tenDVInput.value = '';
        if (ngayCapNhatInput) ngayCapNhatInput.value = ''; // Optionally set default date
        if (hienThiInput) hienThiInput.checked = true; // Default to visible

        // Show the edit modal, marking it as add mode
        const modalOverlay = document.getElementById('editServiceModalOverlay');
        const modal = document.getElementById('editServiceModal');
        const modalTitle = modal ? modal.querySelector('h3') : null;

        if (modalOverlay) modalOverlay.classList.add('visible');
        if (modal) modal._isAddMode = true; // Use a flag on the modal object
        if (modal) modal._editingIndex = null; // Ensure no index is linked in add mode
        // Add add-mode class and layout class
        if (modal) modal.classList.add('add-mode');
        if (modal) modal.classList.remove('edit-mode'); // Remove edit-mode class
        if (modal) modal.classList.add('modal-form-layout-2col'); // Add layout class

        // Change modal title for Add mode
        if (modalTitle) modalTitle.textContent = 'Thêm dịch vụ mới';

        setTimeout(() => { if (maDVInput) maDVInput.focus(); }, 100);
    }

    // --- END Modal Functions ---

    // Define renderServiceTable function in a broader scope
    let filterServiceName = '';
    let filterServiceStatus = ''; // Use string 'true' or 'false'

    let itemsPerPage = 10;
    let currentPage = 1;

    function renderServiceTable(data, page = 1, itemsPerPage = 10) {
        const tbody = document.getElementById('service-table-body');
        const paginationInfoSpan = document.getElementById('pagination-info');
        const paginationButtonsDiv = document.querySelector('.pagination-buttons'); // Container div
        const paginationNavButtonsDiv = paginationButtonsDiv.querySelector('.pagination-nav-buttons'); // New div for nav buttons

        tbody.innerHTML = ''; // Clear existing table rows

        // Apply filters
        let filteredData = data.filter(service => {
            let nameMatch = true;
            let statusMatch = true;

            if (filterServiceName) {
                // DuyKha: Áp dụng chuẩn hóa tiếng Việt cho tìm kiếm tên dịch vụ
                nameMatch = normalizeVietnameseString(service.tenDV).includes(normalizeVietnameseString(filterServiceName));
            }

            if (filterServiceStatus !== '') {
                // Convert boolean hienThi to string 'true' or 'false' for comparison
                statusMatch = String(service.hienThi) === filterServiceStatus;
            }

            return nameMatch && statusMatch;
        });

        // Calculate pagination variables
        const totalItems = filteredData.length;
        const totalPages = Math.ceil(totalItems / itemsPerPage);
        const start = (page - 1) * itemsPerPage;
        const end = start + itemsPerPage;
        const itemsToShow = filteredData.slice(start, end);

        // Adjust current page if it's beyond the last page after filtering
        if (currentPage > totalPages && totalPages > 0) {
            currentPage = totalPages;
            renderServiceTable(data, currentPage, itemsPerPage);
            return;
        }
        if (totalPages === 0) {
            currentPage = 1; // Reset to page 1 if no items
        }

        itemsToShow.forEach((service, index) => {
            const tr = document.createElement('tr');
            // Use the index within the *current page* for STT
            const stt = start + index + 1; // Calculate actual STT based on start index

            // Main row for mobile (MaDV and TenDV visible)
            tr.innerHTML = `
                <td class="col-center"><input type="checkbox" class="rowCheckbox" title="Chọn dòng ${stt}"></td>
                <td class="col-center service-stt">${stt}</td>
                <td>${service.maDV}</td>
                <td>${service.tenDV}</td>
                <td class="service-ngay-cap-nhat">${service.ngayCapNhat}</td>
                <td class="col-center service-hien-thi"><input type="checkbox" ${service.hienThi ? 'checked' : ''} title="Hiển thị dịch vụ này"></td>
                <td class="col-center action-icons service-actions-col">
                    <button class="icon-button icon-edit" title="Sửa"><i class="fa-solid fa-pencil"></i></button>
                    <button class="icon-button icon-danger" title="Xóa"><i class="fa-solid fa-trash-can"></i></button>
                </td>`;

            // Detail row for mobile (initially hidden)
            const detailTr = document.createElement('tr');
            detailTr.classList.add('service-detail-row');
            detailTr.innerHTML = `
                 <td colspan="${tr.cells.length}">
                     <div class="detail-content">
                        <div class="detail-item"><strong>STT:</strong> ${stt}</div>
                        <div class="detail-item"><strong>Ngày cập nhật:</strong> ${service.ngayCapNhat}</div>
                        <div class="detail-item"><strong>Hiển thị:</strong> ${service.hienThi ? 'Có' : 'Không'}</div>
                         <div class="detail-item"><strong>Thao tác:</strong>
                             <button class="icon-button icon-edit" title="Sửa"><i class="fa-solid fa-pencil"></i></button>
                             <button class="icon-button icon-danger" title="Xóa"><i class="fa-solid fa-trash-can"></i></button>
                         </div>
                     </div>
                 </td>
             `;

            // Gắn lại sự kiện cho các nút trong cả hàng chính và hàng chi tiết
            // Events for main row icons (will be hidden on mobile by CSS)
            tr.querySelector('.icon-edit').onclick = () => openEditModalById(service.maDV); // Use maDV to find the service
            tr.querySelector('.icon-danger').onclick = () => openDeleteModalById(service.maDV); // Use maDV
            // Events for detail row icons
            detailTr.querySelector('.icon-edit').onclick = () => openEditModalById(service.maDV); // Use maDV
            detailTr.querySelector('.icon-danger').onclick = () => openDeleteModalById(service.maDV); // Use maDV

            // Add click listener to main row to toggle detail row
            tr.addEventListener('click', function () {
                // Only toggle detail row on smaller screens (e.g., max-width: 768px)
                if (window.innerWidth <= 768) {
                    // Close any currently open detail row (except the one being clicked)
                    document.querySelectorAll('.service-detail-row.open').forEach(openDetailRow => {
                        if (openDetailRow !== detailTr) {
                            openDetailRow.classList.remove('open');
                            openDetailRow.previousElementSibling.classList.remove('expanded'); // Remove expanded class from main row
                        }
                    });

                    // Toggle the clicked detail row and its main row
                    detailTr.classList.toggle('open');
                    tr.classList.toggle('expanded'); // Add expanded class to main row
                }
            });

            tbody.appendChild(tr);
            tbody.appendChild(detailTr); // Append detail row after main row
        });

        // Update pagination info count
        if (paginationInfoSpan) {
            if (totalItems === 0) {
                paginationInfoSpan.innerHTML = 'Không tìm thấy dịch vụ nào';
            } else {
                const displayedStart = totalItems > 0 ? start + 1 : 0;
                const displayedEnd = Math.min(start + itemsPerPage, totalItems);
                paginationInfoSpan.innerHTML = `Hiển thị <b>${displayedStart}</b> đến <b>${displayedEnd}</b> của <b>${totalItems}</b> mục`;
            }
        }

        // Render pagination buttons
        if (paginationNavButtonsDiv) {
            paginationNavButtonsDiv.innerHTML = ''; // Clear *only* the navigation buttons

            // "Trước" button
            const prevButton = document.createElement('button');
            prevButton.classList.add('button');
            if (currentPage === 1 || totalPages === 0) {
                prevButton.disabled = true;
            }
            prevButton.textContent = 'Trước';
            prevButton.addEventListener('click', () => {
                if (currentPage > 1) {
                    currentPage--;
                    renderServiceTable(getServiceData(), currentPage, itemsPerPage);
                }
            });
            paginationNavButtonsDiv.appendChild(prevButton); // Append to the new div

            // Page number buttons
            // Display up to 5 pages around the current page, or fewer if near the beginning/end
            let startPage = Math.max(1, currentPage - 2);
            let endPage = Math.min(totalPages, startPage + 4);

            // Adjust startPage if totalPages < 5 or endPage is limited
            if (endPage - startPage < 4) {
                startPage = Math.max(1, endPage - 4);
            }

            // Add ellipsis and first page button if needed
            if (startPage > 1) {
                const firstPageButton = document.createElement('button');
                firstPageButton.classList.add('button');
                firstPageButton.textContent = '1';
                firstPageButton.onclick = () => {
                    currentPage = 1;
                    renderServiceTable(getServiceData(), currentPage, itemsPerPage);
                };
                paginationNavButtonsDiv.appendChild(firstPageButton);
                if (startPage > 2) {
                    const ellipsis = document.createElement('span');
                    ellipsis.textContent = '...';
                    ellipsis.style.margin = '0 5px';
                    ellipsis.style.color = '#64748b';
                    paginationNavButtonsDiv.appendChild(ellipsis);
                }
            }

            for (let i = startPage; i <= endPage; i++) {
                if (i >= 1 && i <= totalPages) {
                    const pageButton = document.createElement('button');
                    pageButton.classList.add('button');
                    if (i === currentPage) {
                        pageButton.classList.add('active');
                        pageButton.setAttribute('aria-current', 'page');
                        // pageButton.disabled = true; // Disable the current page button (optional)
                    }
                    pageButton.textContent = i;
                    pageButton.addEventListener('click', () => {
                        currentPage = i;
                        renderServiceTable(getServiceData(), currentPage, itemsPerPage);
                    });
                    paginationNavButtonsDiv.appendChild(pageButton); // Append to the new div
                }
            }

            // Add ellipsis and last page button if needed
            if (endPage < totalPages) {
                if (endPage < totalPages - 1) {
                    const ellipsis = document.createElement('span');
                    ellipsis.textContent = '...';
                    ellipsis.style.margin = '0 5px';
                    ellipsis.style.color = '#64748b';
                    paginationNavButtonsDiv.appendChild(ellipsis);
                }
                const lastPageButton = document.createElement('button');
                lastPageButton.classList.add('button');
                lastPageButton.textContent = totalPages;
                lastPageButton.onclick = () => {
                    currentPage = totalPages;
                    renderServiceTable(getServiceData(), currentPage, itemsPerPage);
                };
                paginationNavButtonsDiv.appendChild(lastPageButton);
            }

            // "Sau" button
            const nextButton = document.createElement('button');
            nextButton.classList.add('button');
            if (currentPage === totalPages || totalItems === 0) {
                nextButton.disabled = true;
            }
            nextButton.textContent = 'Sau';
            nextButton.addEventListener('click', () => {
                if (currentPage < totalPages) {
                    currentPage++;
                    renderServiceTable(getServiceData(), currentPage, itemsPerPage);
                }
            });
            paginationNavButtonsDiv.appendChild(nextButton); // Append to the new div
        }

        // Uncheck the select all checkbox after re-rendering
        if (selectAllCheckbox) {
            selectAllCheckbox.checked = false;
        }
    }

    document.addEventListener('DOMContentLoaded', () => {
        initializeActiveSubmenu();
        updateDateTime();
        setInterval(updateDateTime, 1000);

        // --- Filter Logic --- (Adapted from customer-list.html)
        // Filter variables are now defined outside this block

        // Add event listeners for filter inputs and select
        document.getElementById('filterServiceName')?.addEventListener('input', function () {
            filterServiceName = this.value.trim();
            renderServiceTable(getServiceData()); // Re-render with current data and filters
        });

        document.getElementById('filterServiceStatus')?.addEventListener('change', function () {
            filterServiceStatus = this.value;
            renderServiceTable(getServiceData()); // Re-render with current data and filters
        });

        // --- End Filter Logic ---

        // --- Load service data on page load ---
        let serviceData = getServiceData();
        if (serviceData.length === 0) {
            // If no data in localStorage, load from initial HTML table
            const initialRows = document.querySelectorAll('#serviceTable tbody tr');
            initialRows.forEach(row => {
                const maDV = row.children[2].textContent.trim();
                const tenDV = row.children[3].textContent.trim();
                const ngayCapNhat = row.children[4].textContent.trim();
                // Get the checked status from the checkbox in the 6th column (index 5)
                const hienThi = row.children[5].querySelector('input[type="checkbox"]')?.checked || false;
                if (maDV) {
                    serviceData.push({
                        stt: serviceData.length + 1,
                        maDV: maDV,
                        tenDV: tenDV,
                        ngayCapNhat: ngayCapNhat,
                        hienThi: hienThi
                    });
                }
            });
            saveServiceData(serviceData); // Save initial data to localStorage
            console.log('Loaded initial data from HTML and saved:', serviceData);
        } else {
            console.log('Loaded data from localStorage:', serviceData);
        }

        // Render the table with the loaded data
        renderServiceTable(serviceData);

        if (mobileSidebarToggleBtn) mobileSidebarToggleBtn.addEventListener('click', function () {
            if (window.innerWidth > 768) {
                body.classList.toggle('sidebar-collapsed');
            } else {
                body.classList.toggle('sidebar-mobile-open');
            }
            const isOpen = body.classList.contains('sidebar-mobile-open') || !body.classList.contains('sidebar-collapsed');
            mobileSidebarToggleBtn.setAttribute('aria-expanded', String(isOpen));
        });
        if (sidebarOverlay) sidebarOverlay.addEventListener('click', toggleSidebarMobile);
        if (desktopSidebarToggleBtn) desktopSidebarToggleBtn.addEventListener('click', toggleSidebarDesktop);
        document.querySelectorAll('.menu-items .submenu-parent').forEach(link => link.addEventListener('click', toggleSubmenu));
        if (fullscreenBtn) fullscreenBtn.addEventListener('click', toggleFullscreen);
        document.addEventListener('fullscreenchange', handleFullscreenChange);

        if (notificationButton) {
            notificationButton.addEventListener('click', (event) => {
                event.stopPropagation();
                toggleNotificationDropdown();
            });
        }

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

    });

    // Handle delete confirmation for single row delete modal (Logic updated)
    document.getElementById('confirmDeleteService')?.addEventListener('click', function () {
        const modal = document.getElementById('deleteServiceModal');
        const deletingMaDV = deletingMaDV; // Use the global deletingMaDV variable
        if (deletingMaDV) {
            let serviceData = getServiceData();
            const indexToDelete = serviceData.findIndex(service => service.maDV === deletingMaDV);
            if (indexToDelete !== -1) {
                serviceData.splice(indexToDelete, 1); // Remove service by index
                saveServiceData(serviceData); // Save updated data
                renderServiceTable(getServiceData(), currentPage, itemsPerPage); // Re-render table with current filters and page
            }
        }
        document.getElementById('deleteServiceModalOverlay').classList.remove('visible');
        deletingMaDV = null; // Reset maDV
    });

    // Handle cancel for single row delete modal
    document.getElementById('cancelDeleteService')?.addEventListener('click', function () {
        document.getElementById('deleteServiceModalOverlay').classList.remove('visible');
        deletingMaDV = null; // Reset maDV
    });

    // Close modals when clicking outside the modal content (on the overlay)
    document.getElementById('editServiceModalOverlay')?.addEventListener('click', function (e) {
        if (e.target === this) { // Check if the click was directly on the overlay
            closeEditServiceModal();
        }
    });
    document.getElementById('deleteServiceModalOverlay')?.addEventListener('click', function (e) {
        if (e.target === this) { // Check if the click was directly on the overlay
            document.getElementById('deleteServiceModalOverlay').classList.remove('visible');
            deletingMaDV = null; // Reset maDV
        }
    });
    document.getElementById('deleteMultipleModalOverlay')?.addEventListener('click', function (e) {
        if (e.target === this) { // Check if the click was directly on the overlay
            document.getElementById('deleteMultipleModalOverlay').classList.remove('visible');
            // No need to reset deletingMaDV here, as it's handled by confirm/cancel
        }
    });

    // Close modals when clicking the close button
    document.getElementById('editServiceModal')?.querySelector('.modal-close-btn')?.addEventListener('click', function () {
        closeEditServiceModal();
    });
    document.getElementById('deleteServiceModal')?.querySelector('.modal-close-btn')?.addEventListener('click', function () {
        document.getElementById('deleteServiceModalOverlay').classList.remove('visible');
        deletingMaDV = null; // Reset maDV
    });
    document.getElementById('deleteMultipleModal')?.querySelector('.modal-close-btn')?.addEventListener('click', function () {
        document.getElementById('deleteMultipleModalOverlay').classList.remove('visible');
        // No need to reset deletingMaDV here
    });

    // Handle edit form submission (Logic updated)
    document.getElementById('editServiceForm').onsubmit = function (e) {
        e.preventDefault();
        const modal = document.getElementById('editServiceModal');

        const maDVInput = document.getElementById('editMaDV');
        const tenDVInput = document.getElementById('editTenDV');
        const ngayCapNhatInput = document.getElementById('editNgayCapNhat');
        const hienThiInput = document.getElementById('editHienThi');

        if (modal._isAddMode) {
            // Logic for adding a new service object
            let serviceData = getServiceData(); // Get current data
            const newMaDV = maDVInput.value.trim();
            const newTenDV = tenDVInput.value.trim();

            // Check if service code already exists
            if (serviceData.some(service => service.maDV === newMaDV)) {
                alert('Mã dịch vụ đã tồn tại. Vui lòng nhập mã khác.');
                maDVInput.focus();
                return; // Stop the submission
            }

            // Check if service name already exists
            if (serviceData.some(service => normalizeVietnameseString(service.tenDV) === normalizeVietnameseString(newTenDV))) {
                alert('Tên dịch vụ đã tồn tại. Vui lòng nhập tên khác.');
                tenDVInput.focus();
                return; // Stop the submission
            }

            const newService = {
                // STT will be handled by renderServiceTable
                maDV: newMaDV,
                tenDV: newTenDV,
                // Convert yyyy-mm-dd back to dd-mm-yyyy
                ngayCapNhat: ngayCapNhatInput.value.split('-').reverse().join('-'),
                hienThi: hienThiInput.checked
            };

            serviceData.unshift(newService); // Add new service to the beginning of the array
            saveServiceData(serviceData); // Save updated data
            renderServiceTable(getServiceData()); // Re-render table with current filters applied

            // Hide the modal after successful submission
            alert('Thêm dịch vụ thành công!'); // Success message for add

        } else { // This is the EDIT mode
            // Existing logic for updating an edited service object
            let serviceData = getServiceData();
            const editingIndex = editingMaDV;

            if (editingIndex !== undefined && editingIndex !== null) {
                let serviceToUpdate = serviceData[editingIndex];
                const updatedTenDV = tenDVInput.value.trim();

                // Check for duplicate name, excluding the current service being edited
                if (serviceData.some((service, idx) => idx !== editingIndex && normalizeVietnameseString(service.tenDV) === normalizeVietnameseString(updatedTenDV))) {
                    alert('Tên dịch vụ đã tồn tại. Vui lòng nhập tên khác.');
                    tenDVInput.focus();
                    return; // Stop the submission
                }

                // Update the service object
                serviceToUpdate.tenDV = updatedTenDV;
                const [y, m, d] = ngayCapNhatInput.value.split('-');
                serviceToUpdate.ngayCapNhat = [d, m, y].join('-');
                serviceToUpdate.hienThi = hienThiInput.checked;

                saveServiceData(serviceData); // Save updated data
                renderServiceTable(getServiceData()); // Re-render table with current filters applied

                // Hide the modal after successful submission
                console.log('Attempting to close modal after EDIT...'); // Debug log
                alert('Cập nhật thông tin dịch vụ thành công!'); // Success message for edit
            }
        }

        // Clear form and reset mode regardless of action
        maDVInput.value = '';
        tenDVInput.value = '';
        ngayCapNhatInput.value = '';
        hienThiInput.checked = true;
        modal._isAddMode = false;
        modal._editingIndex = null;
        // Also remove add-mode and edit-mode classes
        modal.classList.remove('add-mode');
        modal.classList.remove('edit-mode');
        modal.classList.remove('modal-form-layout-2col'); // Remove layout class
        maDVInput.readOnly = false; // Reset readonly for maDV
        // Close the modal
        closeEditServiceModal();
    };

    // Thêm dịch vụ mới (Logic updated to work with data array)
    (function () {
        const addBtn = document.getElementById('addServiceBtn');
        const modal = document.getElementById('editServiceModal'); // Use the existing edit modal
        const form = document.getElementById('editServiceForm'); // Use the existing edit form
        const maDVInput = document.getElementById('editMaDV');
        const tenDVInput = document.getElementById('editTenDV');
        const ngayCapNhatInput = document.getElementById('editNgayCapNhat');
        const hienThiInput = document.getElementById('editHienThi');

        if (addBtn) {
            addBtn.onclick = function () {
                // Clear form for new entry
                maDVInput.value = '';
                maDVInput.readOnly = false; // Ensure maDV is editable in add mode
                tenDVInput.value = '';
                ngayCapNhatInput.value = ''; // Optionally set default date
                hienThiInput.checked = true; // Default to visible

                // Show the edit modal, marking it as add mode
                document.getElementById('editServiceModalOverlay').classList.add('visible');
                modal._isAddMode = true; // Use a flag on the modal object
                modal._editingIndex = null; // Ensure no index is linked in add mode
                // Add add-mode class and layout class
                modal.classList.add('add-mode');
                modal.classList.remove('edit-mode'); // Remove edit-mode class
                modal.classList.add('modal-form-layout-2col'); // Add layout class

                // Change modal title for Add mode
                modal.querySelector('h3').textContent = 'Thêm dịch vụ mới';

                setTimeout(() => { maDVInput.focus(); }, 100);
            };
        }

        // Update the form submit handler to differentiate between add and edit (Combined logic)
        // This part is now outside the IIFE, combined with the general form submit handler above

        // Also update cancel button logic to clear mode/index and reset title
        const cancelEditServiceBtn = document.getElementById('cancelEditService');
        if (cancelEditServiceBtn) {
            cancelEditServiceBtn.onclick = closeEditServiceModal; // Use the new close function
        }

        // Update modal click outside logic to clear mode/index and reset title
        const editServiceModalElement = document.getElementById('editServiceModal');
        if (editServiceModalElement) {
            editServiceModalElement.onclick = function (e) {
                if (e.target === editServiceModalElement) {
                    closeEditServiceModal(); // Use the new close function
                }
            };
        }

    })(); // End of the add service opener logic

    // Trigger date picker on focus for the date input
    const ngayCapNhatInput = document.getElementById('editNgayCapNhat');
    if (ngayCapNhatInput) {
        ngayCapNhatInput.addEventListener('focus', function () {
            // Check if showPicker method is available (not all browsers support it yet)
            if (typeof this.showPicker === 'function') {
                this.showPicker();
            }
            // Fallback for browsers that don't support showPicker is the default behavior
        });
    }

    // Thêm xử lý cho nút xóa đã chọn (Logic updated to work with data array)
    document.querySelector('.service-actions .button.danger')?.addEventListener('click', function () {
        // Find selected rows and get their original data indexes based on maDV
        // const selectedCheckboxes = document.querySelectorAll('#serviceTable tbody tr input[type="checkbox"]');
        // Adjust selector to only target checkboxes in the first column
        const selectedCheckboxes = document.querySelectorAll('#serviceTable tbody tr td:first-child input[type="checkbox"]:checked');
        if (selectedCheckboxes.length === 0) {
            alert('Vui lòng chọn ít nhất một dịch vụ để xóa!');
            return;
        }

        const deleteMultipleModal = document.getElementById('deleteMultipleModal');
        const deleteMultipleInfo = document.getElementById('deleteMultipleInfo');

        // Collect the maDV of selected rows from the currently rendered table
        const selectedMaDVs = Array.from(selectedCheckboxes).map(checkbox => {
            const row = checkbox.closest('tr');
            return row ? row.cells[2].textContent.trim() : null; // Assuming maDV is in the 3rd cell
        }).filter(maDV => maDV !== null);

        // Get the full service data
        const serviceData = getServiceData();

        // Get the indexes in the original data array based on selected maDVs
        const indexesToDelete = selectedMaDVs.map(maDV => serviceData.findIndex(service => service.maDV === maDV)).filter(index => index !== -1);

        // Get details for the confirmation message
        const servicesToDeleteInfo = indexesToDelete.map(index => {
            const service = serviceData[index];
            return `${service.maDV} - ${service.tenDV}`;
        }).join('<br>');

        deleteMultipleInfo.innerHTML = `Bạn có chắc muốn xóa ${indexesToDelete.length} dịch vụ sau?<br><br>` + servicesToDeleteInfo;

        document.getElementById('deleteMultipleModalOverlay').classList.add('visible');

        // Store indexes to delete on the modal object
        deleteMultipleModal._indexesToDelete = indexesToDelete; // Store the index

        document.getElementById('cancelDeleteMultiple').onclick = function () {
            document.getElementById('deleteMultipleModalOverlay').classList.remove('visible');
            deleteMultipleModal._indexesToDelete = null; // Clear indexes
        };

        document.getElementById('confirmDeleteMultiple').onclick = function () {
            let serviceData = getServiceData();
            // Remove items from the end of the array first to avoid index issues
            // Sort indexes in descending order
            const sortedIndexes = deleteMultipleModal._indexesToDelete.sort((a, b) => b - a);

            sortedIndexes.forEach(index => {
                if (index >= 0 && index < serviceData.length) { // Basic bounds check
                    serviceData.splice(index, 1);
                }
            });

            saveServiceData(serviceData); // Save updated data
            renderServiceTable(getServiceData()); // Re-render table with current filters applied

            document.getElementById('deleteMultipleModalOverlay').classList.remove('visible');
            deleteMultipleModal._indexesToDelete = null; // Clear indexes

            // Uncheck the select all checkbox after deletion
            document.getElementById('select-all-checkbox').checked = false;
        };

        deleteMultipleModal.onclick = function (e) {
            if (e.target === deleteMultipleModal) {
                document.getElementById('deleteMultipleModalOverlay').classList.remove('visible');
                deleteMultipleModal._indexesToDelete = null; // Clear indexes
            } else if (e.target.classList.contains('modal-close-btn')) { // Also close if close button is clicked inside
                document.getElementById('deleteMultipleModalOverlay').classList.remove('visible');
                deleteMultipleModal._indexesToDelete = null; // Clear indexes
            }
        };
    });

    // Cập nhật checkbox "Chọn tất cả" (Keep existing, works with rendered checkboxes)
    document.getElementById('select-all-checkbox').addEventListener('change', function () {
        // Select only checkboxes in the first column of main rows
        const checkboxes = document.querySelectorAll('#serviceTable tbody tr:not(.service-detail-row) td:first-child input[type="checkbox"]');
        checkboxes.forEach(checkbox => {
            checkbox.checked = this.checked;
        });
    });

    // Helper functions for localStorage (Modified to handle full service objects) - KEEP THESE
    function getServiceData() {
        const data = localStorage.getItem('serviceData');
        return data ? JSON.parse(data) : [];
    }

    function saveServiceData(data) {
        localStorage.setItem('serviceData', JSON.stringify(data));
    }

    // Thêm các hàm quản lý đơn hàng - KEEP THESE
    function getPackageData() {
        const data = localStorage.getItem('packageData');
        return data ? JSON.parse(data) : [];
    }

    function savePackageData(data) {
        localStorage.setItem('packageData', JSON.stringify(data));
    }

    // Hàm tạo mã đơn hàng tự động - KEEP THESE
    function generatePackageCode() {
        const packages = getPackageData();
        const date = new Date();
        const year = date.getFullYear().toString().slice(-2);
        const month = (date.getMonth() + 1).toString().padStart(2, '0');
        const day = date.getDate().toString().padStart(2, '0');
        const count = (packages.length + 1).toString().padStart(4, '0');
        return `MTE-${year}${month}${day}-${count}`;
    }

    // Hàm thêm đơn hàng mới - KEEP THESE
    function addNewPackage(packageData) {
        const packages = getPackageData();
        const newPackage = {
            ...packageData,
            maDonHang: generatePackageCode(),
            ngayTao: new Date().toLocaleDateString('vi-VN'),
            trangThai: 'Chờ xử lý'
        };
        packages.unshift(newPackage);
        savePackageData(packages);
        return newPackage;
    }

    // Hàm cập nhật đơn hàng - KEEP THESE
    function updatePackage(maDonHang, newData) {
        const packages = getPackageData();
        const index = packages.findIndex(p => p.maDonHang === maDonHang);
        if (index !== -1) {
            packages[index] = { ...packages[index], ...newData };
            savePackageData(packages);
            return true;
        }
        return false;
    }

    // Hàm xóa đơn hàng - KEEP THESE
    function deletePackage(maDonHang) {
        const packages = getPackageData();
        const newPackages = packages.filter(p => p.maDonHang !== maDonHang);
        if (newPackages.length !== packages.length) {
            savePackageData(newPackages);
            return true;
        }
        return false;
    }


    document.addEventListener('DOMContentLoaded', () => {
        // Use event delegation on the table body for "Hiển thị" checkboxes
        document.getElementById('serviceTable').addEventListener('change', function (e) {
            const targetCheckbox = e.target;

            // Check if the changed element is a checkbox within the 'Hiển thị' column (6th td) in a main row
            if (targetCheckbox.type === 'checkbox' && targetCheckbox.closest('tr:not(.service-detail-row) td:nth-child(6)')) {
                const row = targetCheckbox.closest('tr');
                if (!row) return;

                const maDV = row.cells[2].textContent.trim(); // Get maDV from the 3rd cell
                const isChecked = targetCheckbox.checked;

                let serviceData = getServiceData();
                const serviceIndex = serviceData.findIndex(service => service.maDV === maDV);

                if (serviceIndex !== -1) {
                    // Update the hienThi property
                    serviceData[serviceIndex].hienThi = isChecked;
                    // Save the updated data to localStorage
                    saveServiceData(serviceData);
                    console.log(`Updated service ${maDV} hienThi to ${isChecked}`);

                    // Re-render the table with current filters and page to reflect changes
                    // This might be slightly jarring, but ensures consistency. A more complex
                    // update would modify the row directly without full re-render.
                    renderServiceTable(getServiceData(), currentPage, itemsPerPage);
                }
            }
        });
    });

    // DuyKha: Thêm event listener cho combobox chọn số dịch vụ/trang
    document.addEventListener('DOMContentLoaded', function () {
        const itemsPerPageSelect = document.getElementById('items-per-page-select');
        if (itemsPerPageSelect) {
            itemsPerPageSelect.value = itemsPerPage;
            itemsPerPageSelect.addEventListener('change', function () {
                itemsPerPage = parseInt(this.value);
                currentPage = 1;
                renderServiceTable(getServiceData(), currentPage, itemsPerPage);
            });
        }
    });
</script>

<script>
    // ================== DuyKha: Hàm updateHeaderBlur toàn cục ==================
    function updateHeaderBlur() {
        var header = document.querySelector('.header');
        var anyModalOpen = false;
        document.querySelectorAll('.modal').forEach(function (modal) {
            var style = window.getComputedStyle(modal);
            if (style.display === 'flex' || style.display === 'block') anyModalOpen = true;
        });
        if (document.querySelector('.announcement-overlay.visible')) anyModalOpen = true;
        // Add check for modals in service-management.html - DuyKha
        if (document.getElementById('editServiceModal')?.style.display === 'flex' ||
            document.getElementById('deleteServiceModal')?.style.display === 'flex' ||
            document.getElementById('deleteMultipleModal')?.style.display === 'flex') {
            anyModalOpen = true;
        }

        if (header) {
            if (anyModalOpen) {
                header.classList.add('blurred');
                if (!header.querySelector('.header-dark-overlay')) {
                    var overlay = document.createElement('div');
                    overlay.className = 'header-dark-overlay';
                    header.appendChild(overlay);
                }
            } else {
                header.classList.remove('blurred');
                var overlay = header.querySelector('.header-dark-overlay');
                if (overlay) overlay.remove();
            }
        }
    }
    // ================== END DuyKha ==================
</script>
@endpush
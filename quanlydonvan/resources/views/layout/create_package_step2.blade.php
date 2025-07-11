@extends('index')

@push('css')
<link rel="stylesheet" href="../css/create-package-step2.css">
<link rel="stylesheet" href="../css/package_manager.css">
<style>
    .upload-image-preview {
        width: 40%;
        height: 40%;
        object-fit: contain;
    }

    .file-preview {
        display: flex;
        justify-content: center;
        align-items: center;
        overflow: hidden;
    }
</style>
@endpush

@section('main_content')
<div class="content-wrapper">
    <section class="page-header">
        <div class="page-header-left">
            <h1 class="page-title">Tạo đơn hàng</h1>
            <nav class="breadcrumb" aria-label="breadcrumb"> <a href="#">Tạo đơn hàng</a> / <span>Tạo đơn hàng
                    bước 2</span> </nav>
        </div>
    </section>

    <!-- Progress Steps -->
    <div class="progress-steps">
        <div class="step completed">
            <div class="step-icon">
                <i class="fa-solid fa-file-pen"></i>
            </div>
            <div class="step-label">Tạo đơn hàng bước 1</div>
        </div>
        <div class="step active">
            <div class="step-icon">
                <i class="fa-solid fa-box"></i>
            </div>
            <div class="step-label">Tạo đơn hàng bước 2</div>
        </div>
        <div class="step">
            <div class="step-icon">
                <i class="fa-solid fa-circle-info"></i>
            </div>
            <div class="step-label">Chi tiết đơn hàng</div>
        </div>
    </div>

    <section class="content-area-step2">
        <form id="create-order-step2-form" novalidate>
            <div class="main-content-grid">
                <div class="summary-column">
                    <div class="summary-card-like">
                        <div class="summary-header-like">
                            <div class="summary-header-left">
                                <i class="fas fa-user icon"></i> Người gửi (SENDER)
                            </div>
                        </div>
                        <div class="summary-body-like">
                            <!-- Container for the 2x2 grid sections -->
                            <!-- Editable Sender Info -->
                            <div class="summary-grid-2col editable-sender-row">
                                <label class="summary-label">Người gửi:</label>
                                <div class="input-with-icon">
                                    <label for="sender-info-display" class="visually-hidden">Thông tin người
                                        gửi</label>
                                    <input type="text" id="sender-info-display" name="sender_info_display"
                                        value="" readonly>
                                    <i class="fas fa-pencil-alt edit-icon" title="Chỉnh sửa người gửi"></i>
                                </div>
                            </div>

                            <div class="summary-codes-container">
                                <div class="summary-grid-2col">
                                    <div class="summary-label">Mã đơn hàng:</div>
                                    <div class="summary-value">
                                        <div class="summary-value-box" id="summary-order-code"></div>
                                    </div>
                                    <div class="summary-label">REF Code:</div>
                                    <div class="summary-value">
                                        <div class="summary-value-box" id="summary-ref-code"></div>
                                    </div>
                                </div>
                            </div>

                            <hr class="summary-separator">

                            <!-- Container for the 2x2 grid sections -->
                            <div class="summary-sections-grid">
                                <!-- Section 1. Người gửi -->
                                <div class="summary-section-block">
                                    <div class="summary-section-title"><i class="fas fa-user icon"></i> 1. Người
                                        gửi</div>
                                    <div class="summary-grid-2col">
                                        <div class="summary-label">Tên công ty:</div>
                                        <div class="summary-value" id="summary-sender-company"></div>
                                        <div class="summary-label">Địa chỉ:</div>
                                        <div class="summary-value" id="summary-sender-address"></div>
                                        <div class="summary-label">Số điện thoại:</div>
                                        <div class="summary-value" id="summary-sender-phone"></div>
                                        <div class="summary-label">Thành phố:</div>
                                        <div class="summary-value" id="summary-sender-city-details"></div>
                                        <div class="summary-label">Quốc gia:</div>
                                        <div class="summary-value" id="summary-sender-country-zip"></div>
                                    </div>
                                </div>

                                <hr class="summary-separator">

                                <!-- Section 2. Người nhận -->
                                <div class="summary-section-block">
                                    <div class="summary-section-title"><i class="fas fa-box-open icon"></i> 2.
                                        Người nhận</div>
                                    <div class="summary-grid-2col">
                                        <div class="summary-label">Tên công ty:</div>
                                        <div class="summary-value" id="summary-receiver-company"></div>
                                        <div class="summary-label">Tên người nhận:</div>
                                        <div class="summary-value" id="summary-receiver-name"></div>
                                        <div class="summary-label">Địa chỉ:</div>
                                        <div class="summary-value" id="summary-receiver-address"></div>
                                        <div class="summary-label">Số điện thoại:</div>
                                        <div class="summary-value" id="summary-receiver-phones"></div>
                                        <div class="summary-label">Thành phố:</div>
                                        <div class="summary-value" id="summary-receiver-city-state"></div>
                                        <div class="summary-label">Quốc gia:</div>
                                        <div class="summary-value" id="summary-receiver-country-zip"></div>
                                    </div>
                                </div>

                                <hr class="summary-separator">

                                <!-- Section 3. Dịch vụ -->
                                <div class="summary-section-block">
                                    <div class="summary-section-title"><i class="fas fa-truck icon"></i> 3. Dịch
                                        vụ</div>
                                    <div class="summary-grid-2col">
                                        <div class="summary-label">Dịch vụ:</div>
                                        <div class="summary-value" id="summary-service-type"></div>
                                        <div class="summary-label">Chi nhánh:</div>
                                        <div class="summary-value" id="summary-branch"></div>
                                        <div class="summary-label">Dịch vụ kèm:</div>
                                        <div class="summary-value" id="summary-add-service"></div>
                                        <div class="summary-label">Loại bưu gửi:</div>
                                        <div class="summary-value" id="summary-package-type"></div>
                                        <div class="summary-label">Hình thức gửi hàng:</div>
                                        <div class="summary-value" id="summary-pickup-method"></div>
                                    </div>
                                </div>

                                <hr class="summary-separator">

                                <!-- Section 4. Yêu cầu -->
                                <div class="summary-section-block">
                                    <div class="summary-section-title"><i
                                            class="fas fa-exclamation-circle icon"></i> 4. Yêu cầu</div>
                                    <div class="summary-grid-2col">
                                        <div class="summary-label">Yêu cầu:</div>
                                        <div class="summary-value" id="summary-bill-status"></div>
                                        <div class="summary-label">Đại lý:</div>
                                        <div class="summary-value" id="summary-agent"></div>
                                        <div class="summary-label">OPS điều phối:</div>
                                        <div class="summary-value" id="summary-ops-coord"></div>
                                        <div class="summary-label">CS xử lý:</div>
                                        <div class="summary-value" id="summary-cs-handler"></div>
                                    </div>
                                </div>
                            </div> <!-- End of summary-sections-grid -->
                        </div>
                    </div>
                </div>

                <div class="data-column">
                    <section class="card form-section data-section">
                        <div class="card-header">
                            <h2 class="card-title"><i class="fa-solid fa-weight-hanging icon"></i> Thông tin
                                kiện hàng<span class="required">*</span></h2>
                            <span class="header-note">DIM: <label for="dim_factor" class="visually-hidden">DIM
                                    Factor</label><input type="number" id="dim_factor" value="5000"
                                    title="DIM Factor"></span>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="product_name">Tên sản phẩm:</label>
                                <input type="text" id="product_name" name="product_name" value="Hàng cá nhân">
                                <span class="error-message"></span>
                            </div>
                            <div class="form-group dimension-group">
                                <div class="dimension-labels">
                                    <span>Dài (cm)</span> <span>Rộng (cm)</span> <span>Cao (cm)</span>
                                    <span>Nặng (kg)</span>
                                    <span class="visually-hidden">Hành động</span>
                                </div>
                                <div id="dimension-rows">
                                    <div class="dimension-row">
                                        <label for="dim_length_1" class="visually-hidden">Dài kiện 1</label>
                                        <input type="number" step="any" id="dim_length_1" name="dim_length[]"
                                            value="12.51">
                                        <label for="dim_width_1" class="visually-hidden">Rộng kiện 1</label>
                                        <input type="number" step="any" id="dim_width_1" name="dim_width[]"
                                            value="30.51">
                                        <label for="dim_height_1" class="visually-hidden">Cao kiện 1</label>
                                        <input type="number" step="any" id="dim_height_1" name="dim_height[]"
                                            value="42">
                                        <label for="dim_weight_1" class="visually-hidden">Nặng kiện 1</label>
                                        <input type="number" step="any" id="dim_weight_1" name="dim_weight[]"
                                            value="13.21">
                                        <div class="dim-actions">
                                        </div>
                                    </div>
                                    <div class="dimension-row">
                                        <label for="dim_length_2" class="visually-hidden">Dài kiện 2</label>
                                        <input type="number" step="any" id="dim_length_2" name="dim_length[]"
                                            value="12">
                                        <label for="dim_width_2" class="visually-hidden">Rộng kiện 2</label>
                                        <input type="number" step="any" id="dim_width_2" name="dim_width[]"
                                            value="30.51">
                                        <label for="dim_height_2" class="visually-hidden">Cao kiện 2</label>
                                        <input type="number" step="any" id="dim_height_2" name="dim_height[]"
                                            value="23">
                                        <label for="dim_weight_2" class="visually-hidden">Nặng kiện 2</label>
                                        <input type="number" step="any" id="dim_weight_2" name="dim_weight[]"
                                            value="8.5">
                                        <div class="dim-actions">
                                            <button type="button" class="icon-button add-dim confirm small"
                                                title="Thêm kiện"><i class="fas fa-plus-circle"></i></button>
                                            <button type="button" class="icon-button remove-dim danger small"
                                                title="Xóa kiện"><i class="fas fa-times-circle"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="shipment_notes">Nội dung ghi chú:</label>
                                <textarea id="shipment_notes" name="shipment_notes"></textarea>
                                <span class="error-message"></span>
                            </div>
                            <div class="form-group">
                                <span class="form-label">Ảnh đính kèm:</span>
                                <div class="attachment-group">
                                    <input type="file" id="shipment_images" name="shipment_images[]" multiple
                                        accept="image/jpeg, image/png" class="visually-hidden">
                                    <div class="attachment-button-note">
                                        <button type="button" class="button warning small file-trigger-button"
                                            aria-controls="shipment_images"> <i class="fas fa-image"></i> Chọn
                                            ảnh </button>
                                        <span class="file-type-note">(.jpg/.png/.jpeg)</span>
                                    </div>
                                    <div class="checkbox-group"> <label><input type="checkbox" name="is_fragile"
                                                value="1" checked> Hàng dễ vỡ</label> </div>
                                </div>
                                <div class="selected-files-container" id="selected_files_list"> <span
                                        class="no-files-selected"><i>Chưa chọn file nào.</i></span> </div>
                                <span class="error-message"></span>
                            </div>
                            <div class="form-group">
                                <label for="image_link">Link ảnh kiện:</label>
                                <input type="text" id="image_link" name="image_link"
                                    value="https://drive.google.com/file/d/1mhqWcodHc3gPu40IrEp3cg8Mh7yYG9QY/view">
                                <span class="error-message"></span>
                            </div>
                        </div>
                    </section>

                    <section class="card form-section data-section">
                        <div class="card-header">
                            <h2 class="card-title"><i class="fa-solid fa-clipboard-list icon"></i> Chi tiết hàng
                                hóa</h2>
                            <div class="header-action">
                                <label for="package_select" class="visually-hidden">Chọn kiện</label>
                                <select id="package_select" name="package_select">
                                    <option value="1" selected>Kiện 01</option>
                                    <option value="2">Kiện 02</option>
                                </select>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive-wrapper">
                                <table class="shipment-details-table data-table"
                                    aria-describedby="shipment-details-legend">
                                    <caption id="shipment-details-legend" class="visually-hidden">Bảng chi tiết
                                        hàng hóa trong kiện</caption>
                                    <colgroup>
                                        <col class="col-action">
                                        <col class="col-name">
                                        <col class="col-qty">
                                        <col class="col-unit">
                                        <col class="col-price">
                                        <col class="col-total">
                                    </colgroup>
                                    <thead>
                                        <tr>
                                            <th><span class="visually-hidden">Hành động</span></th>
                                            <th>Tên hàng hóa</th>
                                            <th>SL</th>
                                            <th>Loại</th>
                                            <th>Đơn giá (USD)</th>
                                            <th>Tổng</th>
                                        </tr>
                                    </thead>
                                    <tbody id="shipment-items-tbody">
                                        <tr>
                                            <td><button type="button"
                                                    class="icon-button remove-item danger small"
                                                    title="Xóa dòng 1"><i class="fas fa-trash-alt"></i></button>
                                            </td>
                                            <td><label for="item_name_1" class="visually-hidden">Tên hàng hóa
                                                    dòng 1</label><textarea id="item_name_1" name="item_name[]"
                                                    rows="1">wooden Buddha Statue</textarea></td>
                                            <td><label for="item_quantity_1" class="visually-hidden">Số lượng
                                                    dòng 1</label><input type="number" id="item_quantity_1"
                                                    name="item_quantity[]" value="10" min="1"></td>
                                            <td><label for="item_unit_1" class="visually-hidden">Loại dòng
                                                    1</label><select id="item_unit_1" name="item_unit[]">
                                                    <option value="PCE" selected>PCE</option>
                                                    <option value="PCS">PCS</option>
                                                    <option value="PKG">PKG</option>
                                                    <option value="Rolls">Rolls</option>
                                                </select> </td>
                                            <td><label for="item_price_1" class="visually-hidden">Đơn giá dòng
                                                    1</label><input type="number" step="any" id="item_price_1"
                                                    name="item_price[]" value="5000"></td>
                                            <td><label for="item_total_1" class="visually-hidden">Tổng giá dòng
                                                    1</label><input type="number" step="any" id="item_total_1"
                                                    name="item_total[]" value="50000" readonly></td>
                                        </tr>
                                        <tr>
                                            <td><button type="button"
                                                    class="icon-button remove-item danger small"
                                                    title="Xóa dòng 2"><i class="fas fa-trash-alt"></i></button>
                                            </td>
                                            <td><label for="item_name_2" class="visually-hidden">Tên hàng hóa
                                                    dòng 2</label><textarea id="item_name_2" name="item_name[]"
                                                    rows="1">Dried shrimp</textarea></td>
                                            <td><label for="item_quantity_2" class="visually-hidden">Số lượng
                                                    dòng 2</label><input type="number" id="item_quantity_2"
                                                    name="item_quantity[]" value="20" min="1"></td>
                                            <td><label for="item_unit_2" class="visually-hidden">Loại dòng
                                                    2</label><select id="item_unit_2" name="item_unit[]">
                                                    <option value="PCE">PCE</option>
                                                    <option value="PCS" selected>PCS</option>
                                                    <option value="PKG">PKG</option>
                                                    <option value="Rolls">Rolls</option>
                                                </select> </td>
                                            <td><label for="item_price_2" class="visually-hidden">Đơn giá dòng
                                                    2</label><input type="number" step="any" id="item_price_2"
                                                    name="item_price[]" value="10"></td>
                                            <td><label for="item_total_2" class="visually-hidden">Tổng giá dòng
                                                    2</label><input type="number" step="any" id="item_total_2"
                                                    name="item_total[]" value="200" readonly></td>
                                        </tr>
                                        <tr>
                                            <td><button type="button"
                                                    class="icon-button remove-item danger small"
                                                    title="Xóa dòng 3"><i class="fas fa-trash-alt"></i></button>
                                            </td>
                                            <td><label for="item_name_3" class="visually-hidden">Tên hàng hóa
                                                    dòng 3</label><textarea id="item_name_3" name="item_name[]"
                                                    rows="1">Khô heo từ nhà SatraFood ngon hết xẩy</textarea>
                                            </td>
                                            <td><label for="item_quantity_3" class="visually-hidden">Số lượng
                                                    dòng 3</label><input type="number" id="item_quantity_3"
                                                    name="item_quantity[]" value="5" min="1"></td>
                                            <td><label for="item_unit_3" class="visually-hidden">Loại dòng
                                                    3</label><select id="item_unit_3" name="item_unit[]">
                                                    <option value="PCE">PCE</option>
                                                    <option value="PCS">PCS</option>
                                                    <option value="PKG" selected>PKG</option>
                                                    <option value="Rolls">Rolls</option>
                                                </select> </td>
                                            <td><label for="item_price_3" class="visually-hidden">Đơn giá dòng
                                                    3</label><input type="number" step="any" id="item_price_3"
                                                    name="item_price[]" value="3"></td>
                                            <td><label for="item_total_3" class="visually-hidden">Tổng giá dòng
                                                    3</label><input type="number" step="any" id="item_total_3"
                                                    name="item_total[]" value="15" readonly></td>
                                        </tr>
                                        <tr>
                                            <td><button type="button"
                                                    class="icon-button remove-item danger small"
                                                    title="Xóa dòng 4"><i class="fas fa-trash-alt"></i></button>
                                            </td>
                                            <td><label for="item_name_4" class="visually-hidden">Tên hàng hóa
                                                    dòng 4</label><textarea id="item_name_4" name="item_name[]"
                                                    rows="3">Cuộn nhãn sea food - Seafood sticker roll Manufacturer: 533/6 National Highway 1A, Quarter 1, An Phu Dong Ward, District 12, Ho Chi Minh City</textarea>
                                            </td>
                                            <td><label for="item_quantity_4" class="visually-hidden">Số lượng
                                                    dòng 4</label><input type="number" id="item_quantity_4"
                                                    name="item_quantity[]" value="6" min="1"></td>
                                            <td><label for="item_unit_4" class="visually-hidden">Loại dòng
                                                    4</label><select id="item_unit_4" name="item_unit[]">
                                                    <option value="PCE">PCE</option>
                                                    <option value="PCS">PCS</option>
                                                    <option value="PKG">PKG</option>
                                                    <option value="Rolls" selected>Rolls</option>
                                                </select> </td>
                                            <td><label for="item_price_4" class="visually-hidden">Đơn giá dòng
                                                    4</label><input type="number" step="any" id="item_price_4"
                                                    name="item_price[]" value="10"></td>
                                            <td><label for="item_total_4" class="visually-hidden">Tổng giá dòng
                                                    4</label><input type="number" step="any" id="item_total_4"
                                                    name="item_total[]" value="60" readonly></td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="5"><strong>Tổng trị giá đơn hàng:</strong></td>
                                            <td><strong id="total-order-value">5275</strong> VNĐ</td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <button type="button" class="button secondary small add-item-button"
                                onclick="addItemRow(event)"> <i class="fas fa-plus"></i> Thêm dòng </button>
                        </div>
                    </section>
                </div>
            </div>

            <footer class="form-actions content-actions">
                <div class="confirmation-check terms-agreement">
                    <input type="checkbox" id="confirm_info" name="confirm_info" required>
                    <label for="confirm_info">Vui lòng kiểm tra và điền <strong>đầy đủ</strong> các thông
                        tin</label>
                    <span class="error-message"></span>
                </div>
                <div class="action-buttons">
                    <button type="button" class="button secondary"
                        onclick="window.location.href='/create_package';"> <i
                            class="fa-solid fa-arrow-left"></i> Quay lại </button>
                    <button type="reset" class="button warning" form="create-order-step2-form"> <i
                            class="fa-solid fa-arrows-rotate"></i> Làm mới </button>
                    <button type="button" class="button confirm" onclick="handleViewDetails(event)"> <i
                            class="fa-solid fa-eye"></i> Xem chi tiết</button>
                </div>
            </footer>
        </form>
    </section>

    <footer class="site-footer">
        Minh Khôi Logistics © <span id="current-year"></span>. All rights reserved. Design by Nina Co.,Ltd
    </footer>

</div>
@endsection

@push('script')
<script>
    const body = document.body;
    const sidebar = document.getElementById('sidebar');
    const sidebarOverlay = document.getElementById('sidebar-overlay');
    const mobileSidebarToggleBtn = document.getElementById('mobile-sidebar-toggle');
    const currentDateSpan = document.getElementById('current-date');
    const currentTimeSpan = document.getElementById('current-time');
    const currentYearSpan = document.getElementById('current-year');
    const fullscreenBtn = document.getElementById('fullscreen-btn');

    // Biến mới để lưu trữ Data URL của ảnh đầu tiên được chọn
    let selectedImageDataUrl = '';

    const manageBodyScroll = () => {
        const isSidebarOpen = body.classList.contains('sidebar-mobile-open');
        const isAnyModalVisible = document.querySelector('.modal-overlay.active, .announcement-overlay.visible');
        body.classList.toggle('overflow-hidden', isSidebarOpen || isAnyModalVisible);
    };

    function toggleSidebarMobileOrDesktop() {
        if (window.innerWidth > 768) {
            body.classList.toggle('sidebar-collapsed');
            const isCollapsed = body.classList.contains('sidebar-collapsed');
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
        } else {
            body.classList.toggle('sidebar-mobile-open');
        }
        const isOpen = body.classList.contains('sidebar-mobile-open') || !body.classList.contains('sidebar-collapsed');
        if (mobileSidebarToggleBtn) mobileSidebarToggleBtn.setAttribute('aria-expanded', String(isOpen));
        manageBodyScroll();
    }

    function toggleSubmenu(event) {
        event.preventDefault();
        if (body.classList.contains('sidebar-collapsed') && window.innerWidth > 768) return;
        const parentLink = event.currentTarget;
        const submenuWrapper = parentLink.nextElementSibling;
        const arrow = parentLink.querySelector('.submenu-arrow');

        if (!submenuWrapper || !submenuWrapper.classList.contains('submenu')) return;
        const isActive = submenuWrapper.classList.contains('active');

        document.querySelectorAll('.menu-items .submenu-parent.active').forEach(activeParent => {
            if (activeParent !== parentLink) {
                activeParent.classList.remove('active');
                activeParent.nextElementSibling?.classList.remove('active');
                activeParent.querySelector('.submenu-arrow')?.style.setProperty('transform', 'rotate(0deg)');
            }
        });

        submenuWrapper.classList.toggle('active', !isActive);
        parentLink.classList.toggle('active', !isActive);
        if (arrow) arrow.style.setProperty('transform', !isActive ? 'rotate(180deg)' : 'rotate(0deg)');
    }

    function initializeActiveSubmenu() {
        document.querySelectorAll('.menu-items .submenu-parent').forEach(parentLink => {
            const submenuDiv = parentLink.nextElementSibling;
            const arrow = parentLink.querySelector('.submenu-arrow');
            if (submenuDiv?.classList.contains('submenu')) {
                const hasActiveChild = submenuDiv.querySelector('a.active');
                const shouldBeActive = hasActiveChild && (!body.classList.contains('sidebar-collapsed') || window.innerWidth <= 768);

                submenuDiv.classList.toggle('active', shouldBeActive);
                parentLink.classList.toggle('active', shouldBeActive);
                if (arrow) arrow.style.setProperty('transform', shouldBeActive ? 'rotate(180deg)' : 'rotate(0deg)');
            }
        });
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
        if (sidebarOverlay) sidebarOverlay.addEventListener('click', toggleSidebarMobileOrDesktop);
        document.querySelectorAll('.menu-items .submenu-parent').forEach(link => link.addEventListener('click', toggleSubmenu));
        if (fullscreenBtn) fullscreenBtn.addEventListener('click', toggleFullscreen);
        document.addEventListener('fullscreenchange', handleFullscreenChange);

        const form = document.getElementById('create-order-step2-form');
        const itemTableBody = document.getElementById('shipment-items-tbody');
        const dimensionRowsContainer = document.getElementById('dimension-rows');
        const submitButton = document.querySelector('button.button.confirm[form="create-order-step2-form"]');
        const selectImagesBtn = document.querySelector('.file-trigger-button');
        const fileInput = document.getElementById('shipment_images');
        const fileListDisplay = document.getElementById('selected_files_list');

        if (submitButton && form) { submitButton.addEventListener('click', handleFormSubmit); }
        if (itemTableBody) { itemTableBody.addEventListener('input', handleTableInput); itemTableBody.addEventListener('click', handleTableClick); }
        if (dimensionRowsContainer) { dimensionRowsContainer.addEventListener('click', handleDimensionClick); }
        if (selectImagesBtn && fileInput) { selectImagesBtn.addEventListener('click', (e) => { e.preventDefault(); fileInput.click(); }); } // Prevent default form submission
        if (fileInput && fileListDisplay) { fileInput.addEventListener('change', handleFileSelection); }
        if (fileListDisplay) { fileListDisplay.addEventListener('click', handleRemoveFile); }

        updateTotalOrderValue();
        calculateAllItemTotals();
        ensureAddButtonOnLastRow();
        updateTotalOrderValue(); // Ensure total is updated on load
    });

    function handleFormSubmit(event) {
        const form = document.getElementById('create-order-step2-form');
        const confirmCheckbox = document.getElementById('confirm_info');
        let isValid = true;

        form.querySelectorAll('.error').forEach(el => el.classList.remove('error'));
        form.querySelectorAll('.error-message').forEach(el => el.remove());
        form.querySelectorAll('label[style*="color"], .form-label[style*="color"]').forEach(lbl => lbl.style.color = '');

        if (!form.checkValidity()) {
            const firstInvalid = form.querySelector(':invalid');
            if (firstInvalid) {
                firstInvalid.classList.add('error');
                addErrorMessage(firstInvalid.closest('.form-group') || firstInvalid.parentElement, firstInvalid.validationMessage || 'Trường này là bắt buộc.');
                firstInvalid.focus();
            }
            isValid = false;
        }

        const confirmContainer = confirmCheckbox.closest('.confirmation-check');
        if (!confirmCheckbox.checked) {
            alert('Vui lòng xác nhận đã kiểm tra và điền đầy đủ thông tin.');
            confirmCheckbox.focus();
            if (confirmContainer) confirmContainer.querySelector('label').style.color = 'var(--danger-color)';
            addErrorMessage(confirmContainer, 'Vui lòng xác nhận.');
            isValid = false;
        } else {
            if (confirmContainer) confirmContainer.querySelector('label').style.color = '';
            removeErrorMessage(confirmContainer);
        }

        if (!isValid) {
            event.preventDefault();
            return false;
        }

        // Lưu dữ liệu bước 2 vào localStorage trước khi chuyển trang
        saveStep2ToLocalStorage();

        const formData = new FormData(form);
        const fileInput = document.getElementById('shipment_images');
        const displayedFileNames = Array.from(document.querySelectorAll('#selected_files_list li span:first-child')).map(span => span.textContent);
        const filesToAppend = Array.from(fileInput.files).filter(file => displayedFileNames.includes(file.name));
        formData.delete(fileInput.name);
        filesToAppend.forEach(file => { formData.append(fileInput.name, file); });

        console.log('Form data to be submitted:');
        for (let [key, value] of formData.entries()) {
            if (value instanceof File) { console.log(`${key}:`, value.name, `(size: ${value.size} bytes)`); }
            else { console.log(`${key}:`, value); }
        }

        event.preventDefault();
        alert('Đơn hàng đã được xác nhận và xem chi tiết (demo)!');
    }

    function handleTableInput(e) {
        if (e.target.matches('input[name="item_quantity[]"], input[name="item_price[]"]')) {
            calculateItemTotal(e.target.closest('tr'));
            updateTotalOrderValue();
        }
    }

    function handleTableClick(e) {
        if (e.target.closest('.remove-item')) {
            e.target.closest('tr').remove();
            updateTotalOrderValue();
        }
    }

    function handleDimensionClick(e) {
        const addButton = e.target.closest('.add-dim');
        const removeButton = e.target.closest('.remove-dim');

        if (addButton) { addDimensionRow(); }
        else if (removeButton) {
            const rows = document.querySelectorAll('#dimension-rows .dimension-row');
            if (rows.length > 1) { removeButton.closest('.dimension-row').remove(); }
            else { alert("Phải có ít nhất một kiện hàng."); }
            ensureAddButtonOnLastRow();
        }
    }

    function handleFileSelection(event) {
        const fileListDisplay = document.getElementById('selected_files_list');
        const files = event.target.files;

        // Reset Data URL khi chọn file mới
        selectedImageDataUrl = '';

        fileListDisplay.innerHTML = ''; // Clear existing previews/list
        const list = document.createElement('ul');
        list.className = 'file-list';

        if (files.length > 0) {
            Array.from(files).forEach((file, index) => {
                const listItem = document.createElement('li');
                listItem.className = 'file-item'; // Add a class for styling

                const filePreviewContainer = document.createElement('div');
                filePreviewContainer.className = 'file-preview';
                // Add a loading indicator immediately
                filePreviewContainer.innerHTML = '<i class="fas fa-spinner fa-spin"></i>'; // Loading spinner

                const fileNameSpan = document.createElement('span');
                fileNameSpan.className = 'file-name-text'; // Add class for styling
                fileNameSpan.textContent = file.name;

                const removeBtnSpan = document.createElement('span');
                removeBtnSpan.className = 'file-remove-button-container';
                removeBtnSpan.innerHTML = `<button type="button" class="icon-button remove-file-btn danger small" title="Xóa ${file.name}" data-file-name="${file.name}" data-file-index="${index}"><i class="fas fa-times"></i></button>`;

                // Append parts to the list item immediately
                listItem.appendChild(filePreviewContainer);
                listItem.appendChild(fileNameSpan);
                listItem.appendChild(removeBtnSpan);

                list.appendChild(listItem); // Append the completed list item to the ul

                const reader = new FileReader();

                reader.onload = (e) => {
                    // Clear loading indicator
                    filePreviewContainer.innerHTML = '';

                    // Check if it's an image file to create preview
                    if (file.type.startsWith('image/')) {
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.alt = file.name;
                        img.className = 'upload-image-preview'; // Add a class for styling
                        filePreviewContainer.appendChild(img);

                        // Lưu Data URL của ảnh đầu tiên được chọn
                        if (index === 0) {
                            selectedImageDataUrl = e.target.result;
                            console.log('Selected image Data URL stored.', selectedImageDataUrl.substring(0, 50) + '...'); // Log a part of the URL
                        }

                    } else {
                        // If not an image, add a generic file icon
                        const fileIcon = document.createElement('div');
                        fileIcon.className = 'file-icon';
                        fileIcon.innerHTML = '<i class="fas fa-file"></i>'; // Generic file icon
                        filePreviewContainer.appendChild(fileIcon);
                    }
                };

                reader.onerror = () => {
                    console.error('Error reading file:', file.name);
                    // Clear loading indicator and add error indicator
                    filePreviewContainer.innerHTML = '<span style="color: var(--danger-color);">Lỗi</span>';
                    // Optionally display an error message next to the file name
                    const errorText = document.createElement('span');
                    errorText.textContent = ' (Lỗi đọc file)';
                    errorText.style.color = 'var(--danger-color)';
                    fileNameSpan.appendChild(errorText);
                };

                // Start reading the file. The onload/onerror callbacks will fire when done.
                if (file) { // Check if file is valid
                    reader.readAsDataURL(file);
                }
            });

            // Append the list to the display area ONCE after setting up readers
            // Note: The actual image loading is asynchronous, so previews might appear with a slight delay
            fileListDisplay.appendChild(list);

        } else {
            fileListDisplay.innerHTML = '<span class="no-files-selected"><i>Chưa chọn file nào.</i></span>';
            selectedImageDataUrl = ''; // Clear Data URL if no files are selected
            console.log('No files selected. selectedImageDataUrl cleared.');
        }
    }

    function handleRemoveFile(event) {
        const removeButton = event.target.closest('.remove-file-btn');
        if (removeButton) {
            const fileNameToRemove = removeButton.dataset.fileName;
            const listItem = removeButton.closest('li');
            listItem.remove();

            const fileListDisplay = document.getElementById('selected_files_list');
            const remainingItems = fileListDisplay.querySelectorAll('li');
            if (remainingItems.length === 0) {
                fileListDisplay.innerHTML = '<span class="no-files-selected"><i>Chưa chọn file nào.</i></span>';
                document.getElementById('shipment_images').value = '';
                selectedImageDataUrl = ''; // Clear Data URL if all files are removed
                console.log('All files removed. selectedImageDataUrl cleared.');
            } else {
                // Nếu ảnh đầu tiên bị xóa, cập nhật selectedImageDataUrl với ảnh đầu tiên mới
                const firstRemainingFileItem = fileListDisplay.querySelector('.file-item');
                const firstRemainingImage = firstRemainingFileItem?.querySelector('img.upload-image-preview');
                if (firstRemainingImage) {
                    selectedImageDataUrl = firstRemainingImage.src;
                    console.log('First image removed. Updated selectedImageDataUrl.', selectedImageDataUrl.substring(0, 50) + '...');
                } else {
                    selectedImageDataUrl = ''; // Nếu không còn ảnh nào là ảnh preview
                    console.log('First image removed and no other images remain. selectedImageDataUrl cleared.');
                }
            }
        }
    }

    function calculateItemTotal(row) {
        if (!row) return;
        const quantityInput = row.querySelector('input[name="item_quantity[]"]');
        const priceInput = row.querySelector('input[name="item_price[]"]');
        const totalInput = row.querySelector('input[name="item_total[]"]');
        const quantity = parseFloat(quantityInput?.value) || 0;
        const price = parseFloat(priceInput?.value) || 0;
        if (totalInput) totalInput.value = (quantity * price).toFixed(0);
    }

    function calculateAllItemTotals() {
        const rows = document.querySelectorAll('#shipment-items-tbody tr');
        rows.forEach(row => calculateItemTotal(row));
    }

    function updateTotalOrderValue() {
        let grandTotal = 0;
        const totalInputs = document.querySelectorAll('#shipment-items-tbody input[name="item_total[]"]');
        totalInputs.forEach(input => { grandTotal += parseFloat(input.value) || 0; });
        const totalValueDisplay = document.getElementById('total-order-value');
        // Manually format number with dot as thousands separator
        if (totalValueDisplay) {
            // Convert to string, remove any existing formatting, parse as integer
            let numberString = String(Math.round(grandTotal)); // Round to nearest whole number
            // Add dots every three digits from the right
            let formattedString = '';
            for (let i = numberString.length - 1; i >= 0; i--) {
                formattedString = numberString[i] + formattedString;
                if (i > 0 && (numberString.length - i) % 3 === 0) {
                    formattedString = '.' + formattedString;
                }
            }
            totalValueDisplay.textContent = formattedString;
        }
    }

    function addDimensionRow() {
        const container = document.getElementById('dimension-rows');
        if (!container) return;
        const newIndex = Date.now();
        const newRowHTML = `
           <div class="dimension-row">
               <label for="dim_length_${newIndex}" class="visually-hidden">Dài kiện ${newIndex}</label> <input type="number" step="any" id="dim_length_${newIndex}" name="dim_length[]" placeholder="Dài">
               <label for="dim_width_${newIndex}" class="visually-hidden">Rộng kiện ${newIndex}</label> <input type="number" step="any" id="dim_width_${newIndex}" name="dim_width[]" placeholder="Rộng">
               <label for="dim_height_${newIndex}" class="visually-hidden">Cao kiện ${newIndex}</label> <input type="number" step="any" id="dim_height_${newIndex}" name="dim_height[]" placeholder="Cao">
               <label for="dim_weight_${newIndex}" class="visually-hidden">Nặng kiện ${newIndex}</label> <input type="number" step="any" id="dim_weight_${newIndex}" name="dim_weight[]" placeholder="Nặng">
               <div class="dim-actions"></div>
           </div>`;
        container.insertAdjacentHTML('beforeend', newRowHTML);
        ensureAddButtonOnLastRow();
    }

    function ensureAddButtonOnLastRow() {
        const container = document.getElementById('dimension-rows');
        if (!container) return;
        const rows = container.querySelectorAll('.dimension-row');
        rows.forEach((row, index) => {
            const actionsDiv = row.querySelector('.dim-actions');
            if (!actionsDiv) return;
            actionsDiv.innerHTML = '';
            if (rows.length > 1) {
                actionsDiv.innerHTML += `<button type="button" class="icon-button remove-dim danger small" title="Xóa kiện"><i class="fas fa-times-circle"></i></button>`;
            }
            if (index === rows.length - 1) {
                actionsDiv.innerHTML += `<button type="button" class="icon-button add-dim confirm small" title="Thêm kiện"><i class="fas fa-plus-circle"></i></button>`;
            }
        });
    }

    function addItemRow(event) {
        if (event) event.preventDefault();
        const tbody = document.getElementById('shipment-items-tbody');
        if (!tbody) return;
        const newIndex = Date.now();
        const newRowHTML = `
           <tr>
               <td><button type="button" class="icon-button remove-item danger small" title="Xóa dòng"><i class="fas fa-trash-alt"></i></button></td>
               <td><label for="item_name_${newIndex}" class="visually-hidden">Tên hàng hóa dòng ${newIndex}</label><textarea id="item_name_${newIndex}" name="item_name[]" rows="1"></textarea></td>
               <td><label for="item_quantity_${newIndex}" class="visually-hidden">Số lượng dòng ${newIndex}</label><input type="number" id="item_quantity_${newIndex}" name="item_quantity[]" value="1" min="1"></td>
               <td><label for="item_unit_${newIndex}" class="visually-hidden">Loại dòng ${newIndex}</label><select id="item_unit_${newIndex}" name="item_unit[]"> <option value="PCE" selected>PCE</option> <option value="PCS">PCS</option> <option value="PKG">PKG</option> <option value="Rolls">Rolls</option> </select></td>
               <td><label for="item_price_${newIndex}" class="visually-hidden">Đơn giá dòng ${newIndex}</label><input type="number" step="any" id="item_price_${newIndex}" name="item_price[]" value="0"></td>
               <td><label for="item_total_${newIndex}" class="visually-hidden">Tổng giá dòng ${newIndex}</label><input type="number" step="any" id="item_total_${newIndex}" name="item_total[]" value="0" readonly></td>
           </tr>`;
        tbody.insertAdjacentHTML('beforeend', newRowHTML);
    }

    function resetRightColumn() {
        const rightColumn = document.querySelector('.content-column-right');
        if (rightColumn) {
            rightColumn.querySelectorAll('.data-section').forEach(section => {
                section.querySelectorAll('input[type="text"], input[type="number"], textarea').forEach(input => {
                    if (input.defaultValue !== undefined) { input.value = input.defaultValue; }
                    else { input.value = ''; }
                    input.classList.remove('error');
                });
                section.querySelectorAll('select').forEach(select => {
                    const defaultOption = select.querySelector('option[selected]');
                    select.selectedIndex = defaultOption ? defaultOption.index : 0;
                    select.classList.remove('error');
                });
                section.querySelectorAll('input[type="checkbox"]').forEach(checkbox => { checkbox.checked = checkbox.defaultChecked; });
                section.querySelectorAll('.error-message').forEach(msg => msg.remove());
            });

            const dimensionContainer = document.getElementById('dimension-rows');
            if (dimensionContainer) {
                dimensionContainer.innerHTML = `
                    <div class="dimension-row">
                        <label for="dim_length_1" class="visually-hidden">Dài kiện 1</label> <input type="number" step="any" id="dim_length_1" name="dim_length[]" placeholder="Dài">
                        <label for="dim_width_1" class="visually-hidden">Rộng kiện 1</label> <input type="number" step="any" id="dim_width_1" name="dim_width[]" placeholder="Rộng">
                        <label for="dim_height_1" class="visually-hidden">Cao kiện 1</label> <input type="number" step="any" id="dim_height_1" name="dim_height[]" placeholder="Cao">
                        <label for="dim_weight_1" class="visually-hidden">Nặng kiện 1</label> <input type="number" step="any" id="dim_weight_1" name="dim_weight[]" placeholder="Nặng">
                        <div class="dim-actions">
                            <button type="button" class="icon-button add-dim confirm small" title="Thêm kiện"><i class="fas fa-plus-circle"></i></button>
                        </div>
                    </div>`;
            }

            const itemTableBody = document.getElementById('shipment-items-tbody');
            if (itemTableBody) {
                itemTableBody.innerHTML = `
                    <tr>
                        <td><button type="button" class="icon-button remove-item danger small" title="Xóa dòng"><i class="fas fa-trash-alt"></i></button></td>
                        <td><label for="item_name_1" class="visually-hidden">Tên hàng hóa dòng 1</label><textarea id="item_name_1" name="item_name[]" rows="1"></textarea></td>
                        <td><label for="item_quantity_1" class="visually-hidden">Số lượng dòng 1</label><input type="number" id="item_quantity_1" name="item_quantity[]" value="1" min="1"></td>
                        <td><label for="item_unit_1" class="visually-hidden">Loại dòng 1</label><select id="item_unit_1" name="item_unit[]"><option value="PCE" selected>PCE</option><option value="PCS">PCS</option><option value="PKG">PKG</option><option value="Rolls">Rolls</option></select></td>
                        <td><label for="item_price_1" class="visually-hidden">Đơn giá dòng 1</label><input type="number" step="any" id="item_price_1" name="item_price[]" value="0"></td>
                        <td><label for="item_total_1" class="visually-hidden">Tổng giá dòng 1</label><input type="number" step="any" id="item_total_1" name="item_total[]" value="0" readonly></td>
                    </tr>`;
                updateTotalOrderValue();
            }

            const fileListDisplay = document.getElementById('selected_files_list');
            const fileInput = document.getElementById('shipment_images');
            if (fileListDisplay) { fileListDisplay.innerHTML = '<span class="no-files-selected"><i>Chưa chọn file nào.</i></span>'; }
            if (fileInput) { fileInput.value = ''; }
        }
    }

    function addErrorMessage(container, message) {
        if (!container) return;
        const existingError = container.querySelector('.error-message');
        if (existingError) existingError.remove();
        const errorSpan = document.createElement('span');
        errorSpan.className = 'error-message';
        errorSpan.textContent = message;
        container.appendChild(errorSpan);
    }

    function removeErrorMessage(container) {
        if (!container) return;
        const errorMessages = container.querySelectorAll('.error-message');
        errorMessages.forEach(msg => msg.remove());
    }

    document.addEventListener('DOMContentLoaded', function () {
        // Lấy dữ liệu từ localStorage và hiển thị vào tóm tắt
        const data = JSON.parse(localStorage.getItem('createPackageStep1') || '{}');

        // Hàm ánh xạ value sang tên dịch vụ
        function getServiceName(val) {
            const map = {
                'signature': 'Chữ Ký',
                'fumigation': 'FUMIGATION',
                'packing': 'Đóng kiện gỗ',
                'insurance': 'Bảo hiểm hàng hóa'
            };
            return map[val] || val;
        }

        // Kiểm tra đủ 4 section bắt buộc
        const requiredFields = [
            // Người gửi
            'sender_name', 'sender_phone', 'sender_address',
            // Người nhận
            'receiver_name', 'receiver_phone1', 'receiver_address',
            // Dịch vụ
            'service_type', 'branch', 'package_type', 'pickup_method',
            // Yêu cầu đơn hàng
            'bill_status', 'agent'
        ];

        const missing = requiredFields.filter(f => !data[f] || data[f].toString().trim() === '');
        if (missing.length > 0) {
            console.warn('Thiếu thông tin bắt buộc ở bước 1:', missing); // Log thay vì alert
            // alert('Thiếu thông tin bắt buộc ở bước 1. Vui lòng nhập lại!');
            // window.location.href = 'create-package.html';
            // return; // Không redirect ngay để dễ debug
        }

        // Hiển thị thông tin vào các trường tương ứng
        const senderInfoDisplay = document.getElementById('sender-info-display');
        if (senderInfoDisplay) { senderInfoDisplay.value = data.sender_name_display || ''; }

        // Auto-generate Order Code and REF Code if not present
        const orderCode = data.order_code || 'MTE' + Math.floor(Math.random() * 100000000).toString().padStart(8, '0'); // Simple placeholder generation
        const refCode = data.ref_code || Math.floor(Math.random() * 10000000).toString().padStart(7, '0'); // Simple placeholder generation

        document.getElementById('summary-order-code').textContent = orderCode;
        document.getElementById('summary-ref-code').textContent = refCode;

        // Thông tin Người gửi (using new combined fields)
        document.getElementById('summary-sender-company').textContent = data.sender_company || '';
        document.getElementById('summary-sender-address').textContent = data.sender_address || '';
        document.getElementById('summary-sender-phone').textContent = data.sender_phone || ''; // Keep separate phone field for now
        // Populate combined City, District, Ward
        const cityDetails = [data.sender_city, data.sender_district, data.sender_ward].filter(Boolean).join(', ');
        document.getElementById('summary-sender-city-details').textContent = cityDetails || '';
        // Populate combined Country and Zip
        const countryZip = [data.sender_country, data.sender_zip].filter(Boolean).join(', ');
        document.getElementById('summary-sender-country-zip').textContent = countryZip || '';

        // Thông tin Người nhận
        document.getElementById('summary-receiver-name').textContent = data.receiver_name || '';
        document.getElementById('summary-receiver-company').textContent = data.receiver_company || '';
        document.getElementById('summary-receiver-address').textContent = data.receiver_address || '';
        // Populate combined Phone 1 and Phone 2
        let receiverPhonesDisplay = '';
        const phone1Value = data.receiver_phone1 || '';
        const phone1Code = data.receiver_phone1_code || '';
        const phone2Value = data.receiver_phone2 || '';
        const phone2Code = data.receiver_phone2_code || '';

        const displayPhone1 = phone1Code + phone1Value;
        const displayPhone2 = phone2Code + phone2Value;

        if (phone1Value && phone2Value) {
            // Both have values
            receiverPhonesDisplay = `${displayPhone1} / ${displayPhone2}`;
        } else if (phone1Value) {
            // Only phone 1 has value
            receiverPhonesDisplay = displayPhone1;
        } else if (phone2Value) {
            // Only phone 2 has value (less likely if phone1 is required)
            receiverPhonesDisplay = displayPhone2;
        }
        document.getElementById('summary-receiver-phones').textContent = receiverPhonesDisplay;
        // Populate combined City and State
        const receiverCityState = [data.receiver_city, data.receiver_state].filter(Boolean).join(', ');
        document.getElementById('summary-receiver-city-state').textContent = receiverCityState || '';
        // Populate combined Country and Zip
        const receiverCountryZip = [data.receiver_country, data.receiver_zip].filter(Boolean).join(', ');
        document.getElementById('summary-receiver-country-zip').textContent = receiverCountryZip || '';

        // Thông tin Dịch vụ
        document.getElementById('summary-service-type').textContent = data.service_type || '';
        document.getElementById('summary-branch').textContent = data.branch || '';

        let addServiceArr = data['add_service[]'];
        if (typeof addServiceArr === 'string') addServiceArr = [addServiceArr];
        if (!Array.isArray(addServiceArr)) addServiceArr = [];
        const addServiceText = addServiceArr.map(getServiceName).join(' / ');
        document.getElementById('summary-add-service').textContent = addServiceText;

        document.getElementById('summary-package-type').textContent = data.package_type || '';
        document.getElementById('summary-pickup-method').textContent = data.pickup_method || '';

        // Thông tin Yêu cầu
        document.getElementById('summary-bill-status').textContent = data.bill_status || '';
        document.getElementById('summary-agent').textContent = data.agent || '';
        document.getElementById('summary-ops-coord').textContent = data.ops_coord || '';
        document.getElementById('summary-cs-handler').textContent = data.cs_handler || '';
        // Mã INV không có trong ảnh, giữ lại nếu cần thiết hoặc bỏ đi
        // document.getElementById('summary-invoice-code').textContent = data.invoice_code || '';

    });

    // --- Dropdown thông báo ---
    document.addEventListener('DOMContentLoaded', function () {
        const notificationButton = document.getElementById('notification-button');
        const notificationDropdown = document.getElementById('notification-dropdown');
        const notificationList = document.getElementById('notification-list');
        const announcementOverlay = document.getElementById('announcement-overlay');
        const announcementBox = document.getElementById('announcement-box');
        const announcementTitle = document.getElementById('announcement-title');
        const announcementBodyEl = document.getElementById('announcement-body');
        const announcementTimestamp = document.getElementById('announcement-timestamp');

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
                document.body.classList.add('overflow-hidden');
            }
        }

        function closeAnnouncement() {
            if (announcementOverlay) {
                announcementOverlay.classList.remove('visible');
                document.body.classList.remove('overflow-hidden');
            }
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
        const announcementCloseBtn = document.getElementById('announcement-close-btn');
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
                }
            }
        });
    });

    function handleViewDetails(event) {
        event.preventDefault();

        // Lấy dữ liệu từ localStorage (thông tin từ create-package.html)
        const step1Data = JSON.parse(localStorage.getItem('createPackageStep1') || '{}');

        // Lấy dữ liệu từ form hiện tại
        const form = document.getElementById('create-order-step2-form');
        const formData = new FormData(form);
        const step2Data = {};

        // Chuyển FormData thành object
        for (let [key, value] of formData.entries()) {
            step2Data[key] = value;
        }

        // Lấy thông tin kích thước và cân nặng
        const dimensionRows = document.querySelectorAll('.dimension-row');
        const dimensions = [];
        let missingDimension = false;
        dimensionRows.forEach((row, idx) => {
            const length = row.querySelector('input[name="dim_length[]"]')?.value || '';
            const width = row.querySelector('input[name="dim_width[]"]')?.value || '';
            const height = row.querySelector('input[name="dim_height[]"]')?.value || '';
            const weight = row.querySelector('input[name="dim_weight[]"]')?.value || '';
            if (length === '' || width === '' || height === '' || weight === '') {
                missingDimension = true;
            } else {
                dimensions.push({
                    length: parseFloat(length),
                    width: parseFloat(width),
                    height: parseFloat(height),
                    weight: parseFloat(weight)
                });
            }
        });
        if (missingDimension || dimensions.length === 0) {
            alert('Vui lòng nhập đầy đủ Dài, Rộng, Cao, Nặng cho tất cả các kiện!');
            return;
        }
        step2Data.dimensions = dimensions;

        // Lấy thông tin sản phẩm
        const productName = document.getElementById('product_name').value;
        step2Data.product_name = productName;

        // Lấy danh sách hàng hóa từ bảng
        const items = [];
        document.querySelectorAll('#shipment-items-tbody tr').forEach(row => {
            items.push({
                name: row.querySelector('textarea[name="item_name[]"]').value,
                quantity: row.querySelector('input[name="item_quantity[]"]').value,
                unit: row.querySelector('select[name="item_unit[]"]').value,
                price: row.querySelector('input[name="item_price[]"]').value,
                total: row.querySelector('input[name="item_total[]"]').value
            });
        });
        step2Data.items = items;

        // Kết hợp dữ liệu từ cả 2 bước
        const combinedData = {
            ...step1Data,
            ...step2Data,
            // Thêm các trường cần thiết cho order_detail.html
            bill_code: step1Data.order_code || 'MTE' + Math.floor(Math.random() * 1000000),
            ref_code: step1Data.ref_code || Math.floor(Math.random() * 10000000).toString().padStart(7, '0'),
            order_date: new Date().toISOString(),
            order_status: 'processing',
            sender_name: step1Data.sender_name,
            sender_phone: step1Data.sender_phone,
            sender_address: step1Data.sender_address,
            sender_city: step1Data.sender_city,
            sender_country: step1Data.sender_country,
            receiver_name: step1Data.receiver_name,
            receiver_phone1: step1Data.receiver_phone1,
            receiver_phone2: step1Data.receiver_phone2,
            receiver_address: step1Data.receiver_address,
            receiver_city: step1Data.receiver_city,
            receiver_country: step1Data.receiver_country,
            service_type: step1Data.service_type,
            branch: step1Data.branch,
            add_service: step1Data['add_service[]'],
            package_type: step1Data.package_type,
            pickup_method: step1Data.pickup_method,
            bill_status: step1Data.bill_status,
            agent: step1Data.agent,
            ops_coord: step1Data.ops_coord,
            cs_handler: step1Data.cs_handler,
            dimensions: dimensions,
            product_name: productName,
            // Thêm Data URL của ảnh vào dữ liệu
            shipmentImage: selectedImageDataUrl // Lưu Data URL của ảnh đầu tiên
        };

        // Lưu vào localStorage
        localStorage.setItem('currentOrderDetail', JSON.stringify(combinedData));

        // Chuyển đến trang order_detail.html
        // Lưu trạng thái vào sessionStorage để biết nguồn chuyển trang
        sessionStorage.setItem('fromCreatePackageStep2', 'true');
        window.location.href = '/order_detail';
    }

    // Hàm thu thập dữ liệu form bước 2
    function collectStep2FormData() {
        const formData = {};
        const form = document.getElementById('create-order-step2-form');

        // Lấy thông tin kiện hàng (dimensions)
        formData.dimensions = [];
        form.querySelectorAll('#dimension-rows .dimension-row').forEach(row => {
            const dim = {
                length: row.querySelector('input[name="dim_length[]"]')?.value,
                width: row.querySelector('input[name="dim_width[]"]')?.value,
                height: row.querySelector('input[name="dim_height[]"]')?.value,
                weight: row.querySelector('input[name="dim_weight[]"]')?.value
            };
            // Chỉ thêm vào nếu có ít nhất một giá trị được nhập
            if (Object.values(dim).some(val => val)) {
                formData.dimensions.push(dim);
            }
        });
        formData.dimFactor = form.querySelector('#dim_factor')?.value;
        formData.productName = form.querySelector('#product_name')?.value;
        formData.shipmentNotes = form.querySelector('#shipment_notes')?.value;
        formData.isFragile = form.querySelector('input[name="is_fragile"]')?.checked;
        formData.imageLink = form.querySelector('#image_link')?.value;

        // Lấy chi tiết hàng hóa (items) cho kiện đang chọn
        // Lưu ý: Cách này chỉ lấy chi tiết cho kiện đang hiển thị.
        // Cần logic phức tạp hơn nếu muốn lưu chi tiết cho TẤT CẢ các kiện.
        // Tạm thời lưu theo kiện đang hiển thị hoặc cần chỉnh sửa cấu trúc HTML/JS để gom tất cả.
        // Hiện tại, form chỉ hiển thị chi tiết cho 1 kiện tại 1 thời điểm dựa vào #package_select
        // Giả định đơn giản: gom tất cả các dòng item đang có trong bảng
        formData.shipmentItems = [];
        form.querySelectorAll('#shipment-items-tbody tr').forEach(row => {
            const item = {
                name: row.querySelector('textarea[name="item_name[]"]')?.value,
                quantity: row.querySelector('input[name="item_quantity[]"]')?.value,
                unit: row.querySelector('select[name="item_unit[]"]')?.value,
                price: row.querySelector('input[name="item_price[]"]')?.value,
                total: row.querySelector('input[name="item_total[]"]')?.value
            };
            // Chỉ thêm vào nếu có tên hàng hóa
            if (item.name?.trim()) {
                formData.shipmentItems.push(item);
            }
        });
        formData.totalOrderValue = document.getElementById('total-order-value')?.textContent; // Lấy tổng giá trị

        // Files are handled separately, we won't store file data in localStorage due to size limits.
        // We can indicate if files were selected.
        formData.hasShipmentImages = document.getElementById('shipment_images')?.files.length > 0;
        // For actual submission, files would be appended to FormData.

        // Thêm Data URL của ảnh vào formData
        formData.shipmentImage = selectedImageDataUrl; // Lưu Data URL của ảnh đầu tiên

        return formData;
    }

    // Hàm lưu dữ liệu bước 2 vào localStorage
    function saveStep2ToLocalStorage() {
        const step2Data = collectStep2FormData();
        // Lấy dữ liệu bước 1 (nếu có)
        const step1Data = JSON.parse(localStorage.getItem('createPackageStep1') || '{}');

        // Kết hợp dữ liệu bước 1 và bước 2
        const combinedData = { ...step1Data, ...step2Data };

        // Lưu lại vào localStorage, có thể dùng key mới hoặc cập nhật key cũ
        // Sử dụng key mới 'createPackageWizardData' để lưu toàn bộ quá trình
        localStorage.setItem('createPackageWizardData', JSON.stringify(combinedData));
        console.log('Saved combined step 1 & 2 data to localStorage:', combinedData);
    }

    sessionStorage.removeItem('sourcePageOrderDetail');
    // --- End logic for footer button visibility ---

    sessionStorage.setItem('sourcePageOrderDetail', 'create-package-step2');

</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Function to load data from localStorage and populate the form
        function loadStep2Data() {
            console.log('Attempting to load step 2 data from localStorage...');
            const savedDataJson = localStorage.getItem('createPackageWizardData');

            if (savedDataJson) {
                try {
                    const savedData = JSON.parse(savedDataJson);
                    console.log('Successfully loaded and parsed saved data:', savedData);
                    populateSummaryColumn(savedData);
                    populateItemTable(savedData);
                    populateImagePreview(savedData);
                    updateTotalOrderValue();
                    ensureAddButtonOnLastRow();
                } catch (error) {
                    console.error('Error parsing saved data:', error);
                }
            }
        }

        // Function to populate Summary Column
        function populateSummaryColumn(data) {
            console.log('Populating summary column with data:', data);
            // Hàm ánh xạ value sang tên dịch vụ
            function getServiceName(val) {
                const map = {
                    'signature': 'Chữ Ký',
                    'fumigation': 'FUMIGATION',
                    'packing': 'Đóng kiện gỗ',
                    'insurance': 'Bảo hiểm hàng hóa'
                };
                return map[val] || val;
            }

            const senderInfoDisplay = document.getElementById('sender-info-display');
            if (senderInfoDisplay) { senderInfoDisplay.value = data.sender_name_display || ''; }

            // Auto-generate Order Code and REF Code if not present in saved data
            const orderCode = data.order_code || 'MTE' + Math.floor(Math.random() * 100000000).toString().padStart(8, '0'); // Simple placeholder generation
            const refCode = data.ref_code || Math.floor(Math.random() * 10000000).toString().padStart(7, '0'); // Simple placeholder generation

            document.getElementById('summary-order-code').textContent = orderCode;
            document.getElementById('summary-ref-code').textContent = refCode;

            // Thông tin Người gửi (using new combined fields)
            document.getElementById('summary-sender-company').textContent = data.sender_company || '';
            document.getElementById('summary-sender-address').textContent = data.sender_address || '';
            document.getElementById('summary-sender-phone').textContent = data.sender_phone || ''; // Keep separate phone field for now
            // Populate combined City, District, Ward
            const cityDetails = [data.sender_city, data.sender_district, data.sender_ward].filter(Boolean).join(', ');
            document.getElementById('summary-sender-city-details').textContent = cityDetails || '';
            // Populate combined Country and Zip
            const countryZip = [data.sender_country, data.sender_zip].filter(Boolean).join(', ');
            document.getElementById('summary-sender-country-zip').textContent = countryZip || '';

            // Thông tin Người nhận
            document.getElementById('summary-receiver-name').textContent = data.receiver_name || '';
            document.getElementById('summary-receiver-company').textContent = data.receiver_company || '';
            document.getElementById('summary-receiver-address').textContent = data.receiver_address || '';
            // Populate combined Phone 1 and Phone 2
            let receiverPhonesDisplay = '';
            const phone1Value = data.receiver_phone1 || '';
            const phone1Code = data.receiver_phone1_code || '';
            const phone2Value = data.receiver_phone2 || '';
            const phone2Code = data.receiver_phone2_code || '';

            const displayPhone1 = phone1Code + phone1Value;
            const displayPhone2 = phone2Code + phone2Value;

            if (phone1Value && phone2Value) {
                // Both have values
                receiverPhonesDisplay = `${displayPhone1} / ${displayPhone2}`;
            } else if (phone1Value) {
                // Only phone 1 has value
                receiverPhonesDisplay = displayPhone1;
            } else if (phone2Value) {
                // Only phone 2 has value (less likely if phone1 is required)
                receiverPhonesDisplay = displayPhone2;
            }
            document.getElementById('summary-receiver-phones').textContent = receiverPhonesDisplay;
            // Populate combined City and State
            const receiverCityState = [data.receiver_city, data.receiver_state].filter(Boolean).join(', ');
            document.getElementById('summary-receiver-city-state').textContent = receiverCityState || '';
            // Populate combined Country and Zip
            const receiverCountryZip = [data.receiver_country, data.receiver_zip].filter(Boolean).join(', ');
            document.getElementById('summary-receiver-country-zip').textContent = receiverCountryZip || '';

            // Thông tin Dịch vụ
            document.getElementById('summary-service-type').textContent = data.service_type || '';
            document.getElementById('summary-branch').textContent = data.branch || '';

            let addServiceArr = data['add_service[]'];
            if (typeof addServiceArr === 'string') addServiceArr = [addServiceArr];
            if (!Array.isArray(addServiceArr)) addServiceArr = [];
            const addServiceText = addServiceArr.map(getServiceName).join(' / ');
            document.getElementById('summary-add-service').textContent = addServiceText;

            document.getElementById('summary-package-type').textContent = data.package_type || '';
            document.getElementById('summary-pickup-method').textContent = data.pickup_method || '';

            // Thông tin Yêu cầu
            document.getElementById('summary-bill-status').textContent = data.bill_status || '';
            document.getElementById('summary-agent').textContent = data.agent || '';
            document.getElementById('summary-ops-coord').textContent = data.ops_coord || '';
            document.getElementById('summary-cs-handler').textContent = data.cs_handler || '';
        }

        // Modify addDimensionRow to accept optional dimension data
        function addDimensionRow(dimData = {}) {
            const container = document.getElementById('dimension-rows');
            if (!container) return;
            const newIndex = Date.now(); // Use timestamp for unique ID
            const newRowHTML = `
            <div class="dimension-row">
                <label for="dim_length_${newIndex}" class="visually-hidden">Dài kiện ${newIndex}</label> <input type="number" step="any" id="dim_length_${newIndex}" name="dim_length[]" placeholder="Dài" value="${dimData.length || ''}">
                <label for="dim_width_${newIndex}" class="visually-hidden">Rộng kiện ${newIndex}</label> <input type="number" step="any" id="dim_width_${newIndex}" name="dim_width[]" placeholder="Rộng" value="${dimData.width || ''}">
                <label for="dim_height_${newIndex}" class="visually-hidden">Cao kiện ${newIndex}</label> <input type="number" step="any" id="dim_height_${newIndex}" name="dim_height[]" placeholder="Cao" value="${dimData.height || ''}">
                <label for="dim_weight_${newIndex}" class="visually-hidden">Nặng kiện ${newIndex}</label> <input type="number" step="any" id="dim_weight_${newIndex}" name="dim_weight[]" placeholder="Nặng" value="${dimData.weight || ''}">
                <div class="dim-actions"></div>
            </div>`;
            container.insertAdjacentHTML('beforeend', newRowHTML);
            ensureAddButtonOnLastRow();
        }

        // Modify addItemRow to accept optional item data and event
        function addItemRow(event = null, itemData = {}) {
            if (event) event.preventDefault();
            const tbody = document.getElementById('shipment-items-tbody');
            if (!tbody) return;
            const newIndex = Date.now(); // Use timestamp for unique ID
            const newRowHTML = `
            <tr>
                <td><button type="button" class="icon-button remove-item danger small" title="Xóa dòng"><i class="fas fa-trash-alt"></i></button></td>
                <td><label for="item_name_${newIndex}" class="visually-hidden">Tên hàng hóa dòng ${newIndex}</label><textarea id="item_name_${newIndex}" name="item_name[]" rows="1">${itemData.name || ''}</textarea></td>
                <td><label for="item_quantity_${newIndex}" class="visually-hidden">Số lượng dòng ${newIndex}</label><input type="number" id="item_quantity_${newIndex}" name="item_quantity[]" value="${itemData.quantity || '1'}" min="1"></td>
                <td><label for="item_unit_${newIndex}" class="visually-hidden">Loại dòng ${newIndex}</label><select id="item_unit_${newIndex}" name="item_unit[]"> ${renderUnitOptions(itemData.unit)} </select></td>
                <td><label for="item_price_${newIndex}" class="visually-hidden">Đơn giá dòng ${newIndex}</label><input type="number" step="any" id="item_price_${newIndex}" name="item_price[]" value="${itemData.price || '0'}"></td>
                <td><label for="item_total_${newIndex}" class="visually-hidden">Tổng giá dòng ${newIndex}</label><input type="number" step="any" id="item_total_${newIndex}" name="item_total[]" value="${itemData.total || '0'}" readonly></td>
            </tr>`;
            tbody.insertAdjacentHTML('beforeend', newRowHTML);
        }

        // Helper function to render unit select options, marking the saved one as selected
        function renderUnitOptions(selectedValue) {
            const options = ['PCE', 'PCS', 'PKG', 'Rolls']; // Define your unit options here
            let optionsHTML = '';
            options.forEach(option => {
                const selectedAttr = (option === selectedValue) ? 'selected' : '';
                optionsHTML += `<option value="${option}" ${selectedAttr}>${option}</option>`;
            });
            return optionsHTML;
        }

        // Function to populate Item Table
        function populateItemTable(data) {
            const items = data.items || [];
            items.forEach((item, index) => {
                addItemRow(null, item);
            });
        }

        // Function to populate Image Preview
        function populateImagePreview(data) {
            const imageLink = data.imageLink || '';
            if (imageLink) {
                const img = document.createElement('img');
                img.src = imageLink;
                img.alt = 'Image Preview';
                img.className = 'upload-image-preview';
                document.getElementById('image_link').parentNode.appendChild(img);
            }
        }

        // Load data from localStorage
        loadStep2Data();
    });
</script>
@endpush
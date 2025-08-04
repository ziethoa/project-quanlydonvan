@extends('index')
@push('css')
<link rel="stylesheet" href="../css/create-package.css">
<link rel="stylesheet" href="../css/package_manager.css">
@endpush
@prepend('script')
<script>
    localStorage.removeItem('createPackageStep1');
    localStorage.removeItem('wizardData');
    function updateHeaderBlur() {
        var header = document.querySelector('.header');
        var anyModalOpen = false;
        document.querySelectorAll('.modal').forEach(function (modal) {
            var style = window.getComputedStyle(modal);
            if (style.display === 'flex' || style.display === 'block') anyModalOpen = true;
        });
        if (document.querySelector('.announcement-overlay.visible')) anyModalOpen = true;
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
</script>
@endprepend
@section('overlay')
<div class="modal-overlay" id="terms-modal-overlay"></div>
<div class="modal" id="terms-modal" role="dialog" aria-labelledby="modal-title" aria-modal="true" tabindex="-1">
    <div class="modal-header">
        <h2 class="modal-title" id="modal-title"><i class="fa-solid fa-file-contract icon"></i> Điều khoản Quy định
        </h2>
        <button class="modal-close-btn" id="modal-exit-btn-x" aria-label="Đóng">×</button>
    </div>
    <div class="modal-body">
        <p><strong>1. Lorem Ipsum chỉ đơn giản là một đoạn văn bản giả, được dùng vào việc trình bày và dàn trang
                phục vụ cho in ấn. Lorem Ipsum đã được sử dụng như một văn bản chuẩn cho ngành công nghiệp in ấn từ
                những năm 1500, khi một họa sĩ vô danh ghép nhiều đoạn văn bản với nhau để tạo thành một bản mẫu văn
                bản. Đoạn văn bản này không những đã tồn tại năm thế kỉ, mà khi được áp dụng vào tin học văn phòng,
                nội dung của nó vẫn không hề bị thay đổi. Nó đã được phổ biến trong những năm 1960 nhờ việc bán
                những bản giấy Letraset in những đoạn Lorem Ipsum, và gần đây hơn, được sử dụng trong các ứng dụng
                dàn trang, như Aldus PageMaker.</strong></p>
    </div>
    <div class="modal-footer">
        <div class="modal-terms-agreement">
            <input type="checkbox" id="modal_terms_agree" name="modal_terms_agree">
            <label for="modal_terms_agree">Tôi đã đọc và đồng ý với <a href="#" class="modal-link-underline">Điều
                    khoản quy định</a></label>
        </div>
        <div class="modal-action-buttons">
            <button type="button" class="button secondary" id="modal-exit-btn">
                <i class="fa-solid fa-xmark"></i> Thoát
            </button>
            <button type="button" class="button confirm" id="modal-agree-btn" disabled>
                <i class="fa-solid fa-check"></i> Tạo đơn
            </button>
        </div>
    </div>
</div>
@endsection
@section('main_content')
<div class="content-wrapper">
    <section class="page-header">
        <div class="page-header-left">
            <h1 class="page-title">Tạo đơn hàng</h1>
            <nav class="breadcrumb" aria-label="breadcrumb"> <a href="#">Tạo đơn hàng</a> / <span>Tạo đơn hàng
                    bước 1</span> </nav>
        </div>
    </section>

    <!-- Progress Steps -->
    <div class="progress-steps">
        <div class="step active">
            <div class="step-icon">
                <i class="fa-solid fa-file-pen"></i>
            </div>
            <div class="step-label">Tạo đơn hàng bước 1</div>
        </div>
        <div class="step">
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

    <form id="create-order-form" novalidate autocomplete="off">
        <div class="form-layout">
            <div class="form-column-left">
                <!-- SENDER Section -->
                <section class="card form-section">
                    <div class="card-header">
                        <h2 class="card-title"><i class="fas fa-user icon"></i> Người gửi (SENDER)</h2>
                        <div class="address-book-select">
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="sender_name_input">Người gửi<span class="required">*</span></label>
                            <input type="text" id="sender_name_input" name="sender_name_display" required
                                autocomplete="off" placeholder="Nhập tên hoặc SĐT người gửi">
                            <span class="error-message"></span>
                        </div>
                        <div class="form-group">
                            <label for="sender_company">Tên công ty</label>
                            <input type="text" id="sender_company" name="sender_company" value=""
                                autocomplete="off">
                            <span class="error-message"></span>
                        </div>
                        <div class="form-group inline-group multi-input" aria-labelledby="sender_contact_label">
                            <span id="sender_contact_label" class="visually-hidden">Sender Name and
                                Contact</span>
                            <div class="input-group">
                                <label for="sender_name">Tên người gửi<span class="required">*</span></label>
                                <input type="text" id="sender_name" name="sender_name" value=""
                                    autocomplete="off">
                                <span class="error-message"></span>
                            </div>
                            <div class="input-group">
                                <label for="sender_phone">Số liên hệ<span class="required">*</span></label>
                                <input type="tel" id="sender_phone" name="sender_phone" value=""
                                    autocomplete="off">
                                <span class="error-message"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="sender_city">Chọn địa chỉ<span class="required">*</span></label>
                            <div class="input-group-3 address-dropdown-group">
                                <div class="custom-select-wrapper" id="sender_city_custom_select_wrapper">
                                    <button type="button" class="custom-select-button" aria-haspopup="listbox"
                                        aria-expanded="false" aria-controls="sender_city_listbox"
                                        id="sender_city_button">
                                        <span class="selected-value">Chọn Tỉnh/Thành phố</span>
                                        <i class="fa-solid fa-chevron-down arrow-icon"></i>
                                    </button>
                                    <ul class="custom-select-dropdown hidden" role="listbox"
                                        id="sender_city_listbox" aria-labelledby="sender_city_button">
                                        <li role="option" data-value="" class="selected">Chọn Tỉnh/Thành phố
                                        </li>
                                        <!-- Options will be populated by JS -->
                                    </ul>
                                    <input type="hidden" id="sender_city" name="sender_city" value="" required>
                                </div>
                                <div class="custom-select-wrapper" id="sender_district_custom_select_wrapper">
                                    <button type="button" class="custom-select-button" aria-haspopup="listbox"
                                        aria-expanded="false" aria-controls="sender_district_listbox"
                                        id="sender_district_button">
                                        <span class="selected-value">Chọn Quận / Huyện</span>
                                        <i class="fa-solid fa-chevron-down arrow-icon"></i>
                                    </button>
                                    <ul class="custom-select-dropdown hidden" role="listbox"
                                        id="sender_district_listbox" aria-labelledby="sender_district_button">
                                        <li role="option" data-value="" class="selected">Chọn Quận / Huyện</li>
                                        <!-- Options will be populated by JS -->
                                    </ul>
                                    <input type="hidden" id="sender_district" name="sender_district" value=""
                                        required>
                                </div>
                                <div class="custom-select-wrapper" id="sender_ward_custom_select_wrapper">
                                    <button type="button" class="custom-select-button" aria-haspopup="listbox"
                                        aria-expanded="false" aria-controls="sender_ward_listbox"
                                        id="sender_ward_button">
                                        <span class="selected-value">Chọn Phường / Xã</span>
                                        <i class="fa-solid fa-chevron-down arrow-icon"></i>
                                    </button>
                                    <ul class="custom-select-dropdown hidden" role="listbox"
                                        id="sender_ward_listbox" aria-labelledby="sender_ward_button">
                                        <li role="option" data-value="" class="selected">Chọn Phường / Xã</li>
                                        <!-- Options will be populated by JS -->
                                    </ul>
                                    <input type="hidden" id="sender_ward" name="sender_ward" value="" required>
                                </div>
                            </div>
                            <span class="error-message group-error"></span>
                        </div>
                        <div class="form-group">
                            <label for="sender_address">Địa chỉ<span class="required">*</span></label>
                            <textarea id="sender_address" name="sender_address" required
                                autocomplete="off"></textarea>
                            <span class="error-message"></span>
                        </div>
                    </div>
                </section>

                <!-- SERVICES Section -->
                <section class="card form-section">
                    <div class="card-header">
                        <h2 class="card-title"><i class="fas fa-concierge-bell icon"></i> Chọn dịch vụ
                            (SERVICES)</h2>
                    </div>
                    <div class="card-body">
                        <div class="services-options-grid">
                            <div class="form-group">
                                <span class="form-label">Lý do gửi hàng<span class="required">*</span></span>
                                <div class="radio-group" role="radiogroup" aria-labelledby="send_reason_label">
                                    <span id="send_reason_label" class="visually-hidden">Lý do gửi hàng</span>
                                    <label> <input type="radio" name="send_reason" value="gift" required> Gift
                                        (no commercial value) </label>
                                    <label> <input type="radio" name="send_reason" value="sample" required>
                                        Sample </label>
                                </div>
                                <span class="error-message group-error"></span>
                            </div>
                            <div class="form-group">
                                <span class="form-label">Loại bưu gửi<span class="required">*</span></span>
                                <div class="radio-group" role="radiogroup" aria-labelledby="package_type_label">
                                    <span id="package_type_label" class="visually-hidden">Loại bưu gửi</span>
                                    <label> <input type="radio" name="package_type" value="goods" required> Hàng
                                        hóa </label>
                                    <label> <input type="radio" name="package_type" value="document" required>
                                        Tài liệu </label>
                                </div>
                                <span class="error-message group-error"></span>
                            </div>
                            <div class="form-group">
                                <span class="form-label">Dịch vụ đi kèm</span>
                                <div class="checkbox-group">
                                    <label><input type="checkbox" name="add_service[]" value="signature"> Chữ
                                        Ký</label>
                                    <label><input type="checkbox" name="add_service[]" value="fumigation">
                                        FUMIGATION</label>
                                    <label><input type="checkbox" name="add_service[]" value="packing"> Đóng
                                        kiện gỗ</label>
                                    <label><input type="checkbox" name="add_service[]" value="insurance"
                                            checked> Bảo hiểm hàng hóa</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <span class="form-label">Hình thức gửi hàng<span
                                        class="required">*</span></span>
                                <div class="radio-group" role="radiogroup"
                                    aria-labelledby="pickup_method_label">
                                    <span id="pickup_method_label" class="visually-hidden">Hình thức gửi
                                        hàng</span>
                                    <label> <input type="radio" name="pickup_method" value="pickup" required>
                                        Thu gom tận nơi </label>
                                    <label> <input type="radio" name="pickup_method" value="dropoff" required>
                                        Gửi hàng tại bưu cục </label>
                                </div>
                                <span class="error-message group-error"></span>
                            </div>
                        </div> <!-- Close services-options-grid -->
                        <div class="form-grid-2col">
                            <div class="form-group">
                                <label for="service_type">Chọn dịch vụ<span class="required">*</span></label>
                                <select id="service_type" name="service_type" required>
                                    <option value="" selected>Chọn dịch vụ</option>
                                </select>
                                <span class="error-message"></span>
                            </div>
                            <div class="form-group">
                                <label for="branch_input">Chi nhánh<span class="required">*</span></label>
                                <input type="text" id="branch_input" name="branch" list="branch_suggestions"
                                    required autocomplete="off">
                                <datalist id="branch_suggestions"></datalist>
                                <span class="error-message"></span>
                            </div>
                        </div>
                        <span class="warning-note">Lưu ý*: Một số dịch vụ chỉ nhận từ 20kg trở lên</span>
                    </div>
                </section>
            </div>
            <div class="form-column-right">
                <!-- RECEIVER Section -->
                <section class="card form-section">
                    <div class="card-header">
                        <h2 class="card-title"><i class="fas fa-box-open icon"></i> Người nhận (RECEIVER)</h2>
                        <div class="address-book-select">
                            <label for="receiver_address_book" class="visually-hidden">Chọn từ danh bạ</label>
                            <select id="receiver_address_book" name="receiver_address_book"
                                title="Chọn từ danh bạ">
                                <option value="" selected>Danh sách người nhận</option>
                                <option value="saved1">HIEP THANH
                            </select>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="receiver_company">Tên công ty</label>
                            <input type="text" id="receiver_company" name="receiver_company" value=""
                                autocomplete="off">
                            <span class="error-message"></span>
                        </div>
                        <div class="form-group">
                            <label for="receiver_name">Tên người nhận<span class="required">*</span></label>
                            <input type="text" id="receiver_name" name="receiver_name" value="" required
                                autocomplete="off">
                            <span class="error-message"></span>
                        </div>
                        <div class="form-group inline-group multi-input" aria-labelledby="receiver_phone_label">
                            <span id="receiver_phone_label" class="visually-hidden">Receiver Contact
                                Numbers</span>
                            <div class="input-group">
                                <label for="receiver_phone1">Số điện thoại 1<span
                                        class="required">*</span></label>
                                <div class="phone-input-group">
                                    <div class="custom-select-wrapper"
                                        id="receiver_phone1_code_custom_select_wrapper">
                                        <button type="button" class="custom-select-button"
                                            aria-haspopup="listbox" aria-expanded="false"
                                            aria-controls="receiver_phone1_code_listbox"
                                            id="receiver_phone1_code_button">
                                            <span class="selected-value">+84 (Vietnam)</span>
                                            <i class="fa-solid fa-chevron-down arrow-icon"></i>
                                        </button>
                                        <ul class="custom-select-dropdown hidden" role="listbox"
                                            id="receiver_phone1_code_listbox"
                                            aria-labelledby="receiver_phone1_code_button">
                                            <li role="option" data-value="+84" class="selected">+84 (Vietnam)
                                            </li>
                                            <!-- Options sẽ được JS render -->
                                        </ul>
                                        <input type="hidden" id="receiver_phone1_code"
                                            name="receiver_phone1_code" value="+84" required>
                                    </div>
                                    <input type="tel" id="receiver_phone1" name="receiver_phone1" value=""
                                        required autocomplete="off">
                                </div>
                                <span class="error-message"></span>
                            </div>
                            <div class="input-group">
                                <label for="receiver_phone2">Số điện thoại 2</label>
                                <div class="phone-input-group">
                                    <div class="custom-select-wrapper"
                                        id="receiver_phone2_code_custom_select_wrapper">
                                        <button type="button" class="custom-select-button"
                                            aria-haspopup="listbox" aria-expanded="false"
                                            aria-controls="receiver_phone2_code_listbox"
                                            id="receiver_phone2_code_button">
                                            <span class="selected-value">+84 (Vietnam)</span>
                                            <i class="fa-solid fa-chevron-down arrow-icon"></i>
                                        </button>
                                        <ul class="custom-select-dropdown hidden" role="listbox"
                                            id="receiver_phone2_code_listbox"
                                            aria-labelledby="receiver_phone2_code_button">
                                            <li role="option" data-value="+84" class="selected">+84 (Vietnam)
                                            </li>
                                            <!-- Options sẽ được JS render -->
                                        </ul>
                                        <input type="hidden" id="receiver_phone2_code"
                                            name="receiver_phone2_code" value="+84" required>
                                    </div>
                                    <input type="tel" id="receiver_phone2" name="receiver_phone2" value=""
                                        autocomplete="off">
                                </div>
                                <span class="error-message"></span>
                            </div>
                        </div>
                        <div class="form-grid-2col">
                            <div class="form-group">
                                <label for="receiver_country">Quốc gia<span class="required">*</span></label>
                                <div class="custom-select-wrapper" id="receiver_country_custom_select_wrapper">
                                    <button type="button" class="custom-select-button" aria-haspopup="listbox"
                                        aria-expanded="false" aria-controls="receiver_country_listbox"
                                        id="receiver_country_button">
                                        <span class="selected-value">Chọn quốc gia</span>
                                        <i class="fa-solid fa-chevron-down arrow-icon"></i>
                                    </button>
                                    <ul class="custom-select-dropdown hidden" role="listbox"
                                        id="receiver_country_listbox" aria-labelledby="receiver_country_button">
                                        <li role="option" data-value="" class="selected">Chọn quốc gia</li>
                                        <!-- Options will be populated by JS -->
                                    </ul>
                                    <input type="hidden" id="receiver_country" name="receiver_country" value=""
                                        required>
                                </div>
                                <span class="error-message"></span>
                            </div>
                            <div class="form-group">
                                <label for="receiver_postcode">Postcode</label>
                                <input type="text" id="receiver_postcode" name="receiver_postcode" value=""
                                    autocomplete="off">
                                <span class="error-message"></span>
                            </div>
                            <div class="form-group">
                                <label for="receiver_city">Thành phố<span class="required">*</span></label>
                                <input type="text" id="receiver_city" name="receiver_city" value="" required
                                    placeholder="Nhập tên thành phố" autocomplete="off">
                                <span class="error-message"></span>
                            </div>
                            <div class="form-group">
                                <label for="receiver_state">Tỉnh/Bang<span class="required">*</span></label>
                                <input type="text" id="receiver_state" name="receiver_state" value="" required
                                    autocomplete="off">
                                <span class="error-message"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="receiver_address">Địa chỉ chi tiết<span
                                    class="required">*</span></label>
                            <textarea id="receiver_address" name="receiver_address" required
                                autocomplete="off"></textarea>
                            <span class="helper-text">(Không nhập POST CODE,STATE,CITY)</span>
                            <span class="error-message"></span>
                        </div>
                        <div class="form-group">
                            <label for="receiver_notes">Ghi chú</label>
                            <textarea id="receiver_notes" name="receiver_notes" autocomplete="off"></textarea>
                            <span class="error-message"></span>
                        </div>
                        <div class="checkbox-group">
                            <label> <input type="checkbox" name="save_receiver" value="1" checked> Lưu thông tin
                                người nhận cho lần nhập tiếp theo </label>
                        </div>
                    </div>
                </section>
                <section class="card form-section">
                    <div class="card-header">
                        <h2 class="card-title"><i class="fas fa-file-invoice-dollar icon"></i> Yêu cầu đơn hàng
                            (BILL REQUIREMENT)</h2>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <span class="form-label">Tình trạng đơn<span class="required">*</span></span>
                            <div class="radio-group" role="radiogroup" aria-labelledby="bill_status_label">
                                <span id="bill_status_label" class="visually-hidden">Tình trạng đơn</span>
                                <label> <input type="radio" name="bill_status" value="remote" required> Vùng sâu
                                    vùng xa </label>
                                <label> <input type="radio" name="bill_status" value="vat" required> VAT (8%)
                                </label>
                                <label> <input type="radio" name="bill_status" value="no_invoice" required>
                                    Không xuất Hóa Đơn </label>
                            </div>
                            <span class="error-message group-error"></span>
                        </div>
                        <div class="form-grid-2col">
                            <div class="form-group">
                                <label for="agent_input">Chọn Đại lý<span class="required">*</span></label>
                                <input type="text" id="agent_input" name="agent" list="agent_suggestions"
                                    required autocomplete="off">
                                <datalist id="agent_suggestions"></datalist>
                                <span class="error-message"></span>
                            </div>
                            <div class="form-group">
                                <label for="invoice_code">Mã INV</label>
                                <input type="text" id="invoice_code" name="invoice_code" value="">
                                <span class="error-message"></span>
                            </div>
                            <div class="form-group">
                                <label for="ops_coord">OPS điều phối</label>
                                <select id="ops_coord" name="ops_coord">
                                    <option value="dangvancuong" selected>Đặng Văn Cường - OP...</option>
                                </select>
                                <span class="error-message"></span>
                            </div>
                            <div class="form-group">
                                <label for="cs_handler">CS xử lý</label>
                                <select id="cs_handler" name="cs_handler">
                                    <option value="alice" selected>Alice in the Wonder L...</option>
                                </select>
                                <span class="error-message"></span>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
        <footer class="form-actions">
            <div class="terms-agreement">
                <input type="checkbox" id="terms_agree" name="terms_agree" required>
                <label for="terms_agree">Tôi đã đọc và đồng ý với <a href="#" class="modal-link-underline"
                        id="open-terms-modal-footer">Điều khoản quy định</a></label>
                <span class="error-message"></span>
            </div>
            <div class="action-buttons">
                <button type="button" class="button danger" id="exit-btn">
                    <i class="fa-solid fa-right-from-bracket"></i> Thoát
                </button>
                <button type="button" class="button warning" id="reset-btn">
                    <i class="fa-solid fa-arrows-rotate"></i> Làm mới
                </button>
                <button type="submit" class="button confirm">
                    <i class="fa-solid fa-check"></i> Tạo đơn
                </button>
            </div>
        </footer>
</div>

@endsection
@push('script')
<script src="https://esgoo.net/scripts/jquery.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const body = document.body;
        const sidebarOverlay = document.getElementById('sidebar-overlay');
        const mobileSidebarToggleBtn = document.getElementById('mobile-sidebar-toggle');
        const desktopSidebarToggleBtn = document.querySelector('.sidebar-toggle-desktop');
        const currentDateSpan = document.getElementById('current-date');
        const currentTimeSpan = document.getElementById('current-time');
        const currentYearSpan = document.getElementById('current-year');
        const fullscreenBtn = document.getElementById('fullscreen-btn');
        const termsModal = document.getElementById('terms-modal');
        const termsOverlay = document.getElementById('terms-modal-overlay');
        const agreeCheckbox = document.getElementById('modal_terms_agree');
        const agreeButton = document.getElementById('modal-agree-btn');
        const exitButtonX = document.getElementById('modal-exit-btn-x');
        const exitButtonFooter = document.getElementById('modal-exit-btn');
        const form = document.getElementById('create-order-form');
        const notificationButton = document.getElementById('notification-button');
        const notificationDropdown = document.getElementById('notification-dropdown');
        const notificationList = document.getElementById('notification-list');
        const announcementOverlay = document.getElementById('announcement-overlay');
        const announcementCloseBtn = document.getElementById('announcement-close-btn');
        const announcementTitle = document.getElementById('announcement-title');
        const announcementBodyEl = document.getElementById('announcement-body');
        const announcementTimestamp = document.getElementById('announcement-timestamp');

        const manageBodyScroll = () => {
            const isModalOpen = body.classList.contains('modal-open');
            const isSidebarOpen = body.classList.contains('sidebar-mobile-open');
            const isAnnounceVisible = announcementOverlay?.classList.contains('visible');
            body.style.overflow = (isModalOpen || isSidebarOpen || isAnnounceVisible) ? 'hidden' : '';
        };

        function toggleSidebarMobileOrDesktop() {
            if (window.innerWidth > 768) {
                body.classList.toggle('sidebar-collapsed');
            } else {
                body.classList.toggle('sidebar-mobile-open');
            }
            const isOpen = body.classList.contains('sidebar-mobile-open') || !body.classList.contains('sidebar-collapsed');
            if (mobileSidebarToggleBtn) mobileSidebarToggleBtn.setAttribute('aria-expanded', String(isOpen));
            manageBodyScroll();
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
                document.documentElement.requestFullscreen().catch(() => {});
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
            if (fullscreenBtn) fullscreenBtn.setAttribute('title', isFullscreen ? 'Exit Fullscreen' : 'Fullscreen');
        }

        function openModal(forceOpen = false) {
            const hasAgreedTerms = localStorage.getItem('hasAgreedTerms') === 'true';
            if ((!hasAgreedTerms || forceOpen) && termsModal && termsOverlay) {
                termsOverlay.classList.add('active');
                termsModal.classList.add('active');
                body.classList.add('modal-open');
                manageBodyScroll();
                if (!forceOpen && agreeCheckbox) {
                    agreeCheckbox.checked = false;
                    if (agreeButton) agreeButton.disabled = true;
                }
                termsModal.focus();
            }
        }

        function closeModal() {
            if (termsModal && termsOverlay) {
                termsOverlay.classList.remove('active');
                termsModal.classList.remove('active');
                body.classList.remove('modal-open');
                manageBodyScroll();
            }
        }

        function handleAgree() {
            if (agreeCheckbox?.checked) {
                localStorage.setItem('hasAgreedTerms', 'true');
                closeModal();
                document.getElementById('sender_preset')?.focus();
            } else if (agreeButton) {
                agreeButton.disabled = true;
            }
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

        if (mobileSidebarToggleBtn) mobileSidebarToggleBtn.addEventListener('click', toggleSidebarMobileOrDesktop);
        if (sidebarOverlay) sidebarOverlay.addEventListener('click', toggleSidebarMobileOrDesktop);
        if (desktopSidebarToggleBtn) desktopSidebarToggleBtn.addEventListener('click', toggleSidebarMobileOrDesktop);
        if (fullscreenBtn) fullscreenBtn.addEventListener('click', toggleFullscreen);
        document.addEventListener('fullscreenchange', handleFullscreenChange);

        if (agreeCheckbox && agreeButton) {
            agreeCheckbox.addEventListener('change', () => { agreeButton.disabled = !agreeCheckbox.checked; });
            agreeButton.addEventListener('click', handleAgree);
        }
        if (exitButtonX) exitButtonX.addEventListener('click', closeModal);
        if (exitButtonFooter) exitButtonFooter.addEventListener('click', closeModal);
        document.getElementById('open-terms-modal-footer')?.addEventListener('click', (e) => { e.preventDefault(); openModal(true); });
        document.getElementById('exit-btn')?.addEventListener('click', () => { window.location.href = '/'; });
        document.getElementById('reset-btn')?.addEventListener('click', () => {
            form?.reset();
            localStorage.removeItem('createPackageStep1');
            localStorage.removeItem('wizardData');
        });
        document.getElementById('view-terms-btn')?.addEventListener('click', openModal);

        if (form) {
            form.addEventListener('submit', (event) => {
                event.preventDefault();
                const hasAgreedTerms = localStorage.getItem('hasAgreedTerms') === 'true';
                if (!hasAgreedTerms) {
                    openModal();
                    return;
                }
                if (termsModal?.classList.contains('active')) {
                    alert('Vui lòng đóng cửa sổ Điều khoản Quy định trước khi tiếp tục.');
                    termsModal.focus();
                    return;
                }
                localStorage.setItem('hasAgreedTerms', 'true');
                localStorage.setItem('createPackageStep1', JSON.stringify({ test: 'data' }));
                window.location.href = '/create_package_step2';
            });

            form.addEventListener('reset', () => {
                form.querySelectorAll('.error')?.forEach(el => el.classList.remove('error'));
                form.querySelectorAll('.error-message')?.forEach(el => el.remove());
                form.querySelectorAll('.form-label.error, label.error')?.forEach(lbl => lbl.classList.remove('error'));
            });
        }

        if (notificationButton) notificationButton.addEventListener('click', (event) => { event.stopPropagation(); toggleNotificationDropdown(); });
        if (notificationList) {
            notificationList.addEventListener('click', (event) => {
                const clickedItem = event.target.closest('.notification-item');
                if (clickedItem && announcementTitle && announcementBodyEl && announcementTimestamp) {
                    event.preventDefault();
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
            if (notificationDropdown?.classList.contains('visible')) {
                if (!notificationDropdown.contains(event.target) && event.target !== notificationButton && !notificationButton.contains(event.target)) {
                    closeNotificationDropdown();
                }
            }
        });
        if (announcementCloseBtn) announcementCloseBtn.addEventListener('click', closeAnnouncement);
        if (announcementOverlay) announcementOverlay.addEventListener('click', (event) => { if (event.target === announcementOverlay) closeAnnouncement(); });
        document.addEventListener('keydown', (event) => {
            if (event.key === 'Escape') {
                if (termsModal?.classList.contains('active')) closeModal();
                else if (announcementOverlay?.classList.contains('visible')) closeAnnouncement();
                else if (notificationDropdown?.classList.contains('visible')) closeNotificationDropdown();
            }
        });

        const modalTermsLink = document.querySelector('#terms-modal .modal-link-underline');
        if (modalTermsLink) modalTermsLink.addEventListener('click', (e) => { e.preventDefault(); openModal(); });

        openModal();

        // Address API functions
        const senderCitySelectOriginal = document.getElementById('sender_city');
        const senderCityCustomSelectButton = document.getElementById('sender_city_button');
        const senderCityCustomSelectDropdown = document.getElementById('sender_city_listbox');
        const senderCitySelectedValueSpan = senderCityCustomSelectButton?.querySelector('.selected-value');
        const senderDistrictSelectOriginal = document.getElementById('sender_district');
        const senderDistrictCustomSelectButton = document.getElementById('sender_district_button');
        const senderDistrictCustomSelectDropdown = document.getElementById('sender_district_listbox');
        const senderDistrictSelectedValueSpan = senderDistrictCustomSelectButton?.querySelector('.selected-value');
        const senderWardSelectOriginal = document.getElementById('sender_ward');
        const senderWardCustomSelectButton = document.getElementById('sender_ward_button');
        const senderWardCustomSelectDropdown = document.getElementById('sender_ward_listbox');
        const senderWardSelectedValueSpan = senderWardCustomSelectButton?.querySelector('.selected-value');
        const receiverCountrySelect = document.getElementById('receiver_country');
        const receiverCountryCustomSelectButton = document.getElementById('receiver_country_button');
        const receiverCountryCustomSelectDropdown = document.getElementById('receiver_country_listbox');
        const receiverCountrySelectedValueSpan = receiverCountryCustomSelectButton?.querySelector('.selected-value');

        function populateCustomSelect(dropdownElement, data, hiddenInput, selectedValue, defaultText) {
            dropdownElement.innerHTML = `<li role="option" data-value="" class="selected">${defaultText}</li>`;
            data.forEach(item => {
                const option = document.createElement('li');
                option.setAttribute('role', 'option');
                option.setAttribute('data-value', item.id || item.cca2);
                option.textContent = item.full_name || item.name.common;
                if ((item.id || item.cca2) == selectedValue) {
                    option.classList.add('selected');
                    hiddenInput.previousElementSibling.querySelector('.selected-value').textContent = item.full_name || item.name.common;
                }
                dropdownElement.appendChild(option);
            });
        }

        function toggleCustomSelectDropdown(button, dropdown, expand = null) {
            const wrapper = button.closest('.custom-select-wrapper');
            const formGroup = wrapper?.closest('.form-group');
            const inputGroup3 = wrapper?.closest('.input-group-3');
            const formSection = formGroup?.closest('.form-section');
            const shouldBeActive = expand !== null ? expand : dropdown.classList.contains('hidden');
            if (shouldBeActive) {
                document.querySelectorAll('.custom-select-dropdown.active').forEach(openDropdown => {
                    if (openDropdown !== dropdown) {
                        const openButton = openDropdown.previousElementSibling;
                        toggleCustomSelectDropdown(openButton, openDropdown, false);
                    }
                });
                dropdown.classList.add('active');
                dropdown.classList.remove('hidden');
                button.setAttribute('aria-expanded', 'true');
                wrapper?.classList.add('active');
                formGroup?.classList.add('dropdown-active');
                inputGroup3?.classList.add('dropdown-active-group');
                formSection?.classList.add('section-dropdown-active');
            } else {
                dropdown.classList.add('hidden');
                dropdown.classList.remove('active');
                button.setAttribute('aria-expanded', 'false');
                wrapper?.classList.remove('active');
                formGroup?.classList.remove('dropdown-active');
                inputGroup3?.classList.remove('dropdown-active-group');
                formSection?.classList.remove('section-dropdown-active');
            }
        }

        function handleCustomOptionSelect(selectedValueSpan, hiddenInput, dropdownElement, selectedId, selectedText) {
            selectedValueSpan.textContent = selectedText;
            hiddenInput.value = selectedId;
            dropdownElement.querySelectorAll('li').forEach(li => {
                li.classList.remove('selected');
                if (li.dataset.value == selectedId) li.classList.add('selected');
            });
            hiddenInput.dispatchEvent(new Event('change'));
        }

        $.getJSON('https://esgoo.net/api-tinhthanh/1/0.htm', (data_tinh) => {
            if (data_tinh.error == 0) {
                populateCustomSelect(senderCityCustomSelectDropdown, data_tinh.data, senderCitySelectOriginal, senderCitySelectOriginal.value, 'Chọn Tỉnh/Thành phố');
            }
        }).fail((jqXHR, textStatus, errorThrown) => console.error('AJAX error fetching provinces:', textStatus, errorThrown));

        if (senderCityCustomSelectButton) {
            senderCityCustomSelectButton.addEventListener('click', (event) => {
                event.stopPropagation();
                toggleCustomSelectDropdown(senderCityCustomSelectButton, senderCityCustomSelectDropdown);
            });
        }
        if (senderCityCustomSelectDropdown) {
            senderCityCustomSelectDropdown.addEventListener('click', (event) => {
                const selectedOption = event.target.closest('li');
                if (selectedOption?.hasAttribute('role', 'option')) {
                    const selectedId = selectedOption.dataset.value;
                    const selectedText = selectedOption.textContent;
                    handleCustomOptionSelect(senderCitySelectedValueSpan, senderCitySelectOriginal, senderCityCustomSelectDropdown, selectedId, selectedText);
                    toggleCustomSelectDropdown(senderCityCustomSelectButton, senderCityCustomSelectDropdown, false);
                }
            });
        }

        senderCitySelectOriginal.addEventListener('change', () => {
            const provinceId = senderCitySelectOriginal.value;
            senderDistrictSelectOriginal.value = '';
            senderDistrictSelectedValueSpan.textContent = 'Chọn Quận / Huyện';
            populateCustomSelect(senderDistrictCustomSelectDropdown, [], senderDistrictSelectOriginal, '', 'Chọn Quận / Huyện');
            senderWardSelectOriginal.value = '';
            senderWardSelectedValueSpan.textContent = 'Chọn Phường / Xã';
            populateCustomSelect(senderWardCustomSelectDropdown, [], senderWardSelectOriginal, '', 'Chọn Phường / Xã');
            if (provinceId) {
                $.getJSON(`https://esgoo.net/api-tinhthanh/2/${provinceId}.htm`, (data_quan) => {
                    if (data_quan.error == 0) {
                        populateCustomSelect(senderDistrictCustomSelectDropdown, data_quan.data, senderDistrictSelectOriginal, senderDistrictSelectOriginal.value, 'Chọn Quận / Huyện');
                    }
                }).fail((jqXHR, textStatus, errorThrown) => console.error('AJAX error fetching districts:', textStatus, errorThrown));
            }
        });

        if (senderDistrictCustomSelectButton) {
            senderDistrictCustomSelectButton.addEventListener('click', (event) => {
                event.stopPropagation();
                toggleCustomSelectDropdown(senderDistrictCustomSelectButton, senderDistrictCustomSelectDropdown);
            });
        }
        if (senderDistrictCustomSelectDropdown) {
            senderDistrictCustomSelectDropdown.addEventListener('click', (event) => {
                const selectedOption = event.target.closest('li');
                if (selectedOption?.hasAttribute('role', 'option')) {
                    const selectedId = selectedOption.dataset.value;
                    const selectedText = selectedOption.textContent;
                    handleCustomOptionSelect(senderDistrictSelectedValueSpan, senderDistrictSelectOriginal, senderDistrictCustomSelectDropdown, selectedId, selectedText);
                    toggleCustomSelectDropdown(senderDistrictCustomSelectButton, senderDistrictCustomSelectDropdown, false);
                }
            });
        }

        senderDistrictSelectOriginal.addEventListener('change', () => {
            const districtId = senderDistrictSelectOriginal.value;
            senderWardSelectOriginal.value = '';
            senderWardSelectedValueSpan.textContent = 'Chọn Phường / Xã';
            populateCustomSelect(senderWardCustomSelectDropdown, [], senderWardSelectOriginal, '', 'Chọn Phường / Xã');
            if (districtId) {
                $.getJSON(`https://esgoo.net/api-tinhthanh/3/${districtId}.htm`, (data_phuong) => {
                    if (data_phuong.error == 0) {
                        populateCustomSelect(senderWardCustomSelectDropdown, data_phuong.data, senderWardSelectOriginal, senderWardSelectOriginal.value, 'Chọn Phường / Xã');
                    }
                }).fail((jqXHR, textStatus, errorThrown) => console.error('AJAX error fetching wards:', textStatus, errorThrown));
            }
        });

        if (senderWardCustomSelectButton) {
            senderWardCustomSelectButton.addEventListener('click', (event) => {
                event.stopPropagation();
                toggleCustomSelectDropdown(senderWardCustomSelectButton, senderWardCustomSelectDropdown);
            });
        }
        if (senderWardCustomSelectDropdown) {
            senderWardCustomSelectDropdown.addEventListener('click', (event) => {
                const selectedOption = event.target.closest('li');
                if (selectedOption?.hasAttribute('role', 'option')) {
                    const selectedId = selectedOption.dataset.value;
                    const selectedText = selectedOption.textContent;
                    handleCustomOptionSelect(senderWardSelectedValueSpan, senderWardSelectOriginal, senderWardCustomSelectDropdown, selectedId, selectedText);
                    toggleCustomSelectDropdown(senderWardCustomSelectButton, senderWardCustomSelectDropdown, false);
                }
            });
        }

        async function fetchCountries() {
            try {
                const response = await fetch('https://restcountries.com/v3.1/all?fields=name,cca2');
                const countries = await response.json();
                countries.sort((a, b) => a.name.common.localeCompare(b.name.common));
                populateCustomSelect(receiverCountryCustomSelectDropdown, countries, receiverCountrySelect, receiverCountrySelect.value, 'Chọn quốc gia');
            } catch (error) {
                console.error('Lỗi khi lấy danh sách quốc gia:', error);
                const fallbackCountries = [
                    { cca2: 'US', name: { common: 'UNITED STATES' } },
                    { cca2: 'GB', name: { common: 'UNITED KINGDOM' } },
                    { cca2: 'CA', name: { common: 'CANADA' } },
                    { cca2: 'AU', name: { common: 'AUSTRALIA' } },
                    { cca2: 'DE', name: { common: 'GERMANY' } },
                    { cca2: 'FR', name: { common: 'FRANCE' } },
                    { cca2: 'JP', name: { common: 'JAPAN' } },
                    { cca2: 'KR', name: { common: 'SOUTH KOREA' } },
                    { cca2: 'SG', name: { common: 'SINGAPORE' } }
                ];
                populateCustomSelect(receiverCountryCustomSelectDropdown, fallbackCountries, receiverCountrySelect, receiverCountrySelect.value, 'Chọn quốc gia');
            }
        }

        if (receiverCountryCustomSelectButton) {
            receiverCountryCustomSelectButton.addEventListener('click', (event) => {
                event.stopPropagation();
                toggleCustomSelectDropdown(receiverCountryCustomSelectButton, receiverCountryCustomSelectDropdown);
            });
        }
        if (receiverCountryCustomSelectDropdown) {
            receiverCountryCustomSelectDropdown.addEventListener('click', (event) => {
                const selectedOption = event.target.closest('li');
                if (selectedOption?.hasAttribute('role', 'option')) {
                    const selectedId = selectedOption.dataset.value;
                    const selectedText = selectedOption.textContent;
                    handleCustomOptionSelect(receiverCountrySelectedValueSpan, receiverCountrySelect, receiverCountryCustomSelectDropdown, selectedId, selectedText);
                    toggleCustomSelectDropdown(receiverCountryCustomSelectButton, receiverCountryCustomSelectDropdown, false);
                }
            });
        }

        fetchCountries();

        const branchInput = document.getElementById('branch_input');
        const agentInput = document.getElementById('agent_input');
        const branchDatalist = document.getElementById('branch_suggestions');
        const agentDatalist = document.getElementById('agent_suggestions');

        function getSuggestions(key) {
            return localStorage.getItem(key) ? JSON.parse(localStorage.getItem(key)) : [];
        }

        function addSuggestion(key, value) {
            if (!value?.trim()) return;
            const suggestions = getSuggestions(key);
            if (!suggestions.includes(value.trim())) {
                suggestions.push(value.trim());
                localStorage.setItem(key, JSON.stringify(suggestions));
            }
        }

        function populateDatalist(datalistElement, suggestions) {
            datalistElement.innerHTML = '';
            suggestions.forEach(item => {
                const option = document.createElement('option');
                option.value = item;
                datalistElement.appendChild(option);
            });
        }

        const branchSuggestions = getSuggestions('branchSuggestions');
        const agentSuggestions = getSuggestions('agentSuggestions');
        if (branchDatalist) populateDatalist(branchDatalist, branchSuggestions);
        if (agentDatalist) populateDatalist(agentDatalist, agentSuggestions);

        if (branchInput) branchInput.addEventListener('blur', () => addSuggestion('branchSuggestions', branchInput.value));
        if (agentInput) agentInput.addEventListener('blur', () => addSuggestion('agentSuggestions', agentInput.value));

        updateDateTime();
        setInterval(updateDateTime, 1000);
    });
</script>

<script>
    // --- DuyKha: Tích hợp API mã quốc gia cho 2 combobox mã điện thoại ---
    document.addEventListener('DOMContentLoaded', function () {
        const phoneCodeSelects = [
            document.getElementById('receiver_phone1_code'),
            document.getElementById('receiver_phone2_code')
        ];
        if (!phoneCodeSelects[0] || !phoneCodeSelects[1]) return;

        fetch('https://restcountries.com/v3.1/all?fields=idd,name')
            .then(res => res.json())
            .then(countries => {
                // Lọc và sắp xếp theo tên quốc gia
                const codes = countries
                    .filter(c => c.idd && c.idd.root)
                    .map(c => {
                        // Một số quốc gia có nhiều suffix, chỉ lấy cái đầu tiên
                        const suffix = Array.isArray(c.idd.suffixes) && c.idd.suffixes.length > 0 ? c.idd.suffixes[0] : '';
                        return {
                            code: c.idd.root + suffix,
                            name: c.name.common
                        };
                    })
                    .filter(c => /^\+\d+/.test(c.code))
                    .sort((a, b) => a.name.localeCompare(b.name));
                // Xây dựng HTML option
                let options = codes.map(c => `<option value="${c.code}">${c.code} (${c.name})</option>`).join('');
                // Đảm bảo +84 (Vietnam) luôn ở đầu
                const vietnam = codes.find(c => c.code === '+84');
                if (vietnam) {
                    options = `<option value="+84" selected>+84 (Vietnam)</option>` + options.replace(`<option value="+84">+84 (Vietnam)</option>`, '');
                }
                phoneCodeSelects.forEach(select => {
                    select.innerHTML = options;
                });
            })
            .catch(() => {
                // Nếu lỗi, fallback về các mã phổ biến
                const fallback = [
                    { code: '+84', name: 'Vietnam' },
                    { code: '+1', name: 'United States' },
                    { code: '+44', name: 'United Kingdom' },
                    { code: '+61', name: 'Australia' },
                    { code: '+81', name: 'Japan' },
                    { code: '+82', name: 'South Korea' },
                    { code: '+65', name: 'Singapore' }
                ];
                let options = fallback.map(c => `<option value="${c.code}">${c.code} (${c.name})</option>`).join('');
                options = `<option value="+84" selected>+84 (Vietnam)</option>` + options.replace(`<option value="+84">+84 (Vietnam)</option>`, '');
                phoneCodeSelects.forEach(select => {
                    select.innerHTML = options;
                });
            });
    });
    // ... existing code ...
</script>

<script>
    // --- DuyKha: Custom select cho mã quốc gia điện thoại ---
    document.addEventListener('DOMContentLoaded', function () {
        // ... existing code ...
        // Custom select cho receiver_phone1_code và receiver_phone2_code
        const phoneCodeCustoms = [
            {
                wrapper: document.getElementById('receiver_phone1_code_custom_select_wrapper'),
                button: document.getElementById('receiver_phone1_code_button'),
                dropdown: document.getElementById('receiver_phone1_code_listbox'),
                selectedValueSpan: document.getElementById('receiver_phone1_code_button')?.querySelector('.selected-value'),
                hiddenInput: document.getElementById('receiver_phone1_code'),
            },
            {
                wrapper: document.getElementById('receiver_phone2_code_custom_select_wrapper'),
                button: document.getElementById('receiver_phone2_code_button'),
                dropdown: document.getElementById('receiver_phone2_code_listbox'),
                selectedValueSpan: document.getElementById('receiver_phone2_code_button')?.querySelector('.selected-value'),
                hiddenInput: document.getElementById('receiver_phone2_code'),
            }
        ];
        // Lấy danh sách mã quốc gia
        function getPhoneCodes() {
            return fetch('https://restcountries.com/v3.1/all?fields=idd,name')
                .then(res => res.json())
                .then(countries => {
                    const codes = countries
                        .filter(c => c.idd && c.idd.root)
                        .map(c => {
                            const suffix = Array.isArray(c.idd.suffixes) && c.idd.suffixes.length > 0 ? c.idd.suffixes[0] : '';
                            return {
                                code: c.idd.root + suffix,
                                name: c.name.common
                            };
                        })
                        .filter(c => /^\+\d+/.test(c.code))
                        .sort((a, b) => a.name.localeCompare(b.name));
                    // Đảm bảo +84 (Vietnam) luôn ở đầu
                    const vietnam = codes.find(c => c.code === '+84');
                    let result = codes;
                    if (vietnam) {
                        result = [vietnam, ...codes.filter(c => c.code !== '+84')];
                    }
                    return result;
                })
                .catch(() => [
                    { code: '+84', name: 'Vietnam' },
                    { code: '+1', name: 'United States' },
                    { code: '+44', name: 'United Kingdom' },
                    { code: '+61', name: 'Australia' },
                    { code: '+81', name: 'Japan' },
                    { code: '+82', name: 'South Korea' },
                    { code: '+65', name: 'Singapore' }
                ]);
        }
        // Render options cho custom select
        function renderPhoneCodeOptions(dropdown, codes, selectedCode) {
            dropdown.innerHTML = '';
            codes.forEach(c => {
                const li = document.createElement('li');
                li.setAttribute('role', 'option');
                li.setAttribute('data-value', c.code);
                li.textContent = `${c.code} (${c.name})`;
                if (c.code === selectedCode) li.classList.add('selected');
                dropdown.appendChild(li);
            });
        }
        // Sự kiện mở/đóng custom select
        function togglePhoneCodeDropdown(wrapper, button, dropdown, expand = null) {
            const formGroup = wrapper.closest('.form-group');
            const inputGroup3 = wrapper.closest('.input-group-3');
            const formSection = formGroup ? formGroup.closest('.form-section') : null;
            const shouldBeActive = expand !== null ? expand : dropdown.classList.contains('hidden');
            if (shouldBeActive) {
                document.querySelectorAll('.custom-select-dropdown.active').forEach(openDropdown => {
                    if (openDropdown !== dropdown) {
                        const openButton = openDropdown.previousElementSibling;
                        const openWrapper = openButton.closest('.custom-select-wrapper');
                        const openFormGroup = openWrapper ? openWrapper.closest('.form-group') : null;
                        const openInputGroup3 = openWrapper ? openWrapper.closest('.input-group-3') : null;
                        const openFormSection = openFormGroup ? openFormGroup.closest('.form-section') : null;
                        openDropdown.classList.add('hidden');
                        openDropdown.classList.remove('active');
                        openButton.setAttribute('aria-expanded', 'false');
                        if (openWrapper) openWrapper.classList.remove('active');
                        if (openFormGroup) openFormGroup.classList.remove('dropdown-active');
                        if (openInputGroup3) openInputGroup3.classList.remove('dropdown-active-group');
                        if (openFormSection) openFormSection.classList.remove('section-dropdown-active');
                    }
                });
                dropdown.classList.add('active');
                dropdown.classList.remove('hidden');
                button.setAttribute('aria-expanded', 'true');
                if (wrapper) wrapper.classList.add('active');
                if (formGroup) formGroup.classList.add('dropdown-active');
                if (inputGroup3) inputGroup3.classList.add('dropdown-active-group');
                if (formSection) formSection.classList.add('section-dropdown-active');
            } else {
                dropdown.classList.add('hidden');
                dropdown.classList.remove('active');
                button.setAttribute('aria-expanded', 'false');
                if (wrapper) wrapper.classList.remove('active');
                if (formGroup) formGroup.classList.remove('dropdown-active');
                if (inputGroup3) inputGroup3.classList.remove('dropdown-active-group');
                if (formSection) formSection.classList.remove('section-dropdown-active');
            }
        }
        // Sự kiện chọn option
        function handlePhoneCodeSelect(selectedValueSpan, hiddenInput, dropdown, selectedCode, selectedText) {
            // Chỉ hiện mã quốc gia khi chưa xổ
            selectedValueSpan.textContent = selectedCode;
            hiddenInput.value = selectedCode;
            dropdown.querySelectorAll('li').forEach(li => {
                li.classList.remove('selected');
                if (li.dataset.value == selectedCode) li.classList.add('selected');
            });
            const event = new Event('change');
            hiddenInput.dispatchEvent(event);
        }
        // Khởi tạo custom select cho cả 2 phone code
        getPhoneCodes().then(codes => {
            phoneCodeCustoms.forEach(({ wrapper, button, dropdown, selectedValueSpan, hiddenInput }) => {
                if (!wrapper || !button || !dropdown || !selectedValueSpan || !hiddenInput) return;
                renderPhoneCodeOptions(dropdown, codes, hiddenInput.value || '+84');
                // Ban đầu chỉ hiện mã quốc gia
                selectedValueSpan.textContent = hiddenInput.value || '+84';
                // Sự kiện mở dropdown
                button.addEventListener('click', function (event) {
                    event.stopPropagation();
                    togglePhoneCodeDropdown(wrapper, button, dropdown);
                });
                // Sự kiện chọn option
                dropdown.addEventListener('click', function (event) {
                    const selectedOption = event.target.closest('li');
                    if (selectedOption && selectedOption.hasAttribute('role', 'option')) {
                        const selectedCode = selectedOption.dataset.value;
                        const selectedText = selectedOption.textContent;
                        handlePhoneCodeSelect(selectedValueSpan, hiddenInput, dropdown, selectedCode, selectedText);
                        togglePhoneCodeDropdown(wrapper, button, dropdown, false);
                    }
                });
            });
        });
        // Đóng dropdown khi click ngoài
        document.addEventListener('click', function (event) {
            phoneCodeCustoms.forEach(({ wrapper, button, dropdown }) => {
                if (!wrapper || !button || !dropdown) return;
                if (!wrapper.contains(event.target)) {
                    togglePhoneCodeDropdown(wrapper, button, dropdown, false);
                }
            });
        });
    });
    // ... existing code ...
</script>
@endpush
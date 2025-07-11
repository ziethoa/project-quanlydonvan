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
            const sidebar = document.getElementById('sidebar');
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
            const announcementBox = document.getElementById('announcement-box');
            const announcementCloseBtn = document.getElementById('announcement-close-btn');
            const announcementTitle = document.getElementById('announcement-title');
            const announcementBodyEl = document.getElementById('announcement-body');
            const announcementTimestamp = document.getElementById('announcement-timestamp');

            const manageBodyScroll = () => {
                const isModalOpen = body.classList.contains('modal-open');
                const isSidebarOpen = body.classList.contains('sidebar-mobile-open');
                const isAnnounceVisible = announcementOverlay && announcementOverlay.classList.contains('visible');
                body.style.overflow = (isModalOpen || isSidebarOpen || isAnnounceVisible) ? 'hidden' : '';
            };

            function toggleSidebarMobileOrDesktop() {
                if (window.innerWidth > 768) {
                    body.classList.toggle('sidebar-collapsed');
                    const isCollapsed = body.classList.contains('sidebar-collapsed');
                    if (isCollapsed) {
                        document.querySelectorAll('.menu-items .submenu.active').forEach(submenu => {
                            submenu.classList.remove('active');
                            submenu.previousElementSibling?.classList.remove('active');
                        });
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
                const activeSubmenuLink = document.querySelector('.sidebar .submenu a.active');
                if (activeSubmenuLink) {
                    const submenuDiv = activeSubmenuLink.closest('.submenu');
                    const parentLink = submenuDiv?.previousElementSibling;
                    if (submenuDiv && parentLink && parentLink.classList.contains('submenu-parent')) {
                        submenuDiv.classList.add('active');
                        parentLink.classList.add('active');
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
                    document.documentElement.requestFullscreen().catch(err => { });
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

            
            function openModal(forceOpen = false) {
                console.log('openModal function called', { forceOpen }); // Debug log
                const hasAgreedTerms = localStorage.getItem('hasAgreedTerms') === 'true';
                // DuyKha: Modal sẽ mở nếu chưa đồng ý HOẶC được yêu cầu mở bắt buộc (forceOpen)
                if ((!hasAgreedTerms || forceOpen) && termsModal && termsOverlay) {
                    termsOverlay.classList.add('active');
                    termsModal.classList.add('active');
                    body.classList.add('modal-open');
                    manageBodyScroll();
                    // DuyKha: Nếu không phải mở bắt buộc (tức là lần đầu mở khi chưa đồng ý),
                    // thì đảm bảo checkbox chưa được check.
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
                if (agreeCheckbox && agreeCheckbox.checked) {
                    localStorage.setItem('hasAgreedTerms', 'true');
                    closeModal();
                    document.getElementById('sender_preset')?.focus();
                } else {
                    if (agreeButton) agreeButton.disabled = true;
                }
            }

            function addErrorMessage(field, message) {
                const container = field.closest('.input-group') || field.closest('.form-group') || field.closest('.terms-agreement') || field.parentElement;
                if (!container) return;
                const fieldIdentifier = field.id || field.name;
                if (!fieldIdentifier) return;

                const existingError = container.querySelector(`.error-message[data-field="${fieldIdentifier}"]`) || container.parentNode.querySelector(`.error-message.group-error[data-group="${fieldIdentifier}"]`);
                if (existingError) existingError.remove();

                const errorSpan = document.createElement('span');
                errorSpan.className = 'error-message';
                errorSpan.dataset.field = fieldIdentifier;
                errorSpan.textContent = message;
                errorSpan.style.color = 'var(--danger-color)';
                errorSpan.style.fontSize = '0.8em';
                errorSpan.style.marginTop = '4px';
                errorSpan.style.display = 'block';

                if (field.type === 'radio' || field.type === 'checkbox') {
                    const groupContainer = field.closest('.radio-group, .checkbox-group, .terms-agreement');
                    if (groupContainer) {
                        errorSpan.classList.add('group-error');
                        errorSpan.dataset.group = field.name || field.id;
                        if (groupContainer.classList.contains('terms-agreement')) {
                            groupContainer.appendChild(errorSpan);
                        } else {
                            groupContainer.parentNode.appendChild(errorSpan);
                        }
                        const mainLabel = groupContainer.closest('.form-group')?.querySelector('.form-label');
                        if (mainLabel) mainLabel.classList.add('error');
                    }
                } else {
                    container.appendChild(errorSpan);
                    const label = container.querySelector(`label[for="${field.id}"]`);
                    if (label) label.classList.add('error');
                }
                field.classList.add('error');
            }

            function removeErrorMessage(field) {
                const container = field.closest('.input-group') || field.closest('.form-group') || field.closest('.terms-agreement') || field.parentElement;
                if (!container) return;

                const fieldIdentifier = field.id || field.name;
                if (!fieldIdentifier) return;

                const errorMessages = container.querySelectorAll(`.error-message[data-field="${fieldIdentifier}"]`);
                errorMessages.forEach(msg => msg.remove());
                field.classList.remove('error');

                if (field.type === 'radio' || field.type === 'checkbox') {
                    const groupContainer = field.closest('.radio-group, .checkbox-group, .terms-agreement');
                    if (groupContainer) {
                        let isGroupValid = false;
                        if (field.type === 'radio') {
                            isGroupValid = !!form.querySelector(`input[name="${field.name}"]:checked`);
                        } else {
                            isGroupValid = field.checked || !field.required;
                            if (field.id === 'terms_agree') isGroupValid = field.checked;
                        }
                        if (isGroupValid) {
                            const groupError = container.parentNode.querySelector(`.error-message.group-error[data-group="${fieldIdentifier}"]`) || groupContainer.querySelector('.error-message');
                            if (groupError) groupError.remove();
                            const mainLabel = groupContainer.closest('.form-group')?.querySelector('.form-label');
                            if (mainLabel) mainLabel.classList.remove('error');
                            const termsLabel = groupContainer.querySelector('label[for="terms_agree"]');
                            if (termsLabel) termsLabel.classList.remove('error');
                        }
                    }
                } else {
                    const label = container.querySelector(`label[for="${field.id}"]`);
                    if (label) label.classList.remove('error');
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

            if (mobileSidebarToggleBtn) mobileSidebarToggleBtn.addEventListener('click', toggleSidebarMobileOrDesktop);
            if (sidebarOverlay) sidebarOverlay.addEventListener('click', toggleSidebarMobileOrDesktop);
            if (desktopSidebarToggleBtn) desktopSidebarToggleBtn.addEventListener('click', toggleSidebarMobileOrDesktop);
            document.querySelectorAll('.menu-items .submenu-parent').forEach(link => link.addEventListener('click', toggleSubmenu));
            if (fullscreenBtn) fullscreenBtn.addEventListener('click', toggleFullscreen);
            document.addEventListener('fullscreenchange', handleFullscreenChange);

            if (agreeCheckbox && agreeButton) {
                agreeCheckbox.addEventListener('change', () => { agreeButton.disabled = !agreeCheckbox.checked; });
            }
            if (agreeButton) agreeButton.addEventListener('click', handleAgree);
            const closeHandler = () => closeModal();
            if (exitButtonX) exitButtonX.addEventListener('click', closeHandler);
            if (exitButtonFooter) exitButtonFooter.addEventListener('click', closeHandler);
            document.getElementById('open-terms-modal-footer')?.addEventListener('click', function (e) {
                e.preventDefault(); // Ngăn chặn hành vi mặc định (chuyển hướng)
                console.log('Link "Điều khoản quy định" clicked'); // Debug log
                openModal(true); // Gọi hàm mở modal, buộc mở (bỏ qua localStorage check)
            });
            document.getElementById('exit-btn')?.addEventListener('click', function () {
                window.location.href = '/'; // Or wherever you want to navigate on exit
            });
            document.getElementById('reset-btn')?.addEventListener('click', function () {
                form.reset();
                localStorage.removeItem('createPackageStep1');
                localStorage.removeItem('wizardData'); // Remove old wizard data
            });
            document.getElementById('view-terms-btn')?.addEventListener('click', function () {
                openModal();
            });

            if (form) {
                form.addEventListener('submit', function (event) {
                    event.preventDefault();
                    const hasAgreedTerms = localStorage.getItem('hasAgreedTerms') === 'true';
                    if (!hasAgreedTerms) {
                        openModal();
                        return;
                    }
                    if (termsModal && termsModal.classList.contains('active')) {
                        alert('Vui lòng đóng cửa sổ Điều khoản Quy định trước khi tiếp tục.');
                        termsModal.focus();
                        return;
                    }
                    let isFormValid = true;

                    // Xóa tất cả các thông báo lỗi và trạng thái lỗi hiện có
                    form.querySelectorAll('.error').forEach(el => el.classList.remove('error'));
                    form.querySelectorAll('.error-message').forEach(el => el.textContent = ''); // Chỉ xóa nội dung text
                    form.querySelectorAll('.form-label.error, label.error').forEach(lbl => lbl.classList.remove('error'));

                    // Hàm kiểm tra định dạng số điện thoại Việt Nam
                    function validateVietnamesePhoneNumber(phone) {
                        // Loại bỏ khoảng trắng và dấu gạch ngang
                        phone = phone.replace(/[\s-]/g, '');
                        // Kiểm tra xem có phải là số không
                        if (!/^\d+$/.test(phone)) {
                            return false;
                        }
                        // Kiểm tra độ dài số điện thoại (10-11 số)
                        if (phone.length < 10 || phone.length > 11) {
                            return false;
                        }
                        // Kiểm tra số đầu tiên phải là 0
                        if (phone[0] !== '0') {
                            return false;
                        }
                        return true;
                    }

                    // Hàm kiểm tra định dạng số điện thoại quốc tế cơ bản (chỉ kiểm tra có phải là số và không rỗng)
                    function validateInternationalPhoneNumberBasic(phone) {
                        phone = phone.replace(/[\s-()]/g, ''); // Loại bỏ khoảng trắng, dấu gạch ngang, ngoặc đơn
                        return phone.length > 0 && /^\d+$/.test(phone);
                    }

                    // Hàm hiển thị lỗi cho trường cụ thể
                    function displayFieldError(field, message) {
                        const container = field.closest('.input-group') || field.closest('.form-group');
                        if (!container) return;

                        let errorSpan = container.querySelector('.error-message');
                        if (!errorSpan) {
                            // If the span doesn't exist, create it (should exist based on HTML)
                            errorSpan = document.createElement('span');
                            errorSpan.className = 'error-message';
                            errorSpan.style.color = 'var(--danger-color)';
                            errorSpan.style.fontSize = '0.8em';
                            errorSpan.style.marginTop = '4px';
                            errorSpan.style.display = 'block';
                            // Append it after the input or the phone-input-group
                            const phoneInputGroup = field.closest('.phone-input-group');
                            if (phoneInputGroup) {
                                phoneInputGroup.parentNode.insertBefore(errorSpan, phoneInputGroup.nextSibling);
                            } else {
                                field.parentNode.insertBefore(errorSpan, field.nextSibling);
                            }
                        }

                        errorSpan.textContent = message;
                        field.classList.add('error');
                        const label = container.querySelector('label');
                        if (label) label.classList.add('error');
                    }

                    // Hàm xóa lỗi cho trường cụ thể
                    function clearFieldError(field) {
                        const container = field.closest('.input-group') || field.closest('.form-group');
                        if (!container) return;

                        const errorSpan = container.querySelector('.error-message');
                        if (errorSpan) {
                            errorSpan.textContent = '';
                        }
                        field.classList.remove('error');
                        const label = container.querySelector('label');
                        if (label) label.classList.remove('error');
                    }

                    // Thêm event listeners cho các trường số điện thoại để validate ngay khi nhập
                    const senderPhoneInput = document.getElementById('sender_phone');
                    const receiverPhone1Input = document.getElementById('receiver_phone1');
                    const receiverPhone2Input = document.getElementById('receiver_phone2');
                    const receiverPhone1CodeSelect = document.getElementById('receiver_phone1_code');
                    const receiverPhone2CodeSelect = document.getElementById('receiver_phone2_code');
                    const senderNameInput = document.getElementById('sender_name_input'); // Get sender name input

                    if (senderPhoneInput) {
                        senderPhoneInput.addEventListener('input', function () {
                            const value = this.value.trim();
                            if (!value) {
                                clearFieldError(this);
                                return;
                            }
                            if (!validateVietnamesePhoneNumber(value)) {
                                displayFieldError(this, 'Vui lòng nhập số điện thoại 10-11 số bắt đầu bằng số 0');
                            } else {
                                clearFieldError(this);
                            }
                        });
                        senderPhoneInput.addEventListener('focus', function () {
                            clearFieldError(this);
                        });

                        // Add change listener for select elements
                        if (senderPhoneInput.tagName === 'SELECT') {
                            senderPhoneInput.addEventListener('change', function () {
                                if (!this.value.trim()) {
                                    displayFieldError(this, 'Trường này là bắt buộc.');
                                } else {
                                    clearFieldError(this);
                                }
                            });
                        }

                    }

                    function validateReceiverPhone(phoneInput, countryCodeSelect, isRequired) {
                        const value = phoneInput.value.trim();
                        const countryCode = countryCodeSelect.value;

                        if (isRequired && !value) {
                            displayFieldError(phoneInput, 'Trường này là bắt buộc.');
                            return false;
                        } else if (!isRequired && !value) {
                            clearFieldError(phoneInput);
                            return true;
                        }

                        // If not empty, validate based on country code
                        if (countryCode === '+84') {
                            if (!validateVietnamesePhoneNumber(value)) {
                                displayFieldError(phoneInput, 'Vui lòng nhập số điện thoại 10-11 số bắt đầu bằng số 0');
                                return false;
                            } else {
                                clearFieldError(phoneInput);
                                return true;
                            }
                        } else {
                            // Basic validation for international numbers (just check if it's not empty and is numeric)
                            if (!validateInternationalPhoneNumberBasic(value)) {
                                displayFieldError(phoneInput, 'Vui lòng nhập số điện thoại hợp lệ.');
                                return false;
                            } else {
                                clearFieldError(phoneInput);
                                return true;
                            }
                        }
                    }


                    if (receiverPhone1Input && receiverPhone1CodeSelect) {
                        receiverPhone1Input.addEventListener('input', function () {
                            validateReceiverPhone(this, receiverPhone1CodeSelect, true);
                        });
                        receiverPhone1Input.addEventListener('focus', function () {
                            clearFieldError(this);
                        });
                        receiverPhone1CodeSelect.addEventListener('change', function () {
                            validateReceiverPhone(receiverPhone1Input, this, true);
                        });
                    }

                    if (receiverPhone2Input && receiverPhone2CodeSelect) {
                        receiverPhone2Input.addEventListener('input', function () {
                            validateReceiverPhone(this, receiverPhone2CodeSelect, false);
                        });
                        receiverPhone2Input.addEventListener('focus', function () {
                            clearFieldError(this);
                        });
                        receiverPhone2CodeSelect.addEventListener('change', function () {
                            validateReceiverPhone(receiverPhone2Input, this, false);
                        });
                    }

                    // Validate on submit

                    // Kiểm tra số điện thoại người gửi
                    if (senderPhoneInput) {
                        if (!validateVietnamesePhoneNumber(senderPhoneInput.value.trim())) {
                            isFormValid = false;
                            displayFieldError(senderPhoneInput, 'Vui lòng nhập số điện thoại 10-11 số bắt đầu bằng số 0');
                        } else {
                            clearFieldError(senderPhoneInput);
                        }
                    }

                    // Kiểm tra số điện thoại người nhận 1
                    if (receiverPhone1Input && receiverPhone1CodeSelect) {
                        if (!validateReceiverPhone(receiverPhone1Input, receiverPhone1CodeSelect, true)) {
                            isFormValid = false;
                        }
                    }

                    // Kiểm tra số điện thoại người nhận 2
                    if (receiverPhone2Input && receiverPhone2CodeSelect) {
                        // validateReceiverPhone handles the optional nature and validation based on code
                        if (!validateReceiverPhone(receiverPhone2Input, receiverPhone2CodeSelect, false)) {
                            isFormValid = false;
                        }
                    }


                    // Validation cho các trường bắt buộc khác (giữ nguyên logic cũ)
                    const termsCheckbox = document.getElementById('terms_agree');
                    if (termsCheckbox && !termsCheckbox.checked) {
                        isFormValid = false;
                        addErrorMessage(termsCheckbox, 'Bạn phải đồng ý với Điều khoản quy định của đơn hàng.');
                    } else if (termsCheckbox) {
                        removeErrorMessage(termsCheckbox);
                    }
                    const requiredFields = form.querySelectorAll('[required]');
                    const radioGroupsValidated = {};
                    requiredFields.forEach(input => {
                        if (input.id === 'terms_agree') return; // Terms checkbox handled separately
                        // Skip phone inputs as they are validated above
                        if (input.id === 'sender_phone' || input.id === 'receiver_phone1' || input.id === 'receiver_phone2') return;

                        // Handle select fields and other non-radio/checkbox required fields
                        if (input.tagName === 'SELECT' || input.tagName === 'INPUT' || input.tagName === 'TEXTAREA') {
                            if (!input.value.trim()) {
                                isFormValid = false;
                                displayFieldError(input, 'Trường này là bắt buộc.');
                            } else {
                                clearFieldError(input);
                            }
                            // Add event listener for immediate validation feedback
                            input.addEventListener('input', function () {
                                if (!this.value.trim()) {
                                    displayFieldError(this, 'Trường này là bắt buộc.');
                                } else {
                                    clearFieldError(this);
                                }
                            });
                            // Add focus listener to clear error on focus
                            input.addEventListener('focus', function () {
                                clearFieldError(this);
                            });
                        }

                        if (input.type === 'radio') {
                            const groupName = input.name;
                            if (!radioGroupsValidated[groupName]) {
                                const checkedRadio = form.querySelector(`input[name="${groupName}"]:checked`);
                                if (!checkedRadio) {
                                    isFormValid = false;
                                    // Find the first radio in the group to attach the error
                                    const firstRadioInGroup = form.querySelector(`input[name="${groupName}"]`);
                                    if (firstRadioInGroup) addErrorMessage(firstRadioInGroup, 'Vui lòng chọn một tùy chọn.');
                                } else {
                                    // Find the first radio in the group to remove the error
                                    const firstRadioInGroup = form.querySelector(`input[name="${groupName}"]`);
                                    if (firstRadioInGroup) removeErrorMessage(firstRadioInGroup);
                                }
                                radioGroupsValidated[groupName] = true;
                            }
                        } else if (input.type === 'checkbox' && input.required) {
                            if (!input.checked) {
                                isFormValid = false;
                                addErrorMessage(input, 'Tùy chọn này là bắt buộc.');
                            } else {
                                removeErrorMessage(input);
                            }
                        }
                    });


                    if (isFormValid) {
                        const formData = {};
                        form.querySelectorAll('input, select, textarea').forEach(input => {
                            if (input.type === 'checkbox' && input.name === 'add_service[]') {
                                if (!formData['add_service[]']) formData['add_service[]'] = [];
                                if (input.checked) formData['add_service[]'].push(input.value);
                            } else if (input.type === 'checkbox') {
                                formData[input.name] = input.checked;
                            } else if (input.type === 'radio') {
                                if (input.checked) formData[input.name] = input.value;
                            } else {
                                // Handle the new branch and agent inputs, and other general inputs/textareas
                                // sender_name_input was handled separately in previous edits
                                if (input.id === 'sender_name_input') {
                                    formData['sender_name_display'] = input.value;
                                } else if (input.tagName === 'SELECT') {
                                    // For select fields that still exist (address, country, service, etc.), store their selected text
                                    formData[input.name] = input.options[input.selectedIndex].text;
                                } else if (input.name !== 'sender_preset') { // Exclude the old sender_preset name
                                    formData[input.name] = input.value;
                                }
                            }
                        });

                        // Add sender country as always 'Việt Nam'
                        formData['sender_country'] = 'Việt Nam';

                        localStorage.setItem('createPackageStep1', JSON.stringify(formData));
                        window.location.href = '/create_package_step2';
                    } else {
                        const firstErrorField = form.querySelector('.error');
                        if (firstErrorField) {
                            const elementToScroll = firstErrorField.closest('.form-group, .terms-agreement') || firstErrorField;
                            elementToScroll.scrollIntoView({ behavior: 'smooth', block: 'center' });
                        }
                    }
                });

                form.addEventListener('reset', function () {
                    form.querySelectorAll('.error').forEach(el => el.classList.remove('error'));
                    form.querySelectorAll('.error-message').forEach(el => el.remove());
                    form.querySelectorAll('.form-label.error, label.error').forEach(lbl => lbl.classList.remove('error'));
                });
            }

            if (announcementOverlay && announcementOverlay.classList.contains('visible')) {
                closeAnnouncement();
            }
            if (notificationButton) notificationButton.addEventListener('click', (event) => { event.stopPropagation(); toggleNotificationDropdown(); });
            if (notificationList) {
                notificationList.addEventListener('click', (event) => {
                    const clickedItem = event.target.closest('.notification-item');
                    if (clickedItem && announcementTitle && announcementBodyEl && announcementTimestamp) {
                        event.preventDefault(); // Prevent default link behavior if any
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
            if (announcementCloseBtn) announcementCloseBtn.addEventListener('click', closeAnnouncement);
            if (announcementOverlay) {
                announcementOverlay.addEventListener('click', (event) => { if (event.target === announcementOverlay) closeAnnouncement(); });
            }
            document.addEventListener('keydown', (event) => {
                if (event.key === 'Escape') {
                    if (termsModal && termsModal.classList.contains('active')) {
                        closeModal();
                    } else if (announcementOverlay && announcementOverlay.classList.contains('visible')) {
                        closeAnnouncement();
                    } else if (notificationDropdown && notificationDropdown.classList.contains('visible')) {
                        closeNotificationDropdown();
                    }
                }
            });

            // Listener cho liên kết "Điều khoản quy định" bên trong modal
            const modalTermsLink = document.querySelector('#terms-modal .modal-link-underline');
            if (modalTermsLink) {
                modalTermsLink.addEventListener('click', function (e) {
                    e.preventDefault();
                    openModal(); // Gọi hàm mở modal (sẽ không có hiệu quả nếu modal đã mở)
                });
            }

            // DuyKha: Khi trang load, gọi openModal() mà KHÔNG buộc mở, chỉ mở nếu chưa đồng ý.
            openModal();

            // Address API functions
            const senderCitySelectOriginal = document.getElementById('sender_city'); // Our hidden input
            const senderCityCustomSelectButton = document.getElementById('sender_city_button');
            const senderCityCustomSelectDropdown = document.getElementById('sender_city_listbox');
            const senderCitySelectedValueSpan = senderCityCustomSelectButton.querySelector('.selected-value');

            const senderDistrictSelectOriginal = document.getElementById('sender_district'); // Hidden input for district
            const senderDistrictCustomSelectButton = document.getElementById('sender_district_button');
            const senderDistrictCustomSelectDropdown = document.getElementById('sender_district_listbox');
            const senderDistrictSelectedValueSpan = senderDistrictCustomSelectButton.querySelector('.selected-value');

            const senderWardSelectOriginal = document.getElementById('sender_ward'); // Hidden input for ward
            const senderWardCustomSelectButton = document.getElementById('sender_ward_button');
            const senderWardCustomSelectDropdown = document.getElementById('sender_ward_listbox');
            const senderWardSelectedValueSpan = senderWardCustomSelectButton.querySelector('.selected-value');

            let provincesData = [];
            let districtsData = [];
            let wardsData = [];

            // Function to populate custom select dropdown
            function populateCustomSelect(dropdownElement, data, hiddenInput, selectedValue, defaultText) {
                console.log('populateCustomSelect called with data:', data, 'selectedValue:', selectedValue, 'defaultText:', defaultText);
                dropdownElement.innerHTML = ''; // Clear existing options
                // Add a default option
                const defaultOption = document.createElement('li');
                defaultOption.setAttribute('role', 'option');
                defaultOption.setAttribute('data-value', '');
                defaultOption.textContent = defaultText;
                if (!selectedValue || selectedValue === '') {
                    defaultOption.classList.add('selected');
                }
                dropdownElement.appendChild(defaultOption);

                data.forEach(item => {
                    const option = document.createElement('li');
                    option.setAttribute('role', 'option');
                    option.setAttribute('data-value', item.id);
                    option.textContent = item.full_name;
                    if (item.id == selectedValue) {
                        option.classList.add('selected');
                        hiddenInput.previousElementSibling.querySelector('.selected-value').textContent = item.full_name;
                    }
                    dropdownElement.appendChild(option);
                });
            }

            // Toggle custom select dropdown visibility
            function toggleCustomSelectDropdown(button, dropdown, expand = null) {
                console.log('toggleCustomSelectDropdown called. Current hidden state:', dropdown.classList.contains('hidden'));
                const wrapper = button.closest('.custom-select-wrapper'); // Our custom-select-wrapper
                const formGroup = wrapper ? wrapper.closest('.form-group') : null; // Get the parent form-group
                const inputGroup3 = wrapper ? wrapper.closest('.input-group-3') : null; // Get the parent input-group-3
                const formSection = formGroup ? formGroup.closest('.form-section') : null; // Get the parent form-section

                const shouldBeActive = expand !== null ? expand : dropdown.classList.contains('hidden');
                if (shouldBeActive) {
                    // Close any other open custom dropdowns before opening this one
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
                    if (wrapper) wrapper.classList.add('active'); // Add active class for wrapper for its z-index
                    if (formGroup) formGroup.classList.add('dropdown-active'); // Add class to parent form-group
                    if (inputGroup3) inputGroup3.classList.add('dropdown-active-group'); // Add class to input-group-3
                    if (formSection) formSection.classList.add('section-dropdown-active'); // Add class to form-section
                    console.log('Dropdown set to active');
                } else {
                    dropdown.classList.add('hidden');
                    dropdown.classList.remove('active');
                    button.setAttribute('aria-expanded', 'false');
                    if (wrapper) wrapper.classList.remove('active'); // Remove active class from wrapper
                    if (formGroup) formGroup.classList.remove('dropdown-active'); // Remove class from parent form-group
                    if (inputGroup3) inputGroup3.classList.remove('dropdown-active-group'); // Remove class from input-group-3
                    if (formSection) formSection.classList.remove('section-dropdown-active'); // Remove class from form-section
                    console.log('Dropdown set to hidden');
                }
                // updateHeaderBlur(); // Tạm thời bình luận dòng này để kiểm tra
            }

            // Handle option selection for custom select
            function handleCustomOptionSelect(selectedValueSpan, hiddenInput, dropdownElement, selectedId, selectedText) {
                console.log('handleCustomOptionSelect called. Selected:', selectedText, selectedId);
                selectedValueSpan.textContent = selectedText;
                hiddenInput.value = selectedId;

                dropdownElement.querySelectorAll('li').forEach(li => {
                    li.classList.remove('selected');
                    if (li.dataset.value == selectedId) {
                        li.classList.add('selected');
                    }
                });

                // Manually trigger change event on hidden input to trigger district/ward updates
                const event = new Event('change');
                hiddenInput.dispatchEvent(event);
            }

            // Fetch provinces for custom select
            $.getJSON('https://esgoo.net/api-tinhthanh/1/0.htm', function (data_tinh) {
                console.log('API response for provinces:', data_tinh);
                if (data_tinh.error == 0) {
                    provincesData = data_tinh.data;
                    populateCustomSelect(senderCityCustomSelectDropdown, provincesData, senderCitySelectOriginal, senderCitySelectOriginal.value, 'Chọn Tỉnh/Thành phố');
                } else {
                    console.error('Error fetching provinces API:', data_tinh.message);
                }
            }).fail(function (jqXHR, textStatus, errorThrown) {
                console.error('AJAX error fetching provinces:', textStatus, errorThrown);
            });

            // Event listener for custom city button
            if (senderCityCustomSelectButton) {
                console.log('senderCityCustomSelectButton found', senderCityCustomSelectButton);
                senderCityCustomSelectButton.addEventListener('click', function (event) {
                    console.log('Custom city button clicked!');
                    event.stopPropagation(); // Prevent document click from closing immediately
                    toggleCustomSelectDropdown(senderCityCustomSelectButton, senderCityCustomSelectDropdown);
                });
            } else {
                console.error('senderCityCustomSelectButton not found!');
            }

            // Event listener for custom city dropdown options
            if (senderCityCustomSelectDropdown) {
                console.log('senderCityCustomSelectDropdown found', senderCityCustomSelectDropdown);
                senderCityCustomSelectDropdown.addEventListener('click', function (event) {
                    console.log('Custom city dropdown clicked!', event.target);
                    const selectedOption = event.target.closest('li');
                    if (selectedOption && selectedOption.hasAttribute('role', 'option')) {
                        const selectedId = selectedOption.dataset.value;
                        const selectedText = selectedOption.textContent;
                        handleCustomOptionSelect(senderCitySelectedValueSpan, senderCitySelectOriginal, senderCityCustomSelectDropdown, selectedId, selectedText);
                        toggleCustomSelectDropdown(senderCityCustomSelectButton, senderCityCustomSelectDropdown, false); // Close dropdown
                    }
                });
            } else {
                console.error('senderCityCustomSelectDropdown not found!');
            }

            // Close custom dropdown when clicking outside
            document.addEventListener('click', function (event) {
                // Collect all custom select wrappers
                const customSelectWrappers = document.querySelectorAll('.custom-select-wrapper');

                let isClickInsideAnyCustomSelect = false;
                customSelectWrappers.forEach(wrapper => {
                    if (wrapper.contains(event.target)) {
                        isClickInsideAnyCustomSelect = true;
                    }
                });

                if (!isClickInsideAnyCustomSelect) {
                    // Close all open custom dropdowns
                    document.querySelectorAll('.custom-select-dropdown.active').forEach(dropdown => {
                        const button = dropdown.previousElementSibling;
                        toggleCustomSelectDropdown(button, dropdown, false);
                    });
                }
            });

            // Handle city change (original logic, now triggered by hidden senderCitySelectOriginal)
            senderCitySelectOriginal.addEventListener('change', function () {
                console.log('Hidden senderCitySelectOriginal changed. Value:', this.value);
                const provinceId = senderCitySelectOriginal.value;
                // Clear district and ward dropdowns and hidden inputs
                senderDistrictSelectOriginal.value = '';
                senderDistrictSelectedValueSpan.textContent = 'Chọn Quận / Huyện';
                populateCustomSelect(senderDistrictCustomSelectDropdown, [], senderDistrictSelectOriginal, '', 'Chọn Quận / Huyện');

                senderWardSelectOriginal.value = '';
                senderWardSelectedValueSpan.textContent = 'Chọn Phường / Xã';
                populateCustomSelect(senderWardCustomSelectDropdown, [], senderWardSelectOriginal, '', 'Chọn Phường / Xã');

                if (provinceId) {
                    // Fetch districts
                    $.getJSON('https://esgoo.net/api-tinhthanh/2/' + provinceId + '.htm', function (data_quan) {
                        if (data_quan.error == 0) {
                            districtsData = data_quan.data;
                            populateCustomSelect(senderDistrictCustomSelectDropdown, districtsData, senderDistrictSelectOriginal, senderDistrictSelectOriginal.value, 'Chọn Quận / Huyện');
                        } else {
                            console.error('Error fetching districts API:', data_quan.message);
                        }
                    }).fail(function (jqXHR, textStatus, errorThrown) {
                        console.error('AJAX error fetching districts:', textStatus, errorThrown);
                    });
                }
            });

            // Event listener for custom district button
            if (senderDistrictCustomSelectButton) {
                senderDistrictCustomSelectButton.addEventListener('click', function (event) {
                    event.stopPropagation();
                    toggleCustomSelectDropdown(senderDistrictCustomSelectButton, senderDistrictCustomSelectDropdown);
                });
            }

            // Event listener for custom district dropdown options
            if (senderDistrictCustomSelectDropdown) {
                senderDistrictCustomSelectDropdown.addEventListener('click', function (event) {
                    const selectedOption = event.target.closest('li');
                    if (selectedOption && selectedOption.hasAttribute('role', 'option')) {
                        const selectedId = selectedOption.dataset.value;
                        const selectedText = selectedOption.textContent;
                        handleCustomOptionSelect(senderDistrictSelectedValueSpan, senderDistrictSelectOriginal, senderDistrictCustomSelectDropdown, selectedId, selectedText);
                        toggleCustomSelectDropdown(senderDistrictCustomSelectButton, senderDistrictCustomSelectDropdown, false);
                    }
                });
            }

            // Handle district change (now triggered by hidden senderDistrictSelectOriginal)
            senderDistrictSelectOriginal.addEventListener('change', function () {
                console.log('Hidden senderDistrictSelectOriginal changed. Value:', this.value);
                const districtId = senderDistrictSelectOriginal.value;

                // Clear ward dropdown and hidden input
                senderWardSelectOriginal.value = '';
                senderWardSelectedValueSpan.textContent = 'Chọn Phường / Xã';
                populateCustomSelect(senderWardCustomSelectDropdown, [], senderWardSelectOriginal, '', 'Chọn Phường / Xã');

                if (districtId) {
                    // Fetch wards
                    $.getJSON('https://esgoo.net/api-tinhthanh/3/' + districtId + '.htm', function (data_phuong) {
                        if (data_phuong.error == 0) {
                            wardsData = data_phuong.data;
                            populateCustomSelect(senderWardCustomSelectDropdown, wardsData, senderWardSelectOriginal, senderWardSelectOriginal.value, 'Chọn Phường / Xã');
                        } else {
                            console.error('Error fetching wards API:', data_phuong.message);
                        }
                    }).fail(function (jqXHR, textStatus, errorThrown) {
                        console.error('AJAX error fetching wards:', textStatus, errorThrown);
                    });
                }
            });

            // Event listener for custom ward button
            if (senderWardCustomSelectButton) {
                senderWardCustomSelectButton.addEventListener('click', function (event) {
                    event.stopPropagation();
                    toggleCustomSelectDropdown(senderWardCustomSelectButton, senderWardCustomSelectDropdown);
                });
            }

            // Event listener for custom ward dropdown options
            if (senderWardCustomSelectDropdown) {
                senderWardCustomSelectDropdown.addEventListener('click', function (event) {
                    const selectedOption = event.target.closest('li');
                    if (selectedOption && selectedOption.hasAttribute('role', 'option')) {
                        const selectedId = selectedOption.dataset.value;
                        const selectedText = selectedOption.textContent;
                        handleCustomOptionSelect(senderWardSelectedValueSpan, senderWardSelectOriginal, senderWardCustomSelectDropdown, selectedId, selectedText);
                        toggleCustomSelectDropdown(senderWardCustomSelectButton, senderWardCustomSelectDropdown, false);
                    }
                });
            }

            

            // Thêm code mới để lấy dữ liệu dịch vụ từ localStorage
            function getServiceData() {
                const data = localStorage.getItem('serviceData');
                console.log('getServiceData: Retrieved data from localStorage:', data);
                return data ? JSON.parse(data) : [];
            }

            // Hàm điền dữ liệu vào combobox dịch vụ
            function populateServiceSelect() {
                const serviceSelect = document.getElementById('service_type');
                if (!serviceSelect) {
                    console.error('Không tìm thấy element service_type');
                    return;
                }

                // Xóa tất cả options hiện tại trừ option mặc định
                while (serviceSelect.options.length > 1) {
                    serviceSelect.remove(1);
                }

                // Lấy dữ liệu dịch vụ
                const services = getServiceData();
                console.log('Populating service select with data:', services);

                // Thêm các options mới
                services.forEach(service => {
                    if (service.hienThi) { // Chỉ hiển thị các dịch vụ được đánh dấu là hiển thị
                        const option = document.createElement('option');
                        option.value = service.maDV;
                        option.textContent = `${service.maDV} - ${service.tenDV}`;
                        serviceSelect.appendChild(option);
                    }
                });
            }

            // Gọi hàm điền dữ liệu khi trang được tải
            populateServiceSelect();

            // Thêm code mới để lấy danh sách quốc gia
            const receiverCountrySelect = document.getElementById('receiver_country');
            const receiverCountryCustomSelectButton = document.getElementById('receiver_country_button');
            const receiverCountryCustomSelectDropdown = document.getElementById('receiver_country_listbox');
            const receiverCountrySelectedValueSpan = receiverCountryCustomSelectButton.querySelector('.selected-value');

            // Hàm để lấy danh sách quốc gia từ API
            async function fetchCountries() {
                try {
                    const response = await fetch('https://restcountries.com/v3.1/all?fields=name,cca2');
                    const countries = await response.json();

                    // Sắp xếp quốc gia theo tên
                    countries.sort((a, b) => a.name.common.localeCompare(b.name.common));

                    // Xóa các options hiện tại
                    receiverCountryCustomSelectDropdown.innerHTML = '<li role="option" data-value="" class="selected">Chọn quốc gia</li>';

                    // Thêm các quốc gia vào dropdown
                    countries.forEach(country => {
                        const option = document.createElement('li');
                        option.setAttribute('role', 'option');
                        option.setAttribute('data-value', country.cca2);
                        option.textContent = country.name.common;
                        receiverCountryCustomSelectDropdown.appendChild(option);
                    });
                } catch (error) {
                    console.error('Lỗi khi lấy danh sách quốc gia:', error);
                    // Thêm một số quốc gia phổ biến nếu API không hoạt động
                    const fallbackCountries = [
                        { value: 'US', text: 'UNITED STATES' },
                        { value: 'GB', text: 'UNITED KINGDOM' },
                        { value: 'CA', text: 'CANADA' },
                        { value: 'AU', text: 'AUSTRALIA' },
                        { value: 'DE', text: 'GERMANY' },
                        { value: 'FR', text: 'FRANCE' },
                        { value: 'JP', text: 'JAPAN' },
                        { value: 'KR', text: 'SOUTH KOREA' },
                        { value: 'SG', text: 'SINGAPORE' }
                    ];

                    receiverCountryCustomSelectDropdown.innerHTML = '<li role="option" data-value="" class="selected">Chọn quốc gia</li>';
                    fallbackCountries.forEach(country => {
                        const option = document.createElement('li');
                        option.setAttribute('role', 'option');
                        option.setAttribute('data-value', country.value);
                        option.textContent = country.text;
                        receiverCountryCustomSelectDropdown.appendChild(option);
                    });
                }
            }

            // Gọi hàm lấy danh sách quốc gia khi trang được tải
            fetchCountries();

            // Event listener cho custom country button
            if (receiverCountryCustomSelectButton) {
                receiverCountryCustomSelectButton.addEventListener('click', function (event) {
                    event.stopPropagation();
                    toggleCustomSelectDropdown(receiverCountryCustomSelectButton, receiverCountryCustomSelectDropdown);
                });
            }

            // Event listener cho custom country dropdown options
            if (receiverCountryCustomSelectDropdown) {
                receiverCountryCustomSelectDropdown.addEventListener('click', function (event) {
                    const selectedOption = event.target.closest('li');
                    if (selectedOption && selectedOption.hasAttribute('role', 'option')) {
                        const selectedId = selectedOption.dataset.value;
                        const selectedText = selectedOption.textContent;
                        handleCustomOptionSelect(receiverCountrySelectedValueSpan, receiverCountrySelect, receiverCountryCustomSelectDropdown, selectedId, selectedText);
                        toggleCustomSelectDropdown(receiverCountryCustomSelectButton, receiverCountryCustomSelectDropdown, false);
                    }
                });
            }

            // New code for Branch and Agent autocomplete
            const branchInput = document.getElementById('branch_input');
            const agentInput = document.getElementById('agent_input');

            // Helper function to get data from localStorage
            function getSuggestions(key) {
                const data = localStorage.getItem(key);
                return data ? JSON.parse(data) : [];
            }

            // Helper function to save data to localStorage (add new value if not exists)
            function addSuggestion(key, value) {
                if (!value || typeof value !== 'string' || value.trim() === '') return; // Prevent saving empty or invalid values
                const suggestions = getSuggestions(key);
                const trimmedValue = value.trim();
                if (!suggestions.includes(trimmedValue)) {
                    suggestions.push(trimmedValue);
                    localStorage.setItem(key, JSON.stringify(suggestions));
                }
            }

            // Helper function to populate datalist
            function populateDatalist(datalistElement, suggestions) {
                datalistElement.innerHTML = ''; // Clear existing options
                suggestions.forEach(item => {
                    const option = document.createElement('option');
                    option.value = item;
                    datalistElement.appendChild(option);
                });
            }

            // Populate datalists on page load
            const branchSuggestions = getSuggestions('branchSuggestions');
            const agentSuggestions = getSuggestions('agentSuggestions');

            const branchDatalist = document.getElementById('branch_suggestions');
            const agentDatalist = document.getElementById('agent_suggestions');

            if (branchDatalist) populateDatalist(branchDatalist, branchSuggestions);
            if (agentDatalist) populateDatalist(agentDatalist, agentSuggestions);

            // Add event listeners to save new entries on input blur
            if (branchInput) {
                branchInput.addEventListener('blur', function () {
                    addSuggestion('branchSuggestions', this.value);
                });
            }
            if (agentInput) {
                agentInput.addEventListener('blur', function () {
                    addSuggestion('agentSuggestions', this.value);
                });
            }

            // Update form submit to ensure latest values are saved before leaving the page
            if (form) {
                // form.addEventListener('submit', function (event) {
                //     // ... existing submit logic ...
                //     // Save the current values of branch and agent inputs
                //     if (branchInput) addSuggestion('branchSuggestions', branchInput.value);
                //     if (agentInput) addSuggestion('agentSuggestions', agentInput.value);

                //     // The rest of the form submit logic remains
                // });
                // // Also save on beforeunload in case the form is not submitted but the page is left
                // window.addEventListener('beforeunload', function () {
                //     if (branchInput) addSuggestion('branchSuggestions', branchInput.value);
                //     if (agentInput) addSuggestion('agentSuggestions', agentInput.value);
                // });

                // bỏ qua logic để chạy create package step 2
                form.addEventListener('submit', function (event) {
                event.preventDefault();
                // Bỏ qua kiểm tra hợp lệ, lưu dữ liệu mẫu và chuyển hướng
                localStorage.setItem('hasAgreedTerms', 'true');
                localStorage.setItem('createPackageStep1', JSON.stringify({ test: 'data' }));
                window.location.href = '/create_package_step2';
        });
            }
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
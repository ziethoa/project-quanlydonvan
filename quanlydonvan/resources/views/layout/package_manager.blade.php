@extends('index')

@push('css')
<link rel="stylesheet" href="../css/package_manager.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<link rel="icon" type="image/x-icon" href="../images/favicon.ico">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/xlsx@0.18.5/dist/xlsx.full.min.js"></script>
@endpush

@section('main_content')
<div class="content-wrapper">
    <section class="page-header">
        <div class="page-header-left">
            <h1 class="page-title">QUẢN LÝ ĐƠN HÀNG</h1>
            <nav class="breadcrumb" aria-label="breadcrumb"> <a href="#">Quản lý</a> / <span>Danh sách đơn
                    hàng</span> </nav>
        </div>
        <!-- Đã xóa nút Bộ lọc ở header -->
    </section>

    <section class="filter-bar card d-none d-md-block" aria-label="Filters">
        <div class="filter-controls-desktop">
            <div class="filter-group date-range" style="grid-column: span 2;">
                <label for="date-start">Date Range</label>
                <div style="display: flex; flex-direction: row; align-items: center; gap: 0.7rem; width: 100%;">
                    <input type="date" id="date-start" title="Từ ngày" placeholder="yyyy-mm-dd">
                    <span>→</span>
                    <input type="date" id="date-end" title="Đến ngày" placeholder="yyyy-mm-dd">
                </div>
            </div>
            <div class="filter-group"><label for="filter-status">Status</label><select id="filter-status"
                    title="Filter by status">
                    <option value="">Tất cả trạng thái</option>
                    <option>Mới tạo đơn</option>
                    <option>Đã nhận hàng</option>
                    <option>Đang phát hàng</option>
                    <option>Hoàn tất</option>
                    <option>Hủy</option>
                    <option>Lỗi</option>
                    <option>Chuyển hoàn</option>
                </select></div>
            <div class="filter-group"><label for="filter-data">Data Filter</label><select id="filter-data"
                    title="Data Filter">
                    <option>Lọc dữ liệu</option>
                </select></div>
            <div class="filter-group"><label for="filter-sale">Sales Rep</label><select id="filter-sale"
                    title="Select Sales Rep">
                    <option value="">Tất cả Sale</option>
                    <option>SALE01 - P.H. Đình</option>
                    <option>SALE02 - N.V. An</option>
                </select></div>
            <div class="filter-group"><label for="filter-customer">Customer</label><select id="filter-customer"
                    title="Select Customer">
                    <option value="">Tất cả khách hàng</option>
                    <option>Alice</option>
                </select></div>
            <div class="filter-group"><label for="filter-branch">Branch</label><select id="filter-branch"
                    title="Select Branch">
                    <option value="">Tất cả chi nhánh</option>
                    <option>CN: Tân Phú</option>
                    <option>CN: Bình Tân</option>
                </select></div>
            <div class="filter-group filter-search-input">
                <label for="filter-search-input">Search</label>
                <div class="search-input-wrapper" style="position: relative; flex-grow: 1;">
                    <i class="fa-solid fa-magnifying-glass"
                        style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: #64748b;"></i>
                    <input type="text" id="filter-search-input" placeholder="Order ID, Customer..."
                        style="width: 100%; padding-left: 2.5em;">
                </div>
            </div>
            <div class="filter-group filter-find-button">
                <label for="desktop-apply-filter-btn" class="visually-hidden">Find Orders Button</label>
                <button class="button primary filter-apply-btn" id="desktop-apply-filter-btn"
                    style="height: 30px; width: 150px; padding: 0.3rem 0.6rem; font-size: var(--font-size-sm); display: flex; align-items: center; justify-content: center; gap: 0.2rem;">
                    <i class="fa-solid fa-search"></i> Find Orders
                </button>
            </div>
        </div>
    </section>

    <section class="controls-section">
        <nav class="tabs" aria-label="Order Status Tabs">
            <button class="tab-item active" role="tab">Tất cả (8)</button>
            <button class="tab-item" role="tab">Mới tạo (2)</button>
            <button class="tab-item" role="tab">Chờ lấy hàng (5)</button>
            <button class="tab-item" role="tab">Nhận hàng (1)</button>
            <button class="tab-item" role="tab">Đang phát (2)</button>
            <button class="tab-item" role="tab">Hủy (1)</button>
            <button class="tab-item" role="tab">Lỗi (1)</button>
            <button class="tab-item" role="tab">Chuyển hoàn (0)</button>
            <button class="tab-item" role="tab">Hoàn tất (2)</button>
        </nav>
        <!-- Thanh chọn trạng thái và nút bộ lọc cho mobile -->
        <div class="mobile-status-bar">
            <div style="flex:1;">
                <select id="mobile-status-select" class="form-select" style="width:100%;">
                    <option value="Tất cả">Tất cả</option>
                    <option value="Mới tạo">Mới tạo</option>
                    <option value="Chờ lấy hàng">Chờ lấy hàng</option>
                    <option value="Nhận hàng">Nhận hàng</option>
                    <option value="Đang phát">Đang phát</option>
                    <option value="Hủy">Hủy</option>
                    <option value="Lỗi">Lỗi</option>
                    <option value="Chuyển hoàn">Chuyển hoàn</option>
                    <option value="Hoàn tất">Hoàn tất</option>
                </select>
            </div>
            <button class="button mobile-only" id="mobile-filter-btn"
                style="background: #fff; color: #4f46e5; border: 2px solid #4f46e5; font-weight: 600; min-width: 90px; padding: 0.5em 0.7em;"><i
                    class="fa-solid fa-filter"></i> Bộ lọc</button>
        </div>
        <div class="action-buttons" aria-label="Bulk Order Actions">
            <button class="button primary" onclick="window.location.href='/create_package'"><i
                    class="fa-solid fa-plus"></i> Tạo đơn hàng</button>
            <button class="button secondary"><i class="fa-solid fa-file-export"></i> Xuất DEBIT</button>
            <button class="button confirm" id="main-confirm-bulk-button"
                title="Xác nhận các đơn đã chọn hoàn tất"><i class="fa-solid fa-check-circle"></i> Xác nhận
                ĐH</button>
            <button class="button danger" id="main-delete-bulk-button" title="Xóa các đơn đã chọn"><i
                    class="fa-solid fa-trash-can"></i> Xuất kho</button>
            <button class="button warning" id="main-cancel-bulk-button" title="Hủy các đơn đã chọn"><i
                    class="fa-solid fa-ban"></i> Hủy đơn hàng</button>
        </div>
    </section>

    <section class="table-area card" aria-labelledby="order-table-heading">
        <div class="card-header"
            style="padding: var(--card-padding) var(--card-padding) 0; display: flex; justify-content: space-between; align-items: center;">
            <h2 id="order-table-heading" style="font-size: 1.2rem; font-weight: 600;">Danh sách đơn hàng</h2>
        </div>
        <div class="table-container">
            <div class="table-wrapper">
                <table id="orderTable">
                    <thead>
                        <tr>
                            <th><input type="checkbox" id="select-all-checkbox" title="Select all rows"></th>
                            <th>STT</th>
                            <th>ID BILL</th>
                            <th>Ngày tạo</th>
                            <th>Ngày xuất</th>
                            <th>Pick up</th>
                            <th>Xử lý</th>
                            <th>Tên KH</th>
                            <th>Sale</th>
                            <th>Dịch vụ</th>
                            <th>Tổng cước</th>
                            <th>KH TT</th>
                            <th>ĐL TT</th>
                            <th>Hoa hồng</th>
                            <th>Chi nhánh</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody id="order-table-body">
                        <tr id="main-row-1" class="clickable-row" data-order-id="MTE24081571254"
                            data-status="Mới tạo">
                            <td><input type="checkbox" title="Select row 1"></td>
                            <td>1</td>
                            <td><a href="/order_detail" class="order-id-link">MTE24081571254</a></td>
                            <td>15/08/24</td>
                            <td>18/08/24</td>
                            <td><span class="status-badge status-pending">Mới tạo</span></td>
                            <td>Mới tạo</td>
                            <td>Alice đối gió...</td>
                            <td>Alice H.B</td>
                            <td>DHL</td>
                            <td class="currency">3.198.840₫</td>
                            <td><span class="status-badge status-paid">Đã thanh toán</span></td>
                            <td><span class="status-badge status-paid">Đã thanh toán</span></td>
                            <td class="currency">159.942₫</td>
                            <td>Tân Phú</td>
                            <td class="action-icons"> <button class="icon-button receive-order-btn"
                                    title="Nhận hàng về kho"><i class="fa-solid fa-warehouse"></i></button>
                                <button class="icon-button complete-order-btn" title="Hoàn tất đơn hàng"><i
                                        class="fa-solid fa-check-double"></i></button> <button
                                    class="icon-button icon-edit" title="Sửa"><i
                                        class="fa-solid fa-pencil"></i></button> <button
                                    class="icon-button icon-danger" title="Xóa"><i
                                        class="fa-solid fa-trash-can"></i></button> <button
                                    class="icon-button icon-print" title="In"><i
                                        class="fa-solid fa-print"></i></button>
                            </td>
                        </tr>
                        <tr class="details-row" id="details-row-1" style="display: none;">
                            <td colspan="16">
                                <div class="details-inner-wrapper">
                                    <div class="order-details-content">
                                        <div class="detail-item"><span class="detail-label">REF
                                                Code:</span><span class="detail-value">3012659134</span></div>
                                        <div class="detail-item"><span class="detail-label">Tên sản
                                                phẩm:</span><span class="detail-value">Hàng cá nhân</span></div>
                                        <div class="detail-item"><span class="detail-label">SL
                                                kiện/gói:</span><span class="detail-value">1</span></div>
                                        <div class="detail-item"><span class="detail-label">Ảnh
                                                kiện:</span><span class="detail-value">
                                                <div class="image-modal-trigger"><img src="../images/kien1.jpg"
                                                        alt="Ảnh kiện"></div>
                                            </span></div>
                                        <div class="detail-item"><span class="detail-label">Cân
                                                nặng:</span><span class="detail-value">45 KG</span></div>
                                        <div class="detail-item"><span
                                                class="detail-label">Reweight:</span><span
                                                class="detail-value">42 KG</span></div>
                                        <div class="detail-item"><span class="detail-label">Cân nặng đại
                                                lý:</span><span class="detail-value">43 KG</span></div>
                                        <div class="detail-item full-width"><span class="detail-label">Ghi chú
                                                CPK:</span><span class="detail-value">Đóng kiện Pallet / Phí hải
                                                quan / Phụ phí đóng gói</span></div>
                                    </div>
                                    <div class="details-action-icons">
                                        <button class="icon-button icon-print" title="In chi tiết"><i
                                                class="fa-solid fa-print"></i></button>
                                        <button class="icon-button icon-excel" title="Xuất Excel"><i
                                                class="fa-solid fa-file-excel"></i></button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr id="main-row-2" class="clickable-row" data-order-id="MTE24081561614"
                            data-status="Nhận hàng">
                            <td><input type="checkbox" title="Select row 2"></td>
                            <td>2</td>
                            <td><a href="/order_detail" class="order-id-link">MTE24081561614</a></td>
                            <td>15/08/24</td>
                            <td>18/08/24</td>
                            <td><span class="status-badge status-received">Nhận hàng</span></td>
                            <td>Nhận hàng</td>
                            <td>Phan Thị M.M</td>
                            <td>Trần Q.Đ</td>
                            <td>FEDEX</td>
                            <td class="currency">3.198.840₫</td>
                            <td><span class="status-badge status-unpaid">Chưa thanh toán</span></td>
                            <td><span class="status-badge status-unpaid">Chưa thanh toán</span></td>
                            <td class="currency">159.942₫</td>
                            <td>Tân Phú</td>
                            <td class="action-icons"> <button class="icon-button receive-order-btn"
                                    title="Nhận hàng về kho"><i class="fa-solid fa-warehouse"></i></button>
                                <button class="icon-button complete-order-btn" title="Hoàn tất đơn hàng"><i
                                        class="fa-solid fa-check-double"></i></button> <button
                                    class="icon-button icon-edit" title="Sửa"><i
                                        class="fa-solid fa-pencil"></i></button> <button
                                    class="icon-button icon-danger" title="Xóa"><i
                                        class="fa-solid fa-trash-can"></i></button> <button
                                    class="icon-button icon-print" title="In"><i
                                        class="fa-solid fa-print"></i></button>
                            </td>
                        </tr>
                        <tr class="details-row" id="details-row-2" style="display: none;">
                            <td colspan="16">
                                <div class="details-inner-wrapper">
                                    <div class="order-details-content">
                                        <div class="detail-item"><span class="detail-label">REF
                                                Code:</span><span class="detail-value">3012659134</span></div>
                                        <div class="detail-item"><span class="detail-label">Tên sản
                                                phẩm:</span><span class="detail-value">Hàng cá nhân</span></div>
                                        <div class="detail-item"><span class="detail-label">SL
                                                kiện/gói:</span><span class="detail-value">1</span></div>
                                        <div class="detail-item"><span class="detail-label">Ảnh
                                                kiện:</span><span class="detail-value">
                                                <div class="image-modal-trigger"><img src="../images/kien1.jpg"
                                                        alt="Ảnh kiện"></div>
                                            </span></div>
                                        <div class="detail-item"><span class="detail-label">Cân
                                                nặng:</span><span class="detail-value">45 KG</span></div>
                                        <div class="detail-item"><span
                                                class="detail-label">Reweight:</span><span
                                                class="detail-value">42 KG</span></div>
                                        <div class="detail-item"><span class="detail-label">Cân nặng đại
                                                lý:</span><span class="detail-value">43 KG</span></div>
                                        <div class="detail-item full-width"><span class="detail-label">Ghi chú
                                                CPK:</span><span class="detail-value">Đóng kiện Pallet / Phí hải
                                                quan / Phụ phí đóng gói</span></div>
                                    </div>
                                    <div class="details-action-icons">
                                        <button class="icon-button icon-print" title="In chi tiết"><i
                                                class="fa-solid fa-print"></i></button>
                                        <button class="icon-button icon-excel" title="Xuất Excel"><i
                                                class="fa-solid fa-file-excel"></i></button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr id="main-row-3" class="clickable-row" data-order-id="MTE24081571255"
                            data-status="Mới tạo">
                            <td><input type="checkbox" title="Select row 3"></td>
                            <td>3</td>
                            <td><a href="/order_detail" class="order-id-link">MTE24081571255</a></td>
                            <td>16/08/24</td>
                            <td>19/08/24</td>
                            <td><span class="status-badge status-pending">Mới tạo</span></td>
                            <td>Mới tạo đơn</td>
                            <td>Nguyễn Văn A</td>
                            <td>SALE01</td>
                            <td>DHL</td>
                            <td class="currency">2.000.000₫</td>
                            <td><span class="status-badge status-paid">Đã thanh toán</span></td>
                            <td><span class="status-badge status-unpaid">Chưa thanh toán</span></td>
                            <td class="currency">100.000₫</td>
                            <td>Bình Tân</td>
                            <td class="action-icons"> <button class="icon-button receive-order-btn"
                                    title="Nhận hàng về kho"><i class="fa-solid fa-warehouse"></i></button>
                                <button class="icon-button complete-order-btn" title="Hoàn tất đơn hàng"><i
                                        class="fa-solid fa-check-double"></i></button> <button
                                    class="icon-button icon-edit" title="Sửa"><i
                                        class="fa-solid fa-pencil"></i></button> <button
                                    class="icon-button icon-danger" title="Xóa"><i
                                        class="fa-solid fa-trash-can"></i></button> <button
                                    class="icon-button icon-print" title="In"><i
                                        class="fa-solid fa-print"></i></button>
                            </td>
                        </tr>
                        <tr class="details-row" id="details-row-3" style="display: none;">
                            <td colspan="16">
                                <div class="details-inner-wrapper">
                                    <div class="order-details-content">
                                        <div class="detail-item"><span class="detail-label">REF
                                                Code:</span><span class="detail-value">3012659134</span></div>
                                        <div class="detail-item"><span class="detail-label">Tên sản
                                                phẩm:</span><span class="detail-value">Hàng cá nhân</span></div>
                                        <div class="detail-item"><span class="detail-label">SL
                                                kiện/gói:</span><span class="detail-value">1</span></div>
                                        <div class="detail-item"><span class="detail-label">Ảnh
                                                kiện:</span><span class="detail-value">
                                                <div class="image-modal-trigger"><img src="../images/kien1.jpg"
                                                        alt="Ảnh kiện"></div>
                                            </span></div>
                                        <div class="detail-item"><span class="detail-label">Cân
                                                nặng:</span><span class="detail-value">45 KG</span></div>
                                        <div class="detail-item"><span
                                                class="detail-label">Reweight:</span><span
                                                class="detail-value">42 KG</span></div>
                                        <div class="detail-item"><span class="detail-label">Cân nặng đại
                                                lý:</span><span class="detail-value">43 KG</span></div>
                                        <div class="detail-item full-width"><span class="detail-label">Ghi chú
                                                CPK:</span><span class="detail-value">Đóng kiện Pallet / Phí hải
                                                quan / Phụ phí đóng gói</span></div>
                                    </div>
                                    <div class="details-action-icons">
                                        <button class="icon-button icon-print" title="In chi tiết"><i
                                                class="fa-solid fa-print"></i></button>
                                        <button class="icon-button icon-excel" title="Xuất Excel"><i
                                                class="fa-solid fa-file-excel"></i></button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr id="main-row-4" class="clickable-row" data-order-id="MTE24081571256"
                            data-status="Nhận hàng">
                            <td><input type="checkbox" title="Select row 4"></td>
                            <td>4</td>
                            <td><a href="/order_detail" class="order-id-link">MTE24081571256</a></td>
                            <td>16/08/24</td>
                            <td>19/08/24</td>
                            <td><span class="status-badge status-received">Nhận hàng</span></td>
                            <td>Nhận hàng</td>
                            <td>Trần Văn B</td>
                            <td>SALE02</td>
                            <td>FEDEX</td>
                            <td class="currency">1.500.000₫</td>
                            <td><span class="status-badge status-unpaid">Chưa thanh toán</span></td>
                            <td><span class="status-badge status-paid">Đã thanh toán</span></td>
                            <td class="currency">80.000₫</td>
                            <td>Tân Phú</td>
                            <td class="action-icons"> <button class="icon-button receive-order-btn"
                                    title="Nhận hàng về kho"><i class="fa-solid fa-warehouse"></i></button>
                                <button class="icon-button complete-order-btn" title="Hoàn tất đơn hàng"><i
                                        class="fa-solid fa-check-double"></i></button> <button
                                    class="icon-button icon-edit" title="Sửa"><i
                                        class="fa-solid fa-pencil"></i></button> <button
                                    class="icon-button icon-danger" title="Xóa"><i
                                        class="fa-solid fa-trash-can"></i></button> <button
                                    class="icon-button icon-print" title="In"><i
                                        class="fa-solid fa-print"></i></button>
                            </td>
                        </tr>
                        <tr class="details-row" id="details-row-4" style="display: none;">
                            <td colspan="16">
                                <div class="details-inner-wrapper">
                                    <div class="order-details-content">
                                        <div class="detail-item"><span class="detail-label">REF
                                                Code:</span><span class="detail-value">3012659134</span></div>
                                        <div class="detail-item"><span class="detail-label">Tên sản
                                                phẩm:</span><span class="detail-value">Hàng cá nhân</span></div>
                                        <div class="detail-item"><span class="detail-label">SL
                                                kiện/gói:</span><span class="detail-value">1</span></div>
                                        <div class="detail-item"><span class="detail-label">Ảnh
                                                kiện:</span><span class="detail-value">
                                                <div class="image-modal-trigger"><img src="../images/kien1.jpg"
                                                        alt="Ảnh kiện"></div>
                                            </span></div>
                                        <div class="detail-item"><span class="detail-label">Cân
                                                nặng:</span><span class="detail-value">45 KG</span></div>
                                        <div class="detail-item"><span
                                                class="detail-label">Reweight:</span><span
                                                class="detail-value">42 KG</span></div>
                                        <div class="detail-item"><span class="detail-label">Cân nặng đại
                                                lý:</span><span class="detail-value">43 KG</span></div>
                                        <div class="detail-item full-width"><span class="detail-label">Ghi chú
                                                CPK:</span><span class="detail-value">Đóng kiện Pallet / Phí hải
                                                quan / Phụ phí đóng gói</span></div>
                                    </div>
                                    <div class="details-action-icons">
                                        <button class="icon-button icon-print" title="In chi tiết"><i
                                                class="fa-solid fa-print"></i></button>
                                        <button class="icon-button icon-excel" title="Xuất Excel"><i
                                                class="fa-solid fa-file-excel"></i></button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr id="main-row-5" class="clickable-row" data-order-id="MTE24081571257"
                            data-status="Đang phát">
                            <td><input type="checkbox" title="Select row 5"></td>
                            <td>5</td>
                            <td><a href="/order_detail" class="order-id-link">MTE24081571257</a></td>
                            <td>17/08/24</td>
                            <td>20/08/24</td>
                            <td><span class="status-badge status-processing">Đang phát hàng</span></td>
                            <td>Đang phát hàng</td>
                            <td>Lê Thị C</td>
                            <td>SALE01</td>
                            <td>VNPost</td>
                            <td class="currency">1.800.000₫</td>
                            <td><span class="status-badge status-paid">Đã thanh toán</span></td>
                            <td><span class="status-badge status-unpaid">Chưa thanh toán</span></td>
                            <td class="currency">90.000₫</td>
                            <td>Bình Tân</td>
                            <td class="action-icons"> <button class="icon-button receive-order-btn"
                                    title="Nhận hàng về kho"><i class="fa-solid fa-warehouse"></i></button>
                                <button class="icon-button complete-order-btn" title="Hoàn tất đơn hàng"><i
                                        class="fa-solid fa-check-double"></i></button> <button
                                    class="icon-button icon-edit" title="Sửa"><i
                                        class="fa-solid fa-pencil"></i></button> <button
                                    class="icon-button icon-danger" title="Xóa"><i
                                        class="fa-solid fa-trash-can"></i></button> <button
                                    class="icon-button icon-print" title="In"><i
                                        class="fa-solid fa-print"></i></button>
                            </td>
                        </tr>
                        <tr class="details-row" id="details-row-5" style="display: none;">
                            <td colspan="16">
                                <div class="details-inner-wrapper">
                                    <div class="order-details-content">
                                        <div class="detail-item"><span class="detail-label">REF
                                                Code:</span><span class="detail-value">3012659134</span></div>
                                        <div class="detail-item"><span class="detail-label">Tên sản
                                                phẩm:</span><span class="detail-value">Hàng cá nhân</span></div>
                                        <div class="detail-item"><span class="detail-label">SL
                                                kiện/gói:</span><span class="detail-value">1</span></div>
                                        <div class="detail-item"><span class="detail-label">Ảnh
                                                kiện:</span><span class="detail-value">
                                                <div class="image-modal-trigger"><img src="../images/kien1.jpg"
                                                        alt="Ảnh kiện"></div>
                                            </span></div>
                                        <div class="detail-item"><span class="detail-label">Cân
                                                nặng:</span><span class="detail-value">45 KG</span></div>
                                        <div class="detail-item"><span
                                                class="detail-label">Reweight:</span><span
                                                class="detail-value">42 KG</span></div>
                                        <div class="detail-item"><span class="detail-label">Cân nặng đại
                                                lý:</span><span class="detail-value">43 KG</span></div>
                                        <div class="detail-item full-width"><span class="detail-label">Ghi chú
                                                CPK:</span><span class="detail-value">Đóng kiện Pallet / Phí hải
                                                quan / Phụ phí đóng gói</span></div>
                                    </div>
                                    <div class="details-action-icons">
                                        <button class="icon-button icon-print" title="In chi tiết"><i
                                                class="fa-solid fa-print"></i></button>
                                        <button class="icon-button icon-excel" title="Xuất Excel"><i
                                                class="fa-solid fa-file-excel"></i></button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr id="main-row-6" class="clickable-row" data-order-id="MTE24081571258"
                            data-status="Hoàn tất">
                            <td><input type="checkbox" title="Select row 6"></td>
                            <td>6</td>
                            <td><a href="/order_detail" class="order-id-link">MTE24081571258</a></td>
                            <td>17/08/24</td>
                            <td>20/08/24</td>
                            <td><span class="status-badge status-completed">Hoàn tất</span></td>
                            <td>Hoàn tất</td>
                            <td>Phạm Văn D</td>
                            <td>SALE02</td>
                            <td>J&T</td>
                            <td class="currency">2.200.000₫</td>
                            <td><span class="status-badge status-paid">Đã thanh toán</span></td>
                            <td><span class="status-badge status-paid">Đã thanh toán</span></td>
                            <td class="currency">120.000₫</td>
                            <td>Tân Phú</td>
                            <td class="action-icons"> <button class="icon-button receive-order-btn"
                                    title="Nhận hàng về kho"><i class="fa-solid fa-warehouse"></i></button>
                                <button class="icon-button complete-order-btn" title="Hoàn tất đơn hàng"><i
                                        class="fa-solid fa-check-double"></i></button> <button
                                    class="icon-button icon-edit" title="Sửa"><i
                                        class="fa-solid fa-pencil"></i></button> <button
                                    class="icon-button icon-danger" title="Xóa"><i
                                        class="fa-solid fa-trash-can"></i></button> <button
                                    class="icon-button icon-print" title="In"><i
                                        class="fa-solid fa-print"></i></button>
                            </td>
                        </tr>
                        <tr class="details-row" id="details-row-6" style="display: none;">
                            <td colspan="16">
                                <div class="details-inner-wrapper">
                                    <div class="order-details-content">
                                        <div class="detail-item"><span class="detail-label">REF
                                                Code:</span><span class="detail-value">3012659134</span></div>
                                        <div class="detail-item"><span class="detail-label">Tên sản
                                                phẩm:</span><span class="detail-value">Hàng cá nhân</span></div>
                                        <div class="detail-item"><span class="detail-label">SL
                                                kiện/gói:</span><span class="detail-value">1</span></div>
                                        <div class="detail-item"><span class="detail-label">Ảnh
                                                kiện:</span><span class="detail-value">
                                                <div class="image-modal-trigger"><img src="../images/kien1.jpg"
                                                        alt="Ảnh kiện"></div>
                                            </span></div>
                                        <div class="detail-item"><span class="detail-label">Cân
                                                nặng:</span><span class="detail-value">45 KG</span></div>
                                        <div class="detail-item"><span
                                                class="detail-label">Reweight:</span><span
                                                class="detail-value">42 KG</span></div>
                                        <div class="detail-item"><span class="detail-label">Cân nặng đại
                                                lý:</span><span class="detail-value">43 KG</span></div>
                                        <div class="detail-item full-width"><span class="detail-label">Ghi chú
                                                CPK:</span><span class="detail-value">Đóng kiện Pallet / Phí hải
                                                quan / Phụ phí đóng gói</span></div>
                                    </div>
                                    <div class="details-action-icons">
                                        <button class="icon-button icon-print" title="In chi tiết"><i
                                                class="fa-solid fa-print"></i></button>
                                        <button class="icon-button icon-excel" title="Xuất Excel"><i
                                                class="fa-solid fa-file-excel"></i></button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr id="main-row-7" class="clickable-row" data-order-id="MTE24081571259"
                            data-status="Hủy">
                            <td><input type="checkbox" title="Select row 7"></td>
                            <td>7</td>
                            <td><a href="/order_detail" class="order-id-link">MTE24081571259</a></td>
                            <td>18/08/24</td>
                            <td>21/08/24</td>
                            <td><span class="status-badge status-cancelled">Hủy</span></td>
                            <td>Hủy</td>
                            <td>Ngô Thị E</td>
                            <td>SALE01</td>
                            <td>GHN</td>
                            <td class="currency">1.000.000₫</td>
                            <td><span class="status-badge status-unpaid">Chưa thanh toán</span></td>
                            <td><span class="status-badge status-unpaid">Chưa thanh toán</span></td>
                            <td class="currency">50.000₫</td>
                            <td>Bình Tân</td>
                            <td class="action-icons"> <button class="icon-button receive-order-btn"
                                    title="Nhận hàng về kho"><i class="fa-solid fa-warehouse"></i></button>
                                <button class="icon-button complete-order-btn" title="Hoàn tất đơn hàng"><i
                                        class="fa-solid fa-check-double"></i></button> <button
                                    class="icon-button icon-edit" title="Sửa"><i
                                        class="fa-solid fa-pencil"></i></button> <button
                                    class="icon-button icon-danger" title="Xóa"><i
                                        class="fa-solid fa-trash-can"></i></button> <button
                                    class="icon-button icon-print" title="In"><i
                                        class="fa-solid fa-print"></i></button>
                            </td>
                        </tr>
                        <tr class="details-row" id="details-row-7" style="display: none;">
                            <td colspan="16">
                                <div class="details-inner-wrapper">
                                    <div class="order-details-content">
                                        <div class="detail-item"><span class="detail-label">REF
                                                Code:</span><span class="detail-value">3012659134</span></div>
                                        <div class="detail-item"><span class="detail-label">Tên sản
                                                phẩm:</span><span class="detail-value">Hàng cá nhân</span></div>
                                        <div class="detail-item"><span class="detail-label">SL
                                                kiện/gói:</span><span class="detail-value">1</span></div>
                                        <div class="detail-item"><span class="detail-label">Ảnh
                                                kiện:</span><span class="detail-value">
                                                <div class="image-modal-trigger"><img src="../images/kien1.jpg"
                                                        alt="Ảnh kiện"></div>
                                            </span></div>
                                        <div class="detail-item"><span class="detail-label">Cân
                                                nặng:</span><span class="detail-value">45 KG</span></div>
                                        <div class="detail-item"><span
                                                class="detail-label">Reweight:</span><span
                                                class="detail-value">42 KG</span></div>
                                        <div class="detail-item"><span class="detail-label">Cân nặng đại
                                                lý:</span><span class="detail-value">43 KG</span></div>
                                        <div class="detail-item full-width"><span class="detail-label">Ghi chú
                                                CPK:</span><span class="detail-value">Đóng kiện Pallet / Phí hải
                                                quan / Phụ phí đóng gói</span></div>
                                    </div>
                                    <div class="details-action-icons">
                                        <button class="icon-button icon-print" title="In chi tiết"><i
                                                class="fa-solid fa-print"></i></button>
                                        <button class="icon-button icon-excel" title="Xuất Excel"><i
                                                class="fa-solid fa-file-excel"></i></button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr id="main-row-8" class="clickable-row" data-order-id="MTE24081571260"
                            data-status="Lỗi">
                            <td><input type="checkbox" title="Select row 8"></td>
                            <td>8</td>
                            <td><a href="/order_detail" class="order-id-link">MTE24081571260</a></td>
                            <td>18/08/24</td>
                            <td>21/08/24</td>
                            <td><span class="status-badge status-unpaid">Lỗi</span></td>
                            <td>Lỗi</td>
                            <td>Đặng Văn F</td>
                            <td>SALE02</td>
                            <td>VNPost</td>
                            <td class="currency">1.200.000₫</td>
                            <td><span class="status-badge status-unpaid">Chưa thanh toán</span></td>
                            <td><span class="status-badge status-unpaid">Chưa thanh toán</span></td>
                            <td class="currency">60.000₫</td>
                            <td>Tân Phú</td>
                            <td class="action-icons"> <button class="icon-button receive-order-btn"
                                    title="Nhận hàng về kho"><i class="fa-solid fa-warehouse"></i></button>
                                <button class="icon-button complete-order-btn" title="Hoàn tất đơn hàng"><i
                                        class="fa-solid fa-check-double"></i></button> <button
                                    class="icon-button icon-edit" title="Sửa"><i
                                        class="fa-solid fa-pencil"></i></button> <button
                                    class="icon-button icon-danger" title="Xóa"><i
                                        class="fa-solid fa-trash-can"></i></button> <button
                                    class="icon-button icon-print" title="In"><i
                                        class="fa-solid fa-print"></i></button>
                            </td>
                        </tr>
                        <tr class="details-row" id="details-row-8" style="display: none;">
                            <td colspan="16">
                                <div class="details-inner-wrapper">
                                    <div class="order-details-content">
                                        <div class="detail-item"><span class="detail-label">REF
                                                Code:</span><span class="detail-value">3012659134</span></div>
                                        <div class="detail-item"><span class="detail-label">Tên sản
                                                phẩm:</span><span class="detail-value">Hàng cá nhân</span></div>
                                        <div class="detail-item"><span class="detail-label">SL
                                                kiện/gói:</span><span class="detail-value">1</span></div>
                                        <div class="detail-item"><span class="detail-label">Ảnh
                                                kiện:</span><span class="detail-value">
                                                <div class="image-modal-trigger"><img src="../images/kien1.jpg"
                                                        alt="Ảnh kiện"></div>
                                            </span></div>
                                        <div class="detail-item"><span class="detail-label">Cân
                                                nặng:</span><span class="detail-value">45 KG</span></div>
                                        <div class="detail-item"><span
                                                class="detail-label">Reweight:</span><span
                                                class="detail-value">42 KG</span></div>
                                        <div class="detail-item"><span class="detail-label">Cân nặng đại
                                                lý:</span><span class="detail-value">43 KG</span></div>
                                        <div class="detail-item full-width"><span class="detail-label">Ghi chú
                                                CPK:</span><span class="detail-value">Đóng kiện Pallet / Phí hải
                                                quan / Phụ phí đóng gói</span></div>
                                    </div>
                                    <div class="details-action-icons">
                                        <button class="icon-button icon-print" title="In chi tiết"><i
                                                class="fa-solid fa-print"></i></button>
                                        <button class="icon-button icon-excel" title="Xuất Excel"><i
                                                class="fa-solid fa-file-excel"></i></button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <nav class="pagination" aria-label="Table navigation">
            <span class="pagination-info">Hiển thị <b id="start-index">1</b> cho tới <b id="end-index">8</b> của
                <b id="total-entries">127</b> Đơn hàng</span>
            <div class="pagination-buttons">
                <div class="items-per-page-control">
                    <select id="items-per-page-select" class="form-select">
                        <option value="8">8</option>
                        <option value="10">10</option>
                        <option value="20">20</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                    <span>đơn hàng/trang</span>
                </div>
                <div class="pagination-nav-buttons">
                    <button class="button" id="prev-page" disabled>Trước</button>
                    <div id="page-numbers" class="page-numbers"></div>
                    <button class="button" id="next-page">Sau</button>
                </div>
            </div>
        </nav>
    </section>
</div>
@endsection

@section('notification')
<div id="pickup-orders-list"></div>

<div class="filter-modal" id="filter-modal">
    <div class="filter-modal-content card">
        <div class="filter-modal-header">
            <h3><i class="fa-solid fa-filter"></i> Bộ lọc đơn hàng</h3>
            <button class="filter-modal-close-btn icon-button" aria-label="Close Filters"> <i
                    class="fa-solid fa-xmark"></i> </button>
        </div>
        <div class="filter-modal-body">
            <div class="filter-group date-range"><label for="modal-date-start">Date Range</label><input type="date"
                    id="modal-date-start" title="From Date" placeholder="yyyy-mm-dd"><span>→</span><input type="date"
                    id="modal-date-end" title="To Date" placeholder="yyyy-mm-dd"></div>
            <div class="filter-group"><label for="modal-filter-status">Status</label><select id="modal-filter-status"
                    title="Filter by status">
                    <option value="">Tất cả trạng thái</option>
                    <option>Mới tạo đơn</option>
                    <option>Đã nhận hàng</option>
                    <option>Đang phát hàng</option>
                    <option>Hoàn tất</option>
                    <option>Hủy</option>
                    <option>Lỗi</option>
                    <option>Chuyển hoàn</option>
                </select></div>
            <div class="filter-group"><label for="modal-filter-data">Data Filter</label><select id="modal-filter-data"
                    title="Data Filter">
                    <option>Lọc dữ liệu</option>
                </select></div>
            <div class="filter-group"><label for="modal-filter-sale">Sales Rep</label><select id="modal-filter-sale"
                    title="Select Sales Rep">
                    <option value="">Tất cả Sale</option>
                    <option>SALE01 - P.H. Đình</option>
                    <option>SALE02 - N.V. An</option>
                </select></div>
            <div class="filter-group"><label for="modal-filter-branch">Branch</label><select id="modal-filter-branch"
                    title="Select Branch">
                    <option value="">Tất cả chi nhánh</option>
                    <option>CN: Tân Phú</option>
                    <option>CN: Bình Tân</option>
                </select></div>
            <div class="filter-group"><label for="modal-filter-customer">Customer</label><select
                    id="modal-filter-customer" title="Select Customer">
                    <option value="">Tất cả khách hàng</option>
                    <option>Alice</option>
                </select></div>
            <div class="filter-group filter-search"><label for="modal-filter-search-input">Search</label>
                <div class="search-input-wrapper"><i class="fa-solid fa-magnifying-glass"></i><input type="text"
                        id="modal-filter-search-input" placeholder="Order ID, Customer..."></div>
            </div>
        </div>
        <div class="filter-modal-footer">
            <button class="button secondary" id="modal-reset-filter-btn">Reset</button>
            <button class="button primary" id="modal-apply-filter-btn">Áp dụng</button>
        </div>
    </div>
</div>

<div class="confirmation-modal" id="complete-order-modal">
    <div class="modal-content">
        <div class="modal-header"> <i class="fa-solid fa-triangle-exclamation"></i> <span>Xác nhận Hoàn Tất</span>
        </div>
        <div class="modal-body">
            <div class="confirmation-body-content"> <i class="fa-solid fa-check-circle confirmation-icon"
                    style="color: var(--confirm-color)"></i>
                <div class="confirmation-text">
                    <p>Bạn xác nhận <strong class="modal-target-count"></strong> đơn hàng đã <strong
                            class="highlight-confirm">hoàn tất</strong> và cập nhật đầy đủ thông tin?</p>
                    <p class="modal-target-ids"></p>
                </div>
            </div>
        </div>
        <div class="modal-footer"> <button class="button confirm-cancel">Hủy</button> <button
                class="button confirm-yes confirm">Có, tôi xác nhận</button> </div>
    </div>
</div>
<div class="confirmation-modal" id="cancel-order-modal">
    <div class="modal-content">
        <div class="modal-header" style="background-color: var(--warning-color);"> <i
                class="fa-solid fa-triangle-exclamation"></i> <span>Xác nhận Hủy Đơn</span> </div>
        <div class="modal-body">
            <div class="confirmation-body-content"> <i class="fa-solid fa-ban confirmation-icon"
                    style="color: var(--warning-color)"></i>
                <div class="confirmation-text">
                    <p>Bạn xác nhận muốn <strong class="highlight-cancel">Hủy</strong> <strong
                            class="modal-target-count"></strong> đơn hàng này?</p>
                    <p class="modal-target-ids"></p>
                    <p style="font-size: 0.85em; color: var(--danger-color); margin-top: 5px;">Hành động này có thể
                        không thể hoàn tác.</p>
                </div>
            </div>
        </div>
        <div class="modal-footer"> <button class="button confirm-cancel">Không hủy</button> <button
                class="button confirm-yes warning">Có, Hủy đơn</button> </div>
    </div>
</div>
<div class="confirmation-modal" id="receive-order-modal">
    <div class="modal-content">
        <div class="modal-header" style="background-color: var(--receive-color);"> <i
                class="fa-solid fa-triangle-exclamation"></i> <span>Xác nhận Nhận Hàng</span> </div>
        <div class="modal-body">
            <div class="confirmation-body-content"> <i class="fa-solid fa-warehouse confirmation-icon"
                    style="color: var(--receive-color)"></i>
                <div class="confirmation-text">
                    <p>Bạn xác nhận <strong class="modal-target-count"></strong> đơn hàng này đã được <strong
                            class="highlight-receive">nhận hàng về kho</strong>?</p>
                    <p class="modal-target-ids"></p>
                </div>
            </div>
        </div>
        <div class="modal-footer"> <button class="button confirm-cancel">Hủy</button> <button
                class="button confirm-yes primary">Có, đã nhận</button> </div>
    </div>
</div>
<div class="confirmation-modal" id="delete-order-modal">
    <div class="modal-content">
        <div class="modal-header" style="background-color: var(--danger-color);"> <i
                class="fa-solid fa-triangle-exclamation"></i> <span>Xác nhận Xuất Kho</span> </div>
        <div class="modal-body">
            <div class="confirmation-body-content"> <i class="fa-solid fa-box-archive confirmation-icon"
                    style="color: var(--danger-color)"></i>
                <div class="confirmation-text">
                    <p>Bạn xác nhận <strong class="modal-target-count"></strong> đơn hàng này đã đủ điều kiện
                        <strong class="highlight-confirm">Xuất kho</strong>?
                    </p>
                    <p class="modal-target-ids"></p>
                    <p style="font-size: 0.9em; color: var(--danger-color); margin-top: 10px; font-weight: bold;">
                        HÀNH ĐỘNG NÀY KHÔNG THỂ HOÀN TÁC!</p>
                </div>
            </div>
        </div>
        <div class="modal-footer"> <button class="button confirm-cancel">Không xuất kho</button> <button
                class="button confirm-yes danger">Có, Xuất kho</button> </div>
    </div>
</div>
<div class="announcement-overlay" id="announcement-overlay">
    <div class="announcement-box" id="announcement-box">
        <div class="announcement-header">
            <h3 id="announcement-title">Tiêu đề thông báo</h3>
            <button class="announcement-close-btn" id="announcement-close-btn" title="Đóng thông báo">×</button>
        </div>
        <div class="announcement-body" id="announcement-body">
            Nội dung chi tiết của thông báo sẽ được hiển thị ở đây.
        </div>
        <div class="announcement-footer">
            <span id="announcement-timestamp">Thời gian</span>
        </div>
    </div>
</div>

<!-- Image Modal Structure -->
<div class="image-modal-overlay" id="image-modal-overlay">
    <div class="image-modal-content">
        <img src="" alt="Larger package image" id="large-package-image">
        <button class="image-modal-close-btn" id="image-modal-close-btn">&times;</button>
    </div>
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
        const desktopSidebarToggleBtn = document.querySelector('.sidebar-toggle-desktop');
        const filterModal = document.getElementById('filter-modal');
        const mobileFilterToggleBtn = document.getElementById('mobile-filter-toggle');
        const orderTableBody = document.getElementById('order-table-body');
        const selectAllCheckbox = document.getElementById('select-all-checkbox');
        const mainConfirmBulkBtn = document.getElementById('main-confirm-bulk-button');
        const mainCancelBulkBtn = document.getElementById('main-cancel-bulk-button');
        const mainDeleteBulkBtn = document.getElementById('main-delete-bulk-button');
        const desktopApplyFilterBtn = document.getElementById('desktop-apply-filter-btn');
        const modalApplyFilterBtn = document.getElementById('modal-apply-filter-btn');
        const modalResetFilterBtn = document.getElementById('modal-reset-filter-btn');
        const currentDateSpan = document.getElementById('current-date');
        const currentTimeSpan = document.getElementById('current-time');
        const currentYearSpan = document.getElementById('current-year');
        const fullscreenBtn = document.getElementById('fullscreen-btn');
        const imageModalOverlay = document.getElementById('image-modal-overlay');
        const largePackageImage = document.getElementById('large-package-image');
        const imageModalCloseBtn = document.getElementById('image-modal-close-btn');
        const notificationButton = document.getElementById('notification-button');
        const notificationDropdown = document.getElementById('notification-dropdown');
        const notificationList = document.getElementById('notification-list');
        const announcementOverlay = document.getElementById('announcement-overlay');
        const announcementCloseBtn = document.getElementById('announcement-close-btn');
        const announcementTitle = document.getElementById('announcement-title');
        const announcementBodyEl = document.getElementById('announcement-body');
        const announcementTimestamp = document.getElementById('announcement-timestamp');

        let filteredRows = [];
        let currentPage = 1;
        let itemsPerPage = 8;
        let totalPages = 0;

        // Hàm tiện ích
        const debounce = (func, wait) => {
            let timeout;
            return (...args) => {
                clearTimeout(timeout);
                timeout = setTimeout(() => func(...args), wait);
            };
        };

        const isElementVisible = (el) => el && !el.hasAttribute('hidden') && el.offsetParent !== null;

        const manageBodyScroll = () => {
            const isSidebarOpen = body.classList.contains('sidebar-mobile-open');
            const isAnyModalVisible = document.querySelector('.filter-modal.visible, .confirmation-modal.visible');
            const isImageModalVisible = imageModalOverlay?.classList.contains('visible');
            body.classList.toggle('overflow-hidden', isSidebarOpen || isAnyModalVisible || isImageModalVisible);
        };

        // Sidebar (loại bỏ logic submenu)
        const toggleSidebarMobileOrDesktop = () => {
            if (window.innerWidth > 768) body.classList.toggle('sidebar-collapsed');
            else {
                body.classList.toggle('sidebar-mobile-open');
                mobileSidebarToggleBtn?.setAttribute('aria-expanded', String(body.classList.contains('sidebar-mobile-open')));
            }
            manageBodyScroll();
        };

        const toggleSidebarDesktop = () => {
            body.classList.toggle('sidebar-collapsed');
            const isCollapsed = body.classList.contains('sidebar-collapsed');
            if (desktopSidebarToggleBtn) desktopSidebarToggleBtn.title = isCollapsed ? 'Phóng Sidebar' : 'Thu Sidebar';
        };

        // Filter
        const toggleFilterModal = () => {
            filterModal?.classList.toggle('visible');
            manageBodyScroll();
        };

        const applyFilters = (source, statusTab) => {
            const formPrefix = source === 'modal' ? 'modal-' : '';
            const dateStart = (source !== 'tab' && source !== 'mobile-select') ? document.getElementById(`${formPrefix}date-start`)?.value : '';
            const dateEnd = (source !== 'tab' && source !== 'mobile-select') ? document.getElementById(`${formPrefix}date-end`)?.value : '';
            let filterStatus = statusTab && statusTab !== 'Tất cả' ? statusTab : (source !== 'tab' && source !== 'mobile-select') ? document.getElementById(`${formPrefix}filter-status`)?.value : '';
            const sale = (source !== 'tab' && source !== 'mobile-select') ? document.getElementById(`${formPrefix}filter-sale`)?.value : '';
            const customer = (source !== 'tab' && source !== 'mobile-select') ? document.getElementById(`${formPrefix}filter-customer`)?.value : '';
            const branch = (source !== 'tab' && source !== 'mobile-select') ? document.getElementById(`${formPrefix}filter-branch`)?.value : '';
            const search = document.getElementById(`${formPrefix}filter-search-input`)?.value?.toLowerCase().trim();

            const normalizeText = (text) => text.toLowerCase().normalize('NFD').replace(/[\u0300-\u036f]/g, '').replace(/\s+/g, ' ').trim();
            const normalizeStatus = (status) => status?.trim() === 'Đã nhận hàng' ? 'Nhận hàng' : status?.trim() === 'Mới tạo đơn' ? 'Mới tạo' : status?.trim() === 'Đang phát hàng' ? 'Đang phát' : status?.trim() || '';
            const compareDates = (dateStr, startDate, endDate) => {
                if (!dateStr) return true;
                let [d, m, y] = dateStr.split('/');
                if (y.length === 2) y = '20' + y;
                const rowDate = new Date(`${y}-${m}-${d}`);
                if (startDate && rowDate < new Date(startDate)) return false;
                if (endDate && rowDate > new Date(endDate)) return false;
                return true;
            };

            filteredRows = Array.from(orderTableBody.querySelectorAll('tr.clickable-row')).filter(row => {
                let show = true;
                if (filterStatus && filterStatus !== 'Tất cả') {
                    const rowStatus = normalizeStatus(row.getAttribute('data-status'));
                    if (rowStatus !== normalizeStatus(filterStatus)) show = false;
                }
                if (show && sale && sale !== '') {
                    const saleCell = row.children[8]?.textContent || '';
                    if (!saleCell.includes(sale.split(' - ')[0].trim())) show = false;
                }
                if (show && customer && customer !== '') {
                    const customerCell = row.children[7]?.textContent || '';
                    const searchTerms = normalizeText(customer).split(' ').filter(term => term.length > 0);
                    if (!searchTerms.every(term => normalizeText(customerCell).includes(term))) show = false;
                }
                if (show && branch && branch !== '') {
                    const branchCell = row.children[14]?.textContent || '';
                    if (branchCell !== branch.replace('CN: ', '').trim()) show = false;
                }
                if (show && (dateStart || dateEnd)) {
                    const dateCell = row.children[3]?.textContent || '';
                    if (!compareDates(dateCell, dateStart, dateEnd)) show = false;
                }
                if (show && search && search.length > 0) {
                    const searchTerms = search.split(' ').filter(term => term.length > 0);
                    const cellsToSearch = [row.children[2]?.textContent, row.children[7]?.textContent, row.children[8]?.textContent, row.children[9]?.textContent].map(normalizeText);
                    if (!searchTerms.every(term => cellsToSearch.some(cell => cell.includes(term)))) show = false;
                }
                return show;
            });

            currentPage = 1;
            updatePagination();
            goToPage(currentPage);
            updateTabCounts();
            if (source === 'modal') toggleFilterModal();
        };

        const resetFilters = (source) => {
            const formContainer = source === 'modal' ? filterModal?.querySelector('.filter-modal-body') : document.querySelector('.filter-controls-desktop');
            if (formContainer) {
                formContainer.querySelectorAll('input:not([type="radio"]):not([type="checkbox"]), select').forEach(el => el.tagName === 'SELECT' ? el.selectedIndex = 0 : el.value = '');
                formContainer.querySelectorAll('input[type="radio"], input[type="checkbox"]').forEach(el => el.checked = false);
            }
            applyFilters(source);
        };

        // Order details
        const showOrderDetails = (rowElement) => {
            const detailsRowId = 'details-row-' + rowElement.id.substring('main-row-'.length);
            const detailsRow = document.getElementById(detailsRowId);
            if (!detailsRow) return;
            const isCurrentlyActive = rowElement.classList.contains('active');
            const currentlyVisibleDetails = document.querySelector('tbody tr.details-row[style*="display: table-row"]');
            if (currentlyVisibleDetails && currentlyVisibleDetails !== detailsRow) {
                currentlyVisibleDetails.style.display = 'none';
                document.getElementById('main-row-' + currentlyVisibleDetails.id.substring('details-row-'.length))?.classList.remove('active');
            }
            rowElement.classList.toggle('active', !isCurrentlyActive);
            detailsRow.style.display = !isCurrentlyActive ? 'table-row' : 'none';
        };

        const showConfirmationModal = (modalId, targetIds = []) => {
            const modal = document.getElementById(modalId);
            if (!modal) return;
            modal.dataset.targetIds = JSON.stringify(targetIds);
            modal.querySelector('.modal-target-count').textContent = targetIds.length > 1 ? `${targetIds.length}` : '1';
            const idsElement = modal.querySelector('.modal-target-ids');
            if (idsElement) {
                idsElement.textContent = targetIds.length > 0 ? `ID(s): ${targetIds.join(', ')}` : '';
                idsElement.style.display = targetIds.length > 0 ? 'block' : 'none';
            }
            modal.classList.add('visible');
            manageBodyScroll();
        };

        const hideConfirmationModal = (modalId) => {
            const modal = document.getElementById(modalId);
            if (modal) {
                delete modal.dataset.targetIds;
                modal.classList.remove('visible');
                manageBodyScroll();
            }
        };

        const getSelectedOrderIds = () => Array.from(orderTableBody?.querySelectorAll('tr:not(.details-row) > td:first-child input[type="checkbox"]:checked') || []).map(cb => cb.closest('tr.clickable-row')?.dataset.orderId).filter(Boolean);

        const handleSelectAll = () => {
            if (!orderTableBody || !selectAllCheckbox) return;
            orderTableBody.querySelectorAll('tr:not(.details-row) > td:first-child input[type="checkbox"]').forEach(checkbox => checkbox.checked = selectAllCheckbox.checked);
        };

        const checkSelectAllState = () => {
            if (!orderTableBody || !selectAllCheckbox) return;
            const rowCheckboxes = orderTableBody.querySelectorAll('tr:not(.details-row) > td:first-child input[type="checkbox"]');
            const checkedRows = Array.from(rowCheckboxes).filter(cb => cb.checked).length;
            selectAllCheckbox.checked = checkedRows === rowCheckboxes.length;
            selectAllCheckbox.indeterminate = checkedRows > 0 && checkedRows < rowCheckboxes.length;
        };

        // Date và fullscreen
        const updateDateTime = () => {
            const now = new Date();
            if (currentDateSpan) currentDateSpan.textContent = now.toLocaleDateString('en-GB', { weekday: 'short', day: '2-digit', month: '2-digit', year: 'numeric' }).replace(/,/g, '');
            if (currentTimeSpan) currentTimeSpan.textContent = now.toLocaleTimeString('en-US', { hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: true });
            if (currentYearSpan) currentYearSpan.textContent = now.getFullYear();
        };

        const toggleFullscreen = () => {
            if (!document.fullscreenElement) document.documentElement.requestFullscreen().catch(err => console.error(err));
            else document.exitFullscreen();
        };

        const handleFullscreenChange = () => {
            const isFullscreen = !!document.fullscreenElement;
            const icon = fullscreenBtn?.querySelector('i');
            if (icon) {
                icon.classList.toggle('fa-expand', !isFullscreen);
                icon.classList.toggle('fa-compress', isFullscreen);
            }
            if (fullscreenBtn) fullscreenBtn.setAttribute('title', isFullscreen ? 'Exit Fullscreen' : 'Fullscreen');
        };

        // Notification và announcement
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

        // Image modal
        const showImageModal = (imageUrl) => {
            if (imageModalOverlay && largePackageImage) {
                largePackageImage.src = imageUrl;
                imageModalOverlay.classList.add('visible');
                manageBodyScroll();
            }
        };
        const hideImageModal = () => {
            imageModalOverlay?.classList.remove('visible');
            manageBodyScroll();
        };

        // Order status
        const updateOrderStatus = (orderIds, newStatus, badgeClass, statusText, dlttText) => {
            orderIds.forEach(orderId => {
                const row = document.querySelector(`tr.clickable-row[data-order-id="${orderId}"]`);
                if (row) {
                    row.setAttribute('data-status', newStatus);
                    row.children[5].innerHTML = `<span class="status-badge ${badgeClass}">${statusText}</span>`;
                    row.children[6].textContent = newStatus;
                    const dlttCell = row.children[13];
                    if (dlttCell) dlttCell.innerHTML = dlttText === 'Paid' || dlttText === 'Đã thanh toán' || dlttText === 'Đã thanh toán đủ' ? '<span class="status-badge status-paid">Đã thanh toán</span>' : dlttText === 'Unpaid' || dlttText === 'Chưa thanh toán' ? '<span class="status-badge status-unpaid">Chưa thanh toán</span>' : dlttText === 'Thanh toán một phần' ? '<span class="status-badge status-warning">Thanh toán một phần</span>' : dlttText === 'Đã nhận' ? '<span class="status-badge status-received">Đã nhận</span>' : dlttText === 'Hủy' ? '<span class="status-badge status-cancelled">Hủy</span>' : dlttText;
                }
            });
            updateTabCounts();
        };

        // Pagination
        const handleItemsPerPageChange = () => {
            const select = document.getElementById('items-per-page-select');
            if (select) {
                itemsPerPage = parseInt(select.value);
                currentPage = 1;
                updatePagination();
                goToPage(1);
            }
        };

        const updatePagination = () => {
            totalPages = Math.ceil(filteredRows.length / itemsPerPage);
            const startIndex = filteredRows.length ? (currentPage - 1) * itemsPerPage + 1 : 0;
            const endIndex = Math.min(currentPage * itemsPerPage, filteredRows.length);
            document.getElementById('start-index').textContent = startIndex;
            document.getElementById('end-index').textContent = endIndex;
            document.getElementById('total-entries').textContent = filteredRows.length;
            document.getElementById('prev-page').disabled = currentPage === 1 || !filteredRows.length;
            document.getElementById('next-page').disabled = currentPage === totalPages || !filteredRows.length;
            const pageNumbers = document.getElementById('page-numbers');
            pageNumbers.innerHTML = '';
            let startPage = Math.max(1, currentPage - 2);
            let endPage = Math.min(totalPages, startPage + 4);
            if (endPage - startPage < 4) startPage = Math.max(1, endPage - 4);
            if (totalPages > 0) for (let i = startPage; i <= endPage; i++) {
                const pageButton = document.createElement('button');
                pageButton.className = `button ${i === currentPage ? 'active' : ''}`;
                pageButton.textContent = i;
                pageButton.onclick = () => goToPage(i);
                pageNumbers.appendChild(pageButton);
            }
        };

        const goToPage = (page) => {
            if (page < 1 || page > totalPages) return;
            currentPage = page;
            orderTableBody.querySelectorAll('tr.clickable-row').forEach(row => row.style.display = 'none');
            const startIndex = (page - 1) * itemsPerPage;
            const endIndex = Math.min(startIndex + itemsPerPage, filteredRows.length);
            for (let i = startIndex; i < endIndex; i++) filteredRows[i].style.display = '';
            updatePagination();
            reindexOrderRows();
        };

        const reindexOrderRows = () => {
            let stt = 1;
            document.querySelectorAll('#order-table-body tr.clickable-row:not([style*="display: none"])').forEach(row => {
                if (row.style.display !== 'none') row.children[1].textContent = stt++;
            });
        };

        const updateTabCounts = () => {
            const statusCounts = {};
            filteredRows.forEach(row => {
                let status = row.getAttribute('data-status') || '';
                if (status === 'Đang phát hàng') status = 'Đang phát';
                if (status === 'Mới tạo đơn' || status === 'Mới tạo') status = 'Mới tạo';
                if (status === 'Đã nhận hàng') status = 'Nhận hàng';
                statusCounts[status] = (statusCounts[status] || 0) + 1;
            });
            const tabsContainer = document.querySelector('.tabs');
            const tabNodes = Array.from(tabsContainer.querySelectorAll('.tab-item'));
            const allTab = tabNodes.find(tab => tab.textContent.trim().startsWith('Tất cả'));
            const otherTabs = tabNodes.filter(tab => tab !== allTab);
            if (allTab) allTab.textContent = `Tất cả (${filteredRows.length})`;
            otherTabs.forEach(tab => {
                const status = tab.textContent.replace(/\s*\(\d+\)/, '').trim();
                tab.textContent = `${status} (${statusCounts[status] || 0})`;
            });
        };

        // Event listeners
        updateDateTime();
        setInterval(updateDateTime, 1000);
        checkSelectAllState();

        mobileSidebarToggleBtn?.addEventListener('click', toggleSidebarMobileOrDesktop);
        sidebarOverlay?.addEventListener('click', toggleSidebarMobileOrDesktop);
        desktopSidebarToggleBtn?.addEventListener('click', toggleSidebarDesktop);

        mobileFilterToggleBtn?.addEventListener('click', toggleFilterModal);
        filterModal?.querySelector('.filter-modal-close-btn')?.addEventListener('click', toggleFilterModal);
        filterModal?.addEventListener('click', (event) => { if (event.target === filterModal) toggleFilterModal(); });

        desktopApplyFilterBtn?.addEventListener('click', () => applyFilters('desktop'));
        modalApplyFilterBtn?.addEventListener('click', () => applyFilters('modal'));
        modalResetFilterBtn?.addEventListener('click', () => resetFilters('modal'));

        selectAllCheckbox?.addEventListener('change', handleSelectAll);
        orderTableBody?.addEventListener('change', (event) => { if (event.target.matches('tr:not(.details-row) > td:first-child input[type="checkbox"]')) checkSelectAllState(); });

        mainConfirmBulkBtn?.addEventListener('click', () => { const ids = getSelectedOrderIds(); if (ids.length) showConfirmationModal('complete-order-modal', ids); else alert('Vui lòng chọn đơn hàng.'); });
        mainCancelBulkBtn?.addEventListener('click', () => { const ids = getSelectedOrderIds(); if (ids.length) showConfirmationModal('cancel-order-modal', ids); else alert('Vui lòng chọn đơn hàng.'); });
        mainDeleteBulkBtn?.addEventListener('click', () => { const ids = getSelectedOrderIds(); if (ids.length) showConfirmationModal('delete-order-modal', ids); else alert('Vui lòng chọn đơn hàng.'); });

        orderTableBody?.addEventListener('click', (event) => {
            const clickedRow = event.target.closest('tr.clickable-row');
            const targetElement = event.target;
            if (clickedRow && !targetElement.closest('a, button, input[type="checkbox"], .image-modal-trigger, .detail-item')) showOrderDetails(clickedRow);
            else if (targetElement.closest('.icon-button')) {
                event.stopPropagation();
                const targetButton = targetElement.closest('.icon-button');
                const mainRow = targetButton.closest('tr.clickable-row') || targetButton.closest('tr.details-row')?.closest('tr.clickable-row').previousElementSibling;
                const orderId = mainRow?.dataset.orderId;
                if (!orderId) return;
                if (targetButton.classList.contains('receive-order-btn')) showConfirmationModal('receive-order-modal', orderId);
                else if (targetButton.classList.contains('complete-order-btn')) showConfirmationModal('complete-order-modal', orderId);
                else if (targetButton.classList.contains('icon-danger')) showConfirmationModal('delete-order-modal', orderId);
                else if (targetButton.classList.contains('icon-edit')) alert(`Edit order: ${orderId}`);
                else if (targetButton.classList.contains('icon-print')) alert(`Print order: ${orderId}`);
                else if (targetButton.classList.contains('icon-excel')) alert(`Export DETAILS to Excel for order: ${orderId}`);
            } else if (targetElement.closest('.image-modal-trigger img')) {
                event.stopPropagation();
                showImageModal(targetElement.closest('.image-modal-trigger img').src);
            } else if (targetElement.closest('.manage-payment-btn')) {
                event.preventDefault();
                const paymentButton = targetElement.closest('.manage-payment-btn');
                const mainRow = paymentButton.closest('tr.clickable-row');
                const orderId = mainRow?.dataset.orderId;
                if (orderId) window.location.href = `payment-management.html?orderId=${orderId}`;
            }
        });

        document.querySelectorAll('.confirmation-modal').forEach(modal => {
            const modalId = modal.id;
            modal.querySelector('.confirm-yes')?.addEventListener('click', () => { const ids = JSON.parse(modal.dataset.targetIds || '[]'); console.log(`CONFIRMED: ${modalId}`, ids); hideConfirmationModal(modalId); });
            modal.querySelector('.confirm-cancel')?.addEventListener('click', () => hideConfirmationModal(modalId));
            modal.addEventListener('click', (event) => { if (event.target === modal) hideConfirmationModal(modalId); });
        });

        completeOrderModal?.querySelector('.button.confirm-yes')?.addEventListener('click', () => {
            const ids = JSON.parse(completeOrderModal.dataset.targetIds || '[]');
            updateOrderStatus(ids, 'Hoàn tất', 'status-completed', 'Hoàn tất', 'Paid');
        });
        receiveOrderModal?.querySelector('.button.confirm-yes')?.addEventListener('click', () => {
            const ids = JSON.parse(receiveOrderModal.dataset.targetIds || '[]');
            updateOrderStatus(ids, 'Đã nhận hàng', 'status-received', 'Đã nhận', 'Đã nhận');
        });
        cancelOrderModal?.querySelector('.button.confirm-yes')?.addEventListener('click', () => {
            const ids = JSON.parse(cancelOrderModal.dataset.targetIds || '[]');
            updateOrderStatus(ids, 'Hủy', 'status-cancelled', 'Hủy', 'Unpaid');
        });
        deleteOrderModal?.querySelector('.button.confirm-yes')?.addEventListener('click', () => {
            const ids = JSON.parse(deleteOrderModal.dataset.targetIds || '[]');
            ids.forEach(orderId => {
                const row = document.querySelector(`tr.clickable-row[data-order-id="${orderId}"]`);
                const detailsRow = document.getElementById('details-row-' + row?.id.substring('main-row-'.length));
                row?.remove();
                detailsRow?.remove();
            });
            updateTabCounts();
        });

        notificationButton?.addEventListener('click', (event) => { event.stopPropagation(); toggleNotificationDropdown(); });
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
            if (notificationDropdown?.classList.contains('visible') && !notificationDropdown.contains(event.target) && event.target !== notificationButton && !notificationButton.contains(event.target)) closeNotificationDropdown();
        });
        announcementCloseBtn?.addEventListener('click', closeAnnouncement);
        announcementOverlay?.addEventListener('click', (event) => { if (event.target === announcementOverlay) closeAnnouncement(); });

        imageModalCloseBtn?.addEventListener('click', hideImageModal);
        imageModalOverlay?.addEventListener('click', (event) => { if (event.target === imageModalOverlay) hideImageModal(); });
        document.addEventListener('keydown', (event) => {
            if (event.key === 'Escape') {
                if (imageModalOverlay?.classList.contains('visible')) hideImageModal();
                else if (announcementOverlay?.classList.contains('visible')) closeAnnouncement();
                else if (notificationDropdown?.classList.contains('visible')) closeNotificationDropdown();
                else document.querySelectorAll('.modal.visible').forEach(modal => modal.classList.remove('visible'));
            }
            if ((event.ctrlKey || event.metaKey) && event.key === 'f') {
                event.preventDefault();
                document.getElementById('mobile-search-input')?.focus();
            }
        });

        const images = document.querySelectorAll('img[data-src]');
        const imageObserver = new IntersectionObserver((entries) => entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.src = entry.target.dataset.src;
                entry.target.removeAttribute('data-src');
                imageObserver.unobserve(entry.target);
            }
        }));
        images.forEach(img => imageObserver.observe(img));

        const scrollTopBtn = document.createElement('button');
        scrollTopBtn.innerHTML = '<i class="fa-solid fa-arrow-up"></i>';
        scrollTopBtn.className = 'scroll-top-btn';
        scrollTopBtn.style.cssText = 'position: fixed; bottom: 20px; right: 20px; width: 40px; height: 40px; border-radius: 50%; background: var(--primary-color); color: white; border: none; cursor: pointer; display: none; align-items: center; justify-content: center; box-shadow: 0 2px 10px rgba(0,0,0,0.1); transition: all 0.3s ease';
        body.appendChild(scrollTopBtn);
        window.addEventListener('scroll', () => scrollTopBtn.style.display = window.pageYOffset > 300 ? 'flex' : 'none');
        scrollTopBtn.addEventListener('click', () => window.scrollTo({ top: 0, behavior: 'smooth' }));

        document.querySelectorAll('[data-copy]').forEach(element => element.addEventListener('click', async () => {
            try {
                await navigator.clipboard.writeText(element.dataset.copy);
                const toast = document.createElement('div');
                toast.className = 'toast';
                toast.textContent = 'Copied to clipboard!';
                body.appendChild(toast);
                setTimeout(() => toast.remove(), 2000);
            } catch (err) { console.error('Failed to copy text: ', err); }
        }));

        const style = document.createElement('style');
        style.textContent = '.toast{position:fixed;bottom:20px;left:50%;transform:translateX(-50%);background:var(--primary-color);color:white;padding:10px 20px;border-radius:4px;animation:fadeInOut 2s ease}@keyframes fadeInOut{0%{opacity:0;transform:translate(-50%,20px)}15%{opacity:1;transform:translate(-50%,0)}85%{opacity:1;transform:translate(-50%,0)}100%{opacity:0;transform:translate(-50%,-20px)}}';
        document.head.appendChild(style);

        document.querySelectorAll('.tab-item').forEach(tab => tab.addEventListener('click', function () {
            document.querySelectorAll('.tab-item').forEach(t => t.classList.remove('active'));
            this.classList.add('active');
            applyFilters('tab', this.textContent.replace(/\s*\(\d+\)/, '').trim());
        }));

        document.getElementById('mobile-status-select')?.addEventListener('change', function () {
            applyFilters('mobile-select', this.value);
        });

        document.getElementById('mobile-search-toggle')?.addEventListener('click', (e) => {
            e.stopPropagation();
            const searchOverlay = document.getElementById('mobile-search-overlay');
            const searchInput = document.getElementById('mobile-search-input');
            if (searchOverlay) {
                searchOverlay.style.display = 'flex';
                searchOverlay.style.zIndex = '9999';
                setTimeout(() => searchInput?.focus(), 100);
            }
        });
        document.getElementById('mobile-search-close')?.addEventListener('click', () => document.getElementById('mobile-search-overlay')?.style.display = 'none');
        document.addEventListener('click', (e) => {
            if (window.innerWidth <= 576 && document.getElementById('mobile-search-overlay')?.style.display === 'flex' && !document.getElementById('mobile-search-overlay').contains(e.target) && e.target !== document.getElementById('mobile-search-toggle')) document.getElementById('mobile-search-overlay')?.style.display = 'none';
        });
        document.getElementById('mobile-search-input')?.addEventListener('keydown', (e) => { if (e.key === 'Escape') document.getElementById('mobile-search-overlay')?.style.display = 'none'; });

        document.getElementById('items-per-page-select')?.addEventListener('change', handleItemsPerPageChange);
        document.getElementById('prev-page')?.addEventListener('click', () => goToPage(currentPage - 1));
        document.getElementById('next-page')?.addEventListener('click', () => goToPage(currentPage + 1));

        document.getElementById('filter-search-input')?.addEventListener('input', debounce(() => applyFilters('desktop'), 300));

        document.querySelector('.action-row .button.secondary')?.addEventListener('click', (e) => {
            e.preventDefault();
            const table = document.getElementById('orderTable');
            if (table) XLSX.utils.table_to_book(table, { sheet: "Đơn hàng" });
            else alert('Không tìm thấy bảng đơn hàng!');
        });

        // Lazy loading và payment status
        const imageObserver = new IntersectionObserver((entries) => entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.src = entry.target.dataset.src;
                entry.target.removeAttribute('data-src');
                imageObserver.unobserve(entry.target);
            }
        }));
        document.querySelectorAll('img[data-src]').forEach(img => imageObserver.observe(img));

        document.querySelectorAll('#order-table-body tr.clickable-row').forEach(row => {
            const billCode = row.getAttribute('data-order-id');
            const paymentStatusKH = localStorage.getItem('paymentStatusKH_' + billCode);
            if (paymentStatusKH) row.children[11].innerHTML = paymentStatusKH === 'Đã thanh toán đủ' ? '<span class="status-badge status-paid">Đã thanh toán</span>' : paymentStatusKH === 'Thanh toán một phần' ? '<span class="status-badge status-warning">Thanh toán một phần</span>' : '<span class="status-badge status-unpaid">Chưa thanh toán</span>';
            const paymentStatusDL = localStorage.getItem('paymentStatusDL_' + billCode);
            if (paymentStatusDL) row.children[12].innerHTML = paymentStatusDL === 'Đã thanh toán đủ' ? '<span class="status-badge status-paid">Đã thanh toán</span>' : paymentStatusDL === 'Thanh toán một phần' ? '<span class="status-badge status-warning">Thanh toán một phần</span>' : '<span class="status-badge status-unpaid">Chưa thanh toán</span>';
        });

        window.addEventListener('storage', (e) => { if (e.key?.startsWith('paymentStatusKH_') || e.key?.startsWith('paymentStatusDL_')) location.reload(); });

        // Thêm đơn hàng mới
        const orderData = JSON.parse(localStorage.getItem('currentOrderDetail') || '{}');
        if (Object.keys(orderData).length > 0) {
            const mainRowHTML = `
                <tr id="main-row-new" class="clickable-row" data-order-id="${orderData.bill_code}" data-status="Mới tạo">
                    <td><input type="checkbox" title="Select new row"></td>
                    <td>1</td>
                    <td><a href="/order_detail" class="order-id-link">${orderData.bill_code}</a></td>
                    <td>${new Date().toLocaleDateString('vi-VN')}</td>
                    <td>${new Date(Date.now() + 3 * 24 * 60 * 60 * 1000).toLocaleDateString('vi-VN')}</td>
                    <td><span class="status-badge status-pending">Mới tạo</span></td>
                    <td>Mới tạo</td>
                    <td>${orderData.sender_name || ''}</td>
                    <td>${orderData.agent || 'SALE01'}</td>
                    <td>${orderData.service_type || ''}</td>
                    <td class="currency">${orderData.totalOrderValue || '3.198.840'}₫</td>
                    <td><span class="status-badge status-unpaid">Chưa thanh toán</span></td>
                    <td><span class="status-badge status-unpaid">Chưa thanh toán</span></td>
                    <td class="currency">159.942₫</td>
                    <td>${orderData.branch || ''}</td>
                    <td class="action-icons">
                        <button class="icon-button receive-order-btn" title="Nhận hàng về kho"><i class="fa-solid fa-warehouse"></i></button>
                        <button class="icon-button complete-order-btn" title="Hoàn tất đơn hàng"><i class="fa-solid fa-check-double"></i></button>
                        <a href="#" class="icon-button manage-payment-btn" title="Quản lý thanh toán" data-order-id="${orderData.bill_code}"><i class="fa-solid fa-dollar-sign"></i></a>
                        <button class="icon-button icon-edit" title="Sửa"><i class="fa-solid fa-pencil"></i></button>
                        <button class="icon-button icon-danger" title="Xóa"><i class="fa-solid fa-trash-can"></i></button>
                        <button class="icon-button icon-print" title="In"><i class="fa-solid fa-print"></i></button>
                    </td>
                </tr>
            `;
            const detailsRowHTML = `
                <tr class="details-row" id="details-row-new" style="display: none;">
                    <td colspan="16">
                        <div class="details-inner-wrapper">
                            <div class="order-details-content">
                                <div class="detail-item"><span class="detail-label">REF Code:</span><span class="detail-value">${orderData.ref_code || ''}</span></div>
                                <div class="detail-item"><span class="detail-label">Tên sản phẩm:</span><span class="detail-value">${orderData.product_name || ''}</span></div>
                                <div class="detail-item"><span class="detail-label">SL kiện/gói:</span><span class="detail-value">${orderData.dimensions ? orderData.dimensions.length : (orderData.sl_kien || '')}</span></div>
                                <div class="detail-item"><span class="detail-label">Ảnh kiện:</span><span class="detail-value">
                                    ${orderData.shipmentImage ? `<div class="image-modal-trigger"><img src="${orderData.shipmentImage}" alt="Ảnh kiện từ upload"></div>` : (orderData.imageLink ? `<div class="image-modal-trigger"><img src="${orderData.imageLink}" alt="Ảnh kiện từ link"></div>` : 'Không có ảnh')}
                                </span></div>
                                <div class="detail-item"><span class="detail-label">Cân nặng:</span><span class="detail-value">${orderData.dimensions ? orderData.dimensions.reduce((sum, dim) => sum + parseFloat(dim.weight), 0) : (orderData.totalWeight || orderData.weight || '')} KG</span></div>
                                <div class="detail-item"><span class="detail-label">Reweight:</span><span class="detail-value">${orderData.reweight || ''} KG</span></div>
                                <div class="detail-item"><span class="detail-label">Cân nặng đại lý:</span><span class="detail-value">${orderData.agentWeight || ''} KG</span></div>
                                <div class="detail-item full-width"><span class="detail-label">Ghi chú CPK:</span><span class="detail-value">${(orderData.add_service && Array.isArray(orderData.add_service) && orderData.add_service.length > 0 ? orderData.add_service.map(service => ({ 'signature': 'Chữ Ký', 'fumigation': 'FUMIGATION', 'packing': 'Đóng kiện gỗ', 'insurance': 'Bảo hiểm hàng hóa' })[service] || service).join(' / ') : 'Không có ghi chú')}</span></div>
                            </div>
                            <div class="details-action-icons">
                                <button class="icon-button icon-print" title="In chi tiết"><i class="fa-solid fa-print"></i></button>
                                <button class="icon-button icon-excel" title="Xuất Excel"><i class="fa-solid fa-file-excel"></i></button>
                            </div>
                        </div>
                    </td>
                </tr>
            `;
            orderTableBody.insertAdjacentHTML('afterbegin', mainRowHTML + detailsRowHTML);
            const newRow = document.getElementById('main-row-new');
            const newDetailsRow = document.getElementById('details-row-new');
            if (newRow && newDetailsRow) newRow.addEventListener('click', () => {
                newDetailsRow.style.display = newDetailsRow.style.display === 'none' ? 'table-row' : 'none';
            });
            filteredRows = Array.from(orderTableBody.querySelectorAll('tr.clickable-row'));
            updateTabCounts();
            updatePagination();
            goToPage(1);
        }

        // Tooltip và export
        [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]')).map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
@endpush
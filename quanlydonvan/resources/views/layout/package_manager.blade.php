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

    const isElementVisible = (el) => el && !el.hasAttribute('hidden') && el.offsetParent !== null;

    // Thêm biến toàn cục để lưu trữ các dòng đơn hàng đã lọc
    let filteredRows = []; // Mảng chứa các dòng tr.clickable-row sau khi lọc

    function manageBodyScroll() {
        const isSidebarOpen = body.classList.contains('sidebar-mobile-open');
        const isAnyModalVisible = document.querySelector('.filter-modal.visible, .confirmation-modal.visible');
        const isImageModalVisible = imageModalOverlay && imageModalOverlay.classList.contains('visible');
        if (isSidebarOpen || isAnyModalVisible || isImageModalVisible) {
            body.classList.add('overflow-hidden');
        } else {
            body.classList.remove('overflow-hidden');
        }
    }

    function toggleSidebarMobileOrDesktop() {
        if (window.innerWidth > 768) {
            // Desktop: thu/phóng sidebar
            body.classList.toggle('sidebar-collapsed');
            const isCollapsed = body.classList.contains('sidebar-collapsed');
            // Có thể cập nhật tooltip hoặc trạng thái nếu cần
        } else {
            // Mobile: mở/đóng sidebar
            body.classList.toggle('sidebar-mobile-open');
            const isOpen = body.classList.contains('sidebar-mobile-open');
            if (mobileSidebarToggleBtn) mobileSidebarToggleBtn.setAttribute('aria-expanded', String(isOpen));
            manageBodyScroll();
        }
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
                submenu.previousElementSibling?.classList.remove('active');
            });
        }
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

    function toggleFilterModal() {
        if (filterModal) {
            filterModal.classList.toggle('visible');
            manageBodyScroll();
        } else { console.error("Filter modal element not found!"); }
    }

    function applyFilters(source, statusTab) {
        const formPrefix = source === 'modal' ? 'modal-' : '';
        // Lấy giá trị từ các input filter, nhưng chỉ sử dụng chúng nếu source không phải là từ tab
        const dateStart = (source !== 'tab' && source !== 'mobile-select') ? document.getElementById(`${formPrefix}date-start`)?.value : '';
        const dateEnd = (source !== 'tab' && source !== 'mobile-select') ? document.getElementById(`${formPrefix}date-end`)?.value : '';
        // Trạng thái ưu tiên từ statusTab (khi click tab), nếu không thì lấy từ dropdown filter
        let filterStatus = statusTab && statusTab !== 'Tất cả' ? statusTab : '';
        if (!filterStatus) { // Nếu không có trạng thái từ tab, lấy từ dropdown nếu không phải từ tab
            filterStatus = (source !== 'tab' && source !== 'mobile-select') ? document.getElementById(`${formPrefix}filter-status`)?.value : '';
        }

        const sale = (source !== 'tab' && source !== 'mobile-select') ? document.getElementById(`${formPrefix}filter-sale`)?.value : '';
        const customer = (source !== 'tab' && source !== 'mobile-select') ? document.getElementById(`${formPrefix}filter-customer`)?.value : '';
        const branch = (source !== 'tab' && source !== 'mobile-select') ? document.getElementById(`${formPrefix}filter-branch`)?.value : '';

        // Ô search input vẫn luôn được sử dụng bất kể source nào
        const search = document.getElementById(`${formPrefix}filter-search-input`)?.value?.toLowerCase().trim();

        // Hàm helper để chuẩn hóa text
        const normalizeText = (text) => {
            return text.toLowerCase()
                .normalize('NFD')
                .replace(/[\u0300-\u036f]/g, '') // Bỏ dấu
                .replace(/\s+/g, ' ') // Chuẩn hóa khoảng trắng
                .trim();
        };

        // Hàm helper để chuẩn hóa trạng thái
        const normalizeStatus = (status) => {
            if (!status) return '';
            status = status.trim();
            if (status === 'Đã nhận hàng') return 'Nhận hàng';
            if (status === 'Mới tạo đơn') return 'Mới tạo';
            if (status === 'Đang phát hàng') return 'Đang phát';
            return status;
        };

        // Hàm helper để so sánh ngày
        const compareDates = (dateStr, startDate, endDate) => {
            if (!dateStr) return true;
            // Chuyển ngày bảng (dd/mm/yy hoặc dd/mm/yyyy) thành Date object
            let [d, m, y] = dateStr.split('/');
            if (y.length === 2) y = '20' + y;
            const rowDate = new Date(`${y}-${m}-${d}`);
            // Chuyển input date (yyyy-mm-dd) thành Date object
            if (startDate) {
                const start = new Date(startDate);
                start.setHours(0, 0, 0, 0);
                if (rowDate < start) return false;
            }
            if (endDate) {
                const end = new Date(endDate);
                end.setHours(23, 59, 59, 999);
                if (rowDate > end) return false;
            }
            return true;
        };

        // Lọc các dòng đơn hàng
        const rows = orderTableBody.querySelectorAll('tr.clickable-row');
        // Reset filteredRows ở đầu mỗi lần lọc
        filteredRows = [];

        rows.forEach(row => {
            let show = true;

            // Lọc theo trạng thái (sử dụng filterStatus đã được xác định ở trên)
            if (filterStatus && filterStatus !== 'Tất cả') {
                const rowStatus = row.getAttribute('data-status');
                const normalizedRowStatus = normalizeStatus(rowStatus);
                const normalizedFilterStatus = normalizeStatus(filterStatus);
                // console.log(`Row ID: ${row.dataset.orderId}, Row Status: ${rowStatus}, Filter Status: ${filterStatus}`);
                if (normalizedRowStatus !== normalizedFilterStatus) show = false;
            }

            // Lọc theo sale - So khớp chính xác mã sale
            // Chỉ áp dụng filter này nếu show vẫn true và có giá trị sale được chọn
            if (show && sale && sale !== '') {
                const saleCell = row.children[8]?.textContent || '';
                const saleCode = sale.split(' - ')[0].trim();
                if (!saleCell.includes(saleCode)) show = false;
            }
            // Lọc theo khách hàng - Tìm kiếm mềm
            // Chỉ áp dụng filter này nếu show vẫn true và có giá trị customer được chọn
            if (show && customer && customer !== '') {
                const customerCell = row.children[7]?.textContent || '';
                const normalizedCustomer = normalizeText(customer);
                const normalizedCell = normalizeText(customerCell);
                const searchTerms = normalizedCustomer.split(' ').filter(term => term.length > 0); // Loại bỏ khoảng trắng thừa
                const hasAllTerms = searchTerms.every(term => normalizedCell.includes(term));
                if (!hasAllTerms) show = false;
            }
            // Lọc theo chi nhánh - So khớp chính xác
            // Chỉ áp dụng filter này nếu show vẫn true và có giá trị branch được chọn
            if (show && branch && branch !== '') {
                const branchCell = row.children[14]?.textContent || '';
                const branchName = branch.replace('CN: ', '').trim();
                if (branchCell !== branchName) show = false;
            }
            // Lọc theo ngày tạo
            // Chỉ áp dụng filter này nếu show vẫn true và có ngày bắt đầu hoặc kết thúc được chọn
            if (show && (dateStart || dateEnd)) {
                const dateCell = row.children[3]?.textContent || '';
                if (!compareDates(dateCell, dateStart, dateEnd)) show = false;
            }
            // Lọc theo search - Tìm kiếm thông minh (Luôn áp dụng)
            // Chỉ áp dụng filter này nếu show vẫn true và có giá trị search được nhập
            if (show && search && search.length > 0) {
                const searchTerms = search.split(' ').filter(term => term.length > 0); // Loại bỏ khoảng trắng thừa
                if (searchTerms.length > 0) { // Chỉ lọc nếu có ít nhất một từ khóa search
                    const cellsToSearch = [
                        row.children[2]?.textContent || '', // ID
                        row.children[7]?.textContent || '', // Tên KH
                        row.children[8]?.textContent || '', // Sale
                        row.children[9]?.textContent || '', // Dịch vụ
                        row.children[2]?.textContent || ''  // Mã vận đơn
                    ];
                    const normalizedCells = cellsToSearch.map(cell => normalizeText(cell));
                    // Kiểm tra xem TẤT CẢ các từ khóa search có tồn tại trong BẤT KỲ ô nào không
                    const hasMatch = searchTerms.every(term => normalizedCells.some(cell => cell.includes(term)));
                    if (!hasMatch) show = false;
                }
            }
            // Thêm dòng vào danh sách filteredRows nếu nó được hiển thị
            if (show) {
                filteredRows.push(row);
            }
        });

        // Sau khi lọc xong, cập nhật lại phân trang và hiển thị trang đầu tiên
        currentPage = 1; // Reset về trang 1 sau khi lọc
        updatePagination(); // Cập nhật thông tin phân trang dựa trên filteredRows
        goToPage(currentPage); // Hiển thị trang đầu tiên của kết quả lọc

        // Cập nhật số lượng trên các tab
        updateTabCounts();

        if (source === 'modal') {
            toggleFilterModal();
        }
    }

    // Hàm cập nhật số lượng đơn hàng trong tabs
    // Hàm này chỉ cần đếm dựa trên filteredRows hiện tại.
    function updateTabCounts() {
        const statusCounts = {};

        // Đếm tổng số đơn hàng từng trạng thái dựa trên data-status trong filteredRows
        filteredRows.forEach(row => {
            let status = row.getAttribute('data-status') || '';
            // CHUẨN HÓA: Nếu là 'Đang phát hàng' thì quy về 'Đang phát' để khớp tab
            if (status === 'Đang phát hàng') status = 'Đang phát';
            if (status === 'Mới tạo đơn' || status === 'Mới tạo') status = 'Mới tạo';
            if (status === 'Đã nhận hàng') status = 'Nhận hàng';
            statusCounts[status] = (statusCounts[status] || 0) + 1;
        });

        // Lấy danh sách tab hiện tại
        const tabsContainer = document.querySelector('.tabs');
        const tabNodes = Array.from(tabsContainer.querySelectorAll('.tab-item'));

        // Tách tab 'Tất cả' ra riêng
        const allTab = tabNodes.find(tab => tab.textContent.trim().startsWith('Tất cả'));
        const otherTabs = tabNodes.filter(tab => tab !== allTab);

        // Lấy trạng thái từ text tab
        const getStatusFromTab = tab => tab.textContent.replace(/\s*\(\d+\)/, '').trim();

        // Cập nhật lại số lượng trên từng tab
        if (allTab) {
            // Tab 'Tất cả' đếm TỔNG số dòng trong filteredRows
            allTab.textContent = `Tất cả (${filteredRows.length})`;
        } else {
            console.warn("Tab 'Tất cả' not found!");
        }
        otherTabs.forEach(tab => {
            const status = getStatusFromTab(tab);
            const count = statusCounts[status] || 0;
            tab.textContent = `${status} (${count})`;
        });

        // Lưu ý: Không gọi updatePagination() ở đây nữa vì nó đã được gọi ở cuối applyFilters và goToPage.
    }

    function resetFilters(source) {
        console.log(`Resetting filters in ${source}...`);
        const formContainer = source === 'modal'
            ? filterModal?.querySelector('.filter-modal-body')
            : document.querySelector('.filter-controls-desktop');
        if (formContainer) {
            formContainer.querySelectorAll('input:not([type="radio"]):not([type="checkbox"]), select').forEach(el => {
                if (el.tagName === 'SELECT') el.selectedIndex = 0;
                else el.value = '';
            });
            formContainer.querySelectorAll('input[type="radio"], input[type="checkbox"]').forEach(el => el.checked = false);
        }
        console.log("Filters reset.");
        // Áp dụng lại filter sau khi reset để hiển thị tất cả đơn hàng
        applyFilters(source);
    }

    function showOrderDetails(rowElement) { // Đổi tên tham số để rõ ràng hơn
        console.log('showOrderDetails được gọi cho dòng:', rowElement.id); // Sử dụng rowElement.id
        // Loại bỏ kiểm tra event.target.closest ở đây, logic này được xử lý trong listener
        const clickedRow = rowElement; // Sử dụng trực tiếp phần tử hàng được truyền vào
        if (!clickedRow || !clickedRow.matches('tbody tr.clickable-row')) return;
        // Thay đổi tiền tố tìm kiếm dòng chi tiết từ 'details-' sang 'details-row-'
        const detailsRowId = 'details-row-' + clickedRow.id.substring('main-row-'.length); // Lấy phần sau 'main-row-'
        console.log('Đang tìm dòng chi tiết với ID:', detailsRowId);
        const detailsRow = document.getElementById(detailsRowId);

        if (!detailsRow) {
            console.warn('Không tìm thấy dòng chi tiết với ID:', detailsRowId);
            return;
        }

        console.log('Tìm thấy dòng chi tiết:', detailsRow.id);
        const isCurrentlyActive = clickedRow.classList.contains('active');
        const currentlyVisibleDetails = document.querySelector('tbody tr.details-row[style*="display: table-row"]');
        if (currentlyVisibleDetails && currentlyVisibleDetails !== detailsRow) {
            currentlyVisibleDetails.style.display = 'none';
            // Điều chỉnh cách tìm dòng chính tương ứng với dòng chi tiết đang hiển thị
            const correspondingMainRowId = 'main-row-' + currentlyVisibleDetails.id.substring('details-row-'.length);
            document.getElementById(correspondingMainRowId)?.classList.remove('active');
        }
        clickedRow.classList.toggle('active', !isCurrentlyActive);
        detailsRow.style.display = !isCurrentlyActive ? 'table-row' : 'none';
    }

    function showConfirmationModal(modalId, targetIds = []) {
        const modal = document.getElementById(modalId);
        if (!modal) { console.error("Modal not found:", modalId); return; }
        targetIds = Array.isArray(targetIds) ? targetIds : (targetIds ? [targetIds] : []);
        modal.dataset.targetIds = JSON.stringify(targetIds);
        const countElement = modal.querySelector('.modal-target-count');
        const idsElement = modal.querySelector('.modal-target-ids');
        if (countElement) countElement.textContent = targetIds.length > 1 ? `${targetIds.length}` : '1';
        if (idsElement) {
            idsElement.textContent = targetIds.length > 0 ? `ID(s): ${targetIds.join(', ')}` : '';
            idsElement.style.display = targetIds.length > 0 ? 'block' : 'none';
        }
        modal.classList.add('visible');
        manageBodyScroll();
    }

    function hideConfirmationModal(modalId) {
        const modal = document.getElementById(modalId);
        if (modal) {
            delete modal.dataset.targetIds;
            modal.classList.remove('visible');
            manageBodyScroll();
        }
    }

    function getSelectedOrderIds() {
        const checkboxes = orderTableBody?.querySelectorAll('tr:not(.details-row) > td:first-child input[type="checkbox"]:checked') || [];
        return Array.from(checkboxes).map(cb => cb.closest('tr.clickable-row')?.dataset.orderId).filter(Boolean);
    }

    function handleSelectAll() {
        if (!orderTableBody || !selectAllCheckbox) return;
        const rowCheckboxes = orderTableBody.querySelectorAll('tr:not(.details-row) > td:first-child input[type="checkbox"]');
        rowCheckboxes.forEach(checkbox => checkbox.checked = selectAllCheckbox.checked);
    }

    function checkSelectAllState() {
        if (!orderTableBody || !selectAllCheckbox) return;
        const rowCheckboxes = orderTableBody.querySelectorAll('tr:not(.details-row) > td:first-child input[type="checkbox"]');
        const totalRows = rowCheckboxes.length;
        if (totalRows === 0) {
            selectAllCheckbox.checked = false;
            selectAllCheckbox.indeterminate = false;
            return;
        }
        const checkedRows = Array.from(rowCheckboxes).filter(checkbox => checkbox.checked).length;
        selectAllCheckbox.checked = checkedRows === totalRows;
        selectAllCheckbox.indeterminate = checkedRows > 0 && checkedRows < totalRows;
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
        checkSelectAllState();

        if (mobileSidebarToggleBtn) mobileSidebarToggleBtn.addEventListener('click', toggleSidebarMobileOrDesktop);
        if (sidebarOverlay) sidebarOverlay.addEventListener('click', toggleSidebarMobileOrDesktop);
        if (desktopSidebarToggleBtn) desktopSidebarToggleBtn.addEventListener('click', toggleSidebarDesktop);
        document.querySelectorAll('.menu-items .submenu-parent').forEach(link => link.addEventListener('click', toggleSubmenu));

        if (mobileFilterToggleBtn) mobileFilterToggleBtn.addEventListener('click', toggleFilterModal);
        if (filterModal) {
            filterModal.querySelector('.filter-modal-close-btn')?.addEventListener('click', toggleFilterModal);
            filterModal.addEventListener('click', (event) => { if (event.target === filterModal) toggleFilterModal(); });
        }

        if (desktopApplyFilterBtn) desktopApplyFilterBtn.addEventListener('click', () => applyFilters('desktop'));
        if (modalApplyFilterBtn) modalApplyFilterBtn.addEventListener('click', () => applyFilters('modal'));
        if (modalResetFilterBtn) modalResetFilterBtn.addEventListener('click', () => resetFilters('modal'));

        // Đã xóa: document.querySelectorAll('#orderTable tbody tr.clickable-row').forEach(row => row.addEventListener('click', showOrderDetails));

        if (selectAllCheckbox) selectAllCheckbox.addEventListener('change', handleSelectAll);
        if (orderTableBody) orderTableBody.addEventListener('change', (event) => { if (event.target.matches('tr:not(.details-row) > td:first-child input[type="checkbox"]')) checkSelectAllState(); });

        if (mainConfirmBulkBtn) mainConfirmBulkBtn.addEventListener('click', () => { const ids = getSelectedOrderIds(); if (ids.length === 0) alert("Vui lòng chọn đơn hàng."); else showConfirmationModal('complete-order-modal', ids); });
        if (mainCancelBulkBtn) mainCancelBulkBtn.addEventListener('click', () => { const ids = getSelectedOrderIds(); if (ids.length === 0) alert("Vui lòng chọn đơn hàng."); else showConfirmationModal('cancel-order-modal', ids); });
        if (mainDeleteBulkBtn) mainDeleteBulkBtn.addEventListener('click', () => { const ids = getSelectedOrderIds(); if (ids.length === 0) alert("Vui lòng chọn đơn hàng."); else showConfirmationModal('delete-order-modal', ids); });

        // Giữ nguyên hoặc điều chỉnh trình xử lý click trên orderTableBody để sử dụng event delegation
        if (orderTableBody) orderTableBody.addEventListener('click', function (event) {
            const clickedRow = event.target.closest('tr.clickable-row');
            const targetElement = event.target;

            if (clickedRow) {
                // Kiểm tra nếu click KHÔNG phải trên các phần tử tương tác
                // Thêm kiểm tra explicit cho detail-item hoặc bất kỳ phần tử con nào khác mà không nên kích hoạt details row toggle
                if (!targetElement.closest('a, button, input[type="checkbox"], .image-modal-trigger, .detail-item')) {
                    // Nếu click trên hàng (hoặc bên trong nhưng không phải phần tử tương tác), thì hiển thị/ẩn chi tiết
                    showOrderDetails(clickedRow); // Gọi showOrderDetails với phần tử hàng
                } else {
                    // Xử lý click trên các phần tử tương tác (nút, ảnh, checkbox)
                    const targetButton = targetElement.closest('.icon-button');
                    if (targetButton) {
                        const mainRow = targetButton.closest('tr.clickable-row');
                        const detailsRow = targetButton.closest('tr.details-row'); // Có thể click nút trên details row
                        let orderId;
                        // Lấy orderId từ mainRow hoặc detailsRow nếu click trên nút trong detailsRow
                        if (mainRow) orderId = mainRow.dataset.orderId;
                        else if (detailsRow) {
                            // Tìm main row tương ứng từ details row ID
                            const mainRowId = 'main-row-' + detailsRow.id.substring('details-row-'.length);
                            orderId = document.getElementById(mainRowId)?.dataset.orderId;
                        }

                        if (!orderId) return;
                        event.stopPropagation(); // Ngăn sự kiện lan ra ngoài

                        if (targetButton.classList.contains('receive-order-btn')) showConfirmationModal('receive-order-modal', orderId);
                        else if (targetButton.classList.contains('complete-order-btn')) showConfirmationModal('complete-order-modal', orderId);
                        else if (targetButton.classList.contains('icon-danger')) showConfirmationModal('delete-order-modal', orderId);
                        else if (targetButton.classList.contains('icon-edit')) alert(`Edit order: ${orderId}`);
                        else if (targetButton.classList.contains('icon-print')) alert(`Print order: ${orderId}`);
                        else if (targetButton.classList.contains('icon-excel') && detailsRow) alert(`Export DETAILS to Excel for order: ${orderId}`);
                    }
                    // Thêm xử lý cho các phần tử tương tác khác nếu có (checkbox được xử lý riêng)
                    else if (targetElement.matches('input[type="checkbox"]')) {
                        // Logic đã có trong checkSelectAllState listener
                    } else if (targetElement.closest('.image-modal-trigger img')) {
                        event.stopPropagation(); // Ngăn sự kiện lan ra ngoài
                        const imageUrl = targetElement.closest('.image-modal-trigger img').src;
                        if (imageUrl) {
                            showImageModal(imageUrl);
                        } else {
                            console.warn("Image URL not found for modal trigger");
                        }
                    }
                }
            }
        });

        document.querySelectorAll('.confirmation-modal').forEach(modal => {
            const modalId = modal.id;
            modal.querySelector('.confirm-yes')?.addEventListener('click', () => { const ids = JSON.parse(modal.dataset.targetIds || '[]'); console.log(`CONFIRMED: ${modalId}`, ids); hideConfirmationModal(modalId); });
            modal.querySelector('.confirm-cancel')?.addEventListener('click', () => hideConfirmationModal(modalId));
            modal.addEventListener('click', (event) => { if (event.target === modal) hideConfirmationModal(modalId); });
        });

        // toàn màn hình
        // if (fullscreenBtn) fullscreenBtn.addEventListener('click', toggleFullscreen);
        // document.addEventListener('fullscreenchange', handleFullscreenChange);

        // const userToggle = document.getElementById('user-dropdown-toggle');
        // const userDropdown = document.getElementById('user-dropdown');
        // if (userToggle && userDropdown) {
        //     userToggle.addEventListener('click', function (e) {
        //         e.stopPropagation();
        //         userDropdown.classList.toggle('show');
        //     });
        //     document.addEventListener('click', function (e) {
        //         if (!userDropdown.contains(e.target) && e.target !== userToggle) {
        //             userDropdown.classList.remove('show');
        //         }
        //     });
        // }
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

    document.addEventListener('DOMContentLoaded', function () {
        const images = document.querySelectorAll('img[data-src]');
        const imageObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    img.src = img.dataset.src;
                    img.removeAttribute('data-src');
                    observer.unobserve(img);
                }
            });
        });

        images.forEach(img => imageObserver.observe(img));
    });

    function debounce(func, wait) {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                clearTimeout(timeout);
                func(...args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    }

    function showLoading() {
        const spinner = document.createElement('div');
        spinner.className = 'loading-spinner';
        document.body.appendChild(spinner);
    }

    function hideLoading() {
        const spinner = document.querySelector('.loading-spinner');
        if (spinner) {
            spinner.remove();
        }
    }

    function scrollToTop() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    }

    const scrollTopBtn = document.createElement('button');
    scrollTopBtn.innerHTML = '<i class="fa-solid fa-arrow-up"></i>';
    scrollTopBtn.className = 'scroll-top-btn';
    scrollTopBtn.style.cssText = `
                position: fixed;
                bottom: 20px;
                right: 20px;
                width: 40px;
                height: 40px;
                border-radius: 50%;
                background: var(--primary-color);
                color: white;
                border: none;
                cursor: pointer;
                display: none;
                align-items: center;
                justify-content: center;
                box-shadow: 0 2px 10px rgba(0,0,0,0.1);
                transition: all 0.3s ease;
            `;
    document.body.appendChild(scrollTopBtn);

    window.addEventListener('scroll', () => {
        if (window.pageYOffset > 300) {
            scrollTopBtn.style.display = 'flex';
        } else {
            scrollTopBtn.style.display = 'none';
        }
    });

    scrollTopBtn.addEventListener('click', scrollToTop);

    document.addEventListener('keydown', (e) => {
        if ((e.ctrlKey || e.metaKey) && e.key === 'f') {
            e.preventDefault();
            searchInput?.focus();
        }
        if (e.key === 'Escape') {
            document.querySelectorAll('.modal.visible').forEach(modal => {
                modal.classList.remove('visible');
            });
        }
    });

    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    document.querySelectorAll('[data-copy]').forEach(element => {
        element.addEventListener('click', async () => {
            try {
                await navigator.clipboard.writeText(element.dataset.copy);
                const toast = document.createElement('div');
                toast.className = 'toast';
                toast.textContent = 'Copied to clipboard!';
                document.body.appendChild(toast);
                setTimeout(() => toast.remove(), 2000);
            } catch (err) {
                console.error('Failed to copy text: ', err);
            }
        });
    });

    const style = document.createElement('style');
    style.textContent = `
                .toast {
                    position: fixed;
                    bottom: 20px;
                    left: 50%;
                    transform: translateX(-50%);
                    background: var(--primary-color);
                    color: white;
                    padding: 10px 20px;
                    border-radius: 4px;
                    animation: fadeInOut 2s ease;
                }
    
                @keyframes fadeInOut {
                    0% { opacity: 0; transform: translate(-50%, 20px); }
                    15% { opacity: 1; transform: translate(-50%, 0); }
                    85% { opacity: 1; transform: translate(-50%, 0); }
                    100% { opacity: 0; transform: translate(-50%, -20px); }
                }
            `;
    document.head.appendChild(style);

    // Thêm filter cho tabs trạng thái đơn hàng
    const tabItems = document.querySelectorAll('.tab-item');
    tabItems.forEach(tab => {
        tab.addEventListener('click', function () {
            // Xóa lớp 'active' khỏi tất cả các tab
            tabItems.forEach(t => t.classList.remove('active'));
            // Thêm lớp 'active' cho tab được click
            tab.classList.add('active');

            // Lấy trạng thái từ text tab (bỏ số lượng đi)
            const status = this.textContent.replace(/\s*\(\d+\)/, '').trim();

            // Thay vì hiển thị trực tiếp, gọi hàm applyFilters với trạng thái từ tab
            // applyFilters sẽ tự động gọi updatePagination và goToPage(1)
            applyFilters('tab', status);
        });
    });

    document.addEventListener('DOMContentLoaded', function () {
        var mobileStatusSelect = document.getElementById('mobile-status-select');
        if (mobileStatusSelect) {
            mobileStatusSelect.addEventListener('change', function () {
                var status = this.value;
                // Thay vì hiển thị trực tiếp, gọi hàm applyFilters với trạng thái từ select mobile
                // applyFilters sẽ tự động gọi updatePagination và goToPage(1)
                applyFilters('mobile-select', status);
            });
        }
    });

    document.addEventListener('DOMContentLoaded', function () {
        var searchToggle = document.getElementById('mobile-search-toggle');
        var searchOverlay = document.getElementById('mobile-search-overlay');
        var searchInput = document.getElementById('mobile-search-input');
        var searchClose = document.getElementById('mobile-search-close');
        if (searchToggle && searchOverlay && searchInput && searchClose) {
            searchToggle.onclick = function (e) {
                e.stopPropagation();
                searchOverlay.style.display = 'flex';
                searchOverlay.style.zIndex = '9999';
                setTimeout(function () { searchInput.focus(); }, 100);
            };
            searchClose.onclick = function () {
                searchOverlay.style.display = 'none';
            };
            document.addEventListener('click', function (e) {
                if (window.innerWidth > 576) return;
                if (searchOverlay.style.display === 'flex' && !searchOverlay.contains(e.target) && e.target !== searchToggle) searchOverlay.style.display = 'none';
            });
            searchInput.addEventListener('keydown', function (e) {
                if (e.key === 'Escape') searchOverlay.style.display = 'none';
            });
        }
    });



    function updateOrderStatus(orderIds, newStatus, badgeClass, statusText, dlttText) {
        orderIds.forEach(orderId => {
            const row = document.querySelector(`tr.clickable-row[data-order-id="${orderId}"]`);
            if (row) {
                // Cập nhật thuộc tính trạng thái
                row.setAttribute('data-status', newStatus);
                // Cập nhật cột trạng thái (Pick up)
                const statusCell = row.children[5];
                if (statusCell) {
                    statusCell.innerHTML = `<span class=\"status-badge ${badgeClass}\">${statusText}</span>`;
                }
                // Cập nhật cột xử lý (nếu cần)
                const processCell = row.children[6];
                if (processCell) {
                    processCell.textContent = newStatus;
                }
                // Cập nhật cột ĐL TT (index 13)
                const dlttCell = row.children[13];
                if (dlttCell) {
                    // Chỉnh sửa logic để hiển thị "Đã thanh toán" cho trạng thái 'Paid'
                    if (dlttText === 'Paid' || dlttText === 'Đã thanh toán' || dlttText === 'Đã thanh toán đủ') { // Added || 'Đã thanh toán đủ'
                        dlttCell.innerHTML = '<span class="status-badge status-paid">Đã thanh toán</span>'; // Changed text to 'Đã thanh toán'
                    } else if (dlttText === 'Unpaid' || dlttText === 'Chưa thanh toán') { // Added || 'Chưa thanh toán'
                        dlttCell.innerHTML = '<span class="status-badge status-unpaid">Chưa thanh toán</span>'; // Changed text to 'Chưa thanh toán'
                    } else if (dlttText === 'Thanh toán một phần') { // Added partial payment handling
                        dlttCell.innerHTML = '<span class="status-badge status-warning">Thanh toán một phần</span>';
                    }
                    // Các trạng thái khác như 'Đã nhận', 'Hủy' có thể không nên áp dụng cho cột thanh toán này,
                    // nhưng giữ lại fallback nếu cần
                    else if (dlttText === 'Đã nhận') {
                        dlttCell.innerHTML = '<span class="status-badge status-received">Đã nhận</span>';
                    } else if (dlttText === 'Hủy') {
                        dlttCell.innerHTML = '<span class="status-badge status-cancelled">Hủy</span>';
                    }
                    else {
                        dlttCell.textContent = dlttText; // Fallback
                    }
                }
            }
        });
        updateTabCounts && updateTabCounts();
    }

    // Gắn sự kiện cho các nút xác nhận trong modal
    // Hoàn tất
    const completeOrderModal = document.getElementById('complete-order-modal');
    if (completeOrderModal) {
        completeOrderModal.querySelector('.button.confirm-yes')?.addEventListener('click', function () {
            const ids = JSON.parse(completeOrderModal.dataset.targetIds || '[]');
            updateOrderStatus(ids, 'Hoàn tất', 'status-completed', 'Hoàn tất', 'Paid');
        });
    }
    // Nhận hàng
    const receiveOrderModal = document.getElementById('receive-order-modal');
    if (receiveOrderModal) {
        receiveOrderModal.querySelector('.button.confirm-yes')?.addEventListener('click', function () {
            const ids = JSON.parse(receiveOrderModal.dataset.targetIds || '[]');
            updateOrderStatus(ids, 'Đã nhận hàng', 'status-received', 'Đã nhận', 'Đã nhận');
        });
    }
    // Hủy đơn
    const cancelOrderModal = document.getElementById('cancel-order-modal');
    if (cancelOrderModal) {
        cancelOrderModal.querySelector('.button.confirm-yes')?.addEventListener('click', function () {
            const ids = JSON.parse(cancelOrderModal.dataset.targetIds || '[]');
            updateOrderStatus(ids, 'Hủy', 'status-cancelled', 'Hủy', 'Unpaid');
        });
    }
    // Xóa đơn (ẩn dòng khỏi bảng)
    const deleteOrderModal = document.getElementById('delete-order-modal');
    if (deleteOrderModal) {
        deleteOrderModal.querySelector('.button.confirm-yes')?.addEventListener('click', function () {
            const ids = JSON.parse(deleteOrderModal.dataset.targetIds || '[]');
            ids.forEach(orderId => {
                const row = document.querySelector(`tr.clickable-row[data-order-id=\"${orderId}\"]`);
                const detailsRow = document.getElementById('details-' + row?.id?.substring('main-'.length));
                if (row) row.remove();
                if (detailsRow) detailsRow.remove();
            });
            updateTabCounts && updateTabCounts();
        });
    }

    

    document.addEventListener('DOMContentLoaded', function () {
        var mobileStatusSelect = document.getElementById('mobile-status-select');
        var orderRows = document.querySelectorAll('#order-table-body tr.clickable-row');
        if (mobileStatusSelect) {
            mobileStatusSelect.addEventListener('change', function () {
                var status = this.value;
                // Đã chuyển logic sang applyFilters
                // orderRows.forEach(function(row) {
                //   if (status === 'Tất cả') {
                //     row.style.display = '';
                //   } else {
                //     var rowStatus = row.getAttribute('data-status') || '';
                //     row.style.display = rowStatus === status ? '' : 'none';
                //   }
                // });
            });
        }
    });

    document.addEventListener('DOMContentLoaded', function () {
        var filterBtn = document.getElementById('mobile-filter-btn');
        var filterModal = document.getElementById('filter-modal');
        if (filterBtn && filterModal) {
            filterBtn.addEventListener('click', function () {
                filterModal.classList.add('visible');
                document.body.classList.add('overflow-hidden');
            });
        }
    });

    document.addEventListener('DOMContentLoaded', function () {
        // ... các code khác ...
        updateTabCounts();
    });

    const filterSearchInput = document.getElementById('filter-search-input');
    if (filterSearchInput) {
        filterSearchInput.addEventListener('input', debounce(function () {
            applyFilters('desktop');
        }, 300));
    }

    document.addEventListener('DOMContentLoaded', function () {

    });
    document.addEventListener('DOMContentLoaded', function () {
        // Sau khi thêm tất cả các dòng từ localStorage, cập nhật lại UI
        reindexOrderRows(); // Đánh số lại STT
        // Lấy lại tất cả các dòng clickable-row từ DOM sau khi thêm dòng mới
        const updatedRows = Array.from(orderTableBody.querySelectorAll('tr.clickable-row')); // Replace tbody with orderTableBody
        filteredRows = updatedRows; // Cập nhật lại toàn bộ filteredRows

        updateTabCounts(); // Cập nhật số lượng trên tabs
        // filteredRows đã được cập nhật trong addNewOrder hoặc khi load trang ban đầu
        updatePagination(); // Cập nhật phân trang
        goToPage(1); // Hiển thị trang đầu tiên

        reindexOrderRows();
        updateTabCounts && updateTabCounts();
    });

    // === Thêm hàm đánh lại số thứ tự STT cho các dòng đơn hàng ===
    function reindexOrderRows() {
        // Chỉ lấy các dòng hiển thị để đánh STT
        const rows = document.querySelectorAll('#order-table-body tr.clickable-row:not([style*="display: none"])');
        let stt = 1;
        rows.forEach(row => {
            // Kiểm tra lại để đảm bảo chỉ đánh số cho dòng hiển thị
            if (row.style.display !== 'none') {
                row.children[1].textContent = stt++;
            }
        });
    }

    // === Image Modal Logic ===
    const imageModalOverlay = document.getElementById('image-modal-overlay');
    const largePackageImage = document.getElementById('large-package-image');
    const imageModalCloseBtn = document.getElementById('image-modal-close-btn');

    function showImageModal(imageUrl) {
        if (imageModalOverlay && largePackageImage) {
            largePackageImage.src = imageUrl;
            imageModalOverlay.classList.add('visible');
            manageBodyScroll(); // Manage body scroll when modal is open
        }
    }

    function hideImageModal() {
        if (imageModalOverlay) {
            imageModalOverlay.classList.remove('visible');
            manageBodyScroll(); // Manage body scroll when modal is closed
        }
    }

    document.addEventListener('DOMContentLoaded', function () {
        // Add event listeners to image triggers AFTER rows are potentially added/rendered
        // Using event delegation on the table body
        // Note: Need to select from the document or a static container if orderTableBody is dynamic
        document.body.addEventListener('click', function (event) {
            const imageTrigger = event.target.closest('.image-modal-trigger img');
            if (imageTrigger) {
                event.stopPropagation(); // Prevent row click handler
                const imageUrl = imageTrigger.src;
                if (imageUrl) {
                    showImageModal(imageUrl);
                }
            }
        });

        // Add event listener for clicking on Order ID links to set sourcePage in sessionStorage
        document.body.addEventListener('click', function (event) {
            const orderLink = event.target.closest('a.order-id-link');
            if (orderLink) {
                // Set the source page flag before navigating
                sessionStorage.setItem('sourcePageOrderDetail', 'package-manager');
                // Allow the default link navigation to proceed
            }
        });

        // Close modal when clicking close button or overlay background
        if (imageModalCloseBtn) {
            imageModalCloseBtn.addEventListener('click', hideImageModal);
        }
        if (imageModalOverlay) {
            imageModalOverlay.addEventListener('click', function (event) {
                if (event.target === imageModalOverlay) {
                    hideImageModal();
                }
            });
        }

        // Close modal with Escape key
        document.addEventListener('keydown', function (event) {
            if (event.key === 'Escape' && imageModalOverlay.classList.contains('visible')) {
                hideImageModal();
            }
        });
    });

    // Override default manageBodyScroll to include the new image modal
    const originalManageBodyScroll = typeof manageBodyScroll !== 'undefined' ? manageBodyScroll : null;
    manageBodyScroll = () => {
        const isSidebarOpen = document.body.classList.contains('sidebar-mobile-open');
        const isAnyModalVisible = document.querySelector('.filter-modal.visible, .confirmation-modal.visible');
        const isImageModalVisible = imageModalOverlay && imageModalOverlay.classList.contains('visible');
        if (isSidebarOpen || isAnyModalVisible || isImageModalVisible) {
            document.body.classList.add('overflow-hidden');
        } else {
            document.body.classList.remove('overflow-hidden');
        }
    };
    // End Image Modal Logic

    // Thêm biến và hàm xử lý phân trang
    let currentPage = 1;
    let itemsPerPage = 8; // Giá trị mặc định
    let totalItems = 0;
    let totalPages = 0;

    // Thêm hàm xử lý thay đổi số đơn hàng trên mỗi trang
    function handleItemsPerPageChange() {
        const select = document.getElementById('items-per-page-select');
        if (select) {
            // Lấy giá trị mới từ select
            const newItemsPerPage = parseInt(select.value);

            // Cập nhật biến itemsPerPage
            itemsPerPage = newItemsPerPage;

            // Reset về trang 1
            currentPage = 1;

            // Cập nhật lại phân trang
            updatePagination();
            goToPage(1);
        }
    }

    function updatePagination() {
        totalItems = filteredRows.length; // Tổng số đơn hàng là số lượng trong filteredRows
        totalPages = Math.ceil(totalItems / itemsPerPage);

        // Cập nhật thông tin hiển thị
        const startIndex = (totalItems === 0) ? 0 : (currentPage - 1) * itemsPerPage + 1; // Nếu không có đơn hàng, hiển thị 0
        const endIndex = Math.min(currentPage * itemsPerPage, totalItems);

        document.getElementById('start-index').textContent = startIndex;
        document.getElementById('end-index').textContent = endIndex;
        document.getElementById('total-entries').textContent = totalItems;

        // Cập nhật trạng thái nút Previous/Next
        document.getElementById('prev-page').disabled = currentPage === 1 || totalItems === 0;
        document.getElementById('next-page').disabled = currentPage === totalPages || totalItems === 0;

        // Tạo các nút số trang
        const pageNumbers = document.getElementById('page-numbers');
        pageNumbers.innerHTML = '';

        // Hiển thị tối đa 5 trang xung quanh trang hiện tại, hoặc ít hơn nếu gần đầu/cuối
        let startPage = Math.max(1, currentPage - 2);
        let endPage = Math.min(totalPages, startPage + 4);

        // Điều chỉnh lại startPage nếu totalPages < 5 hoặc endPage bị giới hạn
        if (endPage - startPage < 4) {
            startPage = Math.max(1, endPage - 4);
        }

        // Nếu không có trang nào (totalItems === 0), không hiển thị nút số trang
        if (totalPages > 0) {
            for (let i = startPage; i <= endPage; i++) {
                const pageButton = document.createElement('button');
                pageButton.className = `button ${i === currentPage ? 'active' : ''}`;
                pageButton.textContent = i;
                pageButton.onclick = () => goToPage(i);
                pageNumbers.appendChild(pageButton);
            }
        }

    }

    function goToPage(page) {
        // console.log(`goToPage(${page}) called. totalPages: ${totalPages}, filteredRows.length: ${filteredRows.length}`);
        if (page < 1 || page > totalPages) {
            // console.log("Page out of bounds.");
            return;
        }

        currentPage = page;

        // Ẩn TẤT CẢ các dòng trước khi hiển thị các dòng của trang hiện tại
        const allRows = document.querySelectorAll('#order-table-body tr.clickable-row');
        allRows.forEach(row => {
            row.style.display = 'none';
        });

        const startIndex = (page - 1) * itemsPerPage;
        const endIndex = Math.min(startIndex + itemsPerPage, filteredRows.length); // Sử dụng filteredRows.length

        // console.log(`Showing rows from index ${startIndex} to ${endIndex-1} from filteredRows.`);
        // Chỉ hiển thị các dòng trong filteredRows cho trang hiện tại
        for (let i = startIndex; i < endIndex; i++) {
            if (filteredRows[i]) { // Kiểm tra tồn tại
                filteredRows[i].style.display = '';
            }
        }

        updatePagination(); // Cập nhật thông tin phân trang và nút dựa trên trạng thái hiện tại (bao gồm filteredRows.length)
        reindexOrderRows(); // Đánh số lại STT cho các dòng hiển thị
    }

    // Thêm event listeners cho nút Previous/Next
    document.getElementById('prev-page').addEventListener('click', () => goToPage(currentPage - 1));
    document.getElementById('next-page').addEventListener('click', () => goToPage(currentPage + 1));

    // Cập nhật phân trang khi DOM đã load
    document.addEventListener('DOMContentLoaded', function () {
        // Lấy tất cả các dòng đơn hàng ban đầu
        const initialRows = Array.from(document.querySelectorAll('#order-table-body tr.clickable-row'));
        // Khởi tạo filteredRows với tất cả các dòng khi load trang lần đầu
        filteredRows = initialRows;
        // Cập nhật số lượng trên các tab dựa trên filteredRows ban đầu
        updateTabCounts(); // Gọi updateTabCounts trước để đếm đúng số lượng ban đầu
        // Sau đó cập nhật phân trang và hiển thị trang 1
        updatePagination();
        goToPage(1);

        // Thêm event listener cho select items per page
        const itemsPerPageSelect = document.getElementById('items-per-page-select');
        if (itemsPerPageSelect) {
            itemsPerPageSelect.addEventListener('change', handleItemsPerPageChange);
            // Set giá trị mặc định là 8
            itemsPerPageSelect.value = '8';
        }

        // Gắn lại sự kiện click cho các tab sau khi DOMContentLoaded
        const tabItems = document.querySelectorAll('.tabs .tab-item');
        tabItems.forEach(tab => {
            tab.addEventListener('click', function () {
                // Xóa lớp 'active' khỏi tất cả các tab
                tabItems.forEach(t => t.classList.remove('active'));
                // Thêm lớp 'active' cho tab được click
                tab.classList.add('active');

                // Lấy trạng thái từ text tab (bỏ số lượng đi)
                const status = this.textContent.replace(/\s*\(\d+\)/, '').trim();

                // Gọi applyFilters với source là 'tab'
                applyFilters('tab', status); // Truyền source là 'tab'
            });
        });

        var mobileStatusSelect = document.getElementById('mobile-status-select');
        if (mobileStatusSelect) {
            mobileStatusSelect.addEventListener('change', function () {
                var status = this.value;
                // Gọi applyFilters với source là 'mobile-select'
                applyFilters('mobile-select', status); // Truyền source là 'mobile-select'
            });
        }

        // === Basic JS to focus date inputs on click ===
        flatpickr("#date-start", { /* options */ });
        flatpickr("#date-end", { /* options */ });
        flatpickr("#modal-date-start", { /* options */ });
        flatpickr("#modal-date-end", { /* options */ });
        // ===============================================
    });

    // Cập nhật phân trang khi có thay đổi về số lượng đơn hàng
    // Hàm này không còn cần gọi updatePagination() bên trong nữa.
    function updateTabCounts() {
        const statusCounts = {};

        // Đếm tổng số đơn hàng từng trạng thái dựa trên data-status trong filteredRows
        filteredRows.forEach(row => {
            let status = row.getAttribute('data-status') || '';
            // CHUẨN HÓA: Nếu là 'Đang phát hàng' thì quy về 'Đang phát' để khớp tab
            if (status === 'Đang phát hàng') status = 'Đang phát';
            if (status === 'Mới tạo đơn' || status === 'Mới tạo') status = 'Mới tạo';
            if (status === 'Đã nhận hàng') status = 'Nhận hàng';
            statusCounts[status] = (statusCounts[status] || 0) + 1;
        });

        // Lấy danh sách tab hiện tại
        const tabsContainer = document.querySelector('.tabs');
        const tabNodes = Array.from(tabsContainer.querySelectorAll('.tab-item'));

        // Tách tab 'Tất cả' ra riêng
        const allTab = tabNodes.find(tab => tab.textContent.trim().startsWith('Tất cả'));
        const otherTabs = tabNodes.filter(tab => tab !== allTab);

        // Lấy trạng thái từ text tab
        const getStatusFromTab = tab => tab.textContent.replace(/\s*\(\d+\)/, '').trim();

        // Cập nhật lại số lượng trên từng tab
        if (allTab) {
            // Tab 'Tất cả' đếm TỔNG số dòng trong filteredRows
            allTab.textContent = `Tất cả (${filteredRows.length})`;
        } else {
            console.warn("Tab 'Tất cả' not found!");
        }
        otherTabs.forEach(tab => {
            const status = getStatusFromTab(tab);
            const count = statusCounts[status] || 0;
            tab.textContent = `${status} (${count})`;
        });

    }
    document.addEventListener('DOMContentLoaded', function () {
        // Kiểm tra xem có dữ liệu từ create-package-step2 không
        const orderData = JSON.parse(localStorage.getItem('currentOrderDetail') || '{}');
        console.log('Retrieved order data:', orderData);

        if (Object.keys(orderData).length > 0) {
            // Tạo một hàng mới trong bảng
            const tbody = document.getElementById('order-table-body');
            if (!tbody) {
                console.error('Không tìm thấy tbody với id order-table-body');
                return;
            }

            const newRowId = 'main-row-new';
            const newDetailsRowId = 'details-row-new';

            // Tạo HTML cho hàng chính
            const mainRowHTML = `
                        <tr id="${newRowId}" class="clickable-row" data-order-id="${orderData.bill_code}" data-status="Mới tạo">
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

            // Tạo HTML cho hàng chi tiết
            const detailsRowHTML = `
                        <tr class="details-row" id="${newDetailsRowId}" style="display: none;">
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
                                        <div class="detail-item full-width"><span class="detail-label">Ghi chú CPK:</span><span class="detail-value">${(orderData.add_service && Array.isArray(orderData.add_service) && orderData.add_service.length > 0 ? orderData.add_service.map(service => { const serviceMap = { 'signature': 'Chữ Ký', 'fumigation': 'FUMIGATION', 'packing': 'Đóng kiện gỗ', 'insurance': 'Bảo hiểm hàng hóa' }; return serviceMap[service] || service; }).join(' / ') : 'Không có ghi chú')}</span></div>
                                    </div>
                                    <div class="details-action-icons">
                                        <button class="icon-button icon-print" title="In chi tiết"><i class="fa-solid fa-print"></i></button>
                                        <button class="icon-button icon-excel" title="Xuất Excel"><i class="fa-solid fa-file-excel"></i></button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    `;

            // Thêm các hàng mới vào đầu bảng
            orderTableBody.insertAdjacentHTML('afterbegin', mainRowHTML + detailsRowHTML); // Replace tbody with orderTableBody

            // Thêm sự kiện click cho hàng mới
            const newRow = document.getElementById(newRowId);
            const newDetailsRow = document.getElementById(newDetailsRowId);

            if (newRow && newDetailsRow) {
                newRow.addEventListener('click', function () {
                    const isVisible = newDetailsRow.style.display !== 'none';
                    newDetailsRow.style.display = isVisible ? 'none' : 'table-row';
                });
            }

            // Cập nhật lại danh sách đơn hàng và phân trang
            const initialRows = Array.from(document.querySelectorAll('#order-table-body tr.clickable-row'));
            filteredRows = initialRows;
            updateTabCounts();
            updatePagination();
            goToPage(1);


        }
    });
    // ... existing code ...

    document.addEventListener('DOMContentLoaded', function () {
        // Cập nhật trạng thái thanh toán từ localStorage cho cả KH và ĐL
        const rows = document.querySelectorAll('#order-table-body tr.clickable-row');
        rows.forEach(row => {
            const billCode = row.getAttribute('data-order-id');

            // Cập nhật cột KH TT (index 11)
            const paymentStatusKH = localStorage.getItem('paymentStatusKH_' + billCode);
            if (paymentStatusKH) {
                row.children[11].innerHTML = paymentStatusKH === 'Đã thanh toán đủ'
                    ? '<span class="status-badge status-paid">Đã thanh toán</span>'
                    : (paymentStatusKH === 'Thanh toán một phần'
                        ? '<span class="status-badge status-warning">Thanh toán một phần</span>'
                        : '<span class="status-badge status-unpaid">Chưa thanh toán</span>');
            }

            // Cập nhật cột ĐL TT (index 12)
            const paymentStatusDL = localStorage.getItem('paymentStatusDL_' + billCode);
            if (paymentStatusDL) {
                row.children[12].innerHTML = paymentStatusDL === 'Đã thanh toán đủ'
                    ? '<span class="status-badge status-paid">Đã thanh toán</span>'
                    : (paymentStatusDL === 'Thanh toán một phần'
                        ? '<span class="status-badge status-warning">Thanh toán một phần</span>'
                        : '<span class="status-badge status-unpaid">Chưa thanh toán</span>');
            }
        });

        // Tùy chọn: Tự động reload khi có thay đổi trạng thái từ tab khác
        window.addEventListener('storage', function (e) {
            // Reload khi có thay đổi trạng thái KH hoặc ĐL
            if (e.key && (e.key.startsWith('paymentStatusKH_') || e.key.startsWith('paymentStatusDL_'))) {
                location.reload();
            }
        });
    });

    if (orderTableBody) orderTableBody.addEventListener('click', function (event) {
        // ... existing code ...
        const targetElement = event.target;

        if (targetElement.closest('.manage-payment-btn')) {
            event.preventDefault(); // Ngăn hành động mặc định của thẻ <a> nếu có href="#"
            const paymentButton = targetElement.closest('.manage-payment-btn');
            const mainRow = paymentButton.closest('tr.clickable-row');
            const orderId = mainRow?.dataset.orderId;
            if (orderId) {
                // Chuyển hướng đến trang quản lý thanh toán với orderId trên URL
                window.location.href = `payment-management.html?orderId=${orderId}`;
            }
        }
        // ... existing code ...
    });

    // Hàm xuất Excel cho bảng đơn hàng
    function exportOrderTableToExcel() {
        var table = document.getElementById('orderTable');
        if (!table) {
            alert('Không tìm thấy bảng đơn hàng!');
            return;
        }
        var wb = XLSX.utils.table_to_book(table, { sheet: "Đơn hàng" });
        XLSX.writeFile(wb, 'danh_sach_don_hang.xlsx');
    }

    // Gắn sự kiện cho nút Xuất DEBIT
    document.addEventListener('DOMContentLoaded', function () {
        var exportBtn = document.querySelector('.action-row .button.secondary');
        if (exportBtn && exportBtn.textContent.includes('Xuất DEBIT')) {
            exportBtn.addEventListener('click', function (e) {
                e.preventDefault();
                exportOrderTableToExcel();
            });
        }
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
@endpush
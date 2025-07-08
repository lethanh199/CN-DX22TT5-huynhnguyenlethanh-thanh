🗓️ Báo cáo tiến độ Tuần 5
Thời gian: 06/07/2025 – 12/07/2025
Họ tên: Huỳnh Nguyễn Lê Thanh
MSSV: 170122196
Lớp: DX22TT5
Đề tài: Xây dựng Website mua bán Đồ gỗ qua sử dụng

✅ 1. Mục tiêu tuần 5
Phát triển các chức năng cốt lõi của hệ thống:

Giỏ hàng (cart)

Đặt hàng / thanh toán giả lập

Thống kê đơn hàng (admin)

Hoàn thiện giao diện chi tiết sản phẩm

🛠 2. Nội dung đã thực hiện
2.1. Chức năng giỏ hàng:
Thêm sản phẩm vào giỏ từ trang chủ và trang chi tiết.

Cập nhật số lượng sản phẩm trong giỏ hàng.

Xóa sản phẩm khỏi giỏ hàng.

Hiển thị tổng tiền và danh sách sản phẩm trong cart.php.

2.2. Quy trình đặt hàng:
Tạo bảng orders, order_details trong cơ sở dữ liệu.

Cho phép người dùng xác nhận đơn hàng từ giỏ và lưu đơn vào hệ thống.

Thông báo đơn hàng thành công, redirect sau khi đặt hàng.

2.3. Thống kê quản trị:
Trang admin/orders.php hiển thị danh sách đơn hàng.

Giao diện thống kê đơn hàng đơn giản, có lọc theo thời gian.

Hiển thị số lượng đơn, tổng tiền, trạng thái đơn hàng.

2.4. Giao diện chi tiết sản phẩm:
Căn chỉnh bố cục ảnh bên trái – thông tin bên phải.

Nút “Thêm giỏ” và “Yêu thích” gọn gàng, rõ ràng.

Cải tiến responsive trên màn hình nhỏ.

📁 3. Cập nhật repository
Commit thêm các file và cập nhật:

cart.php, checkout.php, order_success.php, admin/orders.php

Cập nhật product_detail.php, style.css cho UI

Cập nhật db.sql với bảng orders, order_details

Tạo thư mục orders/ để chứa logic đơn hàng nếu cần.

📝 4. Kết quả đạt được
Các tính năng chính đã hoạt động ổn định:

Người dùng thêm/xóa sản phẩm trong giỏ.

Đặt đơn thành công và lưu vào CSDL.

Giao diện đẹp hơn, thân thiện hơn.

Thống kê đơn hàng hỗ trợ tốt cho quản trị viên.

⚠️ 5. Khó khăn & cách khắc phục
Vấn đề	Cách xử lý
Lỗi session giỏ hàng mất sau khi chuyển trang	Đảm bảo session_start() được gọi đầu mỗi file
SQL lỗi khi lưu đơn hàng	Kiểm tra binding tham số, dùng prepare() đúng kiểu dữ liệu
Giao diện không cân đối trên mobile	Sử dụng flex-wrap, thêm media query CSS

🎯 6. Kế hoạch tuần tới
Tích hợp tính năng quản lý yêu thích (wishlist).

Cải tiến UI quản trị: bố cục bảng, nút hành động.

Thêm biểu đồ thống kê đơn hàng (nếu kịp).

Kiểm thử toàn bộ hệ thống trước khi đóng chức năng.
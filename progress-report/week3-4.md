🗓️ Báo cáo tiến độ tuần 3–4
Thời gian: 22/06/2025 – 05/07/2025
Họ tên: Huỳnh Nguyễn Lê Thanh
MSSV: 170122196
Lớp: DX22TT5
Đề tài: Xây dựng Website mua bán Đồ gỗ qua sử dụng

✅ 1. Mục tiêu tuần 3–4
Triển khai các chức năng cơ bản của hệ thống:

Quản lý sản phẩm

Quản lý danh mục

Quản lý người dùng

Xây dựng giao diện người dùng cho:

Trang chủ

Trang chi tiết sản phẩm

🛠 2. Nội dung đã thực hiện
2.1. Backend:
Viết chức năng thêm, sửa, xóa sản phẩm bằng PHP (admin).

Cấu trúc lại cơ sở dữ liệu theo sơ đồ ERD đã thiết kế.

Tạo bảng categories, products, users và thiết lập ràng buộc khóa ngoại.

Lập trình chức năng đăng nhập, đăng ký người dùng.

2.2. Frontend:
Xây dựng trang chủ (index.php) hiển thị sản phẩm theo hàng ngang.

Thiết kế product_detail.php bố cục hình ảnh bên trái, thông tin bên phải.

Tạo CSS cơ bản: tông nâu gỗ, giao diện thân thiện, có hiệu ứng hover.

📁 3. Cập nhật repository
Commit các file sau:

src/index.php, product_detail.php, admin/index.php, admin/add_product.php…

css/style.css, images/, sql/db.sql

Tạo thư mục progress-report/ và cập nhật tiến độ tuần.

📝 4. Kết quả đạt được
Các chức năng cơ bản hoạt động ổn định trên môi trường cục bộ (XAMPP).

Giao diện đạt yêu cầu tối thiểu về bố cục và thẩm mỹ.

Website có thể thực hiện thao tác thêm sản phẩm vào giỏ, xem chi tiết.

⚠️ 5. Khó khăn & hướng xử lý
Vấn đề	Cách xử lý
Bố cục sản phẩm hiển thị theo chiều dọc	Điều chỉnh CSS display: flex; flex-wrap để hiển thị hàng ngang
Lỗi không hiển thị ảnh khi thêm sản phẩm	Kiểm tra đường dẫn và đảm bảo ảnh được đặt trong thư mục img/

🎯 6. Kế hoạch tuần tiếp theo
Tích hợp giỏ hàng, chức năng đặt hàng giả lập.

Viết module thống kê đơn hàng trong trang quản trị.

Tiếp tục hoàn thiện CSS để tối ưu trải nghiệm người dùng.
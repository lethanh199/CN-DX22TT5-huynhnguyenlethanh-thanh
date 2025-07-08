# 🪑 Website Mua Bán Đồ Gỗ Qua Sử Dụng

Đây là dự án xây dựng một website đơn giản cho phép người dùng đăng tin, tìm kiếm, và mua bán đồ gỗ cũ. Website được xây dựng bằng PHP và MySQL.

---

## 🚀 Chức năng chính

- 🧾 Đăng ký / đăng nhập tài khoản người dùng
- 🪑 Xem danh sách và chi tiết sản phẩm
- 🛒 Thêm sản phẩm vào giỏ hàng
- 💳 Thanh toán và tạo đơn hàng
- 🛠️ Trang quản trị để thêm, sửa sản phẩm
- 🔒 Phân quyền người dùng (admin / user)

---

## 🗂️ Cấu trúc thư mục

do-go-cu-website/
├── index.php # Trang chủ
├── product_detail.php # Chi tiết sản phẩm
├── login.php # Đăng nhập
├── register.php # Đăng ký
├── cart.php # Giỏ hàng
├── checkout.php # Thanh toán
├── config.php # Kết nối CSDL
├── header.php # Header dùng chung
├── footer.php # Footer dùng chung
├── css/style.css # Giao diện
├── admin/
│ ├── index.php # Quản lý sản phẩm
│ ├── add_product.php # Thêm sản phẩm
│ └── edit_product.php # Sửa sản phẩm

## ⚙️ Cài đặt và triển khai

### 🔧 Yêu cầu hệ thống

- PHP >= 7.4
- MySQL hoặc MariaDB
- Web Server (Apache hoặc XAMPP, Laragon, v.v.)
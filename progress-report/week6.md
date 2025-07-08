🗓️ Báo cáo tiến độ Tuần 6
Thời gian: 13/07/2025 – 19/07/2025
Họ tên: Huỳnh Nguyễn Lê Thanh
MSSV: 170122196
Lớp: DX22TT5
Đề tài: Xây dựng Website mua bán Đồ gỗ qua sử dụng

✅ 1. Mục tiêu tuần 6
Tích hợp tất cả các module đã lập trình trong những tuần trước.

Thực hiện kiểm thử toàn diện hệ thống.

Sửa lỗi, cải thiện hiệu năng và giao diện.

🛠 2. Nội dung đã thực hiện
2.1. Tích hợp hệ thống:
Kết nối đầy đủ các module: đăng nhập, đăng ký, giỏ hàng, đặt hàng, quản lý sản phẩm, quản lý đơn hàng.

Đồng bộ hóa luồng xử lý dữ liệu giữa Front-end và Back-end.

Đảm bảo cơ sở dữ liệu liên kết đúng giữa các bảng (users, products, orders, order_details, reviews, wishlist...).

2.2. Kiểm thử chức năng:
Kiểm thử đơn vị (Unit Test):

Kiểm tra từng chức năng nhỏ: thêm vào giỏ, thêm sản phẩm, xác nhận đơn hàng...

Kiểm thử tích hợp (Integration Test):

Kiểm tra toàn bộ quy trình từ người dùng đến admin (đặt hàng → lưu đơn → hiển thị đơn).

Kiểm thử giao diện (UI Test):

Giao diện hiển thị tốt trên các độ phân giải khác nhau.

Kiểm tra phản hồi của các nút, liên kết, biểu mẫu.

2.3. Tối ưu hiệu năng và sửa lỗi:
Loại bỏ các truy vấn dư thừa trong PHP.

Cải thiện tốc độ tải trang bằng cách:

Giảm dung lượng hình ảnh.

Gộp CSS và JS.

Sửa các lỗi phát sinh:

Form không hoạt động do thiếu method="post".

Sai đường dẫn ảnh hoặc tệp CSS.

Session giỏ hàng mất khi logout: Đã thêm xác nhận.

📁 3. Cập nhật repository
Tổ chức lại thư mục src/, admin/, includes/.

Tạo file README.md mô tả cấu trúc project.

Cập nhật toàn bộ file đã tích hợp & sửa lỗi.

Ghi lại lịch sử commit rõ ràng theo từng module: cart, order, auth, admin.

📝 4. Kết quả đạt được
Toàn bộ hệ thống đã vận hành ổn định.

Các tính năng hoạt động khớp với mô tả ban đầu.

Giao diện trực quan hơn, dễ sử dụng cho cả người dùng và quản trị viên.

⚠️ 5. Khó khăn & cách khắc phục
Vấn đề	Cách xử lý
Dữ liệu không đồng bộ giữa session và database	Kiểm tra lại logic lưu đơn hàng, thêm xác nhận đơn chính xác
Giao diện bị lỗi font, bố cục vỡ trên mobile	Dùng @media và đơn giản hóa layout
Một số query chạy chậm khi hiển thị thống kê	Thêm chỉ mục cho các cột thường tìm kiếm (ví dụ: created_at, category_id)

🎯 6. Kế hoạch tuần tới
Viết báo cáo chi tiết cho đồ án.

Tạo slide báo cáo & demo video (nếu cần).

Hoàn thiện tài liệu hướng dẫn cài đặt và sử dụng hệ thống.

Nộp GitHub Repository cho giảng viên hướng dẫn.
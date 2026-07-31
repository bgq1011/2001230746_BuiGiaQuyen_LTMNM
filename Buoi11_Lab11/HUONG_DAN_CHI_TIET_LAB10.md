

## 1. CÁC LỆNH ARTISAN PHẢI SỬ DỤNG

```bash
# 1. Tạo liên kết tệp tin lưu trữ tải lên (Storage Link)
php artisan storage:link

# 2. Cập nhật các bảng mới vào Cơ sở dữ liệu MySQL
php artisan migrate

# 3. (Tùy chọn) Làm mới toàn bộ CSDL và nạp dữ liệu mẫu + tài khoản Admin test
php artisan migrate:fresh --seed

# 4. Chạy máy chủ phát triển cục bộ
php artisan serve
```

>  **Tài khoản Admin thử nghiệm:**
> - **Email**: `admin@example.com`
> - **Mật khẩu**: `admin123`

---

## 2. QUY TRÌNH HOẠT ĐỘNG VÀ CÁC CODE CẦN DÙNG CỦA TỪNG BÀI TẬP

---

### 🔹 BÀI TẬP 01: Khung Layout Quản trị & Xác thực Đăng nhập

#### 🎯 Mục tiêu
Tạo cấu hình giao diện Admin chuẩn dùng Bootstrap 5, chia nhỏ giao diện thành các partials (`_sidebar`, `_topbar`, `_flash`), xử lý đăng nhập & đăng xuất với Laravel Breeze.

#### 🔄 Quy trình hoạt động
1. Người dùng truy cập đường dẫn `/admin`.
2. Middleware `auth` kiểm tra phiên đăng nhập. Nếu chưa đăng nhập $\rightarrow$ chuyển hướng về `/login`.
3. Khi đăng nhập thành công $\rightarrow$ giao diện nạp trang `admin.layouts.main`, bao gồm Sidebar bên trái và Topbar phía trên.

#### 📁 Mã nguồn liên quan
- **Layout chính**: `resources/views/admin/layouts/main.blade.php`
- **Sidebar**: `resources/views/admin/partials/_sidebar.blade.php`
- **Topbar**: `resources/views/admin/partials/_topbar.blade.php`
- **Flash Message**: `resources/views/admin/partials/_flash.blade.php`

---

### 🔹 BÀI TẬP 02: CRUD Danh mục Tin tức

#### 🎯 Mục tiêu
Tạo bảng danh mục, xử lý danh sách, thêm, sửa, xóa danh mục tin tức.

#### 🔄 Quy trình hoạt động
1. Admin gửi dữ liệu qua Form Tạo/Sửa danh mục.
2. `DanhMucRequest` kiểm tra tính bắt buộc (`required`) và không trùng lặp (`unique`) của tên & slug.
3. `DanhMucController` lưu bản ghi vào bảng `danh_mucs` trong MySQL và trả về thông báo `session('ok') = 'Thêm danh mục thành công'`.

#### 📁 Mã nguồn liên quan
- **Migration**: `database/migrations/2026_07_29_080000_create_danh_mucs_table.php`
- **Model**: `app/Models/DanhMuc.php` (quan hệ `hasMany` với `TinTuc`)
- **Request**: `app/Http/Requests/DanhMucRequest.php`
- **Controller**: `app/Http/Controllers/Admin/DanhMucController.php`
- **Views**: `resources/views/admin/danhmuc/index.blade.php`, `create.blade.php`, `edit.blade.php`

---

### 🔹 BÀI TẬP 03: CRUD Tin tức, Upload ảnh đại diện & Thùng rác (SoftDeletes)

#### 🎯 Mục tiêu
Quản lý tin tức, upload ảnh đại diện vào `storage/app/public/news`, xóa tạm vào thùng rác (`SoftDeletes`), khôi phục và xóa vĩnh viễn.

#### 🔄 Quy trình hoạt động
1. **Upload ảnh**: Tệp được lưu vào thư mục `storage/app/public/news`. Khi chỉnh sửa và chọn ảnh mới, hệ thống dùng `Storage::disk('public')->delete()` để xóa tệp ảnh cũ.
2. **Soft Delete (Xóa tạm)**: Nút "Xóa" gọi phương thức `destroy()`, gán ngày giờ xóa vào cột `deleted_at`. Bài viết ẩn khỏi danh sách chính.
3. **Khôi phục / Xóa vĩnh viễn**: Hàm `restore()` gán `deleted_at = null`. Hàm `forceDelete()` xóa hẳn bản ghi trong CSDL và xóa tệp ảnh vật lý.

#### 📁 Mã nguồn liên quan
- **Migration**: `database/migrations/2026_07_31_000000_add_upload_and_softdeletes_to_tin_tucs.php`
- **Model**: `app/Models/TinTuc.php` (sử dụng trait `SoftDeletes`, accessor `thumb_url`)
- **Request**: `app/Http/Requests/TinTucRequest.php` (kiểm tra tệp ảnh $\le$ 2MB, định dạng jpg, png, webp)
- **Controller**: `app/Http/Controllers/Admin/TinTucAdminController.php`

---

### 🔹 BÀI TẬP 04: Chuẩn hóa Giao diện Admin (Bootstrap 5 & Dashboard)

#### 🎯 Mục tiêu
Đồng bộ CSS cho toàn bộ Admin, hiệu ứng `active` trên menu Sidebar, Breadcrumbs động và Dashboard thống kê.

#### 🔄 Quy trình hoạt động
1. File `admin.css` thiết lập `--sidebar-w: 260px` và dàn trang responsive.
2. `DashboardController` truy vấn đếm:
   - Tổng số bài viết (`TinTuc::count()`)
   - Số bài trong thùng rác (`TinTuc::onlyTrashed()->count()`)
   - Số danh mục (`DanhMuc::count()`)
3. Trả về view `admin.dashboard.index` để hiển thị 3 thẻ Card thống kê.

#### 📁 Mã nguồn liên quan
- **CSS**: `public/css/admin.css`
- **Controller**: `app/Http/Controllers/Admin/DashboardController.php`
- **View Dashboard**: `resources/views/admin/dashboard/index.blade.php`
- **Component Breadcrumb**: `resources/views/admin/partials/_breadcrumb.blade.php`

---

### 🔹 BÀI TẬP 05: Bổ sung Trạng thái Bài viết (Draft / Published)

#### 🎯 Mục tiêu
Quản lý trạng thái xuất bản (Nháp / Đã đăng), hiển thị Badge màu sắc và bộ lọc trạng thái.

#### 🔄 Quy trình hoạt động
1. Form tạo/sửa bài viết có dropdown chọn Trạng thái (`draft` hoặc `published`).
2. Khi người dùng lưu bài với trạng thái `published`, Controller kiểm tra nếu chưa có ngày đăng $\rightarrow$ tự động gán `ngaydang = now()`.
3. Trang danh sách hiển thị Badge:
   - Màu xanh lá (`bg-success`): **Đã đăng**
   - Màu xám (`bg-secondary`): **Nháp**

#### 📁 Mã nguồn liên quan
- **Migration**: `database/migrations/2026_07_31_000001_add_trang_thai_to_tin_tucs_table.php`
- **Controller**: `TinTucAdminController.php` (`store`, `update`, `index`)

---

### 🔹 BÀI TẬP 06: Tạo Slug tự động cho Bài viết

#### 🎯 Mục tiêu
Tự sinh đường dẫn slug chuẩn từ tiêu đề bài viết, tự nhảy hậu tố `-2`, `-3` khi bị trùng tiêu đề. Xem chi tiết bài viết ngoài Frontend qua Slug.

#### 🔄 Quy trình hoạt động
1. Khi thêm/sửa bài viết mà để trống ô Slug, hàm `makeUniqueSlug()` sử dụng `Str::slug($tieude)` để biến đổi tiêu đề thành chuỗi slug không dấu.
2. Vòng lặp `while` truy vấn CSDL: nếu phát hiện slug đã tồn tại $\rightarrow$ tự gán thêm hậu tố dạng `tin-tuc-1-2`, `tin-tuc-1-3`.
3. Router ngoài Frontend `tin.show` chấp nhận cả `slug` lẫn `id`:
   ```php
   $tin = TinTuc::where('slug', $key)->orWhere('id', $key)->firstOrFail();
   ```

#### 📁 Mã nguồn liên quan
- **Migration**: `database/migrations/2026_07_31_000002_add_slug_to_tin_tucs_table.php`
- **Controller Admin**: `TinTucAdminController.php` (phương thức `makeUniqueSlug()`)
- **Controller Frontend**: `TinTucController.php` (phương thức `show()`)
- **Card Component**: `resources/views/components/news/card.blade.php`

---

### 🔹 BÀI TẬP 07: Tìm kiếm nâng cao & Upload nhiều ảnh (Gallery)

#### 🎯 Mục tiêu
Lọc danh sách bài viết đa điều kiện bằng `when()`, quản lý bộ sưu tập nhiều ảnh phụ cho bài viết.

#### 🔄 Quy trình hoạt động
1. **Tìm kiếm nâng cao**:
   Sử dụng chuỗi hàm `when()` trong Eloquent Query để kiểm tra và lọc theo từ khóa tiêu đề/slug, danh mục, trạng thái và khoảng ngày đăng (`from` $\rightarrow$ `to`). Giữ lại query string khi phân trang với `withQueryString()`.
2. **Upload nhiều ảnh (Gallery)**:
   - Chọn nhiều file `gallery[]` trong form $\rightarrow$ lưu tệp vào `storage/app/public/news/gallery`.
   - Mỗi ảnh tạo 1 bản ghi tương ứng trong bảng `hinh_anh_tin_tucs`.
3. **Xóa ảnh phụ**:
   - Trang sửa bài viết hiển thị danh sách ảnh phụ kèm nút **Xóa ảnh** (gọi route `tin.delete-image`).
   - Khi xóa vĩnh viễn bài viết (`forceDelete`), hệ thống quét và xóa toàn bộ các tệp ảnh chính và ảnh gallery vật lý trong thư mục storage.

#### 📁 Mã nguồn liên quan
- **Migration Gallery**: `database/migrations/2026_07_31_000003_create_hinh_anh_tin_tucs_table.php`
- **Model Gallery**: `app/Models/HinhAnhTinTuc.php`
- **Model TinTuc**: `app/Models/TinTuc.php` (khai báo quan hệ `hinhAnhs()`)
- **Controller**: `TinTucAdminController.php` (xử lý `index`, `store`, `update`, `deleteImage`, `forceDelete`)
- **Views**: `resources/views/admin/tin/index.blade.php` (Form lọc nâng cao), `edit.blade.php` (Hiển thị gallery + nút xóa ảnh phụ)

---

### 🔹 BÀI TẬP 08: Phân quyền cơ bản (Role-Based Access Control)

#### 🎯 Mục tiêu
Chỉ cho phép tài khoản có vai trò `admin` truy cập vào khu vực quản trị `/admin/*`. Người dùng thông thường bị chặn lỗi **403 Forbidden**.

#### 🔄 Quy trình hoạt động
1. Bảng `users` có cột `role` kiểu Enum (`admin`, `editor`, `user`), mặc định là `user`.
2. Middleware `CheckRole` đọc vai trò của tài khoản đang đăng nhập:
   ```php
   if (!in_array($user->role, $roles)) {
       abort(403, 'Không có quyền truy cập');
   }
   ```
3. Đăng ký alias middleware `'role' => \App\Http\Middleware\CheckRole::class` trong `app/Http/Kernel.php`.
4. Áp dụng middleware cho nhóm route admin trong `routes/web.php`:
   ```php
   Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(...);
   ```

#### 📁 Mã nguồn liên quan
- **Migration Role**: `database/migrations/2026_07_31_000004_add_role_to_users_table.php`
- **Middleware**: `app/Http/Middleware/CheckRole.php`
- **Kernel**: `app/Http/Kernel.php`
- **Route File**: `routes/web.php`
- **Seeder**: `database/seeders/DatabaseSeeder.php` (gán `role = 'admin'` cho tài khoản `admin@example.com`)

---

## 📌 TỔNG KẾT BẢNG MÃ NGUỒN CHÍNH CỦA DỰ ÁN

| Đường dẫn tệp | Bài tập liên quan | Chức năng chính |
| :--- | :--- | :--- |
| `routes/web.php` | BT01 $\rightarrow$ BT08 | Khai báo tất cả các Route kèm Middleware phân quyền `role:admin` |
| `app/Http/Controllers/Admin/TinTucAdminController.php` | BT03, 05, 06, 07 | Xử lý CRUD tin tức, upload ảnh đại diện, gallery, slug, soft delete |
| `app/Http/Controllers/Admin/DanhMucController.php` | BT02 | Xử lý CRUD danh mục tin tức |
| `app/Http/Controllers/Admin/DashboardController.php` | BT04 | Thống kê số lượng bài viết, thùng rác, danh mục cho Dashboard |
| `app/Http/Middleware/CheckRole.php` | BT08 | Middleware phân quyền kiểm tra vai trò admin |
| `app/Models/TinTuc.php` | BT03, 05, 06, 07 | Model tin tức, SoftDeletes, quan hệ `danhMuc()`, `hinhAnhs()` |
| `app/Models/HinhAnhTinTuc.php` | BT07 | Model quản lý bộ sưu tập ảnh phụ (Gallery) |
| `resources/views/admin/tin/index.blade.php` | BT03, 05, 06, 07 | Bảng danh sách tin tức, bộ lọc nâng cao, badge trạng thái, slug |
| `resources/views/admin/tin/edit.blade.php` | BT03, 05, 06, 07 | Form sửa bài viết, chọn trạng thái, upload ảnh chính & quản lý ảnh phụ |

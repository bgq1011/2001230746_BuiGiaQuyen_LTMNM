<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class TinTucSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Tạo danh mục
        $cat1 = DB::table('danh_mucs')->insertGetId(['ten' => 'Công nghệ', 'created_at' => now(), 'updated_at' => now()]);
        $cat2 = DB::table('danh_mucs')->insertGetId(['ten' => 'Lập trình', 'created_at' => now(), 'updated_at' => now()]);
        $cat3 = DB::table('danh_mucs')->insertGetId(['ten' => 'Phần mềm', 'created_at' => now(), 'updated_at' => now()]);

        // 2. Chèn tin tức gắn danh mục
        DB::table('tin_tucs')->insert([
            [
                'tieude' => 'Laravel 11 chính thức ra mắt',
                'tomtat' => 'Phiên bản mới với nhiều cải tiến về hiệu năng và bảo mật.',
                'noidung' => 'Laravel 11 mang đến nhiều tính năng hiện đại, hỗ trợ developer tốt hơn...',
                'hinhanh' => '1.jpg',
                'ngaydang' => Carbon::now()->subDays(3),
                'danh_muc_id' => $cat2
            ],
            [
                'tieude' => 'PHP 8.3 được cộng đồng đón nhận tích cực',
                'tomtat' => 'Ngôn ngữ PHP tiếp tục phát triển mạnh mẽ với nhiều tính năng mới.',
                'noidung' => 'Cộng đồng mã nguồn mở đánh giá cao tốc độ và khả năng tối ưu...',
                'hinhanh' => '2.jpg',
                'ngaydang' => Carbon::now()->subDays(2),
                'danh_muc_id' => $cat2
            ],
            [
                'tieude' => 'MySQL tung ra bản cập nhật 9.0',
                'tomtat' => 'Bản nâng cấp tăng cường khả năng xử lý dữ liệu lớn và tối ưu query.',
                'noidung' => 'Phiên bản mới của MySQL tập trung vào performance tuning...',
                'hinhanh' => '3.jpg',
                'ngaydang' => Carbon::now()->subDays(1),
                'danh_muc_id' => $cat1
            ],
            [
                'tieude' => 'VS Code trở thành IDE phổ biến nhất năm 2025',
                'tomtat' => 'Báo cáo từ StackOverflow cho thấy VS Code vẫn dẫn đầu.',
                'noidung' => 'Với hệ sinh thái mở rộng mạnh mẽ, VS Code chiếm lĩnh cộng đồng lập trình viên...',
                'hinhanh' => '4.jpg',
                'ngaydang' => Carbon::now(),
                'danh_muc_id' => $cat3
            ],
            [
                'tieude' => 'GitHub ra mắt tính năng AI Commit Summarizer',
                'tomtat' => 'Công cụ giúp tự động sinh mô tả commit bằng AI.',
                'noidung' => 'GitHub tiếp tục mở rộng tính năng Copilot nhằm tăng hiệu suất làm việc...',
                'hinhanh' => '5.jpg',
                'ngaydang' => Carbon::now(),
                'danh_muc_id' => $cat1
            ],
        ]);
    }
}

<?php

namespace App\Http\Controllers;

class PageController extends Controller
{
    // Bài 07: trang giới thiệu khóa học dùng layout chung
    public function about()
    {
        $labSessions = [
            'Buổi 1: Làm quen Laravel, cấu trúc project và route cơ bản',
            'Buổi 2: Route cơ bản & gợi nhớ PHP',
            'Buổi 3: Controller, Blade và danh sách sinh viên bằng mảng',
            'Buổi 4: Model, Migration & Eloquent với bảng students',
            'Buổi 5: So sánh dữ liệu mảng tĩnh và CSDL',
            'Buổi 6: Blade directive hiện đại, layout và component',
            'Buổi 7: Tổng ôn, hoàn thiện giao diện và kiểm tra lại chức năng',
        ];

        return view('pages.about', compact('labSessions'));
    }
}

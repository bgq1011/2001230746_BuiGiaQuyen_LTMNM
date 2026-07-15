@extends('layouts.app')

@section('title', 'Giới thiệu khóa học')

@section('content')
    <x-card title="Giới thiệu khóa học">
        <h2>Giới thiệu khóa học</h2>
        <p>
            Học phần này giúp sinh viên làm quen với Laravel 12 thông qua các bài tập thực hành,
            từ route, controller, view cho đến Eloquent, migration, seeder và Blade component.
        </p>

        <h3>Mục tiêu học phần</h3>
        <ul>
            <li>Hiểu và vận dụng được route, controller và view trong Laravel.</li>
            <li>Biết tổ chức dữ liệu bằng mảng PHP và truy vấn dữ liệu bằng Eloquent.</li>
            <li>Biết xây dựng layout chung, tái sử dụng Blade component và directive hiện đại.</li>
            <li>Rèn kỹ năng trình bày giao diện rõ ràng, đúng cấu trúc và dễ mở rộng.</li>
        </ul>

        <h3>Lịch 7 buổi lab</h3>
        <ol>
            @foreach ($labSessions as $session)
                <li>{{ $session }}</li>
            @endforeach
        </ol>

        <h3>Chuẩn đầu ra mong đợi</h3>
        <ul>
            <li>Tạo được route, controller và view đúng quy ước Laravel.</li>
            <li>Hiển thị và xử lý dữ liệu cơ bản bằng PHP trong ngữ cảnh Laravel.</li>
            <li>Thiết kế được trang có layout chung, nội dung rõ ràng và không lỗi chính tả.</li>
            <li>Hoàn thành bài tập thực hành với cấu trúc code gọn, dễ đọc và dễ bảo trì.</li>
        </ul>
    </x-card>
@endsection

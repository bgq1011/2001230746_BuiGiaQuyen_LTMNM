<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TinTucRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    // [Bài tập 03 & 05 & 06 & 07]: Khai báo quy tắc kiểm tra Form Request Validation
    public function rules(): array
    {
        return [
            'tieude' => ['required', 'string', 'max:200'], // [Bài tập 03]
            'slug' => ['nullable', 'string', 'max:255', 'alpha_dash'], // [Bài tập 06]
            'tomtat' => ['nullable', 'string', 'max:300'],
            'noidung' => ['required', 'string'], // [Bài tập 03]
            'ngaydang' => ['nullable', 'date'],
            'danhmuc_id' => ['nullable', 'exists:danh_mucs,id'],
            'trang_thai' => ['nullable', 'in:draft,published'], // [Bài tập 05]
            'hinhanh_up' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'], // [Bài tập 03]
        ];
    }

    public function messages(): array
    {
        return [
            'tieude.required' => 'Tiêu đề bắt buộc.',
            'tieude.max' => 'Tiêu đề tối đa :max ký tự.',
            'tomtat.max' => 'Tóm tắt tối đa :max ký tự.',
            'noidung.required' => 'Nội dung bắt buộc.',
            'hinhanh_up.image' => 'Tệp phải là ảnh.',
            'hinhanh_up.mimes' => 'Định dạng cho phép: jpg, jpeg, png, webp.',
            'hinhanh_up.max' => 'Kích thước tối đa 2MB.',
        ];
    }
}

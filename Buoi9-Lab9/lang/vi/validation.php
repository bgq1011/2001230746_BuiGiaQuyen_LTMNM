<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    */

    'required' => 'Trường :attribute không được để trống.',
    'email' => 'Trường :attribute phải là một địa chỉ email hợp lệ.',
    'max' => [
        'numeric' => 'Trường :attribute không được lớn hơn :max.',
        'file' => 'Dung lượng :attribute không được vượt quá :max kilobytes.',
        'string' => 'Trường :attribute không được quá :max ký tự.',
        'array' => 'Trường :attribute không được có nhiều hơn :max phần tử.',
    ],
    'min' => [
        'numeric' => 'Trường :attribute phải tối thiểu là :min.',
        'file' => 'Dung lượng :attribute phải tối thiểu :min kilobytes.',
        'string' => 'Trường :attribute phải có ít nhất :min ký tự.',
        'array' => 'Trường :attribute phải có ít nhất :min phần tử.',
    ],
    'unique' => 'Trường :attribute đã tồn tại trên hệ thống.',
    'confirmed' => 'Xác nhận :attribute không khớp.',
    'image' => 'Trường :attribute phải là định dạng hình ảnh.',
    'mimes' => 'Trường :attribute phải là file thuộc định dạng: :values.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    */

    'attributes' => [
        'title' => 'tiêu đề',
        'body' => 'nội dung',
        'tags' => 'thẻ (tags)',
        'image' => 'hình ảnh',
        'email' => 'địa chỉ email',
        'password' => 'mật khẩu',
        'name' => 'họ và tên',
    ],

];

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DanhMucRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->route('danhmuc')?->id ?? $this->route('danhmuc');
        if (is_object($id)) {
            $id = $id->id;
        }

        return [
            'ten' => ['required', 'string', 'max:150', "unique:danh_mucs,ten,{$id}"],
            'slug' => ['nullable', 'string', 'max:160', 'alpha_dash', "unique:danh_mucs,slug,{$id}"],
        ];
    }

    public function messages(): array
    {
        return [
            'ten.required' => 'Tên danh mục bắt buộc.',
            'ten.unique' => 'Tên danh mục đã tồn tại.',
            'slug.required' => 'Slug bắt buộc.',
            'slug.alpha_dash' => 'Slug chỉ gồm chữ, số, gạch ngang, gạch dưới.',
            'slug.unique' => 'Slug đã tồn tại.',
        ];
    }
}

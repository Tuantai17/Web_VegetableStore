<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTopictRequest extends FormRequest
{
    /**
     * Xác định người dùng có quyền gửi request không.
     */
    public function authorize(): bool
    {
        return true; // Cho phép request
    }

    /**
     * Luật kiểm tra dữ liệu nhập vào.
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:topic,slug',
        ];
    }

    /**
     * Tuỳ chỉnh thông báo lỗi (không bắt buộc)
     */
    public function messages()
    {
        return [
            'name.required' => 'Tên chủ đề không được để trống.',
            'name.max' => 'Tên chủ đề quá dài.',
            'slug.unique' => 'Slug đã tồn tại.',
        ];
    }
}

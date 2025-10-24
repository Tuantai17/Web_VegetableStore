<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    /**
     * Xác nhận người dùng có quyền gửi request không.
     */
    public function authorize(): bool
    {
        return true; // Cho phép gửi request
    }

    /**
     * Các quy tắc kiểm tra dữ liệu gửi lên.
     */
    public function rules(): array
    {
        return [
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:user,email',
            'password' => 'required|string|min:6|confirmed', // phải có cả password_confirmation
            'roles'    => 'nullable|in:customer,admin',     
            'status'   => 'nullable|boolean',
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'       => 'required|unique:category',
            'sort_order' => 'required|integer',
            'parent_id'  => 'nullable|integer',
            'status'     => 'required|in:0,1',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'       => 'Tên danh mục không được để trống',
            'name.unique'         => 'Tên danh mục đã tồn tại',
            'sort_order.required' => 'Vị trí sắp xếp không được để trống',
            'sort_order.integer'  => 'Vị trí sắp xếp phải là số',
            'parent_id.integer'   => 'Danh mục cha không hợp lệ',
            'status.required'     => 'Trạng thái không được để trống',
            'status.in'           => 'Trạng thái không hợp lệ',
        ];
    }
}

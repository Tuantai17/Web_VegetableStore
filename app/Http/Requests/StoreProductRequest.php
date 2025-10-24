<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'        => 'required|unique:product',
            'thumbnail'   => 'nullable|image|mimes:jpeg,png,jpg,gif,webp',
            'detail'      => 'required',
            'category_id' => 'required',
            'brand_id'    => 'required',
            'price_root'  => 'required',
            'price_sale'  => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'        => 'Tên không để trống',
            'name.unique'          => 'Tên đã tồn tại',
            'thumbnail.image'      => 'Không phải hình',
            'thumbnail.mimes'      => 'Định dạng tập tin không đúng',
            'detail.required'      => 'Chi tiết không để trống',
            'category_id.required' => 'Chưa chọn danh mục',
            'brand_id.required'    => 'Chưa chọn thương hiệu',
            'price_root.required'  => 'Giá bán không để trống',
            'price_sale.required'  => 'Giá khuyến khích không để trống',
        ];
    }
}

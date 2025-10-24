<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'detail' => 'required|string',
            'description' => 'nullable|string|max:500',
            'topic_id' => 'required|exists:topics,id',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Tiêu đề không được để trống',
            'detail.required' => 'Nội dung chi tiết bắt buộc',
            'topic_id.required' => 'Chủ đề là bắt buộc',
            'topic_id.exists' => 'Chủ đề không tồn tại',
            'thumbnail.image' => 'Ảnh đại diện phải là hình ảnh',
            'thumbnail.mimes' => 'Ảnh phải có định dạng jpeg, png, jpg, gif, webp',
            'thumbnail.max' => 'Ảnh đại diện tối đa 2MB',
        ];
    }
}

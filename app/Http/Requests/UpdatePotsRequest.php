<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
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
            'detail.required' => 'Nội dung bài viết là bắt buộc',
            'topic_id.required' => 'Chủ đề là bắt buộc',
            'topic_id.exists' => 'Chủ đề không tồn tại',
            'thumbnail.image' => 'Ảnh đại diện không hợp lệ',
            'thumbnail.mimes' => 'Định dạng ảnh không đúng (jpeg, png, jpg, gif, webp)',
        ];
    }
}

<?php

namespace App\Http\Requests;

use App\Enums\PostStatus;
use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'image' => 'nullable|mimes:jpg,jpeg,png,gif|max:2048',
            'category_id' => 'required|exists:categories,id',
            'title' => 'required',
            'content' => 'required',
            'status' => 'required|in:'.implode(',', array_column(PostStatus::cases(), 'value')),
        ];
    }
}

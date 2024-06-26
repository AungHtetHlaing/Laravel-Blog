<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateArticleRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|min:10|max:255|unique:articles,title,' . $this->route('article')->id,
            'description' => 'required|min:10',
            'category' => "required|exists:categories,id",
            'photos.*' => "mimes:png,jpg|file|max:512",
            'featured_image' => 'nullable|file|max:512'
        ];
    }
}
